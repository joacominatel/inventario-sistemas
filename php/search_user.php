<?php
include './db_connection.php';
session_start();

$usuarioLogueado = isset($_SESSION['user_id']);

$search = $_GET['search'] ?? '';

if($search != ''){
    $query = "SELECT * FROM usuarios WHERE CONCAT(nombre, ' ', apellido) LIKE ? OR nombre LIKE ? OR apellido LIKE ? OR workday_id LIKE ? OR mail LIKE ?";
    $stmt = mysqli_prepare($conn, $query);

    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, 'sssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='search-result-item'>";
            echo "<div class='user-checkbox-container'>";
                echo "<input type='checkbox' class='user-checkbox' value='".$row['workday_id']."'>";
                echo "<span>".$row['nombre']." ".$row['apellido']." (".$row['workday_id'].")</span>";
            echo "</div>";
            echo "<div class='search-result-item-actions'>";
                echo "<a href='templates/baja.php?workday_id=".$row['workday_id']."' class='btn-baja' target='_blank'><i class=\"fa-solid fa-print\"></i></a>";
                if ($usuarioLogueado) {
                    echo "<i class='fas fa-edit'></i>";
                    echo "<i class='fas fa-trash-alt'></i>";
                } else {
                    echo "<i class='fas fa-eye'></i>";
                }
            echo "</div>";
        echo "</div>";
    }
    mysqli_close($conn);
}
?>
