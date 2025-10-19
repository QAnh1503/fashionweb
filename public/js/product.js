function toggleFavourite(element) {
    const heartIcon = element.querySelector('i'); // Lấy biểu tượng trái tim
    heartIcon.classList.toggle('fav'); // Thay đổi lớp CSS
}

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

//Change Image
function changeImage(imgElement, newSrc) {
    imgElement.classList.add("hidden"); //mờ ảnh trước khi đổi
    setTimeout(function () {
        imgElement.src = newSrc;
        imgElement.classList.remove("hidden"); //bỏ hiệu ứng mờ để hiện ảnh mới lên
    }, 200); // set 0.5s (khớp với transition)
}
function resetImage(imgElement, originalSrc) {
    imgElement.src = originalSrc;
}