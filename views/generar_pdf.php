<?php
require('../fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta según tu configuración
require_once('../models/conexion.model.php');

try {
    // Crear una instancia de la clase FPDF
    $pdf = new FPDF();

    // Agregar una página
    $pdf->AddPage();

    // Establecer el título del documento
    $pdf->SetTitle('Lista de Estudiantes');

    // Crear una instancia de la clase Conexion
    $conexion = new Conexion();

    // Obtener la conexión
    $conn = $conexion->getConnection();

    // Consulta SQL para obtener los datos de los estudiantes
    $sql = "SELECT e.id, e.nombre, e.correo, p.descripcion AS rol_descripcion
            FROM estudiante e
            JOIN permisos p ON e.rol = p.id";

    // Ejecutar la consulta y manejar los errores si los hay
    $result = $conexion->consultar($sql);

    if ($result->num_rows > 0) {
        // Encabezados de la tabla
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(20, 10, 'ID', 1);
        $pdf->Cell(50, 10, 'Nombre', 1);
        $pdf->Cell(50, 10, 'Correo', 1);
        $pdf->Cell(70, 10, 'Rol', 1);
        $pdf->Ln();

        // Datos de los estudiantes
        $pdf->SetFont('Arial', '', 12);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(20, 10, $row['id'], 1);
            $pdf->Cell(50, 10, $row['nombre'], 1);
            $pdf->Cell(50, 10, $row['correo'], 1);
            $pdf->Cell(70, 10, $row['rol_descripcion'], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(190, 10, 'No hay estudiantes registrados', 1, 0, 'C');
    }

    // Salida del documento PDF
    $pdf->Output('lista_estudiantes.pdf', 'I');

} catch (Exception $e) {
    // Capturar y mostrar cualquier excepción que ocurra durante la ejecución
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>


