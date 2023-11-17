<?php
include_once './php/db_connection.php';

// obtener cantidad de usuarios activos
$sql = "SELECT COUNT(*) AS total FROM usuarios";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_usuarios = $row['total'];

// obtener cantidad de usuarios borrados
$sql = "SELECT COUNT(*) AS total FROM usuarios_borrados";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_usuarios_borrados = $row['total'];

// obtener cantidad de accesorios
$sql = "SELECT COUNT(*) AS total FROM accesorios";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_accesorios = $row['total'];

// obtener usuarios recientemente creados (ultimos 3)
$sql = "SELECT * FROM usuarios ORDER BY workday_id DESC LIMIT 3";
$result = mysqli_query($conn, $sql);
$usuarios_recientes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    <title>Inventario Dentsu | Admin</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Dentsu</span></div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="/inventario-sistemas"><i class='bx bxs-dashboard'></i>Inicio</a></li>
            <li><a href="/inventario-sistemas/usuarios.php"><i class='bx bx-group'></i>Usuarios</a></li>
            <li><a href="/inventario-sistemas/usuarios_borrados.php"><i class='bx bx-analyse'></i>Borrados</a></li>
            <li><a href="/inventario-sistemas/accesorios.php"><i class='bx bx-message-square-dots'></i>Accesorios</a>
            </li>
        </ul>
        <!-- <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul> -->
    </div>

    <div class="content">
        <nav>
            <i class='fas fa-bars-staggered'></i>
            <div></div>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Inicio</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Datos
                            </a></li>
                        /
                        <li><a href="#" class="active">...</a></li>
                    </ul>
                </div>
                <a href="./php/export_to_csv.php" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Descargar CSV</span>
                </a>
            </div>

            <ul class="insights">
                <li>
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_usuarios + $total_usuarios_borrados; ?>
                        </h3>
                        <p>Usuarios totales</p>
                    </span>
                </li>
                <li><i class='fas fa-check'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_usuarios; ?>
                        </h3>
                        <p>Usuarios activos</p>
                    </span>
                </li>
                <li><i class='fas fa-trash'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_usuarios_borrados; ?>
                        </h3>
                        <p>Usuarios borrados</p>
                    </span>
                </li>
                <li><i class='fas fa-headphones'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_accesorios; ?>
                        </h3>
                        <p>Accesorios</p>
                    </span>
                </li>
            </ul>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Usuarios modificados recientemente</h3>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Cambios</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                $sql = "SELECT * FROM tabla_auditoria WHERE tabla = 'usuarios' ORDER BY timestamp DESC LIMIT 3";
                $resultado = mysqli_query($conn, $sql);

                while($fila = mysqli_fetch_assoc($resultado)) {
                    $datos = $fila['accion'] == 'Borrado' ? $fila['datos_antiguos'] : $fila['datos_nuevos'];
                    $accion = $fila['accion'];
                    $datosNuevos = $fila['accion'] != 'Borrado' ? $fila['datos_nuevos'] : '';
                
                    // Ajuste de la expresión regular para coincidir con el formato proporcionado
                    if (preg_match("/Nombre: (.*?), Apellido: (.*?),/", $datos, $matches)) {
                        $nombre = $matches[1];
                        $apellido = $matches[2];
                    } else {
                        // Valores por defecto en caso de no encontrar coincidencias
                        $nombre = "Desconocido";
                        $apellido = "Desconocido";
                    }
                
                    // Determinar la clase del estado basado en la acción
                    $estadoClase = '';
                    switch ($fila['accion']) {
                        case 'Creado':
                            $estadoClase = 'status completed';
                            break;
                        case 'Modificado':
                            $estadoClase = 'status process';
                            break;
                        case 'Borrado':
                            $estadoClase = 'status pending';
                            break;
                    }
                
                    echo "<tr>";
                    echo "<td><p>{$nombre} {$apellido}</p></td>";
                    echo "<td>$datosNuevos</td>";
                    echo "<td><span class='$estadoClase'>{$fila['accion']}</span></td>";
                    echo "</tr>";
                }
                
                ?>
                        </tbody>
                    </table>
                </div>

                <!-- <div c lass="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Recordatorios</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-plus'></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>X</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Analyse Our Site</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="not-completed">
                            <div class="task-title">
                                <i class='bx bx-x-circle'></i>
                                <p>Play Footbal</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div> -->
            </div>

        </main>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>