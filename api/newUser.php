<?php
include_once '../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    // Obtener los valores del JSON
    $workday_id = $data->workday_id;
    $nombre = $data->nombre;
    $apellido = $data->apellido;
    $marca = $data->marca;
    $modelo = $data->modelo;
    $serie = $data->serie;
    $mail = $data->mail;
    $usuario = $data->usuario;

    $sql = "SELECT workday_id FROM usuarios WHERE workday_id = '$workday_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Actualizar datos en la base de datos
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, marca = ?, modelo = ?, serie = ?, mail = ?, usuario = ? WHERE workday_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nombre, $apellido, $marca, $modelo, $serie, $mail, $usuario, $workday_id);
    } else {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie, mail, usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $workday_id, $nombre, $apellido, $marca, $modelo, $serie, $mail, $usuario);
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
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuarios = array();
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            echo json_encode($usuarios);
        } else {
            echo "No se encontraron resultados";
        }
    } else {
    echo "error: " . $_SERVER['REQUEST_METHOD'] . " no es un método válido";
}

$conn->close();
?>