<?php
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $_POST["workday_id"];
    $nombre = $_POST["nombre"];
    $accesorio = $_POST["accesorio"];
    $ticket = $_POST["ticket"];

    $sql = "INSERT INTO accesorios (workday_id, nombre, accesorio, ticket, detalle) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $workday_id, $nombre, $accesorio, $ticket, $detalle);

    $workday_id = $_POST["workday_id"];
    $nombre = $_POST["nombre"];
    $accesorio = $_POST["accesorio"];
    $ticket = $_POST["ticket"];
    $detalle = $_POST["detalle"];

    if ($stmt->execute()) {
        header("Location: ../index.html");
        exit(); 
    } else {
        echo "Error al insertar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>