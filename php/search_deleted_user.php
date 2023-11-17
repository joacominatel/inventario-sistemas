<?php
include './db_connection.php';

$search = $_GET['search'] ?? '';

if($search != ''){
    $query = "SELECT * FROM usuarios_borrados WHERE CONCAT(nombre, ' ', apellido) LIKE ? OR nombre LIKE ? OR apellido LIKE ? OR workday_id LIKE ? OR mail LIKE ?";
    $stmt = mysqli_prepare($conn, $query);

    $searchParam = "%$search%";
    mysqli_stmt_bind_param($stmt, 'sssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='search-result-item'>";
        echo "<span>".$row['nombre']." ".$row['apellido']." (".$row['workday_id'].")</span>";
        echo "<div class='search-result-item-actions'>";
        echo "<i id='return-user' class='fas fa-rotate-left'></i>";
        echo "</div>";
        echo "</div>";
    }
    mysqli_close($conn);
}
?>
