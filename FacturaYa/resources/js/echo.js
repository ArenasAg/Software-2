import Echo from 'laravel-echo';
import { io } from 'socket.io-client';

window.io = io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001', // Asegúrate de que el puerto coincida con el configurado en Laravel Echo Server
    transports: ['websocket', 'polling'], // Opcional: especifica los transportes que deseas usar
});