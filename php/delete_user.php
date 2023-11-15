<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $conn->real_escape_string($_POST['workday_id']);

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        $sql = "INSERT INTO usuarios_borrados SELECT * FROM usuarios WHERE workday_id = '$workday_id'";
        $conn->query($sql);

        $sql = "DELETE FROM usuarios WHERE workday_id = '$workday_id'";
        $conn->query($sql);

        $conn->commit();
        echo "Usuario borrado con éxito";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al borrar usuario: " . $e->getMessage();
    }

    $conn->close();
}
?>
