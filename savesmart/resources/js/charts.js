import Chart from 'chart.js/auto';

// Dépenses par catégorie (Pie Chart)
const categoryChart = new Chart(
    document.getElementById('expensesByCategory'),
    {
        type: 'pie',
        data: {
            labels: categoryData.map(category => category.name),
            datasets: [{
                data: categoryData.map(category => category.total),
                backgroundColor: categoryData.map(category => category.color)
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    }
);

// Évolution mensuelle (Line Chart)
const monthlyChart = new Chart(
    document.getElementById('monthlyExpenses'),
    {
        type: 'line',
        data: {
            labels: monthlyData.map(data => data.month),
            datasets: [{
                label: 'Dépenses mensuelles',
                data: monthlyData.map(data => data.total),
                borderColor: '#10B981',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }
);

// Budget vs Dépenses (Bar Chart)
const budgetChart = new Chart(
    document.getElementById('budgetComparison'),
    {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Budget',
                data: budgetData,
                backgroundColor: '#10B981'
            }, {
                label: 'Dépenses',
                data: expenseData,
                backgroundColor: '#EF4444'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }
);
