<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    require './../bdd/produits.php';
    session_start();

    //$_SESSION['panier'][] = $products[$_GET['id']];
    if(isset($_GET['id']) && intval($_GET['id']) < count($products)) {
        $majQte = false;
        $listProduitsPanier = array_column($_SESSION['panier'], 'nom');
        $indexProduit = array_search($products[$_GET['id']]['nom'], $listProduitsPanier);

            if ($indexProduit >= 0 && $indexProduit !== false) {
                $_SESSION['panier'][$indexProduit]['quantite'] += 1;
                $majQte = true;
            }
            if ($majQte == false) {
                /**
                 * Créer une ligne produit de la forme :
                 * Nom produit | La quantité | le prix unitaire | Le prix total | (option : photo produit)
                 */

                //1 ère méthode : créer 2 tableaux (1 -> infos produits; 1-> pr la quantité), puis fusionner les 2
                // pour générer la ligne produit du panier
                $product = [
                    "nom" => $products[$_GET['id']]["nom"],
                    "prix" => $products[$_GET['id']]["prix"],
                ];
                $qte = ["quantite" => 1];

                $_SESSION['panier'][] = $product + $qte;

                //2 ème méthode
                //$_SESSION['panier'][] = array_merge($product, $qte);

                //var_dump($_SESSION['panier']);
            }


    }

    header('location: ./../index.php?page=produits');
    exit;
