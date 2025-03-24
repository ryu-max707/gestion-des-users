<?php
 
 
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?url=login');
    exit();
}

// L'utilisateur est connecté, donc on récupère son nom depuis la session
$user_name = $_SESSION['user_name'];  // Supposons que le nom de l'utilisateur est stocké en session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 text-white p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold">Mon Dashboard</h2>
            <nav class="mt-6">
                <ul>
                    <li class="py-2"><a href="#" class="hover:text-gray-300">Accueil</a></li>
                    <li class="py-2"><a href="#" class="hover:text-gray-300">Profil</a></li>
                    <li class="py-2"><a href="#" class="hover:text-gray-300">Paramètres</a></li>
                </ul>
            </nav>
        </div>
        <form action="index.php?url=logout" method="POST">
            <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-700">Déconnexion</button>
        </form>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-10">
        <header class="mb-6">
            <h1 class="text-4xl font-bold text-gray-800 animate-bounce">Bienvenue, <?php echo htmlspecialchars($user_name); ?> !</h1>
        </header>

        <section class="bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-700">Informations</h2>
            <p class="text-gray-600 mt-2">Vous êtes connecté en tant que <span class="font-bold"><?php echo htmlspecialchars($user_name); ?></span>.</p>
        </section>
    </main>
</body>
</html>
