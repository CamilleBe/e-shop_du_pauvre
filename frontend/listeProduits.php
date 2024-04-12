<div class="row d-flex justify-content-center">
    <div class="col-10 my-5">
        <h1>Liste des produits</h1>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            // require './bdd/produits.php';
            $products = $productModel->findAll();
            var_dump($products);
            foreach($products as $key => $product) {
                echo '
      <div class="card mx-2" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$product['nom'].'</h5>
          <p class="card-text">'.$product['description'].'</p>
          <p class="card-text">'.$product['prix'].' €</p>
          <a href="./backend/addArticle.php?id='.$$product["id"].'" class="btn btn-primary">Ajouter au panier</a>
        </div>
      </div>
          ';
            }
            ?>
        </div>

    </div>
</div>


