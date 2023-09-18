<?php
include 'db_connection.php';

// Verifica que los campos requeridos estén presentes y no estén vacíos
if (
    isset($_POST['workday_id']) &&
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['marca']) &&
    isset($_POST['modelo']) &&
    isset($_POST['serie'])
) {
    $workday_id = mysqli_real_escape_string($conn, $_POST['workday_id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $serie = mysqli_real_escape_string($conn, $_POST['serie']);

    // Crea una consulta preparada para insertar los datos en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssss', $workday_id, $nombre, $apellido, $marca, $modelo, $serie);

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
