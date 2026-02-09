<?php
require_once __DIR__ . '/../model/usuario_model.php';

class ClientController
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function index()
    {
        $especialidades = $this->model->getEspeciality();

        require_once __DIR__ . '/../view/home_view.php';
    }
}
