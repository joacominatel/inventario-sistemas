<?php
include_once '../php/db_connection.php';

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

    // Verificar si el workday_id ya existe en la base de datos
    $check_sql = "SELECT COUNT(*) FROM usuarios WHERE workday_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $workday_id);
    $check_stmt->execute();
    $check_stmt->bind_result($existing_count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($existing_count > 0) {
        // El workday_id ya existe, actualizar los datos
        $update_sql = "UPDATE usuarios SET nombre=?, apellido=?, marca=?, modelo=?, serie=? WHERE workday_id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssi", $nombre, $apellido, $marca, $modelo, $serie, $workday_id);

        if ($update_stmt->execute()) {
            echo "Datos actualizados con éxito";
        } else {
            echo "Error al actualizar datos: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        $insert_sql = "INSERT INTO usuarios (workday_id, nombre, apellido, marca, modelo, serie) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("isssss", $workday_id, $nombre, $apellido, $marca, $modelo, $serie);

        if ($insert_stmt->execute()) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "Ok. 200";
} else {
    echo "error: " . $_SERVER['REQUEST_METHOD'] . " no es un método válido";
}

$conn->close();
?>
