<div class="row d-flex justify-content-center">
    <div class="col-10 my-5">
        <h1>Liste Produits</h1>

        <?php
            require './bdd/produits.php';
            //var_dump($products);

            foreach ($products as $key => $product) {
                echo '
                    <div class="card" style="width: 18rem;">
                       <img src="..." class="card-img-top" alt="...">
                          <div class="card-body">
                             <h5 class="card-title">' . $products['nom'] . '</h5>
                                <p class="card-text">' . $products['description'] . '</p>
                                <p class="card-text">' . $products['prix'] . ' €</p>
                                <a href="" class="btn btn-primary">Ajouter au panier</a>
                          </div>
                    </div>
                ';
            };
        ?>



    </div>
</div>


