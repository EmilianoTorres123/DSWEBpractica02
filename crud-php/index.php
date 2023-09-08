<?php
session_start();

function mostrarDetalles($registro) {
    echo "<h2>Detalles del Registro</h2>";
    echo "<p><strong>Clave:</strong> {$registro['Clave']}</p>";
    echo "<p><strong>Nombre:</strong> {$registro['Nombre']}</p>";
    echo "<p><strong>Dirección:</strong> {$registro['Dirección']}</p>";
    echo "<p><strong>Teléfono:</strong> {$registro['Teléfono']}</p>";
}

if (isset($_POST['submit'])) {
    $registro = array(
        'Clave' => $_POST['clave'],
        'Nombre' => $_POST['name'],
        'Dirección' => $_POST['direccion'],
        'Teléfono' => $_POST['telefono']
    );


    if (isset($_SESSION['registros'])) {
        $_SESSION['registros'][] = $registro;
    } else {
        //
        $_SESSION['registros'] = array($registro);
    }
}

 
$clave = "";
$nombre = "";
$direccion = "";
$telefono = "";

if (isset($_GET['ver']) && isset($_SESSION['registros'][$_GET['ver']])) {
    $registro = $_SESSION['registros'][$_GET['ver']];
    $clave = $registro['Clave'];
    $nombre = $registro['Nombre'];
    $direccion = $registro['Dirección'];
    $telefono = $registro['Teléfono'];
}


if (isset($_GET['eliminar']) && isset($_SESSION['registros'][$_GET['eliminar']])) {
    unset($_SESSION['registros'][$_GET['eliminar']]);

    $_SESSION['registros'] = array_values($_SESSION['registros']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Equipo 4</title>
</head>
<body>


    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="clave">Clave:</label>
        <input type="number" name="clave" required value="<?php echo $clave; ?>"><br>

        <label for="name">Nombre:</label>
        <input type="text" name="name" required value="<?php echo $nombre; ?>"><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required value="<?php echo $direccion; ?>"><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required value="<?php echo $telefono; ?>"><br>

        <input type="submit" name="submit" value="Enviar Formulario"><br>
    </form>
    
</body>
</html>
