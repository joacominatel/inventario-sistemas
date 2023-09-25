<?php
require_once 'db_connection.php';

$workday_id = $_POST['workday_id'];

// Verificar si se envió un ID válido
if(isset($workday_id) && is_numeric($workday_id)) {
    $sql = "SELECT * FROM usuarios WHERE workday_id = $workday_id";
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
                    <input type="text" name="workday_id" value="<?php echo $row['workday_id']; ?>" readonly>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>">
                    <label for="marca">Marca:</label>
                    <input type="text" name="marca" value="<?php echo $row['marca']; ?>">
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" value="<?php echo $row['modelo']; ?>">
                    <label for="serie">Numero de serie:</label>
                    <input type="text" name="serie" value="<?php echo $row['serie']; ?>">
                    <label for="mail">Mail:</label>
                    <input type="text" name="mail" value="<?php echo $row['mail']; ?>">
                    <div class="btns-buscar">
                        <button class="btn-modify" type="submit">Modificar Usuario</button>
                        <a class="btn-modify" href="../index.html">Volver</a>
                    </div>
                </form>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontraron datos para el ID proporcionado.";
    }

    mysqli_free_result($result);

} else {
    echo "ID no válido. $workday_id";
}

mysqli_close($conn);
?>