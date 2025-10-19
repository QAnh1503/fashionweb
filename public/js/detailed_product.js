//Accordion
document.querySelectorAll(".accordion-header").forEach(button => {
    button.addEventListener("click", () => {
        const accordionItem= button.parentElement;
        accordionItem.classList.toggle("active");

        if (accordionItem.classList.contains("active")) {
            content.style.height = content.scrollHeight + "px";
        } else {
            content.style.height = "0";
        }
    });
});


//Add to favourite
function toggleFavourite(element) {
    const heartIcon = element.querySelector('i'); 
    heartIcon.classList.toggle('fav'); 
}


//Swiper
new Swiper('.card-wrapper', {
    loop: true,
    spaceBetween: 30,

    // Pagination bullets
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // Responsive breakpoints
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        },
    }
});


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


//Modal
const modal = document.querySelector('.modal');
const commitment =document.querySelector('.commitment');
const closeBtn=document.querySelector('.close');

commitment.onclick =function (event) {
    event.preventDefault();
    modal.style.display='flex';
}
closeBtn.onclick =function (event) {
    modal.style.display='none';
}
window.onclick =function (event) {
    if (event.target=='modal')
        modal.style.display='none';
}

//Modal footer
const modal_footer = document.querySelector('.modal_footer');
const btn = document.querySelector('.locator');
const closeBtnfooter = document.querySelector('.close_footer');

btn.onclick = function (event) {
    event.preventDefault();
    modal_footer.style.display = 'flex';
}
closeBtnfooter.onclick = function (event) {
    modal_footer.style.display = 'none';
}


const openBtn = document.getElementById('open_cart_btn')
const cart = document.getElementById('sidecart')
const closeBtnCart = document.getElementById('close_btn')
const backdrop = document.querySelector('.backdrop')
// const itemEl = document.querySelector('.items')

openBtn.addEventListener('click', openCart)
closeBtnCart.addEventListener('click', closeCart)
backdrop.addEventListener('click', closeCart)

//Open Cart
function openCart() {
    cart.classList.add('open')
    backdrop.style.display = 'block'

    setTimeout(() => {
        backdrop.classList.add('show')
    }, 0)
}

//Close Cart
function closeCart() {
    cart.classList.remove('open')
    backdrop.classList.remove('show')

    setTimeout(() => {
        backdrop.style.display = 'none'
    }, 500);
}