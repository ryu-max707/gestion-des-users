<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
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
                <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-700 w-full">Déconnexion</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            <h1 class="text-2xl font-bold mb-5">Bienvenue  Administrateur</h1>
            <div class="bg-white shadow-md rounded p-5">
                <h2 class="text-xl font-semibold mb-3">Gestion des utilisateurs</h2>
                <table class="w-full border-collapse border border-gray-300 text-center">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nom</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Rôle</th>
                            <th class="border p-2">update</th>
                            <th class="border p-2">status</th>
                            <th class="border p-2">Actions</th>
                             

                             
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users) && is_array($users)) : ?>
                            <?php foreach ($users as $user): ?>
                                <tr class="bg-gray-50 hover:bg-gray-100 transition duration-200">
                                    <td class="border p-2 flex items-center justify-center gap-2">
                                        <i data-lucide="user-circle" class="text-blue-600"></i> 
                                        <?= htmlspecialchars($user['id']) ?>
                                    </td>
                                    <td class="border p-2"><?= htmlspecialchars($user['name']) ?></td>
                                    <td class="border p-2"><?= htmlspecialchars($user['email']) ?></td>
                                    <td class="border p-2"><?= htmlspecialchars($user['role']) ?></td>
                                    <td class="border p-2 flex justify-center gap-3">
                                        <button onclick="openModal(<?= $user['id'] ?>, '<?= htmlspecialchars($user['name']) ?>', '<?= htmlspecialchars($user['email']) ?>', '<?= htmlspecialchars($user['role']) ?>')" class="text-yellow-500 hover:text-yellow-700">
                                            <i data-lucide="edit"></i>
                                        </button>
                                        <a href="index.php?url=deleteUser&id=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')" class="text-red-500 hover:text-red-700">
                                            <i data-lucide="trash"></i>
                                        </a>
                                        <td class="border p-2">
    <?php if ($user['status'] == 'active'): ?>
        <span class="text-green-500 font-bold">✔ Actif</span>
    <?php else: ?>
        <span class="text-red-500 font-bold">✖ Inactif</span>
    <?php endif; ?>
</td>
<td class="border p-2 flex justify-center gap-3">
    <a href="index.php?url=toggleUserStatus&id=<?= $user['id'] ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">
        <?= ($user['status'] == 'active') ? 'Désactiver' : 'Activer' ?>
    </a>
    
</td>
                      
                                </tr>
                                
                                

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="border p-2">Aucun utilisateur trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Modification -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-5 rounded shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-3">Modifier l'utilisateur</h2>
            <form method="POST" action="index.php?url=editUser">
                <input type="hidden" name="id" id="editId">
                <label for="editName" class="block">Nom</label>
                <input type="text" name="name" id="editName" class="w-full border p-2 mb-2" required>
                
                <label for="editEmail" class="block">Email</label>
                <input type="email" name="email" id="editEmail" class="w-full border p-2 mb-2" required>
                
                <label for="editRole" class="block">Rôle</label>
                <select name="role" id="editRole" class="w-full border p-2 mb-4">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Admin</option>
                </select>
                
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Mettre à jour</button>
                <button type="button" onclick="closeModal()" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Annuler</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, name, email, role) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        lucide.createIcons();
    </script>
</body>
</html>
