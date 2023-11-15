<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workday_id = $conn->real_escape_string($_POST['workday_id']);

    // Obtener datos del usuario
    $sqlUsuario = "SELECT * FROM usuarios WHERE workday_id = '$workday_id'";
    $resultadoUsuario = $conn->query($sqlUsuario);

    // Obtener accesorios del usuario
    $sqlAccesorios = "SELECT * FROM accesorios WHERE workday_id = '$workday_id'";
    $resultadoAccesorios = $conn->query($sqlAccesorios);

    if ($resultadoUsuario->num_rows > 0) {
        $usuario = $resultadoUsuario->fetch_assoc();
        $accesorios = $resultadoAccesorios->fetch_all(MYSQLI_ASSOC);

        // Combinar los datos del usuario y sus accesorios
        $datosCompletos = array("usuario" => $usuario, "accesorios" => $accesorios);

        echo json_encode($datosCompletos);
    } else {
        echo json_encode(array("error" => "Usuario no encontrado"));
    }

    $conn->close();
}
?>
