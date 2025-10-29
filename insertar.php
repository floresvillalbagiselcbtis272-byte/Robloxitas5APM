<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $rol = trim($_POST['rol']);
    $numControl = trim($_POST['numControl']);

    $fotoNombre = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $carpetaFotos = "foto/";

    //ruta completa para guardar la foto
    $rutaDestino = $carpetaFotos . basename($fotoNombre);

    //validar y mover la foto subida
    if (move_uploaded_file($fotoTmp, $rutaDestino)) {
        //insertar datos en la base de datos
        $sql = "INSERT INTO alumnas (Nombre, Rol, Num_control, foto) 
                VALUES ('$nombre', '$rol', '$numControl', '$fotoNombre')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registro guardado correctamente'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error al guardar los datos'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error al subir la foto'); window.history.back();</script>";
    }
}

$conn->close();
?>
