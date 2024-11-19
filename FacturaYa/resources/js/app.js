import './bootstrap';

import Echo from 'laravel-echo';
import { io } from 'socket.io-client';

window.io = io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.channel('metodo-pagos')
    .listen('MetodoPagoUpdated', (e) => {
        if (typeof updateTable === 'function') {
            updateTable(e.metodoPago);
        }
    });