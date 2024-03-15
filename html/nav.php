<?php
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="EKOD-LOGO.svg" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
          <li class="nav-item">
              <a class="nav-link" href="index.php?page=produits">Produits</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="index.php?page=contact">Contact</a>
          </li>
      </ul>
        <!-- Afficheage conditionnel navbarre non log / nav barre log-->
        <?php
            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {

        ?>

          <p>Bonjour <?= $_SESSION['prenom'] ?></p>
          <a href="./index.php?page=panier" class="btn btn-primary">
              Panier
              <span class="badge text-bg-secondary">
                  <?= count($_SESSION['panier']) ?>
              </span>
          </a>
          <a href="./backend/logout.php" class="btn btn-primary">Déconnexion</a>

        <?php
            } else {
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Connexion
        </button>
        <?php
            }
        ?>

    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./backend/login.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>
