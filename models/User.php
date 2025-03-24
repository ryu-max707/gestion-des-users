<?php

require_once __DIR__ . "/../config/database.php";

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour inscrire un utilisateur
    public function register() {
        $sql = "INSERT INTO " . $this->table . " (name, email, password, role, status) 
                VALUES (:name, :email, :password, 'user', 'active')";
        $stmt = $this->conn->prepare($sql);
        
        // On lie les paramètres
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':status', $this->status);
        
        // Exécution de la requête
        return $stmt->execute();
    }

    // Méthode pour la connexion d'un utilisateur
    public function login() {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        
        // Retourner l'utilisateur si trouvé, sinon null
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les utilisateurs (utilisé par l'admin)
    public function getAllUsers() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($sql);
        
        // Retourner tous les utilisateurs sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $name, $email, $role) {
        $sql = "UPDATE " . $this->table . " SET name = :name, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Exécution de la mise à jour
        return $stmt->execute([
            'name' => $name, 
            'email' => $email, 
            'role' => $role, 
            'id' => $id
        ]);
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        // Exécution de la suppression
        return $stmt->execute(['id' => $id]);
    }
}
