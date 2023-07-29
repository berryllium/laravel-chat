import axios from "axios";

const messages = document.getElementById('messages')
const form = document.getElementById('sendForm')
messages.scrollTop = messages.scrollHeight;

document.getElementById('text').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        send()
    }
});

document.getElementById('sendButton').addEventListener('click', function(event) {
    event.preventDefault()
    send()
})

function send() {
    const field = document.getElementById('text')
    const message = field.value
    field.value = null
    socket.emit('message', JSON.stringify({
        from: form.dataset.from,
        to: form.dataset.to,
        message: message.trim()
    }));
    addMessage(message, 'right')
}

import io from 'socket.io-client';

let socket = io.connect('http://localhost:3000', {query: {userId: form.dataset.from}});
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

messages.addEventListener('scroll', function () {
    if(messages.scrollTop === 0) {
        const from = Number(form.dataset.from)
        const to = Number(form.dataset.to)
        const scrollOffset = messages.scrollHeight - messages.scrollTop;

        axios.post(window.location, {
            from: from,
            to: to,
            message_id: messages.firstElementChild.dataset.id,
            _token: form.dataset.csrf
        }).then(function (response) {
            console.log(response.data)
            let html = ''

            response.data = Array.prototype.reverse.call(response.data)
            for(let i in response.data) {
                let el = response.data[i]
                html += `<li data-id="${el.id}" class="${el.from === from ? 'left' : 'right'}">${el.message}</li>`
            }
            messages.insertAdjacentHTML('afterbegin', html);
            messages.scrollTop = messages.scrollHeight - scrollOffset;
        })
    }
})