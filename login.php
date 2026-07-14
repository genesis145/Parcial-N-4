<?php
session_start();

require_once 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

   
    if (empty($correo) || empty($password)) {
        die("Todos los campos son obligatorios. Solicitud denegada.");
    }

    try {

        $sql = "SELECT id, nombre_usuario, password_hash FROM usuarios WHERE correo = :correo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            
            echo "¡Bienvenido" . htmlspecialchars($_SESSION['nombre_usuario']) . "!";    
        } else {
           
            echo "Correo o contraseña incorrectos.";
        }

    } catch (PDOException $e) {

        die("Error, intente más tarde.");
    }
}
?>