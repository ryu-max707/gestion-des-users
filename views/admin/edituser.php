<!--  
<h1>Modifier l'utilisateur</h1>

<form method="POST" action="index.php?url=editUser">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label for="name">Nom</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label for="role">Rôle</label>
    <select name="role" id="role">
        <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>Utilisateur</option>
        <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>

<a href="index.php?url=admin_dashboard">Retour au tableau de bord admin</a> -->
