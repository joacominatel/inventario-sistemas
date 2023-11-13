<?php
include_once "../php/db_connection.php";

$workday_id = $_GET['workday_id'];

$query = "SELECT * FROM usuarios WHERE workday_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $workday_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $marca = $row['marca'];
    $modelo = $row['modelo'];
    $serie = $row['serie'];
    $mail = $row['mail'];
} else {
    echo "No se encontraron resultados";
}

$computadora = "$marca - $modelo - $serie";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja de usuario</title>
    <link rel="stylesheet" href="../css/baja.css">
</head>
<body>
    <div class="logo">
        <h2>dentsu</h2>
        <p>Manuel Ugarte 1674, CABA (1428)</p>
        <p>Buenos Aires, Argentina</p>
        <p>+54 11 5194-5100</p>
    </div>
    <h1>Equipamiento de <span><?php echo "$nombre $apellido"; ?></span></h1>
    <div class="datos-de-usuario">
        <p>Workday ID: <span><?php echo $workday_id; ?></span></p>
        <p>Nombre: <span><?php echo $nombre; ?></span></p>
        <p>Apellido: <span><?php echo $apellido; ?></span></p>
        <p>Computadora: <span><?php echo $computadora; ?></span></p>
        <p>Mail: <span><?php echo $mail; ?></span></p>
    </div>
    <div class="equipo-devolver">
        <table class="tabla-equipo">
            <tbody>
                <tr>
                    <th>Equipo</th>
                    <th>Detalle</th>
                    <th>Devolucion</th>
                </tr>
                <tr>
                    <td contenteditable='true'><?php echo "$marca $modelo"; ?></td>
                    <td contenteditable='true'><?php echo $serie; ?></td>
                    <td><input type="date" name="fecha-devolucion" id="fecha-devolucion"></td>
                </tr>
                <?php 
                $query = "SELECT * FROM accesorios WHERE workday_id = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 's', $workday_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $accesorio = $row['accesorio'];
                        $detalle = $row['detalle'];
                        echo "<tr>";
                        echo "<td contenteditable='true'>$accesorio</td>";
                        echo "<td contenteditable='true'>$detalle</td>";
                        echo "<td contenteditable='true'><input type='date' name='fecha-devolucion' id='fecha-devolucion'></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>    
        </table>
        <button onclick="addRow()" class="add-row-button">+</button>
        <div class="firmas">
            <div class="firma-usuario">
                <img src="../img/firma-usuario.png" alt="Firma del usuario">
            </div>
            <div class="firma-admin">
                <img src="../img/firma-admin.png" alt="Firma del administrador">
            </div>
        </div>
        <button class="btn-imprimir" onclick="window.print()">Imprimir</button>
    </div>
    <script src="../js/baja.js"></script>
</body>
</html>