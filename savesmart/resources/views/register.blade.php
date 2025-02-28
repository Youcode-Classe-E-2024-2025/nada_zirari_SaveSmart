<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SaveSmart - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-4xl flex bg-white rounded-lg shadow-lg overflow-hidden">
        
        <!-- Section Image -->
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/finance.jpg') }}');">
            <div class="h-full bg-black bg-opacity-40 flex items-center justify-center">
                <h2 class="text-white text-3xl font-bold text-center px-4">Prenez le contrôle de vos finances avec SaveSmart</h2>
            </div>
        </div>

        <!-- Section Formulaire -->
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center mb-4">Créer un compte</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Nom</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                    S'inscrire
                </button>
            </form>

            <p class="mt-4 text-center">Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Se connecter</a>
            </p>
        </div>
    </div>

</body>
</html>
