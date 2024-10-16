const bruteForce = (user, password, limite) => {
    const startTime = Date.now();
    let intentos = 0;
  
    while (intentos < limite) {
      intentos += 1;
      // Aquí estamos simulando el intento de login con un usuario y contraseña fijos
      if (user === 'admin' && password === 'password') {
        const endTime = Date.now();
        console.log(`Inició sesión como ${user} con la contraseña ${password}`);
        console.log(`Intentos fallidos: ${intentos}`);
        console.log(`Tiempo transcurrido: ${(endTime - startTime) / 1000} segundos`);
        console.log(`Combinaciones intentadas: ${intentos}`);
        return;
      }
    }
    const endTime = Date.now();
    console.log('No se pudo iniciar sesión');
    console.log(`Intentos fallidos: ${intentos}`);
    console.log(`Tiempo transcurrido: ${(endTime - startTime) / 1000} segundos`);
    console.log(`Combinaciones intentadas: ${intentos}`);
  };
  
  // Recibiendo los argumentos de línea de comandos
  const args = process.argv.slice(2);
  if (args.length !== 3) {
    console.log('Uso: node bruteForce.js <usuario> <contraseña> <intentos>');
    process.exit(1);
  }
  
  const user = args[0];
  const password = args[1];
  const limite = parseInt(args[2], 10);
  
  bruteForce(user, password, limite);
  