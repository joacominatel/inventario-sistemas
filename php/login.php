<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilos básicos para tu modal */
        .login-modal {
            display: block; /* O 'none' si deseas ocultarlo inicialmente */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* Añade tus propios estilos aquí */
    </style>
</head>
<body>

<div id="loginModal" class="login-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="loginForm" action="login.php" method="post">
            <label for="user">Usuario:</label>
            <input type="text" id="user" name="user" required><br><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="submitBtn" value="Iniciar Sesión">
            <!-- Puedes quitar el botón cancelar o manejarlo con JavaScript -->
        </form>
    </div>
</div>

<script>
    // JavaScript para manejar el cierre del modal
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('loginModal').style.display = 'none';
    });
</script>

</body>
</html>
<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: pagina_principal.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php'; // Asume que este archivo devuelve una variable $conn para la conexión

    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Aquí debes cambiar la consulta para que utilice una verificación de contraseña segura
    $query = "SELECT * FROM login WHERE user = '$user' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        if (password_verify($password, $userData['password'])) {
            $_SESSION['user'] = $user; // Guardar el usuario en la sesión
            header('Location: pagina_principal.php'); // Redirige a la página principal
            exit();
        } else {
            echo "<p>Usuario o contraseña incorrectos.</p>";
        }
    } else {
        echo "<p>Usuario o contraseña incorrectos.</p>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
}
?>
