<?php
    require_once "variables_conexion.php";
    $conn = mysqli_connect($servername, $username,$password,$datebase);
    if(!$conn){
        die("Conexion Fallida ". mysqli_connect_error());
    }
    echo "Conecado correctamente";
    mysqli_close($conn);
?>