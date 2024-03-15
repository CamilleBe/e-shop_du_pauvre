<?php
    include './html/header.html';
    include './html/nav.php';

    /**
     * Mise en place du rooter
     */
    $page = $_GET['page'];
    //var_dump($page);

    if($page !== null) {
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