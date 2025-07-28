document.addEventListener('DOMContentLoaded', () => {
    let cartLogo = document.querySelector('.cartLogo');
    let cartClose = document.querySelector('#cart-close');
    let body = document.querySelector('body');
    let myCart = document.querySelector('.myCart');

    let iconCart = document.querySelector('.iconCart');
    let cartClose1 = document.querySelector('#cart-close1');
    let sidebar = document.querySelector('.sidebar');

    cartLogo.addEventListener('click', () => {
        if (body.classList.contains('sidebar-active')) {
            body.classList.remove('sidebar-active');
            sidebar.classList.remove('active');
        }
        body.classList.add('myCart-active');
        myCart.classList.add('active');
        loadCartFromLocalStorage(); // Load cart items from local storage
    });

    cartClose.addEventListener('click', () => {
        body.classList.remove('myCart-active');
        myCart.classList.remove('active');
    });

    iconCart.addEventListener('click', () => {
        if (body.classList.contains('myCart-active')) {
            body.classList.remove('myCart-active');
            myCart.classList.remove('active');
        }
        body.classList.add('sidebar-active');
        sidebar.classList.add('active');
    });

    cartClose1.addEventListener('click', () => {
        body.classList.remove('sidebar-active');
        sidebar.classList.remove('active');
    });

    fetchProducts();
    loadCartFromLocalStorage(); // Load cart items on initial load
});

const fetchProducts = () => {
    fetch('get_rent_items.php')
        .then(response => response.json())
        .then(data => {
            product = data;
            displayAllItems();
            populateFilterButtons();
        });
};

const btns = [
    { id: 1, name: 'Digital Cameras' },
    { id: 2, name: 'Lenses' },
    { id: 3, name: 'Flashes' },
    { id: 4, name: 'Tripods' },
    { id: 5, name: 'Lightning Items' },
    { id: 6, name: 'Drones' }
];

const filters = [...new Set(btns.map(btn => btn.name))];

const populateFilterButtons = () => {
    document.getElementById('btns').innerHTML = filters.map(btn => {
        return `<button class='fil-p' onclick='filterItems("${btn}")'>${btn}</button>`;
    }).join('');
};

let product = [];
let currentCategory = null;

const filterItems = (category) => {
    currentCategory = category;
    const filteredProducts = category ? product.filter(item => item.item_category.toLowerCase().includes(category.toLowerCase())) : product;
    displayItems(filteredProducts);
};

const displayAllItems = () => {
    currentCategory = null;
    displayItems(product);
};

const displayItems = (items) => {
    document.getElementById('root').innerHTML = items.map((item, index) => {
        const { item_id, image_url, item_name, per_night_price } = item;
        return `
            <div class='box'>
                <h3 class='h3-1'>${item_name}</h3>
                <div class='img-box'>
                    <img class='images' src='${image_url}' alt='${item_name}'></img>
                </div>
                <div class='bottom'>
                    <h2 class='h2-1'>Rs ${per_night_price} Per Night</h2>
                    <button id='btnBuyCartItem-${index}' class='btnBuyCartItem'>Add to Cart</button>
                </div>
            </div>`;
    }).join('');

    items.forEach((item, index) => {
        const button = document.getElementById(`btnBuyCartItem-${index}`);
        button.addEventListener('click', () => {
            addToCart(item);
        });
    });
};

// Search function
document.getElementById('searchButton').addEventListener('click', searchProducts);

function searchProducts() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const filteredProducts = product.filter(item => {
        return item.item_name.toLowerCase().includes(searchText);
    });

    if (filteredProducts.length === 0) {
        displayNoResultsMessage();
    } else {
        displayItems(filteredProducts);
    }
}

function displayNoResultsMessage() {
    const root = document.getElementById('root');
    root.innerHTML = '<div class="no-results">There is no any product by this name</div>';
}

