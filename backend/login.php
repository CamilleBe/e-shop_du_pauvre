<?php
    //Récupérer les données clients

    require './../bdd/users.php';
    //var_dump($users);

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Version opti
    $listUsername = array_column($users, 'username');
    //var_dump($listUsername);
    $indexOfUsername = array_search($username, $listUsername);

    if ($indexOfUsername >= 0 && $indexOfUsername !== false) {
        $checkUsername = $username === $users[$indexOfUsername]['username'] ? true : false; //condition if-else sur une même ligne
        $checkPassword = $password === $users[$indexOfUsername]['password'] ? true : false; //condition if-else sur une même ligne

        if ($checkUsername && $checkPassword) {
            /**
             * Génère une session
             * On ajoute les informations user à l'intérieur
             * Redirection vers l'accueil avec un message de success
             */
            session_start();
            session_regenerate_id();
            $_SESSION['isLogin'] = true;
            $_SESSION['nom'] = $users[$indexOfUsername]['nom'];
            $_SESSION['prenom'] = $users[$indexOfUsername]['prenom'];
            $_SESSION['email'] = $users[$indexOfUsername]['email'];
            $_SESSION['panier'] = [];

            //Redirect to login
            header('location: ./../index.php?login=ok');
            exit;
        }
    }

    /**
     * Redirection mais avec un message failer
     */
    header('location: ./../index.php?login=ko');
    exit;