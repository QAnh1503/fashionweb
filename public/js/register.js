const modal = document.getElementById('modal');
const btn = document.getElementById('moreDetailsBtn');
const closeBtn = document.querySelector('.close');
const closeLbl = document.querySelector('.modal-close');

btn.onclick = function (event) {
    event.preventDefault();
    modal.style.display = 'flex';
}   

closeBtn.onclick = function () {
    modal.style.display = 'none';
}

closeLbl.onclick = function () {
    modal.style.display = 'none';
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}