<?php
include("conexion.php");


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID no válido'); window.location.href='index.php';</script>";
    exit;
}

$id = intval($_GET['id']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $rol = $conn->real_escape_string($_POST['rol']);
    $num_control = $conn->real_escape_string($_POST['num_control']);

    if (!empty($_FILES['foto']['name'])) {
        $fotoNombre = basename($_FILES['foto']['name']);
        $rutaDestino = "foto/" . $fotoNombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
        
        $sql = "UPDATE alumnas SET Nombre='$nombre', Rol='$rol', Num_control='$num_control', foto='$fotoNombre' WHERE ID=$id";
    } else {

        $sql = "UPDATE alumnas SET Nombre='$nombre', Rol='$rol', Num_control='$num_control' WHERE ID=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro actualizado correctamente'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error al actualizar el registro');</script>";
    }
}


$sql = "SELECT * FROM alumnas WHERE ID = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<script>alert('Registro no encontrado'); window.location.href='index.php';</script>";
    exit;
}

$alumna = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar registro</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-color: #f6e6ff;
            text-align: center; 
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #4a148c;
            margin-top: 40px;
        }
        form { 
            display: inline-block; 
            padding: 25px 30px; 
            background: #ffffffcc; 
            border: 1px solid #d1b3ff; 
            border-radius: 12px; 
            margin-top: 30px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        input, select { 
            display: block; 
            margin: 12px auto; 
            padding: 10px; 
            width: 80%; 
            border-radius: 6px; 
            border: 1px solid #ccc;
        }
        button { 
            background-color: #7e57c2; 
            color: white; 
            border: none; 
            padding: 10px 15px; 
            border-radius: 5px; 
            cursor: pointer; 
            margin-top: 10px;
            font-weight: bold;
        }
        button:hover { background-color: #5e35b1; }
        a { 
            display: inline-block; 
            margin-top: 15px; 
            color: #4a148c; 
            text-decoration: none; 
            font-weight: bold;
        }
        a:hover { text-decoration: underline; }
        img { 
            width: 150px; 
            border-radius: 6px; 
            margin: 10px 0; 
            border: 1px solid #d1b3ff;
        }
    </style>
</head>
<body>
    <h2>Editar registro de <?php echo htmlspecialchars($alumna['Nombre']); ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($alumna['Nombre']); ?>" required>
        <input type="text" name="rol" value="<?php echo htmlspecialchars($alumna['Rol']); ?>" required>
        <input type="text" name="num_control" value="<?php echo htmlspecialchars($alumna['Num_control']); ?>" required>
        
        <p>Foto actual:</p>
        <?php if (!empty($alumna['foto']) && file_exists("foto/" . $alumna['foto'])): ?>
            <img src="foto/<?php echo htmlspecialchars($alumna['foto']); ?>" alt="Foto actual">
        <?php else: ?>
            <div style="color:gray;">Sin foto</div>
        <?php endif; ?>

        <label for="foto">Cambiar foto (opcional):</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit">Actualizar</button>
        <a href="index.php">Volver</a>
    </form>
</body>
</html>
<?php
$conn->close();
?>
