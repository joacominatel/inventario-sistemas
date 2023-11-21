<?php
include_once './php/db_connection.php';

// obtener cantidad de accesorios donde la columna sea accesorio y el valor sea monitor
$sql = "SELECT COUNT(*) AS total FROM accesorios WHERE accesorio = 'monitor'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_monitores = $row['total'];

// Celular
$sql = "SELECT COUNT(*) AS total FROM accesorios WHERE accesorio = 'celular'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_celulares = $row['total'];

// Auriculares
$sql = "SELECT COUNT(*) AS total FROM accesorios WHERE accesorio = 'auriculares'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_auriculares = $row['total'];

// Otros + mouse + silla
$sql = "SELECT COUNT(*) AS total FROM accesorios WHERE accesorio = 'otros' OR accesorio = 'mouse' OR accesorio = 'silla'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_otros = $row['total'];
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
    <title>Inventario Dentsu | Accesorios</title>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme') || 'light'; 
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Dentsu</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="./index.php"><i class='bx bxs-dashboard'></i>Inicio</a></li>
            <li><a href="./usuarios.php"><i class='bx bx-group'></i>Usuarios</a></li>
            <li><a href="./usuarios_borrados.php"><i class='bx bx-analyse'></i>Borrados</a></li>
            <li class="active"><a href="./accesorios.php"><i class='bx bx-message-square-dots'></i>Accesorios</a></li>
        </ul>
        <ul class="side-menu">
            <!-- <li>
                <a href="#" class="login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </a>
            </li> -->
        </ul>
    </div>

    <div class="content">
        <nav>
            <i class='fas fa-bars-staggered'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
        </nav>

        <main>
            <ul class="insights">
                <li class="accesorios-item" data-accesorio="monitor">
                    <i class="fa-solid fa-desktop"></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_monitores; ?>
                        </h3>
                        <p>Monitores</p>
                    </span>
                </li>
                <li class="accesorios-item" data-accesorio="celular">
                    <i class='fas fa-phone'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_celulares; ?>
                        </h3>
                        <p>Celulares</p>
                    </span>
                </li>
                <li class="accesorios-item" data-accesorio="auriculares"><i class='fas fa-headphones'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_auriculares; ?>
                        </h3>
                        <p>Auriculares</p>
                    </span>
                </li>
                <li class="accesorios-item" data-accesorio="otros"><i class='fas fa-computer-mouse'></i>
                    <span class="info">
                        <h3>
                            <?php echo $total_otros; ?>
                        </h3>
                        <p>Otros</p>
                    </span>
                </li>
            </ul>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <h2>Accesorios</h2>
                        <div class="functions">
                            <i id="add-accessory" class="fas fa-plus"></i>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Workday ID</th>
                                <th>Nombre</th>
                                <th>Accesorio</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody id="bottom-data-accesorios">
                            <!-- <tr>
                                <td>workday_id</td>
                                <td>nombre</td>
                                <td>accesorio</td>
                                <td>detalle</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div class="agregar-accesorio" id="agregar-accesorio">
        <h2>Agregar Accesorio</h2>
        <i id="close-add-accessory" class="fas fa-times"></i>
        <form action="php/add_accesory.php" class="form-agregar-accesorio">
            <input type="text" name="workday_id" id="workday_id" placeholder="Workday ID" required>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre y apellido" required>
            <select name="accesorio" id="accesorio" required>
                <option value="" disabled selected>Accesorio</option>
                <option value="Monitor">Monitor</option>
                <option value="Celular">Celular</option>
                <option value="Auriculares">Auriculares</option>
                <option value="Mouse">Mouse</option>
                <option value="Silla">Silla</option>
                <option value="otros">Otros</option>
            </select>
            <input type="text" name="detalle" id="detalle" placeholder="Detalle" required>
            <input type="text" name="ticket" id="ticket" placeholder="Ticket">
            <input type="submit" value="Agregar">
        </form>
    </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./js/app.js"></script>
        <script src="./js/accesorios.js"></script>
</body>

</html>