<?php
include_once("../../php/db_connection.php");

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']); 

    $query = "SELECT * FROM usuarios WHERE CONCAT(nombre, ' ', apellido) LIKE ? OR nombre LIKE ? OR apellido LIKE ? OR workday_id LIKE ? OR mail LIKE ?";
    $stmt = mysqli_prepare($conn, $query);

    // Asocia los parámetros y realiza la búsqueda
    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, 'sssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='resultado'>";
            echo "<ul>";
            
                $workday_id = htmlspecialchars($row['workday_id']); 
                $nombre = htmlspecialchars($row['nombre']);
                $apellido = htmlspecialchars($row['apellido']);
                $marca = htmlspecialchars($row['marca']);
                $modelo = htmlspecialchars($row['modelo']);
                $serie = htmlspecialchars($row['serie']);
                $mail = htmlspecialchars($row['mail']);

                echo "<li onclick='copiarAlPortapapeles(\"$workday_id\")'>Workday ID: <span class='listContent'>$workday_id</span></li>";
                echo "<li onclick='copiarAlPortapapeles(\"$nombre\")'>Nombre: <span class='listContent'>$nombre</span></li>";
                echo "<li onclick='copiarAlPortapapeles(\"$apellido\")'>Apellido: <span class='listContent'>$apellido</span></li>";
                if (!empty($marca) && !empty($modelo) && !empty($serie)) {
                    $computadoraInfo = "$marca - $modelo - AR-$serie";
                    echo "<li onclick='copiarAlPortapapeles(\"$computadoraInfo\")'>Computadora: <span class='listContent'>$computadoraInfo</span></li>";
                }
            echo "</ul>";
            echo "<div class='btns'>";
                echo "<button class='btn-borrar' onclick='borrarUsuario(\"$workday_id\")'>Borrar</button>";
                echo "<button class='btn-verMas' onclick='abrirModal(\"$workday_id\")' data-workday_id='$workday_id'><i class=\"fa-solid fa-eye\"></i></button>";
            echo "</div>";
            echo "</div>";

        echo "<div id='modal-$workday_id' class='modal'>";
            echo "<div class='modal-content'>";
            echo "<span class='close' onclick='cerrarModal(\"$workday_id\")' data-workday_id='$workday_id'>&times;</span>";                
            echo "<ul>";
                    echo "<li>Workday ID: <span class='listContent'>$workday_id</span></li>";
                    echo "<li>Nombre: <span class='listContent'>$nombre</span></li>";
                    echo "<li>Apellido: <span class='listContent'>$apellido</span></li>";
                    if (!empty($marca) && !empty($modelo) && !empty($serie)) {
                        $computadoraInfo = "$marca - $modelo - AR-$serie";
                        echo "<li>Computadora: <span class='listContent'>$computadoraInfo</span></li>";
                    }
                    if (!empty($mail)) {
                        echo "<li>Mail: <span class='listContent'>$mail</span></li>";
                    } else {
                        echo "<li>Mail: <span class='listContent'> - </span></li>";
                    }

                    $sql_accesorios = "SELECT * FROM accesorios WHERE workday_id = '$workday_id'";
                    $result_accesorios = mysqli_query($conn, $sql_accesorios);

                    if (mysqli_num_rows($result_accesorios) > 0) {
                        echo "<li>Accesorios: <span class='listContent'>";
                        while ($row_accesorios = mysqli_fetch_assoc($result_accesorios)) {
                            $accesorio = htmlspecialchars($row_accesorios['accesorio']);
                            echo "$accesorio, ";
                        }
                        echo "</span></li>";
                    } else {
                        echo "<li>Accesorios: <span class='listContent'> - </span></li>";
                    }
                echo "</ul>";
            echo "</div>";
        echo "</div>";

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
