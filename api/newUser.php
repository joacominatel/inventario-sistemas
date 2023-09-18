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

    // Consulta para verificar si workday_id existe
    $sql = "SELECT workday_id FROM usuarios WHERE workday_id = '$workday_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Actualizar datos en la base de datos
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, marca = ?, modelo = ?, serie = ? WHERE workday_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $apellido, $marca, $modelo, $serie, $workday_id);
    } else {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $workday_id, $nombre, $apellido, $marca, $modelo, $serie);
    }

    if ($stmt->execute()) {
        echo "Datos insertados con éxito";

        $command = "python3 ../scripts/generate_log.py \"$sql\" $workday_id";
        $output = shell_exec($command);
        echo $output;
        
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