<div class="row d-flex justify-content-center">
    <div class="col-10 my-5">
        <h1>Panier</h1>
        <?php
            if ($_SESSION['panier'] == []) {
                echo '<h2>Oh non... Le panier est vide... :\'(</h2>';
            } else { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Prix total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $totalTTC = 0;
                            foreach ($_SESSION['panier'] as $key => $product) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td><?= $product['nom'] ?></td>
                                    <td><?= $product['quantite'] ?></td>
                                    <td><?= $product['prix'] . '€' ?></td>
                                    <td><?= $product['quantite'] * $product['prix'] ?></td>
                                    <td>
                                        <a href="./backend/removeArticle.php?id=<?= $key ?>" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $totalTTC += ($product['quantite'] * $product['prix']) * 1.2;
                            }
                        ?>
                    </tbody>
                </table>
                <p>Total TTC :  <?= $totalTTC ?> € </p>
                <a href="./backend/order.php" class="btn btn-success">Commander</a>
                <a href="./backend/removeArticle.php?id=all" class="btn btn-danger">Vider le panier</a>
           <?php } ?>


    </div>
</div>
