<?php
include_once("../php/db_connection.php");

if (isset($_GET['workday_id'])) {
    $workday_id = mysqli_real_escape_string($conn, $_GET['workday_id']); 

    $query = "SELECT * FROM usuarios WHERE workday_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Asocia el parámetro y realiza la búsqueda
    mysqli_stmt_bind_param($stmt, 's', $workday_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    $userData = mysqli_fetch_assoc($result);

    echo json_encode($userData);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
