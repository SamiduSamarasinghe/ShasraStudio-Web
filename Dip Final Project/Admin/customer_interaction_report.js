document.addEventListener('DOMContentLoaded', function() {
    fetchMetricsData(fullName);

    function fetchMetricsData(fullName) {
        fetch(`customer_interaction_report.php?fullName=${encodeURIComponent(fullName)}`)
            .then(response => response.json())
            .then(data => {
                populateTables(data);
                generateCharts(data);
            })
            .catch(error => console.error('Error fetching metrics data:', error));
    }

    function populateTables(data) {
        const totalOrdersTable = document.querySelector('#totalOrdersTable tbody');
        data.orders.forEach(order => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${order.order_id}</td>
                <td>${order.product_ids}</td>
                <td>${order.total_price}</td>
                <td>${order.order_date}</td>
                <td>${order.status}</td>
            `;
            totalOrdersTable.appendChild(row);
        });

        const totalRentalsTable = document.querySelector('#totalRentalsTable tbody');
        data.rentals.forEach(rental => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${rental.rent_id}</td>
                <td>${rental.item_id}</td>
                <td>${rental.rent_days}</td>
                <td>${rental.rent_price}</td>
                <td>${rental.rent_date}</td>
                <td>${rental.rent_status}</td>
            `;
            totalRentalsTable.appendChild(row);
        });
    }

    function generateCharts(data) {

        // Total Orders
        const ordersByDate = data.orders.reduce((acc, order) => {
            const date = order.order_date;
            if (!acc[date]) {
                acc[date] = 0;
            }
            acc[date]++;
            return acc;
        }, {});

        const orderDates = Object.keys(ordersByDate);
        const orderCounts = Object.values(ordersByDate);

        const ordersChartCtx = document.getElementById('totalOrdersChart').getContext('2d');
        new Chart(ordersChartCtx, {
            type: 'bar',
            data: {
                labels: orderDates,
                datasets: [{
                    label: 'Total Orders',
                    data: orderCounts,
                    backgroundColor: 'rgba(54, 162, 235)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const spendOrdersChartCtx = document.getElementById('totalSpendOrdersChart').getContext('2d');
        new Chart(spendOrdersChartCtx, {
            type: 'bar',
            data: {
                labels: data.orders.map(order => order.order_date),
                datasets: [{
                    label: 'Total Spend on Orders',
                    data: data.orders.map(order => order.total_price),
                    backgroundColor: 'rgba(255, 99, 132)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Total Rents
        const rentalsByDate = data.rentals.reduce((acc, rental) => {
            const date = rental.rent_date;
            if (!acc[date]) {
                acc[date] = 0;
            }
            acc[date]++;
            return acc;
        }, {});

        const rentalDates = Object.keys(rentalsByDate);
        const rentalCounts = Object.values(rentalsByDate);

        const rentalsChartCtx = document.getElementById('totalRentalsChart').getContext('2d');
        new Chart(rentalsChartCtx, {
            type: 'bar',
            data: {
                labels: rentalDates,
                datasets: [{
                    label: 'Total Rental Transactions',
                    data: rentalCounts,
                    backgroundColor: 'rgba(75, 192, 192)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const spendRentalsChartCtx = document.getElementById('totalSpendRentalsChart').getContext('2d');
        new Chart(spendRentalsChartCtx, {
            type: 'bar',
            data: {
                labels: data.rentals.map(rental => rental.rent_date),
                datasets: [{
                    label: 'Total Spend on Rentals',
                    data: data.rentals.map(rental => rental.rent_price),
                    backgroundColor: 'rgba(153, 102, 255)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const bookingTypesChartCtx = document.getElementById('bookingTypesChart').getContext('2d');
        new Chart(bookingTypesChartCtx, {
            type: 'bar',
            data: {
                labels: data.bookingDates,
                datasets: [{
                    label: 'Event Photography',
                    data: data.eventPhotographyCounts,
                    backgroundColor: 'rgba(255, 159, 64)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }, {
                    label: 'Identification Photography',
                    data: data.identificationPhotographyCounts,
                    backgroundColor: 'rgba(255, 205, 86)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }, {
                    label: 'Studio & Outdoor Photography',
                    data: data.studioOutdoorPhotographyCounts,
                    backgroundColor: 'rgba(75, 192, 192)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Wedding Photography',
                    data: data.weddingPhotographyCounts,
                    backgroundColor: 'rgba(54, 162, 235)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
