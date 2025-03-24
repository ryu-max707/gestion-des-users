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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Inscription</h2>
        <form method="POST" class="space-y-4">
            <input type="text" name="name" placeholder="Nom" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            <input type="password" name="password" placeholder="Mot de passe" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            
            <!-- <label class="flex items-center space-x-2">
                <input type="hidden" name="role" value="admin" class="w-4 h-4"> 
                <span>Créer un compte administrateur</span>
            </label> -->
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">S'inscrire</button>
        </form>
        <p class="text-center text-gray-600 mt-4">Vous avez déjà un compte ? <a href="index.php?url=login" class="text-blue-500 hover:underline">Connectez-vous ici</a></p>
    </div>
</body>
</html>
