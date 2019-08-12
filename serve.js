
let port = process.env | 3000;
let http = require('http').createServer();
let io = require('socket.io')(http);

http.listen(port, () => {
    console.log(`Server start listening on port ${port}`)
});

io.on('connection', (socket) => {
    socket.on('msg', msg => {
        console.log(msg);
    });
    // console.log(socket);
});
