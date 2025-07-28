document.addEventListener('DOMContentLoaded', function() {
    fetchMetricsData(month);  // Use the 'month' variable from PHP
});

function fetchMetricsData(month) {
    fetch(`profit_report.php?month=${month}`)
        .then(response => response.json())
        .then(data => {
            populateSalesRevenue(data.totalSalesRevenue);
            populateRentalRevenue(data.totalRentalRevenue);
            populateTotalProfit(data.totalProfit);
        })
        .catch(error => console.error('Error fetching metrics data:', error));
}

function populateSalesRevenue(totalSalesRevenue) {
    const salesTableView = document.getElementById('salesRevenueTableView');
    salesTableView.innerHTML = `<table>
                                    <tbody>
                                        <tr>
                                            <td>Rs. ${totalSalesRevenue}</td>
                                        </tr>
                                    </tbody>
                                </table>`;

    const salesRevenueChart = document.getElementById('salesRevenueChart').getContext('2d');
    new Chart(salesRevenueChart, {
        type: 'bar',
        data: {
            labels: ['Total Sales Revenue'],
            datasets: [{
                label: 'Total Sales Revenue',
                data: [totalSalesRevenue],
                backgroundColor: '#4caf50',
                borderColor: '#4caf50',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function populateRentalRevenue(totalRentalRevenue) {
    const rentalTableView = document.getElementById('rentalRevenueTableView');
    rentalTableView.innerHTML = `<table>
                                    <tbody>
                                        <tr>
                                            <td>Rs. ${totalRentalRevenue}</td>
                                        </tr>
                                    </tbody>
                                </table>`;

    const rentalRevenueChart = document.getElementById('rentalRevenueChart').getContext('2d');
    new Chart(rentalRevenueChart, {
        type: 'bar',
        data: {
            labels: ['Total Rental Revenue'],
            datasets: [{
                label: 'Total Rental Revenue',
                data: [totalRentalRevenue],
                backgroundColor: '#2196f3',
                borderColor: '#2196f3',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function populateTotalProfit(totalProfit) {
    const profitTableView = document.getElementById('totalProfitTableView');
    profitTableView.innerHTML = `<table>
                                    <tbody>
                                        <tr>
                                            <td>Rs. ${totalProfit}</td>
                                        </tr>
                                    </tbody>
                                </table>`;

    const totalProfitChart = document.getElementById('totalProfitChart').getContext('2d');
    new Chart(totalProfitChart, {
        type: 'bar',
        data: {
            labels: ['Total Profit'],
            datasets: [{
                label: 'Total Profit',
                data: [totalProfit],
                backgroundColor: '#ff9800',
                borderColor: '#ff9800',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
