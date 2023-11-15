<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge y limpia los datos del formulario
    $workday_id = $conn->real_escape_string($_POST['workday_id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $serie = $conn->real_escape_string($_POST['serie']);
    $mail = $conn->real_escape_string($_POST['mail']);
    $usuario = $conn->real_escape_string($_POST['usuario']);

    $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie, mail, usuario) VALUES ('$workday_id', '$nombre', '$apellido', '$marca', '$modelo', '$serie', '$mail', '$usuario')";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
} else {
    echo "No se recibieron datos del formulario";
}
?>
