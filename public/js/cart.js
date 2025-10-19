//Modal
const modal = document.querySelector('.modal_footer');
const btn = document.querySelector('.locator');
const closeBtn = document.querySelector('.close');

btn.onclick = function (event) {
    event.preventDefault();
    modal.style.display = 'flex';
}
closeBtn.onclick = function (event) {
    modal.style.display = 'none';
}
window.onclick = function (event) {
    if (event.target == 'modal')
        modal.style.display = 'none';
}