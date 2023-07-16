const messages = document.getElementById('messages')

document.getElementById('text').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      var message = this.value;
      this.value = null
      socket.emit('message', message);
      addMessage(message, 'right')
    }
});

import io from 'socket.io-client';

let socket = io.connect('http://localhost:3000');
    socket.on('connection', function () {
        console.log('Connected to server');
    });

socket.on('connect', () => {
  console.log('Connected to Socket.IO server');
});

socket.on('disconnect', () => {
  console.log('Disconnected from Socket.IO server');
});

socket.on('message', (message) => {
    addMessage(message, 'left')
});

function addMessage(message, type = 'right') {
    const li = document.createElement('li')
    li.textContent = message
    li.className = type
    messages.appendChild(li)
    messages.scrollTop = messages.scrollHeight;
}