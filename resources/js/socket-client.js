
let io = require('socket.io-client');
let protocol = `${window.location.origin}:8080`;
module.exports.socket = io(protocol);