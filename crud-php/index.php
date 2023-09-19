<?php
session_start();

try {
    $dsn = "pgsql:host=172.17.0.3;port=5432;dbname=ejemplo;";
    $username = "postgres";
    $password = "postgres";

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if (isset($_POST['submit_registro'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);

        
        $id_usuario = 1; 

        $query = "INSERT INTO usuarios (id, nombre, email, contraseña) VALUES (:id, :nombre, :email, :contrasena)";
        $statement = $pdo->prepare($query);

        $parameters = [
            ':id' => $id_usuario,
            ':nombre' => $nombre,
            ':email' => $email,
            ':contrasena' => $contraseña
        ];

        $result = $statement->execute($parameters);

        if ($result) {
            echo "Registro exitoso. <a href='alta.php'>Iniciar Sesión</a>";
        } else {
            echo "Error en el registro.";
        }
    }

    if (isset($_POST['submit_login'])) {
        $email = $_POST['email_login'];
        $contraseña = $_POST['contraseña_login'];

        $query = "SELECT * FROM usuarios WHERE email = :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $usuarioEncontrado = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuarioEncontrado && password_verify($contraseña, $usuarioEncontrado['contraseña'])) {
            // Inicio de sesión exitoso
            $_SESSION['usuario'] = $usuarioEncontrado['nombre'];
            header('Location: alta.php');
            exit();
        } else {
            // Credenciales incorrectas, mostrar mensaje de error
            $login_error = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    }

    // Consulta de empleados
    $consulta = "SELECT * FROM empleado";
    $stmt = $pdo->query($consulta);
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>


