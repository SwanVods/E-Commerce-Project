<?php
include 'koneksi.php'; 
include 'google-api/config.php';

if(isset($_SESSION['email'])) {
    $google_client->revokeToken();
    $email = $_SESSION['email'];
    $koneksi->query("UPDATE client SET active = '0' WHERE email='$email'");
    $_SESSION['email']='';
    unset($_SESSION['email']);
    session_unset();
    session_destroy();
    header("Location: index.php");
} else if (isset($_SESSION['access_token'])){
    session_destroy();
    header("Location: index.php");
} else {
    header("Location: index.php");
}