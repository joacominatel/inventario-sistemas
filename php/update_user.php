<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $conn->real_escape_string($_POST['workday_id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $serie = $conn->real_escape_string($_POST['serie']);
    $mail = $conn->real_escape_string($_POST['mail']);
    $usuario = $conn->real_escape_string($_POST['usuario']);

    $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', marca = '$marca', modelo = '$modelo', serie = '$serie', mail = '$mail', usuario = '$usuario' WHERE workday_id = '$workday_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado con éxito";
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }

    $conn->close();
}
?>
