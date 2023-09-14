<?php
include 'db_connection.php';

$nombre = $_POST['workday_id'];
$cantidad = $_POST['nombre'];
$precio = $_POST['apellido'];
$descripcion = $_POST['marca'];
$imagen = $_POST['modelo'];
$serie = $_POST['serie'];

// Insertar los datos en la tabla 'usuarios'
$sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie) VALUES ('$nombre', '$cantidad', '$precio', '$descripcion', '$imagen', '$serie')";

if ($conn->query($sql) === TRUE) {
    echo "Datos ingresados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: ../index.html");
?>