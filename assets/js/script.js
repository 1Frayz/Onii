function toggleMenu() {
    const menu = document.getElementById('dropdownMenu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}

window.onclick = function (event) {
    if (!event.target.matches('.card-avatar')) {
        const dropdowns = document.getElementsByClassName('dropdown-menu');
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
}


function showSection(section) {
    document.querySelectorAll('.search-section').forEach(function (el) {
        el.classList.add('d-none');
    });

    document.querySelectorAll('.btn-group .btn').forEach(function (el) {
        el.classList.remove('active');
        el.style.borderBottom = 'none';
    });

    document.getElementById(section).classList.remove('d-none');

    var activeButton = document.querySelector('.btn-group .btn[onclick="showSection(\'' + section + '\')"]');
    activeButton.classList.add('active');
    activeButton.style.borderBottom = '2px solid #333';

}


document.addEventListener('DOMContentLoaded', function () {
    showSection('posts');
});