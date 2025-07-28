document.addEventListener('DOMContentLoaded', () => {
    const existingCartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

    const productsContainer = document.querySelector('.products');
    let totalPrice = 0;
    let productIds = [];
    let productQuantities = {};

    existingCartItems.forEach(item => {
        const itemTotalPrice = parseFloat(item.price.replace('Rs', '').replace(',', '')) * item.quantity;
        totalPrice += itemTotalPrice;
        productIds.push(item.id);
        productQuantities[item.id] = item.quantity;

        productsContainer.innerHTML += `
            <div class="product" style="display: flex; align-items: center;">
                <img src="${item.image}" alt="Product">
                <div style="flex: 1; padding: 10px;">
                    <div style="display: flex; justify-content: space-between;">
                        <p>${item.title}</p>
                        <p>Qty: ${item.quantity}</p>
                    </div>
                </div>
                <div>
                    <p style="margin: 0; padding: 10px;">Rs${itemTotalPrice.toFixed(2)}</p>
                </div>
            </div>
        `;
    });

    totalPrice = parseFloat(totalPrice.toFixed(2));
    document.getElementById('clientPayTotal').innerHTML = `Total: Rs${totalPrice.toFixed(2)}`;

    document.getElementById("pay-btn").addEventListener("click", function () {
        const email = document.getElementById("email").value;
        const cardNumber = document.getElementById("card-number").value;
        const cvc = document.getElementById("cvc").value;
        const name = document.getElementById("name").value;
        const address = document.getElementById("address").value;
        const city = document.getElementById("city").value;
        const postalCode = document.getElementById("postal-code").value;
        const paymentMethod = document.getElementById("paymethod").value;

        if (!email || !cardNumber || !cvc || !name || !address || !city || !postalCode) {
            alert("Please fill in all the required fields.");
            return;
        }

        const formData = new FormData();
        formData.append('customer_username', localStorage.getItem('username'));
        formData.append('product_ids', productIds.join(','));
        formData.append('product_quantities', JSON.stringify(productQuantities));
        formData.append('total_price', totalPrice.toFixed(2));
        formData.append('email', email);
        formData.append('card_number', cardNumber);
        formData.append('cvc', cvc);
        formData.append('payment_method', paymentMethod);
        formData.append('name_on_card', name);
        formData.append('billing_address', address);
        formData.append('city', city);
        formData.append('postal_code', postalCode);

        fetch('rent_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal("Your Payment is Done", "Order is Placed Successfully!", "success").then(() => {
                    window.location.href = `rentReceipt.html?order_id=${data.order_id}`;
                });
            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error occurred while placing order. Please try again.");
        });
    });
});