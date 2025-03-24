<?php
 
require_once 'models/User.php';

class AuthController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $conn = $db->connect();
            $user = new User($conn);
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
            if ($user->register()) {
                $_SESSION['success_message'] = "Bravo ! Vous êtes inscrit. Veuillez vous connecter.";
                header('Location: index.php?url=login');
                exit();
            }
        }
        require 'views/auth/register.php';
    }
    

        
    

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $conn = $db->connect();
            $user = new User($conn);
            $user->email = $_POST['email'];
            $data = $user->login();
    
            if ($data && password_verify($_POST['password'], $data['password'])) {
                // Stocker les informations dans la session
                $_SESSION['user_id'] = $data['id'];  
                $_SESSION['role'] = $data['role'];    
                $_SESSION['user_name'] = $data['name'];  
    
                // Vérification du rôle pour rediriger vers le bon tableau de bord
                if ($_SESSION['role'] === 'admin') {
                    header('Location: index.php?url=admin_dashboard'); // Redirection vers le dashboard admin
                } else {
                    header('Location: index.php?url=dashboard'); // Redirection vers le dashboard utilisateur
                }
                exit();
            } else {
                // Message d'erreur en cas d'identifiants incorrects
                $_SESSION['error_message'] = "Identifiants incorrects !";
            }
        }
        require 'views/auth/login.php';
    }
    
}