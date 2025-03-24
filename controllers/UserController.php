<?php
require_once 'models/User.php';
class UserController {
    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=login');


            // Récupérer le nom de l'utilisateur depuis la session
        $user_name = $_SESSION['user_name'];
        }
        require 'views/user/dashboard.php';
    }


    public function adminDashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }
        
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require 'views/admin/dashboard.php';
    }

    public function editUser() {
   
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }
    
      
        $db = new Database();
        $conn = $db->connect();
    
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];
    
           
            $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role, 'id' => $id]);
    
             
            header('Location: index.php?url=admin_dashboard'); // Rediriger vers le tableau de bord admin
            exit();
        }
    
         
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
         
    
    
        require 'views/admin/edituser.php';
    }

    public function deleteUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?url=login');
            exit();
        }
    
        $db = new Database();
        $conn = $db->connect();
        $id = $_GET['id'];
    
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    
        header('Location: index.php?url=admin_dashboard'); // Rediriger vers le tableau de bord admin
        exit();
            
    }
    
    
    
}