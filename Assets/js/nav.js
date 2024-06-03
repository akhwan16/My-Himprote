const navbarItems = document.querySelectorAll('.navbar-item');

navbarItems.forEach(item => {
    item.addEventListener('click', () => {
        navbarItems.forEach(nav => nav.classList.remove('active'));
        item.classList.add('active');
    });
});