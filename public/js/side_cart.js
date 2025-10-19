const ITEMS = [
    {
        id:1 ,
        name: 'Iphone 14 Pro Max',
        price: 1099,
        image: '../public/img/outdoor_fashion.jpg',
        qty:1
    },
    {
        id:1 ,
        name: 'Samsung Galaxy S23 Ultra',
        price: 1199,
        image: '../public/img/outdoor_fashion.jpg',
        qty:1
    },
    {
        id:1 ,
        name: 'Google Pixel 7 Pro',
        price: 899,
        image: '../public/img/outdoor_fashion.jpg',
        qty:1
    },
    {
        id:1 ,
        name: 'One Plus 11 5G',
        price: 699,
        image: '../public/img/outdoor_fashion.jpg',
        qty:1
    },
]

const openBtn = document.getElementById('open_cart_btn')
const cart= document.getElementById('sidecart')
const closeBtn = document.getElementById('close_btn')
const backdrop = document.querySelector('.backdrop')
const itemEl= document.querySelector('.items')

openBtn.addEventListener ('click', openCart)
closeBtn.addEventListener ('click', closeCart)
backdrop.addEventListener('click', closeCart)

//Open Cart
function openCart (){
    cart.classList.add('open')
    backdrop.style.display = 'block'

    setTimeout(() => {
        backdrop.classList.add('show')
    }, 0)
}

//Close Cart
function closeCart (){
    cart.classList.remove('open')
    backdrop.classList.remove('show')

    setTimeout (() => {
        backdrop.style.display = 'none'
    }, 500);
}

//Render Items
// function renderItems(){
//     ITEMS.forEach((item) => {
//         const itemEl = document.createElement('div')
//         itemEl.classList.add('item');
//         itemEl.innerHTML = 
//         <img src="${item.image}"
//     })
// }