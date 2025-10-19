
// ================================= CONTACT US =================================
const openCardContact = document.getElementById('open_card_contact')
const cardContact = document.getElementById('sidecard_contact')
const closeBtnCardContact = document.getElementById('close_btn_contact')
const backdropContact = document.querySelector('.backdropContact')

openCardContact.addEventListener('click', openCard)
closeBtnCardContact.addEventListener('click', closeCard)
backdropContact.addEventListener('click', closeCard)

//Open Card
function openCard() {
    cardContact.classList.add('open')
    backdropContact.style.display = 'block'

    setTimeout(() => {
        backdropContact.classList.add('show')
    }, 0)
}

//Close Cart
function closeCard() {
    cardContact.classList.remove('open')
    backdropContact.classList.remove('show')

    setTimeout(() => {
        backdropContact.style.display = 'none'
    }, 500);
}


// ================================= CONTACT US BELOW =================================
const openCardContactBelow = document.getElementById('open_card_contact_below')
const cardContactBelow = document.getElementById('sidecard_contact')
const closeBtnCardContactBelow = document.getElementById('close_btn_contact')
const backdropContactBelow = document.querySelector('.backdropContact')

openCardContactBelow.addEventListener('click', openCardBelow)
closeBtnCardContactBelow.addEventListener('click', closeCardBelow)
backdropContactBelow.addEventListener('click', closeCardBelow)

function openCardBelow() {
    cardContactBelow.classList.add('open')
    backdropContactBelow.style.display = 'block'

    setTimeout(() => {
        backdropContactBelow.classList.add('show')
    }, 0)
}

function closeCardBelow() {
    cardContactBelow.classList.remove('open')
    backdropContactBelow.classList.remove('show')

    setTimeout(() => {
        backdropContactBelow.style.display = 'none'
    }, 500);
}


// ================================= SHOPPING CART =================================
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
