<x-app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900">Mes Objectifs d'Épargne</h2>
                    <button onclick="document.getElementById('addGoalModal').classList.remove('hidden')" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Nouvel Objectif
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($savingsGoals as $goal)
                        <div class="bg-white rounded-lg shadow p-6 border">
                            <h3 class="text-lg font-medium text-gray-900">{{ $goal->title }}</h3>
                            <div class="mt-2">
                                <div class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                                            <span class="text-xs font-semibold inline-block text-blue-600">
                                                {{ number_format(($goal->current_amount / $goal->target_amount) * 100, 0) }}%
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-semibold inline-block text-blue-600">
                                                {{ number_format($goal->current_amount, 2) }}€ / {{ number_format($goal->target_amount, 2) }}€
                                            </span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                                        <div style="width:{{ ($goal->current_amount / $goal->target_amount) * 100 }}%" 
                                             class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Add Goal Modal -->
    <div id="addGoalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">Nouvel Objectif d'Épargne</h3>
            <form action="{{ route('savings-goals.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nom de l'objectif</label>
                    <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Montant cible (€)</label>
                    <input type="number" name="target_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Montant initial (€)</label>
                    <input type="number" name="current_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="0" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="document.getElementById('addGoalModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Créer</button>
                </div>
            </form>
        </div>
    </div>
</x-app>
