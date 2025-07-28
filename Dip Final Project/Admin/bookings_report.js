document.addEventListener('DOMContentLoaded', function() {
    // Fetch data from backend
    fetch('bookings_report.php')
        .then(response => response.json())
        .then(data => {
            // Populate total bookings per month table
            const totalBookingsPerMonthTable = document.getElementById('totalBookingsPerMonthTable');
            data.totalBookingsPerMonth.forEach(booking => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${booking.Month}</td><td>${booking.Total_Bookings}</td>`;
                totalBookingsPerMonthTable.appendChild(row);
            });

            // Populate booking types variation table
            const bookingTypesVariationTable = document.getElementById('bookingTypesVariationTable');
            data.bookingTypesVariation.forEach(booking => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${booking.Month}</td>
                    <td>${booking.Event_Photography}</td>
                    <td>${booking.Identification_Photography}</td>
                    <td>${booking.Studio_Outdoor_Photography}</td>
                    <td>${booking.Wedding_Photography}</td>
                `;
                bookingTypesVariationTable.appendChild(row);
            });

            // Generate charts
            generateTotalBookingsPerMonthChart(data.totalBookingsPerMonth);
            generateBookingTypesVariationChart(data.bookingTypesVariation);
        })
        .catch(error => console.error('Error fetching data:', error));
});

function generateTotalBookingsPerMonthChart(data) {
    const labels = data.map(item => item.Month);
    const values = data.map(item => item.Total_Bookings);

    const ctx = document.getElementById('totalBookingsPerMonthChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Bookings',
                data: values,
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
}

function generateBookingTypesVariationChart(data) {
    const labels = data.map(item => item.Month);
    const eventPhotography = data.map(item => item.Event_Photography);
    const identificationPhotography = data.map(item => item.Identification_Photography);
    const studioOutdoorPhotography = data.map(item => item.Studio_Outdoor_Photography);
    const weddingPhotography = data.map(item => item.Wedding_Photography);

    const ctx = document.getElementById('bookingTypesVariationChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Event Photography',
                    data: eventPhotography,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132)',
                    fill: false
                },
                {
                    label: 'Identification Photography',
                    data: identificationPhotography,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235)',
                    fill: false
                },
                {
                    label: 'Studio & Outdoor Photography',
                    data: studioOutdoorPhotography,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86)',
                    fill: false
                },
                {
                    label: 'Wedding Photography',
                    data: weddingPhotography,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192)',
                    fill: false
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
