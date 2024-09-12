<?php
session_start();
include 'Conexion/Conexion.php';  // Asegúrate de que tu archivo de conexión sea correcto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_ingresado = trim($_POST["cajaUsuario"]);
    $contraseña_ingresada = trim($_POST["cajaContraseña"]);

    
    $consulta = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $usuario_ingresado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if ($usuario['contraseña'] == $contraseña_ingresada && $usuario['usuario'] == $usuario_ingresado) {
            
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['id'] = $usuario['id'];

            if ($usuario['Es_admin'] == 1) {
                header("Location: Administrador.html");  
                exit();
            } 
            else if ($usuario['Es_admin'] == 0) {
                header("Location: Usuario.html");  
                exit();
            }
        } else {
            
            echo "Contraseña incorrecta.";
        }
    } else {
        
        echo "Usuario no encontrado. Por favor, verifica tu información.";
    }

    $stmt->close();
    $conexion->close();
}
?>
