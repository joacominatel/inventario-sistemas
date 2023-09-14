<?php
require_once 'db_connection.php';


$workday_id = $_POST["workday_id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$serie = $_POST["serie"];

    
$query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', marca = '$marca', modelo = '$modelo', serie = '$serie' WHERE workday_id = '$workday_id'";

if ($conn->query($query) === TRUE) {
    echo "Actualizado correctamente";
    header("refresh:2; url=../index.html");
} else {
    echo "Error actualizando usuario: " . $conn->error;
}
    
$conn->close();
?>