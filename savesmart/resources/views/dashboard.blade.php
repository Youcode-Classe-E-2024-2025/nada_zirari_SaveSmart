<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SaveSmart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <nav class="bg-blue-500 p-4 text-white flex justify-between">
        <h1 class="text-xl font-bold">SaveSmart</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Se déconnecter</button>
        </form>
    </nav>

    <div class="p-8">
        <h2 class="text-2xl font-bold mb-4">Bienvenue, {{ Auth::user()->name }} ! 🎉</h2>
        <p class="text-gray-700">Ceci est votre tableau de bord. Commencez à gérer vos finances dès maintenant 💸</p>
    </div>
</body>
</html>
