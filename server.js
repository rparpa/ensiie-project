const hostname = '0.0.0.0';
const port = 3000;

const server = require('./controller.js');

//test
server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
});