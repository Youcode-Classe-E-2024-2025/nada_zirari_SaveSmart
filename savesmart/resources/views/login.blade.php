<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function selectProfile(profileId) {
            document.getElementById('selected_profile').value = profileId;
            document.querySelectorAll('.profile-option').forEach(el => {
                el.classList.remove('border-indigo-500', 'ring-2', 'ring-indigo-500');
            });
            document.getElementById('profile-' + profileId).classList.add('border-indigo-500', 'ring-2', 'ring-indigo-500');
            document.getElementById('login-form').classList.remove('hidden');
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-indigo-600 flex items-center justify-center min-h-screen">
    <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden max-w-2xl w-full p-8">
        <h2 class="text-3xl font-semibold text-gray-700 text-center">Qui utilise SaveSmart ?</h2>
        <p class="text-gray-500 text-center mb-6">Sélectionnez un profil</p>

        <!-- Sélection des profils -->
        <div class="flex justify-center gap-4">
            @foreach($profiles as $profile)
                <div id="profile-{{ $profile->id }}" onclick="selectProfile({{ $profile->id }})"
                     class="profile-option cursor-pointer flex flex-col items-center p-3 border rounded-full hover:border-indigo-500 transition">
                    <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-xl font-bold">{{ substr($profile->name, 0, 1) }}</span>
                    </div>
                    <p class="text-sm mt-2">{{ $profile->name }}</p>
                </div>
            @endforeach
        </div>

        <!-- Formulaire caché, affiché après sélection -->
        <form id="login-form" class="mt-6 hidden" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="profile_id" id="selected_profile" required>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="password" class="w-full p-3 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white p-3 rounded-lg hover:bg-indigo-600 transition duration-300">
                Se connecter
            </button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Nouveau sur SaveSmart ? <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Créer un compte</a>
        </p>
    </div>
</body>
</html>
