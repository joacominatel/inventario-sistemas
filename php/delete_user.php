<?php
require_once 'db_connection.php';

$workday_id = $_POST['workday_id'];
echo $workday_id;

// Verificar si se envió un ID válido
if(isset($workday_id) && is_numeric($workday_id)) {
    $sql = "SELECT * FROM usuarios WHERE workday_id = $workday_id";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // mover a la base de datos de usuarios eliminados
        $sql = "INSERT INTO usuarios_borrados (workday_id, nombre, apellido, marca, modelo, serie, mail, usuario) VALUES ('$row[workday_id]', '$row[nombre]', '$row[apellido]', '$row[marca]', '$row[modelo]', '$row[serie]', '$row[mail]', '$row[usuario]')";
        $result = mysqli_query($conn, $sql);
        $sql = "DELETE FROM usuarios WHERE workday_id = $workday_id";
        $result = mysqli_query($conn, $sql);
        echo "Usuario eliminado correctamente.";

        // retornar despues de 2 segundos
        header('Refresh: 2; URL = ../index.html');
    } else {
        echo "No se encontraron datos para el ID proporcionado.";
    }

    mysqli_free_result($result);

} else {
    echo "ID no válido. $workday_id";
}

mysqli_close($conn);
?>