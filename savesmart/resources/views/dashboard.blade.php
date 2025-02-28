@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-beige">

    <h1 class="text-3xl font-bold text-gray-800 mb-10">Hello : {{ $profile->name }}</h1>

    <!-- Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Card Revenus -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700">Total Revenus</h3>
            <p class="text-3xl font-semibold text-green-600">{{ number_format($revenus, 2) }} €</p>
        </div>

        <!-- Card Dépenses -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700">Total Dépenses</h3>
            <p class="text-3xl font-semibold text-red-600">{{ number_format($depenses, 2) }} €</p>
        </div>

        <!-- Card Solde -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700">Solde</h3>
            <p class="text-3xl font-semibold text-blue-600">{{ number_format($revenus - $depenses, 2) }} €</p>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="flex gap-6 mb-8">
        <a href="{{ route('transactions.create') }}" class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition w-full md:w-auto text-center">
            + Nouvelle Transaction
        </a>
        <a href="#" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition w-full md:w-auto text-center">
            + Nouvel Objectif
        </a>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Répartition des Dépenses par Catégorie</h3>
            <div class="h-64">
                <canvas id="expensesChart" ></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Évolution Mensuelle</h3>
            
            <div class="h-64">
            <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Transactions Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Dernières Transactions</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-600">Date</th>
                        <th class="px-6 py-3 text-left text-gray-600">Catégorie</th>
                        <th class="px-6 py-3 text-left text-gray-600">Description</th>
                        <th class="px-6 py-3 text-right text-gray-600">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 text-gray-700">{{ $transaction->date }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $transaction->category }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $transaction->description }}</td>
                        <td class="px-6 py-4 text-right {{ $transaction->type === 'revenu' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'revenu' ? '+' : '-' }} {{ number_format($transaction->amount, 2) }} €
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Dashboard - {{ $profile->name }}</h1>
        <button id="addCategoryBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            + Nouvelle Catégorie
        </button>
    </div>

    <!-- Categories Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @foreach($categories as $category)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold">{{ $category->name }}</h3>
                <div class="flex gap-2">
                    <button class="text-blue-500 hover:text-blue-700" onclick="editCategory({{ $category->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-500 hover:text-red-700" onclick="deleteCategory({{ $category->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <p class="text-gray-600 mt-2">Total: {{ number_format($category->transactions->sum('amount'), 2) }} €</p>
        </div>
        @endforeach
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">Ajouter une Catégorie</h3>
            <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nom de la catégorie</label>
                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Couleur</label>
                    <input type="color" name="color" class="w-full">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Annuler</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration des graphiques Chart.js
    const ctx1 = document.getElementById('expensesChart').getContext('2d');
    const ctx2 = document.getElementById('monthlyChart').getContext('2d');

    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Alimentation', 'Logement', 'Transport', 'Loisirs', 'Autres'],
            datasets: [{
                data: [30, 25, 15, 20, 10],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 12,
                        },
                        color: '#555'
                    }
                }
            }
        }
    });

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Revenus',
                data: [1200, 1900, 1500, 1800, 2000, 1700],
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                fill: true,
                borderWidth: 2
            }, {
                label: 'Dépenses',
                data: [1000, 1700, 1400, 1600, 1800, 1500],
                borderColor: '#F44336',
                backgroundColor: 'rgba(244, 67, 54, 0.2)',
                fill: true,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 12,
                        },
                        color: '#555'
                    }
                }
            }
        }
    });
</script>
@endpush

@endsection
