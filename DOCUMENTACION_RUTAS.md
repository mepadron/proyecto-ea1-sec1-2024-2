# Documentación de Implementación: Rutas Amigables y Ruteo en PHP

Esta guía explica los cambios realizados para implementar un sistema de navegación basado en rutas amigables (Friendly URLs) en el proyecto.

## 1. Configuración del Servidor (`.htaccess`)
Se creó este archivo para interceptar todas las peticiones que no sean archivos físicos (imágenes, CSS) y redirigirlas al controlador frontal.

```apache
RewriteEngine On

# Permitir el acceso directo a archivos y directorios existentes
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Redirigir todas las demás peticiones a index.php
RewriteRule ^(.*)$ index.php [QSA,L]
```

## 2. Controlador Frontal y Router (`index.php`)
Se transformó el `index.php` original en un **Front Controller**. Ahora analiza la URL solicitada y carga la vista correspondiente.

```php
<?php
// Manejo de archivos estáticos
$requested_uri = $_SERVER['REQUEST_URI'];
if (strpos($requested_uri, '/public/') !== false) {
    $path_parts = explode('/public/', $requested_uri);
    $file_path = __DIR__ . '/public/' . end($path_parts);
    if (file_exists($file_path) && is_file($file_path)) {
        return false; 
    }
}

// Lógica de Ruteo
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$route = str_replace($script_name, '', $requested_uri);
$route = trim($route, '/');
$route = explode('?', $route)[0]; // Ignorar parámetros GET en la ruta

switch ($route) {
    case '':
    case 'login':
        require_once "view/validar_view.php";
        break;
    
    case 'home':
        require_once "view/home_view.php";
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        echo "<a href='login'>Volver al inicio</a>";
        break;
}
```

## 3. Nueva Vista de Éxito (`view/home_view.php`)
Se creó una nueva interfaz para mostrarla cuando el usuario se autentica correctamente.

```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Dashboard</title>
    <link rel="stylesheet" href="public/simple.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Sistema</h1>
    </header>
    <main>
        <p>Has iniciado sesión correctamente.</p>
        <a href="login" class="button">Cerrar Sesión (Volver)</a>
    </main>
</body>
</html>
```

## 4. Modificaciones en la Vista de Login (`view/validar_view.php`)
Se realizaron cambios críticos para permitir la navegación:
- **Eliminación de `echo` prematuro**: Se quitó un `echo "<br>"` que impedía el funcionamiento de la función `header()`.
- **Redirección**: Al validar las credenciales, se usa `header("Location: home")`.
- **Rutas Relativas**: Se ajustaron los enlaces a CSS para que funcionen desde cualquier URL.

```php
if (isset($_POST['submit'])) {
    $objetct = new ValidarUsuario();
    $response = $objetct->login($_POST['usuario'], $_POST['password']);

    if ($response) {
        header("Location: home");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
```

## Resumen de Flujo
1. El usuario entra a `/login`.
2. El servidor redirige internamente a `index.php`.
3. `index.php` carga `view/validar_view.php`.
4. El usuario envía sus datos.
5. Si son correctos, PHP envía una cabecera de redirección a `/home`.
6. El navegador pide `/home`, el router lo detecta y carga `view/home_view.php`.
