/**
 * Node Socket Server
 * created 23/11/19
 * author yousuf khalid
 */

let fs = require('fs');
let path = require('path');
let app = require('express')();
let env = require('dotenv').config({
    path: `${path.dirname(__dirname)}/${path.basename(__dirname)}/.env`
});

let protocol = null;
let PORT = env.parsed.SOCKET_PORT || 8080;

if(env.parsed.PROTOCOL === 'https') {
    const privateKey = fs.readFileSync(env.parsed.SSL_KEY, 'utf8');
    const certificate = fs.readFileSync(env.parsed.SSL_CERTIFICATE, 'utf8');
    const credentials = {
        key: privateKey,
        cert: certificate,
        passphrase: process.env.PASSPHRASE
    };

    protocol = require('https').createServer(credentials, app);

} else {
    protocol = require('http').createServer(app);
}

let io = require('socket.io')(protocol);

io.on('connection', function(socket){
    console.log(`User Connected with id: [${socket.id}]`);

    // Chat Channel Events
    socket.on('chat-channel', function(data){
        // Forward Message
        console.log(`Message Event: listen-chat-event.${data.to}`);
        io.emit(`listen-chat-event.${data.to}`, data);

    });

    // Notification Channel Events
    socket.on('notification-channel', function(data){
        // Forward Notification
        data = JSON.parse(data);
        console.log(`Notification Event: listen-notification-event.${data.to}`);
        io.emit(`listen-notification-event.${data.to}`, data);
    });

    // User Disconnect With Socket Event
    socket.on('disconnect', function() {
        console.log(`User with id: [${socket.id}] Disconnected`);
    });
});

protocol.listen(PORT, function(){
    console.log(`listening on port: ${PORT}`);
    console.log(`Current Protocol is: ${env.parsed.PROTOCOL}`);
});