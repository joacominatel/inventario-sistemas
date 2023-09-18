<?php
// Incluye el archivo de conexión a la base de datos
include_once("../../php/db_connection.php");

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']); // Evita la inyección SQL

    // Utiliza consultas preparadas para mayor seguridad
    $query = "SELECT * FROM usuarios WHERE CONCAT(nombre, ' ', apellido) LIKE ? OR nombre LIKE ? OR apellido LIKE ? OR workday_id LIKE ?";
    $stmt = mysqli_prepare($conn, $query);

    // Asocia los parámetros y realiza la búsqueda
    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, 'ssss', $searchParam, $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='resultado'>";
        echo "<ul>";
        $workday_id = htmlspecialchars($row['workday_id']); // Evita problemas de seguridad
        $nombre = htmlspecialchars($row['nombre']);
        $apellido = htmlspecialchars($row['apellido']);
        $marca = htmlspecialchars($row['marca']);
        $modelo = htmlspecialchars($row['modelo']);
        $serie = htmlspecialchars($row['serie']);
        echo "<li onclick='copiarAlPortapapeles(\"$workday_id\")'>Workday ID: <span class='listContent'>$workday_id</span></li>";
        echo "<li onclick='copiarAlPortapapeles(\"$nombre\")'>Nombre: <span class='listContent'>$nombre</span></li>";
        echo "<li onclick='copiarAlPortapapeles(\"$apellido\")'>Apellido: <span class='listContent'>$apellido</span></li>";
        if (!empty($marca) && !empty($modelo) && !empty($serie)) {
            $computadoraInfo = "$marca - $modelo - AR-$serie";
            echo "<li onclick='copiarAlPortapapeles(\"$computadoraInfo\")'>Computadora: <span class='listContent'>$computadoraInfo</span></li>";
        }
        echo "</ul>";
        echo "<button class='btn-borrar' onclick='borrarUsuario(\"$workday_id\")'>Borrar</button>";
        echo "</div>";
    }

    // Cierra la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
