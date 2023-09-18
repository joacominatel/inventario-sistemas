<?php
include_once 'db_connection.php';

if (
    isset($_POST['workday_id']) &&
    isset($_POST['auriculares']) &&
    isset($_POST['monitor']) &&
    isset($_POST['mouse']) &&
    isset($_POST['teclado']) &&
    isset($_POST['otros'])
) {
    $workday_id = mysqli_real_escape_string($conn, $_POST['workday_id']);
    $auriculares = intval($_POST['auriculares']);
    $monitor = intval($_POST['monitor']);
    $mouse = intval($_POST['mouse']);
    $teclado = intval($_POST['teclado']);
    $otros = intval($_POST['otros']);

    // Crea una consulta preparada para actualizar la tabla "accesorios"
    $sql = "UPDATE accesorios SET 
            auriculares = ?,
            monitor = ?,
            mouse = ?,
            teclado = ?,
            otros = ?
            WHERE workday_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iiiiis', $auriculares, $monitor, $mouse, $teclado, $otros, $workday_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Cambios guardados con éxito. <a href='../index.html'>Volver</a>";
        echo "<h2>Workday ID: $workday_id</h2>";
    } else {
        echo "Error al guardar cambios: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    $conn->close();
} else {
    echo "Faltan campos requeridos o están vacíos.";
}
?>
