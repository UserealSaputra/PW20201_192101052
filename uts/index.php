<html>
    <head>
        <title>UTS - Pemrograman Web</title>
    </head>
    <style>
        .flex {
            display: flex;
            justify-content: space-between;
        }
        .form-input {
            margin: 12px 2px;
            width: 660px;
        }
        .output{
            width: 40%;
            display: flex;
            justify-content: space-between;
        }
    </style>
    <body>
        <center class="form-input">
            <h3>NUSANTARA COMPUTER CENTER</h3>
        </center>
        <form method="post" id="frm" action="<?php ($_SERVER["PHP_SELF"]);?>">
            <div class="form-input">
                Nama : <input type="text" name=nama id="nama"/>
            </div>
            <div class="form-input">
                Kode Pendaftaran : 
                <select name=kode id="kode" >
                    <option value="" disabled selected></option>
                    <option value="VBSK00108">VBSK00108</option>
                    <option value="DPSJ00210">DPSJ00210</option>
                    <option value="LXSM10105">LXSM10105</option>
                </select>
            </div>
            <div class="form-input">
                Kelas : 
                <select name=kelas id="kelas">
                    <option value="" disabled selected></option>
                    <option value="Reguler">Reguler</option>
                    <option value="Private">Private</option>
                </select>
            </div>
            <div class="form-input flex">
                <div>
                    Jumlah Pertemuan : <input type="number" min="1" name="jtemu" id="jtemu"/> kali
                </div>
                <div>
                    Jumlah Peserta : <input type="number" min="1" name="jpeserta" id="jpeserta"/> orang
                </div>
            </div>
            <div class="form-input">
                Hasil Tes Awal : 
                <select name="grade">
                    <option value="" disabled selected></option>
                    <option value="Grade A">Grade A</option>
                    <option value="Grade B">Grade B</option>
                    <option value="Grade C">Grade C</option>
                </select>
            </div>
            
        </form>
        <center class="form-input">
            <input type="submit" form="frm" value="Proses">
            <button onclick="document.getElementById('output').remove()">Ulang</button>
        </center>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                $nama = $_POST['nama'];
                $kode = $_POST['kode'];
                $kelas = $_POST['kelas'];
                $jtemu = $_POST['jtemu'];
                $jtemu = substr($kode, 7,2);
                $jpeserta = $_POST['jpeserta'];
                $grade = $_POST['grade'];

                $kursus = substr($kode, 0, 2);
                $nourut = substr($kode, 4, 3);
                $khari = substr($kode, 3, 1);
                $hari = "";
                $bykursus = 0;
                $bysub = 0;
                $jenis = "";
                $byplus = 0;
                if($kursus == "VB"){
                    $bykursus = 750000;
                    $jenis = "Visual Basic";
                }elseif($kursus == "DP"){
                    $bykursus = 650000;
                    $jenis = "Delphi";
                }else{
                    $bykursus = 800000;
                    $jenis = "Linux";
                }

                if($khari == "K"){
                    $hari = "Kamis";
                }elseif($khari == "J"){
                    $hari = "Jumat";
                }else{
                    $hari = "Minggu";
                }
                

                if($grade == "Grade A"){
                    $bysub = $bykursus - ($bykursus * 0.5);
                }elseif($grade == "Grade B"){
                    $bysub = $bykursus - ($bykursus * 0.2);
                }else{
                    $bysub = $bykursus;
                }

                if($kelas == "Private" && $jpeserta > 5){
                    $byplus = 75000 * $jpeserta;
                }else if($kelas == "Private" && $jpeserta < 5){
                    $byplus = 200000 * $jpeserta;
                }else if($kelas == "Reguler" && $jpeserta < 10){
                    $byplus = 50000 * $jpeserta;
                }else{
                    $byplus = "Tidak dikenakan biaya";
                }
                $total = 0;
                if($byplus !== "Tidak dikenakan biaya"){
                    $total = $bykursus + $bysub + $byplus;
                }else{
                    $total = $bykursus + $bysub;                    
                }
                printf("<div id='output'>");
                printf("<h3>Output</h3>");

                printf("<h3>Kode Pendaftaran: $kode</h3>");

                printf("<div class='output'>");
                printf("<div>");
                printf("<div>Nama: $nama</div>");
                printf("<div>Kelas: $kelas</div>");
                printf("<div>Hasil Tes Awal: $grade</div>");
                printf("<div>Jumlah Peserta: $jpeserta</div>");
                printf("<div>Biaya Kursus: $bykursus</div>");
                printf("<div>Biaya Subsidi: $bysub</div>");
                printf("</div>");

                printf("<div>");
                printf("<div>Jenis Kurus: $jenis</div>");
                printf("<div>No. Urut: $nourut</div>");
                printf("<div>Hari: $hari</div>");
                printf("<div>Jumlah Pertemuan: $jtemu</div>");
                printf("<div>Biaya Tambahan: $byplus</div>");
                printf("<div>Biaya yang Dibayar: $total</div>");
                printf("</div>");

                printf("</div>");
                printf("</div>");

            }
        ?>
        
        
    </body>
</html>