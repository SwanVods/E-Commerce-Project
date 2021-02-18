<?php
require 'koneksi.php';
include 'google-api/config.php';

if (isset($code)) {
    $token = $google_client->fetchAccessTokenWithAuthCode($code);
    $google_client->setAccessToken($token['access_token']);
    
    // get profile info
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();

    // Jika berhasil login dari google
    if (isset($data)) {
        $email = $data['email'];
    
        //ambil data user
        $result = $koneksi->query("SELECT * FROM `client` WHERE `email`='$email' LIMIT 1");
        $num = $result->num_rows;
        // jika email telah terdaftar
        if ($num == 1) {
            $_SESSION['email'] = $email;
            header("Location: index.php");
            $koneksi->query("UPDATE `client` SET `active` = '1', `google` = '1' WHERE `email`='$email'");
            header("Location: index.php");
        }
    
        // jika email belum terdaftar 
        else {
            $name = $data['givenName'] . ' ' . $data['familyName'];
            $email = $data['email']; 
            $sql = "INSERT INTO `client` (`name`, `email`, `pass`, `google`, `reg_date`) VALUES ('$name', '$email', PASSWORD('adf5s6qwdczxfwvsb2'), '1', CURDATE());"; 
            if ($koneksi->query($sql)) {
                $_SESSION['email'] = $email;
                $koneksi->query("UPDATE client SET active = '1' WHERE email='$email'");
                header("Location: index.php");
            } else {
                $error = true;
            }
        }
    } else {
        $data = NULL;
    }
} else if (isset($_POST['submit'])) {
    $email = filter_input(INPUT_POST, 'email');
    $passwd = filter_input(INPUT_POST, 'pass');

    // jika bukan login dari google
    $sql = "SELECT * FROM `client` WHERE `email`='$email' AND `pass`= PASSWORD('$passwd') LIMIT 1";
    $result = $koneksi->query($sql);
    $num = $result->num_rows;
    if ($num == 1) {
        session_start();
        $_SESSION['email'] = $email;
        $koneksi->query("UPDATE client SET active = '1' WHERE email='$email'");
        header("Location: index.php");
    } else {
        $error = true;
    }
}
