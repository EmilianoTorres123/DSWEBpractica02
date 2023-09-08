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
