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

    //Hiệu ừng đang nhập
        socket.on('isTyping', (typing, room_id) => {
            // io.sockets.emit('sendChatToClient', message);
            socket.broadcast.emit('isTyping', typing, room_id);
        });

    //Đặt hàng nhóm
    socket.on('orderGroup', (user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price) => {
        io.sockets.emit('orderGroup',user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price);
    });
    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});