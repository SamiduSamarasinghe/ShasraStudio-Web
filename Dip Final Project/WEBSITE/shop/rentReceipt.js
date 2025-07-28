document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('order_id');
    const customerUsername = localStorage.getItem('username');

    if (orderId) {
        fetch(`rent_order.php?order_id=${orderId}`)
            .then(response => response.json())
            .then(order => {
                if (order.error) {
                    alert(order.error);
                } else {
                    document.getElementById('date').textContent = new Date(order.order_date).toLocaleDateString();
                    document.getElementById('receipt-id').textContent = order.order_id;

                    fetch(`get_customer_details.php`)
                        .then(response => response.json())
                        .then(customer => {
                            if (customer.error) {
                                alert(customer.error);
                            } else {
                                document.getElementById('customer-name').textContent = customer.Full_Name;

                                const productIds = order.product_ids.split(',');
                                const productQuantities = JSON.parse(order.product_quantities);
                                const orderItemsContainer = document.getElementById('order-items');

                                let subtotal = 0;

                                productIds.forEach(productId => {
                                    fetch(`rent_items.php?product_id=${productId}`)
                                        .then(response => response.json())
                                        .then(product => {
                                            const quantity = productQuantities[productId];
                                            const productTotal = product.per_night_price * quantity;
                                            subtotal += productTotal;

                                            orderItemsContainer.innerHTML += `
                                                <tr>
                                                    <td>${product.item_name}</td>
                                                    <td>${quantity}</td>
                                                    <td>Rs ${productTotal.toFixed(2)}</td>
                                                </tr>
                                            `;

                                            document.getElementById('total').textContent = `Rs ${order.total_price}`;
                                        });
                                });
                            }
                        });
                }
            })
            .catch(error => console.error('Error fetching order details:', error));
    } else {
        alert('No order ID or customer username provided');
    }
});
