const navbarItems = document.querySelectorAll('.navbar-item');

navbarItems.forEach(item => {
    item.addEventListener('click', () => {
        navbarItems.forEach(nav => nav.classList.remove('active'));
        item.classList.add('active');
    });
});

const choiceItems = document.querySelectorAll('.choice-item');

choiceItems.forEach(item => {
    item.addEventListener('click', () => {
        choiceItems.forEach(choice => choice.classList.remove('active'));
        item.classList.add('active');
    });
});