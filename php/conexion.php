<?php
    $servername = "10.206.173.188:3306";
    $username = "mysqldb";
    $password = "Colombia2025=";
    $database = "token";
  
    // Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $database);
  
    // Verificar la conexión
    if (!$conn) {
      die("Error de conexión: " . mysqli_connect_error());
    } else {
    }
?>