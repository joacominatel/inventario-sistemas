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
    <title>Inventario Dentsu | Usuarios</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Dentsu</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="/inventario-sistemas"><i class='bx bxs-dashboard'></i>Inicio</a></li>
            <li class="active"><a href="/inventario-sistemas/usuarios.php"><i class='bx bx-group'></i>Usuarios</a></li>
            <li><a href="/inventario-sistemas/usuarios_borrados.php"><i class='bx bx-analyse'></i>Borrados</a></li>
            <li><a href="/inventario-sistemas/accesorios.php"><i class='bx bx-message-square-dots'></i>Accesorios</a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <nav>
            <i class='fas fa-bars-staggered'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
        </nav>
        <main>
            <div class="bottom-data">
                <div class="user-info">
                    <div class="header">
                        <i class='fas fa-users'></i>
                        <h3>Usuarios</h3>
                        <div class="search">
                            <input id="search" type="search" placeholder="Buscar...">
                        </div>
                        <div class="functions">
                            <i id="add-user" class="fas fa-plus"></i>
                            <i id="delete-user" class="fas fa-trash"></i>
                        </div>
                    </div>
                    <div id="search-results">
                        <!-- <div class="search-result-item">
                            <span>nombre apellido (workday_id)</span>
                            <div class="search-result-item-actions">
                                <i class="fas fa-edit"></i>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </main>

    </div>
    <div class="form-create-user" id="form-create-user">
        <form class="form-ingresar" action="php/insertar.php" method="post">
            <input type="workday_id" name="workday_id" id="workday_id" placeholder="Workday ID" required />
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required />
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" required />
            <input type="text" name="marca" id="marca" placeholder="Marca" required />
            <input type="text" name="modelo" id="modelo" placeholder="Modelo" required />
            <input type="text" name="serie" id="serie" placeholder="Numero de Serie" required />
            <input type="text" name="mail" id="mail" placeholder="Mail" />
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" />
            <input type="submit" value="Enviar" id="form-post-button" />
        </form>
    </div>

    <div id="editUserModal" style="display: none;" class="form-create-user">
        <form id="editUserForm">
            <input type="hidden" id="edit-workday_id" name="workday_id">
            <input type="text" id="edit-nombre" name="nombre" placeholder="Nombre">
            <input type="text" id="edit-apellido" name="apellido" placeholder="Apellido">
            <input type="text" id="edit-marca" name="marca" placeholder="Marca">
            <input type="text" id="edit-modelo" name="modelo" placeholder="Modelo">
            <input type="text" id="edit-serie" name="serie" placeholder="Serie">
            <input type="text" id="edit-mail" name="mail" placeholder="Mail">
            <input type="text" id="edit-usuario" name="usuario" placeholder="Usuario">
            <button type="button" id="updateUser">Actualizar Usuario</button>
            <button type="button" id="cancelUpdate">Cancelar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/users.js"></script>
</body>

</html>