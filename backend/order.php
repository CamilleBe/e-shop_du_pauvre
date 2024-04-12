<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once './../PHPMailer/src/Exception.php';
    require_once './../PHPMailer/src/PHPMailer.php';
    require_once './../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();

    $message = '
        <p>Bonjour '.$_SESSION["prenom"].' '. $_SESSION['nom'].'
        <br>
        Voici le récapitulatif de votre commande fake : </p>
        <table>
          <thead>
            <tr>
              <th>Nom du produit</th>
              <th>Quantité</th>
              <th>Prix unitaire</th>
              <th>Prix Total</th>
            </tr>
          </thead>
          <tbody>
      ';
    $total = 0;
    foreach($_SESSION['panier'] as $key => $product){
        $message .= "<tr><td>".$product["nom"]."</td><td>".$product["quantite"]."</td><td>".$product["prix"]."</td><td>".$product["prix"]*$product["quantite"]."€</td></tr>";
        $total += ($product["prix"]*$product["quantite"]) * 1.2;
    }
    $message .= "
        </tbody>
        </table>
        <p>Total : ".$total."</p>
      ";

    try{
        $mail->setFrom('no-reply@prestapauvre.com');
        $mail->addAddress($_SESSION['email']);

        $mail->isHTML(true);
        $mail->Subject = "Votre commande PrestaPauvre";
        $mail->Body = $message;

        $mail->send();
        $_SESSION['panier'] = [];
        header('location: ./../index.php?page=panier');
        exit;
    }catch(Exception $e){
        header('Location: ./../index.php?send=ko');
        exit;
    }