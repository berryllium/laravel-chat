import { createServer } from "http";
import { Server } from "socket.io";

// DB connection
import mysql from 'mysql2/promise';
const connection = await mysql.createConnection({
  host: 'mysql',
  user: 'sail',
  password: 'password',
  database: 'chat'
});

// listening websocket
const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "*"
  }
});

const users = []

io.on("connection", (socket) => {
  const userId = socket.handshake.query.userId
  if(!(userId in users)) {
      users[userId] = []
  }
  users[userId].push(socket.id)

  console.log('a user connected ' + userId);
  console.log(users)
  socket.on('disconnect', () => {
    const userId = socket.handshake.query.userId
    users[userId] = users[userId].filter(item => item !== socket.id)
    console.log('user disconnected ' + userId);
    console.log(users)
  });
  socket.on('message', (message) => {
    const messageObj = JSON.parse(message)
    const insertQuery = "INSERT INTO messages (`from`, `to`, message, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
    const values = [messageObj.from, messageObj.to, messageObj.message, new Date(), new Date()];

    if(messageObj.to in users) {
      socket.to(users[messageObj.to]).emit('message', messageObj.message);
    }

    connection.query(insertQuery, values, (error, result) => {
      if (error) {
        console.error('Error saving message:', error);
      } else {
        console.log('Message saved:', result);
      }
    });

    console.log(message);
  });
});


io.listen(3000, () => console.log('test'))