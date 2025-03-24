<?php

require_once 'models/User.php';

class AuthController {
    private $conn;  

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User($this->conn);
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
            $user = new User($this->conn);
            $user->email = $_POST['email'];
            $data = $user->login();

            if ($data) {
                // Vérifier si l'utilisateur est inactif
                if ($data['status'] === 'inactive') {
                    $_SESSION['error_message'] = "Votre compte est désactivé. Veuillez contacter un administrateur.";
                    header("Location: index.php?url=login");
                    exit();
                }

                // Vérifier le mot de passe
                if (password_verify($_POST['password'], $data['password'])) {
                    // Stocker les informations dans la session
                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['role'] = $data['role'];
                    $_SESSION['user_name'] = $data['name'];

                    // Redirection en fonction du rôle
                    $redirectUrl = ($_SESSION['role'] === 'admin') ? 'admin_dashboard' : 'dashboard';
                    header("Location: index.php?url=$redirectUrl");
                    exit();
                }
            }

            // Si l'authentification échoue
            $_SESSION['error_message'] = "Identifiants incorrects !";
        }

        require 'views/auth/login.php';
    }
}
