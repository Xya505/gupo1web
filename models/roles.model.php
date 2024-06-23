<?php
require_once 'conexion.model.php';

class Roles {
    private $conn;
    private $table = 'roles';

    public function __construct() {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function obtenerRolesEstudiantes() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE nombre LIKE '%estudiante%'";
            $result = $this->conn->query($query);
            
            if ($result === false) {
                throw new Exception("Error al obtener roles de estudiantes: " . $this->conn->error);
            }
    
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            // Manejo de errores: puedes registrar el error, lanzar una excepción diferente, etc.
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>


