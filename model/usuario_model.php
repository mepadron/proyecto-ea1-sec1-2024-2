<?php
require_once 'config/databases.php';

class ClientModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getEspeciality()
    {
        $sql = "
            SELECT * FROM `especialidades`
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
