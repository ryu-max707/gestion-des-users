<?php
 
session_start();

require_once 'config/Database.php';
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/UserController.php";

$url = isset($_GET['url']) ? $_GET['url'] : 'login';

switch ($url) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
    case 'register':
        $auth = new AuthController();
        $auth->register();
        break;
    case 'dashboard':
        $user = new UserController();
        $user->dashboard();
        break;
    case 'admin_dashboard':
  
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $user = new UserController();
            $user->adminDashboard();
        } else {
            // Rediriger l'utilisateur non connecté ou non administrateur vers la page de login
            header('Location: index.php?url=login');
        }
        break;
   case 'editUser':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $user = new UserController();
            $user->editUser();
        } else {
            header('Location: index.php?url=login');
        }
        break;
   case 'deleteUser':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $user = new UserController();
            $user->deleteUser();
        } else {
            header('Location: index.php?url=admin_dashboard');
        }
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php');
        break;
    default:
        echo "Page non trouvée";
        break;
}
?>
