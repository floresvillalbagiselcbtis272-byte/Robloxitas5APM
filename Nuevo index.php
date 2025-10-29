<?php
include("conexion.php");

if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $sqlEliminar = "DELETE FROM alumnas WHERE ID = $idEliminar";
    if ($conn->query($sqlEliminar) === TRUE) {
        echo "<script>alert('Registro eliminado correctamente'); window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
        exit;
    } else {
        echo "<script>alert('Error al eliminar el registro');</script>";
    }
}

$sql = "SELECT ID, Nombre, Rol, Num_control, foto FROM alumnas";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de alumnas</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-color: #e6f0ff;
            margin: 0;
            padding: 0;
        }
        h2 { 
            text-align: center; 
            color: #004080;
            margin-top: 40px;
        }
        table { 
            width: 90%; 
            border-collapse: collapse; 
            margin: 30px auto; 
            background: #ffffffcc; 
            border-radius: 10px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #a3c2ff; 
            padding: 10px; 
            text-align: center; 
        }
        th { 
            background-color: #cce0ff; 
            color: #003366; 
        }
        tr:hover { background-color: #d1b3ff; transition: 0.3s; }
        img { 
            width: 120px; 
            height: auto; 
            border-radius: 6px; 
            border: 1px solid #aac8ff;
        }
        a { 
            color: #0044cc; 
            text-decoration: none; 
        }
        a:hover { text-decoration: underline; }

        .placeholder { 
            width:120px; 
            height:80px; 
            display:inline-block; 
            background:#eee; 
            line-height:80px; 
            color:#666; 
            border-radius:6px; 
        }

        .btn-eliminar, .btn-editar {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            margin: 2px;
            display: inline-block;
            font-weight: bold;
        }

        .btn-eliminar { background-color: #e53935; }
        .btn-eliminar:hover { background-color: #b71c1c; }

        .btn-editar { background-color: #43a047; }
        .btn-editar:hover { background-color: #2e7d32; }

        .btn-agregar {
            position: fixed; 
            top: 20px;
            right: 20px;
            background-color: #64b5f6;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: 0.3s;
        }
        .btn-agregar:hover { background-color: #42a5f5; }
    </style>
</head>
<body>
    <a href="formulario.html" class="btn-agregar">Agregar Nuevo Registro</a>

    <h2>Tabla de alumnas</h2>
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

                echo "<td>
                        <a href='editar.php?id={$id}' class='btn-editar'>Editar</a>
                        <a href='?eliminar={$id}' class='btn-eliminar' onclick='return confirm(\"¿Seguro que deseas eliminar a {$nombre}?\");'>Eliminar</a>
                      </td>";
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
