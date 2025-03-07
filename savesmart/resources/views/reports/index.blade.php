
<x-dashboard>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Exporter les Rapports</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('reports.pdf') }}" class="flex flex-col items-center p-6 bg-white border rounded-lg hover:bg-gray-50">
                            <i class="fas fa-file-pdf text-red-500 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold">Exporter en PDF</h3>
                            <p class="text-gray-600 mt-2 text-center">Télécharger le rapport au format PDF</p>
                        </a>

                        <a href="{{ route('reports.excel') }}" class="flex flex-col items-center p-6 bg-white border rounded-lg hover:bg-gray-50">
                            <i class="fas fa-file-excel text-green-500 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold">Exporter en Excel</h3>
                            <p class="text-gray-600 mt-2 text-center">Télécharger le rapport au format Excel</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>