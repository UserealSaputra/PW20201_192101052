<?php
    $conn = mysqli_connect("localhost","root","");
    mysqli_select_db($conn, "lat_dbase");
    $hasil = mysqli_query($conn, "select * from tbl_mhs");
    $hit = mysqli_num_rows($hasil);
    echo "jumlah record $hit";
?>