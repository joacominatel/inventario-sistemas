<?php
require_once 'db_connection.php';

// Verifica que los campos requeridos estén presentes y no estén vacíos
if (
    isset($_POST["workday_id"]) &&
    isset($_POST["nombre"]) &&
    isset($_POST["apellido"]) &&
    isset($_POST["marca"]) &&
    isset($_POST["modelo"]) &&
    isset($_POST["serie"]) &&
    isset($_POST["mail"]) 
) {
    $workday_id = mysqli_real_escape_string($conn, $_POST["workday_id"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $apellido = mysqli_real_escape_string($conn, $_POST["apellido"]);
    $marca = mysqli_real_escape_string($conn, $_POST["marca"]);
    $modelo = mysqli_real_escape_string($conn, $_POST["modelo"]);
    $serie = mysqli_real_escape_string($conn, $_POST["serie"]);
    $mail = mysqli_real_escape_string($conn, $_POST["mail"]);

    // Crea una consulta preparada para actualizar los datos
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, marca = ?, modelo = ?, serie = ?, mail = ? WHERE workday_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $nombre, $apellido, $marca, $modelo, $serie, $mail, $workday_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Actualizado correctamente";
        header("refresh:2; url=../index.html");

        // Ejecuta un script Python para generar un registro de log
        $command = "python3 ../scripts/generate_log.py \"$query\" $workday_id";
        $output = shell_exec($command);
        echo $output;
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    $conn->close();
} else {
    echo "Faltan campos requeridos o están vacíos.";
}
?>
