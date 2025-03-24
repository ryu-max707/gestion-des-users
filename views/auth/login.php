<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <?= $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); // Supprime le message après affichage ?>
<?php endif; ?>

<?php if (isset($_SESSION['success_message'])) : ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); // Supprime le message après affichage ?>
<?php endif; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-semibold text-center text-green-700 mb-6 "> Bienvenue  dans Notre Gestion Users</h1>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-600">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Entrez votre email" required>
            </div>
            <div>
                <label class="block text-gray-600">Mot de passe</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Se connecter</button>
        </form>
        <p class="text-center text-gray-600 mt-4">Vous n'avez pas de compte ? <a href="index.php?url=register" class="text-blue-500 hover:underline">Inscrivez-vous ici</a></p>
    </div>
</body>
</html>

