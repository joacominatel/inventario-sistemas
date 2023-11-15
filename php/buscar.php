<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $conn->real_escape_string($_POST['workday_id']);

    $sql = "SELECT workday_id, nombre, apellido, marca, modelo, serie, mail, usuario FROM usuarios WHERE workday_id = '$workday_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Suponiendo que solo hay un resultado
        $userData = $result->fetch_assoc();
        echo json_encode($userData);
    } else {
        echo json_encode(array("error" => "Usuario no encontrado"));
    }

    $conn->close();
}
?>
