document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar-modern');
    const content = document.querySelector('.content-area');
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const notificationBell = document.querySelector('.notification-bell');
    const notifications = [
        { id: 1, message: "Nueva factura recibida", time: "Hace 5 minutos" },
        { id: 2, message: "Pago confirmado", time: "Hace 15 minutos" },
        { id: 3, message: "Nuevo cliente registrado", time: "Hace 1 hora" }
    ];

    // Create notifications dropdown
    const dropdown = document.createElement('div');
    dropdown.className = 'notifications-dropdown';
    dropdown.style.display = 'none';

    notifications.forEach(notif => {
        const item = document.createElement('div');
        item.className = 'notification-item';
        item.innerHTML = `
            <div class="notification-message">${notif.message}</div>
            <div class="notification-time">${notif.time}</div>
        `;
        dropdown.appendChild(item);
    });

    notificationBell.appendChild(dropdown);

    notificationBell.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Close notifications when clicking outside
    document.addEventListener('click', (e) => {
        if (!notificationBell.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Toggle Sidebar
    sidebarCollapse.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
    });

    // Responsive Behavior
    function checkWidth() {
        if (window.innerWidth > 768) {
            sidebar.classList.add('active');
            content.classList.add('active');
        } else {
            sidebar.classList.remove('active');
            content.classList.remove('active');
        }
    }

    window.addEventListener('resize', checkWidth);
    checkWidth(); // Initial check

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (event) => {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) &&
                !sidebarCollapse.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                content.classList.remove('active');
            }
        }
    });
});

function loadContent(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content-area').innerHTML = html;
        })
        .catch(error => console.error('Error al cargar contenido:', error));
}
