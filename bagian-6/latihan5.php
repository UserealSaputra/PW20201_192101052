<?php
    $conn = mysqli_connect("localhost","root","");
    // mysqli_select_db("lat_dbase");
    mysqli_select_db($conn, "lat_dbase");
    $hasil = mysqli_query($conn, "select * from tbl_mhs");
    While($data=mysqli_fetch_row($hasil)){
        echo "$data[0] $data[1] $data[2]<br>";
    }
?>