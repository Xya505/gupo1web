<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'login');

class Conexion {
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Verificar si la conexión fue exitosa
        if ($this->mysqli->connect_error) {
            throw new Exception("No se pudo conectar con la base de datos: ". $this->mysqli->connect_error);
        }

        /*else {
            echo "Conexión establecida correctamente.";
        }*/
    }

    public function consultar($query) {
        if (!$this->mysqli) {
            throw new Exception("La conexión no está establecida.");
        }

        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Error en la consulta: ". $this->mysqli->error);
        }
        return $result;
    }

    public function __destruct() {
        $this->mysqli->close();
    }
}
