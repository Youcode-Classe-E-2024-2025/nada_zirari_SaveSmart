<x-dashboard>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Analyses Graphiques</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-4">Répartition des dépenses</h3>
                        <canvas id="expensesByCategory"></canvas>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-4">Évolution mensuelle</h3>
                        <canvas id="monthlyExpenses"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Chart(document.getElementById('expensesByCategory'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($expensesByCategory->pluck('name')) !!},
                    datasets: [{
                        data: {!! json_encode($expensesByCategory->pluck('total')) !!},
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                    }]
                }
            });

            new Chart(document.getElementById('monthlyExpenses'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyExpenses->pluck('month')) !!},
                    datasets: [{
                        label: 'Dépenses mensuelles',
                        data: {!! json_encode($monthlyExpenses->pluck('total')) !!},
                        borderColor: '#36A2EB',
                        tension: 0.1
                    }]
                }
            });
        });
    </script>
</x-dashboard>
