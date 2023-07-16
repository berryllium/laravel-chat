import { createServer } from "http";
import { Server } from "socket.io";

const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "*"
  }
});

io.on("connection", (socket) => {
  socket.broadcast.emit('hi');
  console.log('a user connected');
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
  socket.on('message', (message) => {
    socket.broadcast.emit('message', message);
    console.log(message);
  });
});


io.listen(3000, () => console.log('test'))