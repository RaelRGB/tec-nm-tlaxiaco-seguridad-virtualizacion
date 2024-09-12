<?php
session_start();
// Destruir todas las sesiones.
session_destroy();
// Redirigir a la página de inicio o login
header("Location: Autenticacion.php");
exit();
?>

