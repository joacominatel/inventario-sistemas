<?php
include_once 'db_connection.php';

// Obtener los valores del formulario
$workday_id = $_POST['workday_id'];
$auriculares = intval($_POST['auriculares']);
$monitor = intval($_POST['monitor']);
$mouse = intval($_POST['mouse']);
$teclado = intval($_POST['teclado']);
$otros = intval($_POST['otros']);

// Actualizar la tabla "accesorios" con los valores proporcionados
$sql = "UPDATE accesorios SET 
        auriculares = $auriculares,
        monitor = $monitor,
        mouse = $mouse,
        teclado = $teclado,
        otros = $otros
        WHERE workday_id = '$workday_id'";

if ($conn->query($sql) === TRUE) {
    echo "Cambios guardados con éxito. <a href='../index.html'>Volver</a>";
    echo "<h2>Workday ID: $workday_id</h2>";

} else {
    echo "Error al guardar cambios: " . $conn->error;
}

$conn->close();
?>