/* Cart Details */
const addToCart = (item) => {
    const cartContent = document.getElementById('cart-content');

    // Check if the item already exists in the cart
    const existingCartItem = [...cartContent.children].find(cartBox => cartBox.querySelector('.cart-product').innerText === item.item_name);

    if (existingCartItem) {
        // Increase the quantity if the item already exists
        const quantityInput = existingCartItem.querySelector('.cart-quantity');
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
    } else {
        // Add a new item to the cart
        const cartItemHtml = `
            <div class="cart-box">
                <img src="${item.image_url}" alt="${item.item_name}" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product">${item.item_name}</div>
                    <div class="cart-price">Rs ${item.per_night_price}</div>
                    <div class="cart-id" style="display: none;">${item.item_id}</div>
                    <input type="number" value="1" class="cart-quantity">
                </div>
                <svg class="cart-remove" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                </svg>
            </div>`;
        cartContent.insertAdjacentHTML('beforeend', cartItemHtml);

        const newCartRemoveIcon = cartContent.querySelector('.cart-box:last-child .cart-remove');
        newCartRemoveIcon.addEventListener('click', (event) => {
            event.target.closest('.cart-box').remove();
            updateCartCount();
            updateTotalPrice();
            saveCartToLocalStorage();
        });

        const newCartQuantityInput = cartContent.querySelector('.cart-box:last-child .cart-quantity');
        newCartQuantityInput.addEventListener('change', (event) => {
            if (event.target.value < 1) event.target.value = 1;
            updateTotalPrice();
            saveCartToLocalStorage();
        });
    }

    updateCartCount();
    updateTotalPrice();
    saveCartToLocalStorage();
};

const saveCartToLocalStorage = () => {
    const cartBoxes = document.querySelectorAll('.cart-box');
    const cartItems = [];

    cartBoxes.forEach(cartBox => {
        const id = cartBox.querySelector('.cart-id').innerText;
        const image = cartBox.querySelector('.cart-img').src;
        const title = cartBox.querySelector('.cart-product').innerText;
        const price = cartBox.querySelector('.cart-price').innerText;
        const quantity = cartBox.querySelector('.cart-quantity').value;

        cartItems.push({ id, image, title, price, quantity });
    });

    localStorage.setItem('cartItems', JSON.stringify(cartItems));
};

const loadCartFromLocalStorage = () => {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartContent = document.getElementById('cart-content');
    cartContent.innerHTML = ''; // Clear the cart content

    cartItems.forEach(item => {
        const cartItemHtml = `
            <div class="cart-box">
                <img src="${item.image}" alt="${item.title}" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product">${item.title}</div>
                    <div class="cart-price">${item.price}</div>
                    <div class="cart-id" style="display: none;">${item.id}</div>
                    <input type="number" value="${item.quantity}" class="cart-quantity">
                </div>
                <svg class="cart-remove" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                </svg>
            </div>`;
        cartContent.insertAdjacentHTML('beforeend', cartItemHtml);

        const newCartRemoveIcon = cartContent.querySelector('.cart-box:last-child .cart-remove');
        newCartRemoveIcon.addEventListener('click', (event) => {
            event.target.closest('.cart-box').remove();
            updateCartCount();
            updateTotalPrice();
            saveCartToLocalStorage();
        });

        const newCartQuantityInput = cartContent.querySelector('.cart-box:last-child .cart-quantity');
        newCartQuantityInput.addEventListener('change', (event) => {
            if (event.target.value < 1) event.target.value = 1;
            updateTotalPrice();
            saveCartToLocalStorage();
        });
    });

    updateTotalPrice();
    updateCartCount();
};

const updateTotalPrice = () => {
    const cartContent = document.getElementById('cart-content');
    const cartBoxes = cartContent.querySelectorAll('.cart-box');
    let totalPrice = 0;

    cartBoxes.forEach(box => {
        const priceElement = box.querySelector('.cart-price');
        const quantityElement = box.querySelector('.cart-quantity');
        const price = parseFloat(priceElement.textContent.replace('Rs', '').replace(',', ''));
        const quantity = parseInt(quantityElement.value, 10);
        totalPrice += price * quantity;
    });

    document.querySelector('.total-price').textContent = `Rs ${totalPrice.toFixed(2)}`;
};

const updateCartCount = () => {
    const cartContent = document.getElementById('cart-content');
    const cartBoxes = cartContent.querySelectorAll('.cart-box');
    const totalCount = [...cartBoxes].reduce((acc, box) => acc + parseInt(box.querySelector('.cart-quantity').value, 10), 0);

    const cartCountElement = document.getElementById('cartCount');
    cartCountElement.innerText = String(totalCount);
};

function clearFilters() {
    currentCategory = null;
    filterItems(null);
}

document.getElementById('clearFiltersBtn').addEventListener('click', clearFilters);

// Initial display
displayAllItems();
loadCartFromLocalStorage();