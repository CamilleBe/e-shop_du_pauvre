<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    session_start();
    include './html/header.html';
    include './html/nav.php';

    /**
     * MAJ 1: Mettre en place notre Autoloader pour charger kes différentes classes qui seront instanciées dans le process
     */

    use App\Autoloader;
    use App\Models\ProductModel;

    require_once "Autoloader.php";
    Autoloader::register();


    /**
     * Mise en place du routeur
     */
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'contact':
                include './frontend/contact.php';
                break;
            case 'produits':
                $productModel = new ProductModel();
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
        include './frontend/accueil.html';
    }

    include './html/footer.html';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//session_start();

?>






