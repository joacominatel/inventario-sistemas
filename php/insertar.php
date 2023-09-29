<?php
include 'db_connection.php';

// Verifica que los campos requeridos estén presentes y no estén vacíos
if (
    isset($_POST['workday_id']) &&
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['marca']) &&
    isset($_POST['modelo']) &&
    isset($_POST['serie']) &&
    isset($_POST['mail']) &&
    isset($_POST['usuario'])
) {
    $workday_id = mysqli_real_escape_string($conn, $_POST['workday_id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $serie = mysqli_real_escape_string($conn, $_POST['serie']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

    // Crea una consulta preparada para insertar los datos en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie, mail, usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssss', $workday_id, $nombre, $apellido, $marca, $modelo, $serie, $mail, $usuario);

    if (mysqli_stmt_execute($stmt)) {
        echo "Datos ingresados correctamente";

        // Guarda logs
        $command = "python3 ../scripts/generate_log.py \"$sql\" $workday_id";
        $output = shell_exec($command);
        echo $output;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    $conn->close();
} else {
    echo "Faltan campos requeridos o están vacíos.";
}

header("Location: ../index.html");
?>
