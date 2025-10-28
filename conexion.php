<?php
// conexion.php

$servername = "localhost";
$username   = "root";       
$password   = "";
$dbname     = "5apm";

// Crea conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
