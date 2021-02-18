<?php
require 'koneksi.php';
include 'fb-config.php';

if (isset($_GET['code'])) {
    if (isset($_SESSION['access_token'])) {
        $access_token = $_SESSION['access_token'];
    } else {
        $access_token = $facebook_helper->getAccessToken();
        $_SESSION['access_token'] = $access_token;
        
        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }

    $graph_response = $facebook->get("/me?fields=name,email", $access_token);

    $data = $graph_response->getGraphUser();


    if (isset($data)) {
        $email = $data['id'];
        var_dump($email);
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
            $name = $data['name'];
            $email = $data['id'];
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
else {
    $auth_url = $facebook_helper->getLoginUrl("https://vanzystore.000webhostapp.com/login.php", ['id']);
}