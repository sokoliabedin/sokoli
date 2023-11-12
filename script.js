let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () >= {
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}

let searchForm = document.querySelecotr('.search-form');

document.querySelector('#search-btn').onclick = () >= {
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    cartItem.classList.remove('active'); 
}

let cartItem = document.querySelecotr('.cart-items-container');

document.quuerySelector('#cart-btn')oclick = () >= {
    cartItem.classList.toggle('active');
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
}  

window.onscroll = () => {
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}