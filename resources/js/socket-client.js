
let io = require('socket.io-client');
let protocol = `http://localhost:8080`;
module.exports.socket = io(protocol);
