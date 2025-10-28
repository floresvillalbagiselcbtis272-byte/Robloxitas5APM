<?php
include("conexion.php");

if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $sqlEliminar = "DELETE FROM alumnas WHERE ID = $idEliminar";
    if ($conn->query($sqlEliminar) === TRUE) {
        echo "<script>alert('Registro eliminado correctamente'); window.location.href='".$_SERVER['PHP_SELF']."';</script>";
        exit;
    } else {
        echo "<script>alert('Error al eliminar el registro');</script>";
    }
}

// Consulta de la tabla
$sql = "SELECT ID, Nombre, Rol, Num_control, foto FROM alumnas";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de alumnas</title>
  <style>
    body { font-family: Arial, sans-serif; }
    table { width: 90%; border-collapse: collapse; margin: 20px auto;}
    th, td { border: 1px solid #444; padding: 10px; text-align: center; }
    table, th, td {border-style:20px; height:40px; }
    table, th, td {border: 1px solid blue; }
    th { background-color: #f0f0f0; }
    img { width: 120px; height: auto; border-radius: 6px; }
    a { color: #0b5ed7; text-decoration: none; }
    .placeholder { width:120px; height:80px; display:inline-block; background:#eee; line-height:80px; color:#666; border-radius:6px; }
    tr:hover {background-color:coral; }
    .btn-eliminar {
      background-color: red;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }
    .btn-eliminar:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>

<h2 style="text-align:center;">Tabla de alumnas</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Rol</th>
    <th>Número de Control</th>
    <th>Foto</th>
    <th>Acciones</th>
  </tr>

<?php
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = (int)$row['ID'];
        $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $rol = htmlspecialchars($row['Rol'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $control = htmlspecialchars($row['Num_control'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $fotoFile = basename($row['foto']);
        $fotoPath = __DIR__ . "/foto/" . $fotoFile;
        $fotoWeb = "foto/" . rawurlencode($fotoFile);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td><a href='https://www.google.com/search?q=" . rawurlencode($row['Nombre']) . "' target='_blank'>{$nombre}</a></td>";
        echo "<td>{$rol}</td>";
        echo "<td>{$control}</td>";

        if (file_exists($fotoPath) && is_file($fotoPath)) {
            echo "<td><img src='{$fotoWeb}' alt='Foto de {$nombre}'></td>";
        } else {
            echo "<td><div class='placeholder'>Sin foto</div></td>";
        }

        echo "<td><a href='?eliminar={$id}' class='btn-eliminar' onclick='return confirm(\"¿Seguro que deseas eliminar a {$nombre}?\");'>Eliminar</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay datos en la tabla</td></tr>";
}
?>

</table>

</body>
</html>

<?php
$conn->close();
?>
