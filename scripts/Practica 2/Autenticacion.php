<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    
</style>
</head>
<body>
    <?php ?>
    <form class="formulario" name="formulario" method="POST" action="configuracionLogin.php">
        <h1>INICIAR SESION</h1>
        <h2></h2>
        
        <input class="cajaUsuario" type="text" placeholder="Usuario" name="cajaUsuario">
        <div class="password-container">
            <input class="cajaContraseña" type="password" placeholder="Contraseña" name="cajaContraseña" id="password">
            <i class="far fa-eye" id="togglePassword"></i>
        </div>
        <input type="submit" value="Iniciar Sesión">
        <input type="button" value="Registrar" onclick="window.location.href =`Registrar.php`">
    </form>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

