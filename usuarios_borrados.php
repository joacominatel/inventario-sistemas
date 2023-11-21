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
    <title>Inventario Dentsu | Usuarios borrados</title>
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
            <li ><a href="./usuarios.php"><i class='bx bx-group'></i>Usuarios</a></li>
            <li class="active"><a href="./usuarios_borrados.php"><i class='bx bx-analyse'></i>Borrados</a></li>
            <li><a href="./accesorios.php"><i class='bx bx-message-square-dots'></i>Accesorios</a></li>
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
        <div class="bottom-data">
                <div class="user-info"> 
                    <div class="header">
                        <i class='fas fa-user-lock'></i>
                        <h3>Usuarios borrados</h3>
                        <div class="search">
                            <input id="search" type="search" placeholder="Buscar...">
                        </div>
                    </div>
                    <div id="search-results">
                    
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./js/app.js"></script>
        <script src="./js/users-borrados.js"></script>
</body>

</html>