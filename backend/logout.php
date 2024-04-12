<?php
ini_set('display_errors', 1);
ini_set('display_startups_errors', 1);
error_reporting(E_ALL);

    session_start();
    session_destroy();
    header('location: ./../index.php');
    exit;
