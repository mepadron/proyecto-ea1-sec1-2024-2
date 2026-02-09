<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Permitir servir archivos estáticos desde /public/
$requested_uri = $_SERVER['REQUEST_URI'];
$query_string_pos = strpos($requested_uri, '?');
if ($query_string_pos !== false) {
    $requested_uri = substr($requested_uri, 0, $query_string_pos);
}

// Limpiar la ruta para el router (quitar el slash inicial y subcarpetas si existen)
// Esto asume que el proyecto está en la raíz o manejamos la ruta relativa
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$route = str_replace($script_name, '', $requested_uri);
$route = trim($route, '/');

// Si la solicitud es para un archivo dentro de /public/
if (strpos($requested_uri, '/public/') !== false) {
    $path_parts = explode('/public/', $requested_uri);
    $file_path = __DIR__ . '/public/' . end($path_parts);
    if (file_exists($file_path) && is_file($file_path)) {
        return false;
    }
}

// Sistema de ruteo simple
switch ($route) {
    case '':
    case 'login':
        require_once "view/validar_view.php";
        break;

    case 'home':
        require_once "controller/usuario_controler.php";
        $controller = new ClientController();
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        echo "<p>La ruta '$route' no existe.</p>";
        echo "<a href='login'>Volver al inicio</a>";
        break;
}
