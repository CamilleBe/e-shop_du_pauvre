<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    session_start();

    // Vidage panier
    if(isset($_GET['id']) && $_GET['id'] == 'all'){
        $_SESSION['panier'] = [];
    }
    else if(isset($_GET['id']) && intval($_GET['id']) < count($_SESSION['panier'])){
        if($_SESSION['panier'][$_GET['id']]['quantite'] > 1){
            $_SESSION['panier'][$_GET['id']]['quantite']-=1;
        }else{
            array_splice($_SESSION['panier'],$_GET['id'],1);
        }
    }

    header('location: ./../index.php?page=panier');
    exit;