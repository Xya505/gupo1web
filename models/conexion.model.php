<?php
if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'klk');

class Conexion {
    private $mysqli;

    public function __construct() {
        // Crear una nueva instancia de mysqli y manejar la conexión
        $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Verificar si la conexión fue exitosa
        if ($this->mysqli->connect_error) {
            throw new Exception("No se pudo conectar con la base de datos: ". $this->mysqli->connect_error);
        }
    }

    public function prepare($query) {
        // Método para preparar consultas SQL utilizando prepared statements
        return $this->mysqli->prepare($query);
    }

    public function consultar($query) {
        // Método para ejecutar consultas SQL y retornar el resultado
        if (!$this->mysqli) {
            throw new Exception("La conexión no está establecida.");
        }

        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Error en la consulta: ". $this->mysqli->error);
        }
        return $result;
    }

    public function getConnection() {
        // Método para obtener la conexión activa
        return $this->mysqli;
    }
}
?>
