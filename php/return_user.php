<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $conn->real_escape_string($_POST['workday_id']);

    $conn->begin_transaction();

    try {
        // Mover el usuario de vuelta a la tabla 'usuarios'
        $sql = "INSERT INTO usuarios SELECT * FROM usuarios_borrados WHERE workday_id = '$workday_id'";
        $conn->query($sql);

        $sql = "DELETE FROM usuarios_borrados WHERE workday_id = '$workday_id'";
        $conn->query($sql);

        $conn->commit();
        echo "Usuario devuelto con éxito";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al devolver usuario: " . $e->getMessage();
    }

    $conn->close();
}
?>
