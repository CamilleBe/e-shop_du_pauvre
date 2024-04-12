<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

use App\Autoloader;
use Couchbase\User;
use App\Models\UserModel;

require_once './../Autoloader.php';
Autoloader::register();

$userEmail = $_POST['email'];
$userPassword = $_POST["password"];

$userModel = new UserModel;
$user = $userModel->findBy(['email' => $userEmail]);

if(!empty($user)) {
    $user = $user[0];
    $checkUserEmail = $userEmail === $userEmail['$email'] ? true : false; //condition if-else sur une même ligne
    $checkPassword = $userPassword === $userPassword['password'] ? true : false; //condition if-else sur une même ligne

    if ($checkUserEmail && $checkPassword) {
        /**
         * Génère une session
         * On ajoute les informations user à l'intérieur
         * Redirection vers l'accueil avec un message de success
         */
        session_start();
        session_regenerate_id();
        $_SESSION['isLogin'] = true;
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['panier'] = [];

        //Redirect to login
        header('location: ./../index.php?login=ok');
        exit;
    }
}