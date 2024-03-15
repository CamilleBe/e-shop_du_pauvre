<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once './../PHPMailer/src/Exception.php';
    require_once './../PHPMailer/src/PHPMailer.php';
    require_once './../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();

    $message = '
        <p>Bonjour '. $_SESSION["prenom"] . ' ' . $_SESSION['nom'] . ' <br> Merci pour ta commande :)</p>
    ';

    try {
        $mail->setFrom('no-reply@prestapauvre.com');
        $mail->addAddress($_SESSION['email']);

        $mail->isHTML(true);
        $mail->Subject = "Votrre commande PrestaPauvre";
        $mail->Body = $message;

        $mail->send();

    } catch (Exception $e) {

    }
