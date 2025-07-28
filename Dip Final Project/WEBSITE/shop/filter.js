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
});

const fetchProducts = () => {
    fetch('filter.php')
        .then(response => response.json())
        .then(data => {
            product = data;
            displayAllItems();
            populateFilterButtons();
        });
};

const btns = [
    { id: 1, name: 'Canon' },
    { id: 2, name: 'Nikon' },
    { id: 3, name: 'Sony' }
];

const filters = [...new Set(btns.map(btn => btn.name))];

const populateFilterButtons = () => {
    document.getElementById('btns').innerHTML = filters.map(btn => {
        return `<button class='fil-p' onclick='filterItems("${btn}")'>${btn}</button>`;
    }).join('');
};

let product = [];
let currentCategory = null;
let priceFilterActive = false;

const filterItems = (category) => {
    currentCategory = category;
    const filteredProducts = category ? product.filter(item => item.category.toLowerCase().includes(category.toLowerCase())) : product;
    filterItemsByPrice(filteredProducts); // Ensure price filter is applied along with category filter
};

const filterItemsByPrice = (filteredProducts) => {
    const priceRange = document.getElementById('priceRange').value;
    const filteredByPrice = filteredProducts.filter(item => {
        return priceFilterActive ? parseInt(item.price) <= parseInt(priceRange) : true;
    });
    displayItems(filteredByPrice);
};

const displayAllItems = () => {
    currentCategory = null;
    displayItems(product);
};

const displayItems = (items) => {
    document.getElementById('root').innerHTML = items.map((item, index) => {
        const { id, image_url, name, price } = item;
        return `
            <div class='box'>
                <h3 class='h3-1'>${name}</h3>
                <div class='img-box' onclick='viewProduct(${id})'>
                    <img class='images' src='${image_url}' alt='${name}'></img>
                </div>
                <div class='bottom'>
                    <h2 class='h2-1'>Rs ${price}.00</h2>
                    <button id='btnBuyCartItem-${index}' class='btnBuyCartItem'>
                        <svg id='iconCart4' aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>`;
    }).join('');

    items.forEach((item, index) => {
        const button = document.getElementById(`btnBuyCartItem-${index}`);
        button.addEventListener('click', () => {
            console.log(`Button ${index} clicked for item:`, item);
            addToCart(item);
        });
    });
};

const viewProduct = (id) => {
    window.location.href = `product1.html?id=${id}`;
};

document.getElementById('searchButton').addEventListener('click', searchProducts);

function searchProducts() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const filteredProducts = product.filter(item => {
        return item.name.toLowerCase().includes(searchText);
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

// Add to cart functionality
const addToCart = (item) => {
    const cartContent = document.getElementById('cart-content');

    // Check if the item already exists in the cart
    const existingCartItem = [...cartContent.children].find(cartBox => cartBox.querySelector('.cart-id').innerText === item.id.toString());

    if (existingCartItem) {
        // Increase the quantity if the item already exists
        const quantityInput = existingCartItem.querySelector('.cart-quantity');
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
    } else {
        // Add a new item to the cart
        const cartItemHtml = `
            <div class="cart-box">
                <img src="${item.image_url}" alt="${item.name}" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product">${item.name}</div>
                    <div class="cart-price">${item.price}</div>
                    <div class="cart-id" style="display: none;">${item.id}</div>
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
            updateCartCount(-1);
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

    updateCartCount(1);
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
            updateCartCount(-1);
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
};

const updateTotalPrice = () => {
    const cartContent = document.getElementById('cart-content');
    const cartBoxes = cartContent.querySelectorAll('.cart-box');
    let totalPrice = 0;

    cartBoxes.forEach(box => {
        const priceElement = box.querySelector('.cart-price');
        const quantityElement = box.querySelector('.cart-quantity');
        const price = parseInt(priceElement.textContent.replace(/,/g, ''), 10);
        const quantity = parseInt(quantityElement.value, 10);
        totalPrice += price * quantity;
    });

    document.querySelector('.total-price').textContent = `Rs ${totalPrice.toLocaleString()}.00`;
};

const updateCartCount = (value) => {
    const cartCountElement = document.getElementById('cartCount');
    let currentCount = parseInt(cartCountElement.innerText, 10);
    currentCount = Math.max(currentCount + value, 0);
    cartCountElement.innerText = String(currentCount);
};

const priceRange = document.getElementById('priceRange');
const priceRangeValue = document.getElementById('priceRangeValue');

function filterProducts() {
    priceFilterActive = true;
    const maxPrice = parseInt(priceRange.value.replace(/,/g, ''), 10);
    priceRangeValue.textContent = `200,000 - ${maxPrice.toLocaleString()}`;
    filterItemsByPrice(product);
}

function clearFilters() {
    priceFilterActive = false;
    priceRange.value = '';
    priceRangeValue.textContent = '200,000 -';
    currentCategory = null;
    filterItems(null);
}

document.getElementById('priceRange').addEventListener('input', filterProducts);
document.getElementById('clearFiltersBtn').addEventListener('click', clearFilters);

document.getElementById("btn-buy").addEventListener('click', () => {
    console.log("BUY ITEM CLICKED");
});
