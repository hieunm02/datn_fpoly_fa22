const express = require('express');

const app = express();


const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*"}
});


io.on('connection', (socket) => {
    console.log('connection');

    // Chat 
        socket.on('sendChatToServer', (message, id, name, avatar, room_id) => {
            // io.sockets.emit('sendChatToClient', message);
            socket.broadcast.emit('sendChatToClient', message, id, name, avatar, room_id);
        });


        socket.on('isTyping', (typing, room_id) => {
            // io.sockets.emit('sendChatToClient', message);
            socket.broadcast.emit('isTyping', typing, room_id);
        });
    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});