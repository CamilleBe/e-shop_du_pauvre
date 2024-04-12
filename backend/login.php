<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

// require './../bdd/users.php';

// $username = $_POST['username'];
// $password = $_POST['password'];

// Version opti
// $listUsername = array_column($users, 'username');
// $indexOfUsername = array_search($username, $listUsername);

// if($indexOfUsername >= 0 && $indexOfUsername !== false){
//   $checkUsername = $username === $users[$indexOfUsername]['username'] ? true : false;
//   $checkPassword = $password === $users[$indexOfUsername]['password'] ? true : false;
//   if($checkUsername && $checkPassword){
//     /**
//      * Génère une session
//      * On ajoute les informations user à l'intérieur
//      * Redirection vers l'accueil avec un message success
//      */
//     session_start();
//     session_regenerate_id();
//     $_SESSION['isLogin'] = true;
//     $_SESSION['nom'] = $users[$indexOfUsername]['nom'];
//     $_SESSION['prenom'] = $users[$indexOfUsername]['prenom'];
//     $_SESSION['email'] = $users[$indexOfUsername]['email'];
//     $_SESSION['panier'] = [];
//     //Redirect
//     header('location: ./../index.php?login=ok');
//     exit;
//   }
// }

    /**
     * Version connexion avec la base de données.
     */

    use App\Autoloader;
    use App\Models\UserModel;

    require_once './../Autoloader.php';
    Autoloader::register();

    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $userModel = new UserModel;
    $user = $userModel->findBy(['email' => $userEmail]);

    if (!empty($user)) {
        $user = $user[0];
        $checkUserEmail = $userEmail === $user['email'] ? true : false;
        $checkPassword = $userPassword === $user['password'] ? true : false;
        if ($checkUserEmail && $checkPassword) {
            /**
             * Génère une session
             * On ajoute les informations user à l'intérieur
             * Redirection vers l'accueil avec un message success
             */
            session_start();
            session_regenerate_id();
            $_SESSION['isLogin'] = true;
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['panier'] = [];
            //Redirect
            header('location: ./../index.php?login=ok');
            exit;
        }
    }


    /**
     * Redirection vers l'accueil avec un message failure
     */
    header('location: ./../index.php?login=ko');
    exit;
