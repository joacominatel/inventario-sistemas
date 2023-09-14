<?php
include_once("../../php/db_connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    
    if (strpos($search, ' ') !== false) {
        $query = "SELECT * FROM usuarios WHERE CONCAT(nombre, ' ', apellido) LIKE '$search%'";
    } else {
        $query = "SELECT * FROM usuarios WHERE nombre LIKE '$search%' OR apellido LIKE '$search%' OR workday_id LIKE '$search%'";
    }    
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        die('Query Error: ' . mysqli_error($conn));
    }

    while($row = mysqli_fetch_array($result)){
        echo "<div class='resultado'>"; 
            echo "<ul>";
                $workday_id = $row['workday_id'];
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $marca = $row['marca'];
                $modelo = $row['modelo'];
                $serie = $row['serie'];
                echo "<li>Workday ID: $workday_id</li>";
                echo "<li>Nombre: $nombre</li>";
                echo "<li>Apellido: $apellido</li>";
                if (!empty($marca) && !empty($modelo) && !empty($serie)) {
                    echo "<li>Computadora: $marca - $modelo - AR-$serie</li>";
                }
            echo "</ul>";
        echo "</div>";
    }
}
?>
