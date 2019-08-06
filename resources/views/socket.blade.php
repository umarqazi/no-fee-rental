<html>
<head>
<title>Hello</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script>
    var socket = io('http://localhost:3000');
    socket.emit('msg', { my: 'data' });
</script>
</body>
</html>
