<?php
include './db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workday_id = $_POST['workday_id'];

    if (is_array($workday_id)) {
        foreach ($workday_id as $workday_id) {
            // mover a la tabla de usuarios_borrados
            $query = "INSERT INTO usuarios_borrados SELECT * FROM usuarios WHERE workday_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $workday_id);
            mysqli_stmt_execute($stmt);

            // eliminar de la tabla de usuarios
            $query = "DELETE FROM usuarios WHERE workday_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $workday_id);
            mysqli_stmt_execute($stmt);
            
        }
    }

    mysqli_close($conn);
    echo "Usuarios eliminados con éxito";
}
?>
