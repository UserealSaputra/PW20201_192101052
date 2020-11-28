<?php
    // hostname or ip of server
    $servername='localhost';
    // username and password
    $dbusername='root';
    $dbpassword='';
    $link=mysqli_connect("$servername","$dbusername","$dbpassword") or die ( "Koneksi database gagal");
    if ($link){
        echo "Koneksi berhasil";
    }
?>