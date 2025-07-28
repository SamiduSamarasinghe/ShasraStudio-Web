document.addEventListener('DOMContentLoaded', () => {
    let cartLogo = document.querySelector('.cartLogo');
    let cartClose = document.querySelector('#cart-close');
    let body = document.querySelector('body');
    let myCart = document.querySelector('.myCart');

    let iconCart = document.querySelector('.iconCart');
    let cartClose1 = document.querySelector('#cart-close1');
    let sidebar = document.querySelector('.sidebar');

     // Add event listener to all .cart-remove SVG icons
     document.querySelectorAll('.cart-remove').forEach(icon => {
        icon.addEventListener('click', (event) => {
            // Remove the parent detail-box element
            event.target.closest('.cart-box').remove();
        });
    });
    

    cartLogo.addEventListener('click', () => {
        if (body.classList.contains('sidebar-active')) {
            body.classList.remove('sidebar-active');
            sidebar.classList.remove('active');
        }
        body.classList.add('myCart-active');
        myCart.classList.add('active');
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
});

const btns = [
    {
        id: 1,
        name: 'Canon'
    },
    {
        id: 2,
        name: 'Nikon'
    },
    {
        id: 3,
        name: 'Sony'
    },
];
const filters = [...new Set(btns.map(btn => btn.name))];

document.getElementById('btns').innerHTML = filters.map(btn => {
    return `<button class='fil-p' onclick='filterItems("${btn}")'>${btn}</button>`;
}).join('');

let product = [
    // Your product data...

    {
        id: 1,
        image: 'canon_eos_m50.jpg',
        title: 'Canon EOS M50 Mark II Mirrorless Digital Camera with 15-45mm Lens',
        price: '244,500',
        category: 'canon camera'
    },
    {
        id: 1,
        image: 'canon_eos_r6_.jpg',
        title: 'Canon EOS R6 Mirrorless Digital Camera',
        price: '659,500',
        category: 'canon camera'
    },
    {
        id: 2,
        image: 'nikon-z5-lens.jpg',
        title: 'Nikon Z5 Mirrorless Camera with 24-50mm Lens',
        price: '499,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-fx3.jpg',
        title: 'Sony FX3 Full-Frame Cinema Camera',
        price: '1,150,000',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-fx6.jpg',
        title: 'Sony FX6 Full-Frame Cinema Camera (Body Only)',
        price: '1,799,500',
        category: 'sony'
    },
    {
        id: 1,
        image: 'canon_EOS-R.jpg',
        title: 'Canon EOS R Mirrorless Digital Camera',
        price: '512,500',
        category: 'canon camera'
    },
    {
        id: 2,
        image: 'nikon-z5-mirrorless.jpg',
        title: 'Nikon Z5 Mirrorless Camera',
        price: '359,999',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon_m200.jpg',
        title: 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens',
        price: '172,000',
        category: 'canon camera'
    },
    {
        id: 3,
        image: 'sony-a6700.jpg',
        title: 'Sony a6700 Mirrorless Camera',
        price: '469,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z5.jpg',
        title: 'Nikon Z 5 Mirrorless Digital Camera with Nikon FTZ Mount Adapter',
        price: '329,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-a6700-lens.jpg',
        title: 'Sony a6700 Mirrorless Camera with 16-50mm Lens',
        price: '515,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z6-2.jpg',
        title: 'Nikon Z 6II Mirrorless Digital Camera Body Only',
        price: '499,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon-eos-r3.jpg',
        title: 'Canon EOS R3 Mirrorless Camera',
        price: '1,649,500',
        category: 'canon'
    },
    {
        id: 1,
        image: 'canon-eos-r5.jpg',
        title: 'Canon EOS R5 Mirrorless Digital Camera',
        price: '979,500',
        category: 'canon'
    },
    {
        id: 3,
        image: 'sony-a7cr.jpg',
        title: 'Sony a7CR Mirrorless Camera',
        price: '969,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7r-4.jpg',
        title: 'Sony Alpha a7R IV Mirrorless Digital Camera (Body Only)',
        price: '929,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z6.jpg',
        title: 'Nikon Z 6 Mirrorless Digital Camera Body with Adapter',
        price: '345,500',
        category: 'nikon'
    },
    {
        id: 2,
        image: 'nikon-z6-lens.jpg',
        title: 'Nikon Z 6 Mirrorless Digital Camera with 24-70mm Lens',
        price: '510,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon-eos-r8-.jpg',
        title: 'Canon EOS R8 Mirrorless Camera',
        price: '445,500',
        category: 'canon'
    },
    {
        id: 2,
        image: 'nikon-z7-2.jpg',
        title: 'Nikon Z 7II Mirrorless Digital Camera Body Only',
        price: '749,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'sony-a7c.jpg',
        title: 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens ',
        price: '599,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-alpha.jpg',
        title: 'Sony Alpha a1 Mirrorless Digital Camera (Body Only)',
        price: '2,250,000',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z9.jpg',
        title: 'Nikon Z9 Mirrorless Camera (Body Only)',
        price: '1,639,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-zv.jpg',
        title: 'Sony ZV-E1 Mirrorless Camera with 28-60mm Lens',
        price: '839,000',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7c-2.jpg',
        title: 'Sony a7C II Mirrorless Camera',
        price: '699,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7r-5.jpg',
        title: 'Sony a7R V Mirrorless Camera ',
        price: '900,000',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z8.jpg',
        title: 'Nikon Z8 Mirrorless Camera with FTZ II Mount Adapter',
        price: '1,129,000',
        category: 'nikon'
    },
    {
        id: 2,
        image: 'nikon-z50.jpg',
        title: 'Nikon Z50 Mirrorless Camera',
        price: '229,500',
        category: 'nikon'
    },

];

let currentCategory = null;
let priceFilterActive = false;

const filterItems = (category) => {
    currentCategory = category;
    const filteredProducts = category ? product.filter(item => item.category.toLowerCase().includes(category.toLowerCase())) : product;
    filterItemsByPrice(); // Added to ensure price filter is applied along with category filter
    displayItems(filteredProducts);
};

const filterItemsByPrice = () => {
    const priceRange = document.getElementById('priceRange').value;
    const filteredProducts = product.filter(item => {
        return priceFilterActive ? parseInt(item.price.replace(/,/g, '')) <= parseInt(priceRange) : true;
    });
    displayItems(filteredProducts);
};

const displayAllItems = () => {
    currentCategory = null;
    displayItems(product);
};

const displayItems = (items) => {
    document.getElementById('root').innerHTML = items.map((item, index) => {
        const {image, title, price} = item;
        return `
            <div class='box'>
                <h3 class='h3-1'>${title}</h3>
                <div class='img-box'>
                    <img class='images' src='${image}' alt='${title}'></img>
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
            // Handle button click
            console.log(`Button ${index} clicked for item:`, item);

            const cartCountElement = document.getElementById('cartCount');
            let currentCount = parseInt(cartCountElement.innerText, 10);
            cartCountElement.innerText = String(currentCount + 1);

            addToCart(item);
        });
    });
};
//search function
document.getElementById('searchButton').addEventListener('click', searchProducts);

function searchProducts() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const filteredProducts = product.filter(item => {
        return item.title.toLowerCase().includes(searchText);
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

/*Cart Details*/
const addToCart = (item) => {
    const cartContent = document.getElementById('cart-content');
    const cartItemHtml = `
        <div class="cart-box">
            <img src="${item.image}" alt="${item.title}" class="cart-img">
            <div class="detail-box">
                <div class="cart-product">${item.title}</div>
                <div class="cart-price">${item.price}</div>
                <input type="number" value="1" class="cart-quantity">
            </div>
            <svg class="cart-remove" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
            </svg>
        </div>`;
    cartContent.insertAdjacentHTML('beforeend', cartItemHtml);

    // Add event listener to the newly added .cart-remove SVG icon
    const newCartRemoveIcon = cartContent.querySelector('.cart-box:last-child .cart-remove');
    newCartRemoveIcon.addEventListener('click', (event) => {
        event.target.closest('.cart-box').remove();
        updateCartCount(-1);
        updateTotalPrice();// update total price when item is removed
    });
    const newCartQuantityInput = cartContent.querySelector('.cart-box:last-child .cart-quantity');
    newCartQuantityInput.addEventListener('change', updateTotalPrice);

    updateTotalPrice();// update total price when item is added
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
    currentCount = Math.max(currentCount + value, 0);  // Ensure the count doesn't go below 0
    cartCountElement.innerText = String(currentCount);
};
function saveCartToLocalStorage(cartData) {
    localStorage.setItem('cart', JSON.stringify(cartData));
}
function loadCartFromLocalStorage() {
    const storedCart = localStorage.getItem('cart');
    return storedCart ? JSON.parse(storedCart) : [];
}
function updateCartDisplay() {
    const cart = loadCartFromLocalStorage();
    const cartContainer = document.getElementById('cartContainer');
    cartContainer.innerHTML = '';

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.textContent = item.title;
        cartContainer.appendChild(cartItem);
    });
}

// Initial display
displayAllItems();

const priceRange = document.getElementById('priceRange');
const priceRangeValue = document.getElementById('priceRangeValue');
const root = document.getElementById('root');

function filterProducts() {
    priceFilterActive = true;
    const maxPrice = parseInt(priceRange.value.replace(/,/g, ''), 10);
    priceRangeValue.textContent = `200,000 - ${maxPrice.toLocaleString()}`;
    filterItemsByPrice();
}

function clearFilters() {
    priceFilterActive = false;
    priceRange.value = '';
    priceRangeValue.textContent = '200,000 -';
    currentCategory = null;
    filterItems(null);
}

priceRange.addEventListener('input', filterProducts);
document.getElementById('clearFiltersBtn').addEventListener('click', clearFilters);
