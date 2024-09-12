<?php
include 'Conexion/Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];

    // Validar que las contraseñas coincidan y cumplan con los criterios de seguridad
    if ($contraseña !== $confirmarContraseña) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    } elseif (strlen($contraseña) < 8) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres.');</script>";
    } elseif (!preg_match('/[A-Z]/', $contraseña) || !preg_match('/[a-z]/', $contraseña) || 
              !preg_match('/[0-9]/', $contraseña) || !preg_match('/[\W]/', $contraseña)) {
        echo "<script>alert('La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.');</script>";
    } else {
        // En este caso, no se hashea la contraseña
        $contraseña_sin_hash = $contraseña; 

        // Insertar usuario en la base de datos
        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)");
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conexion->error);
        }

        // Vincular los parámetros (el nombre de usuario y la contraseña sin hash)
        $stmt->bind_param('ss', $usuario, $contraseña_sin_hash);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Usuario registrado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="Estilos.css">
    <script>
        function validarContraseña() {
            var contraseña = document.forms["formulario"]["contraseña"].value;
            var mensaje = "";

            // Validar si cumple con los criterios de seguridad
            if (contraseña.length < 8) {
                mensaje += "La contraseña debe tener al menos 8 caracteres.\n";
            }
            if (!/[A-Z]/.test(contraseña)) {
                mensaje += "La contraseña debe contener al menos una letra mayúscula.\n";
            }
            if (!/[a-z]/.test(contraseña)) {
                mensaje += "La contraseña debe contener al menos una letra minúscula.\n";
            }
            if (!/[0-9]/.test(contraseña)) {
                mensaje += "La contraseña debe contener al menos un número.\n";
            }
            if (!/[\W]/.test(contraseña)) {
                mensaje += "La contraseña debe contener al menos un carácter especial.\n";
            }

            if (mensaje) {
                alert(mensaje);
                return false; // Evitar el envío del formulario si la contraseña no es segura
            }

            return true; // Permitir el envío si todo está bien
        }
    </script>
</head>
<body>
    
    <form class="formulario" name="formulario" action="registrar.php" method="POST" onsubmit="return validarContraseña();">
        <h1>REGISTRO</h1>
        <input type="text" name="usuario" placeholder="Usuario" required><br>
        <input type="password" name="contraseña" placeholder="Contraseña" required><br>
        <input type="password" name="confirmarContraseña" placeholder="Confirmar Contraseña" required><br>
        <input type="submit" value="Registrar">
        <input type="button" value="¿Ya tienes cuenta?" onclick="window.location.href='Autenticacion.php'">
    </form>
    
</body>
</html>
