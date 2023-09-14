<?php
require_once 'db_connection.php';

$serie = $_POST['serie'];

// Verificar si se envió un ID válido
if(isset($serie) && is_numeric($serie)) {
    $sql = "SELECT * FROM usuarios WHERE serie = $serie";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Detalle de Usuario</title>
            <link rel="stylesheet" href="../css/styles.css">
        </head>
        <body>
                <form action="update_user.php" method="post">
                    <label for="workday_id">Workday ID:</label>
                    <input type="text" name="workday_id" value="<?php echo $row['serie']; ?>" required>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" required>
                    <label for="marca">Marca:</label>
                    <input type="text" name="marca" value="<?php echo $row['marca']; ?>" required>
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" value="<?php echo $row['modelo']; ?>" required>
                    <label for="serie">Numero de serie:</label>
                    <input type="text" name="serie" value="<?php echo $row['serie']; ?>">

                    <button class="btn-modify" type="submit">Modificar Usuario</button>
                </form>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontraron datos para el ID proporcionado.";
    }

    // Liberar resultado
    mysqli_free_result($result);

} else {
    echo "ID no válido. $serie";
}

mysqli_close($conn);
?>