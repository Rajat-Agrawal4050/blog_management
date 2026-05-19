
const ham = document.getElementById('ham');
const mNav = document.getElementById('mobileNav');
ham.addEventListener('click', () => mNav.classList.toggle('open'));

document.addEventListener('click', function (e) {
    if (!document.getElementById('authArea').contains(e.target)) {
        document.getElementById('dropdown').classList.remove('show');
        document.getElementById('userBtn').classList.remove('open');
    }
});

function toggleDropdown() {
    const d = document.getElementById('dropdown');
    const btn = document.getElementById('userBtn');
    const isOpen = d.classList.contains('show');
    d.classList.toggle('show');
    btn.classList.toggle('open', !isOpen);
}
