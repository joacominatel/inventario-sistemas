<?php
if (isset($_POST['workday_id'])) {
    include_once("../../php/db_connection.php");

    $workday_id = mysqli_real_escape_string($conn, $_POST['workday_id']);
    $query = "SELECT * FROM usuarios WHERE workday_id = '$workday_id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);

    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $marca = $row['marca'];
    $modelo = $row['modelo'];
    $serie = $row['serie'];
    $mail = $row['mail'];
    $usuario = $row['usuario'];

    // Utiliza prepared statements para evitar la inyección SQL
    $insert_query = "INSERT INTO usuarios_borrados (workday_id, nombre, apellido, marca, modelo, serie, mail, usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, 'ssssssss', $workday_id, $nombre, $apellido, $marca, $modelo, $serie, $mail, $usuario);

    if (mysqli_stmt_execute($insert_stmt)) {
        $delete_query = "DELETE FROM usuarios WHERE workday_id = ?";
        $delete_stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($delete_stmt, 's', $workday_id);

        if (mysqli_stmt_execute($delete_stmt)) {
            header("Location: ../../templates/rrhh.html");
        } else {
            die('Delete Query Error: ' . mysqli_error($conn));
        }
    } else {
        die('Insert Query Error: ' . mysqli_error($conn));
    }

    // Cierra las declaraciones preparadas y la conexión
    mysqli_stmt_close($insert_stmt);
    mysqli_stmt_close($delete_stmt);
    mysqli_close($conn);
} else {
    die('Error: No se recibió el ID del usuario a borrar');
}
?>
