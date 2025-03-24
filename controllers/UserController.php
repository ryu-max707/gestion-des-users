<?php
require_once 'models/User.php';
 

class UserController {
    private $conn;  

    // 🔹 Constructeur : Initialise la connexion une seule fois
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=login');
            exit();
        }

        // Récupérer le nom de l'utilisateur depuis la session
        $user_name = $_SESSION['user_name'];

        require 'views/user/dashboard.php';
    }

    public function adminDashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }

        // 🔹 Utilisation de la connexion stockée
        $stmt = $this->conn->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require 'views/admin/dashboard.php';
    }

    public function editUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'id' => $id
            ]);

            header('Location: index.php?url=admin_dashboard');
            exit();
        }

        $id = $_GET['id'];
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        require 'views/admin/edituser.php';
    }


    

    public function deleteUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }

        $id = $_GET['id'];

        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?url=admin_dashboard');
        exit();
    }

    public function toggleUserStatus() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }
    
        $id = $_GET['id'];
    
        // Récupérer le statut actuel
        $stmt = $this->conn->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
            $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->execute([$newStatus, $id]);
        }
    
        header('Location: index.php?url=admin_dashboard');
    }
    

    
}
