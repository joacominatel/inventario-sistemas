<?php
include_once '../php/db_connection.php';

// Verificar si la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer el JSON desde la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Obtener los valores del JSON
    $workday_id = $data->workday_id;
    $nombre = $data->nombre;
    $apellido = $data->apellido;
    $marca = $data->marca;
    $modelo = $data->modelo;
    $serie = $data->serie;

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $workday_id, $nombre, $apellido, $marca, $modelo, $serie);

    if ($stmt->execute()) {
        echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo "Ok. 200";
    } else {
    echo "error: " . $_SERVER['REQUEST_METHOD'] . " no es un método válido";
}

$conn->close();
?>