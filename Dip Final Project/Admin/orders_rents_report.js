document.addEventListener('DOMContentLoaded', function() {
    // Fetch data from backend
    fetch('orders_rents_report.php')
        .then(response => response.json())
        .then(data => {
            // Populate total orders and rents per month table
            const totalOrdersRentsPerMonthTable = document.getElementById('totalOrdersRentsPerMonthTable');
            data.totalOrdersRentsPerMonth.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${record.Month}</td><td>${record.Total_Orders}</td><td>${record.Total_Rents}</td>`;
                totalOrdersRentsPerMonthTable.appendChild(row);
            });

            // Populate city distribution table
            const cityDistributionTable = document.getElementById('cityDistributionTable');
            data.cityDistribution.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${record.city}</td><td>${record.Total_Orders}</td><td>${record.Total_Rents}</td>`;
                cityDistributionTable.appendChild(row);
            });

            // Generate charts
            generateTotalOrdersRentsPerMonthChart(data.totalOrdersRentsPerMonth);
            generateCityDistributionChart(data.cityDistribution);
        })
        .catch(error => console.error('Error fetching data:', error));
});

function generateTotalOrdersRentsPerMonthChart(data) {
    const labels = data.map(item => item.Month);
    const totalOrders = data.map(item => item.Total_Orders);
    const totalRents = data.map(item => item.Total_Rents);

    const ctx = document.getElementById('totalOrdersRentsPerMonthChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Orders',
                    data: totalOrders,
                    backgroundColor: 'rgba(75, 192, 192)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Rents',
                    data: totalRents,
                    backgroundColor: 'rgba(255, 159, 64)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
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

function generateCityDistributionChart(data) {
    const labels = data.map(item => item.city);
    const totalOrders = data.map(item => item.Total_Orders);
    const totalRents = data.map(item => item.Total_Rents);

    const ctx = document.getElementById('cityDistributionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Orders',
                    data: totalOrders,
                    backgroundColor: 'rgba(75, 192, 192)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Rents',
                    data: totalRents,
                    backgroundColor: 'rgba(255, 159, 64)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
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
