<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

/**
 * Version données en local (via ./bdd/produits.php)
 */
// require './../bdd/produits.php';
session_start();

// if (isset($_GET['id']) && intval($_GET['id']) < count($products)) {
//   $majQte = false;
//   $listProduitsPanier = array_column($_SESSION['panier'], 'nom');
//   $indexProduit = array_search($products[$_GET['id']]['nom'], $listProduitsPanier);
//   if ($indexProduit >= 0 && $indexProduit !== false) {
//     $_SESSION['panier'][$indexProduit]['quantite'] += 1;
//     $majQte = true;
//   }
//   if ($majQte == false) {
//     $product = [
//       "nom" => $products[$_GET['id']]["nom"],
//       "prix" => $products[$_GET['id']]["prix"]
//     ];
//     $qte = ["quantite" => 1];
//     $_SESSION['panier'][] = $product + $qte;
//   }
// }

/**
 * Version avec la base de données.
 */

use App\Autoloader;
use App\Models\ProductModel;

require_once "./../Autoloader.php";
Autoloader::register();

if (isset($_GET['id'])) {
    $productModel = new ProductModel;
    $product = $productModel->find($_GET['id']);
    if (!empty($product)) {
        $majQte = false;
        $listProduitsPanier = array_column($_SESSION['panier'], 'nom');
        $indexProduit = array_search($product['nom'], $listProduitsPanier);
        if ($indexProduit >= 0 && $indexProduit !== false) {
            $_SESSION['panier'][$indexProduit]['quantite'] += 1;
            $majQte = true;
        }
        if ($majQte == false) {
            $product = [
                "nom" => $product["nom"],
                "prix" => $product["prix"]
            ];
            $qte = ["quantite" => 1];
            $_SESSION['panier'][] = $product + $qte;
        }
    }
}

header('location: ./../index.php?page=produits');
exit;
