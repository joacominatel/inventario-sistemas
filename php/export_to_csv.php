<?php
include './db_connection.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=usuarios.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('workday_id', 'nombre', 'apellido', 'marca', 'modelo', 'serie', 'mail', 'usuario'));

$query = "SELECT workday_id, nombre, apellido, marca, modelo, serie, mail, usuario FROM usuarios";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($connection);
?>
