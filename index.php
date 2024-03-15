<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    session_start();
    include './html/header.html';
    include './html/nav.php';



    /**
     * Mise en place du rooter
     */

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        //var_dump($page);

        switch ($page) {
            case 'contact':
                include './frontend/contact.php';
                break;

            case 'produits':
                include './frontend/listeProduits.php';
                break;

            case 'panier':
                include './frontend/panier.php';
                break;

            default:
                include './frontend/404.html';
                break;
        }

    } else {
        include "./frontend/accueil.html";
    }



    include './html/footer.html';
?>