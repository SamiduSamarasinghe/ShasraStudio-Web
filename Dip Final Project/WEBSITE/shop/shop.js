document.addEventListener('DOMContentLoaded', function() {
    const cartIcon = document.getElementById('icon-cart2');
    const cartClose = document.getElementById('cart-close');
    const myCart = document.querySelector('.myCart');

    cartIcon.addEventListener('click', function() {
        myCart.style.display = 'block';
    });

    cartClose.addEventListener('click', function() {
        myCart.style.display = 'none';
    });
});
