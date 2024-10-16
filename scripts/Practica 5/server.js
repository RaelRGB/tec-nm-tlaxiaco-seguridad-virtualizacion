const http = require('http');

// Crear el servidor
const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');
    res.end('Hola, este es el servidor de prueba\n');
});

// El servidor escuchará en el puerto 3000
const port = 3000;
server.listen(port, '127.0.0.1', () => {
    console.log(`Servidor funcionando en http://127.0.0.1:${port}/`);
});
