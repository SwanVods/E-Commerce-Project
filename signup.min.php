<?php
if(isset($_POST['submit'])){
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $telp = filter_input(INPUT_POST, 'telpon');
    $passwd = filter_input(INPUT_POST, 'passwd');
    $name = $fname . " " . $lname;
    
    
    require 'koneksi.php';
    
    if (mysqli_connect_error()) {
        die('Koneksi Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
    
        $email_cek = "SELECT `email` FROM `client` WHERE `email` = '$email'";
        $cek = $koneksi->query($email_cek);
        $email_num = $cek->num_rows;
        if($email_num > 0) {
            $emailError = true;
        }
    
        $tel_cek = "SELECT `tel` FROM `client` WHERE `tel` = '$telp'";
        $cek = $koneksi->query($tel_cek);
        $telp_num = $cek->num_rows;
        if ($telp_num > 0) {
            $telpError = true;
        }
    
        if (!isset($emailError) || !isset($telpError)) {
            $sql = "INSERT INTO `client` (`name`, `email`, `pass`, `tel`, `reg_date`) VALUES ('$name', '$email', PASSWORD('$passwd'), '$telp', 'CURRENT_DATE()')";
            
            if ($koneksi->query($sql)) {
                $success = true;
            }
        }
    } 
}
?>