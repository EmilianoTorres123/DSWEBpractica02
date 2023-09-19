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
}