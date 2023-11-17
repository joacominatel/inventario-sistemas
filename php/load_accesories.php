<?php
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (is_array($_POST['accesorio'])) {
        $accesorios = array_map(function($item) use ($conn) {
            return $conn->real_escape_string($item);
        }, $_POST['accesorio']);
        
        $placeholders = implode(',', array_fill(0, count($accesorios), '?'));
        $types = str_repeat('s', count($accesorios));
        
        $stmt = $conn->prepare("SELECT workday_id, nombre, accesorio, detalle FROM accesorios WHERE accesorio IN ($placeholders) ");
        $stmt->bind_param($types, ...$accesorios);
    } else {
        $accesorio = $conn->real_escape_string($_POST['accesorio']);
        $stmt = $conn->prepare("SELECT workday_id, nombre, accesorio, detalle FROM accesorios WHERE accesorio = ?");
        $stmt->bind_param("s", $accesorio);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $accesorios = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($accesorios);
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
