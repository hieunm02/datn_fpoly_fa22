const express = require('express');

const app = express();


const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*" }
});


io.on('connection', (socket) => {
    console.log('connection');

    // function chat() {
    socket.on('sendChatToServer', (message, id, name, avatar, room_id) => {
        console.log(message, id);

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message, id, name, avatar, room_id);
    });
    // }
    // chat();
    socket.on('sendNotifyToServer', (user_id, id, mark_readed, notify, order_id) => {
        // io.sockets.emit('sendChatToClient', user_id);
        socket.broadcast.emit('sendNotifyToClient', user_id, id, mark_readed, notify, order_id);
    });
    // function contactUs() {
    //     socket.on('sendContacToServer', (name) => {
    //         console.log(name);

    //         // io.sockets.emit('sendChatToClient', message);
    //         socket.broadcast.emit('sendContacToServer', name);
    //     });
    // }
    // contactUs();


    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});