<div class="container mt-5">
    <div class="row">
        <div class="col-9">
            <h3>DATA LOGISTIK LEMBAR KERJA SISWA(LKS)</h3>
            <h4>Programmer: Yusril Saputra</h4>
            <?php Flasher::flash(); ?>
            <br/>

            <div style="display: flex;justify-content: space-between;">
                <a href="<?= BASEURL; ?>/stock">Input Stock</a>
                <a>Distribusi</a>
                <a href="<?= BASEURL; ?>/stock/check">Check Stock</a>
            </div>
            <br/>
            <br/>

            <h4>Form Input Stock LKS</h4>
            <br/>
            <form action="<?= BASEURL; ?>/school/tambah" method="post" id="form">
                <input type="hidden" name="id" id="up_id" />
                <input type="hidden" name="stock_id" id="stock_id" />
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Nama Sekolah</label>
                    <input id="nama" name="nama" type="text" required/>
                </div>
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Kelas</label>
                    <div id="kelas" style="display: flex; justify-content: space-between; width: 65%;">
                        <label>
                            <input type="radio" name="kelas" value="1" onchange="pilihHarga('1')" required> 1
                        </label>
                        <label>
                            <input type="radio" name="kelas" value="2" onchange="pilihHarga('2')"> 2
                        </label>
                        <label>
                            <input type="radio" name="kelas" value="3" onchange="pilihHarga('3')"> 3
                        </label>
                        <label>
                            <input type="radio" name="kelas" value="4" onchange="pilihHarga('4')"> 4
                        </label>
                        <label>
                            <input type="radio" name="kelas" value="5" onchange="pilihHarga('5')"> 5
                        </label>
                        <label>
                            <input type="radio" name="kelas" value="6" onchange="pilihHarga('6')"> 6
                        </label>
                    </div>
                    
                </div>
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Jumlah</label>
                    <input required id="jumlah" name="jumlah" type="number" min="1" onkeypress="hitungBayar()" onkeyup="hitungBayar()" onkeydown="hitungBayar()"/>
                </div>
                <div style="display: flex;justify-content: flex-end; width: 50%;">
                    <label id="harga">Harga: </label>
                </div>
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Total Pembayaran</label>
                    <input id="bayar" name="bayar" readonly type="number" min="0" />
                    <input id="sisa" name="sisa" readonly type="hidden" />
                </div>
                <button type="submit" id="sub_btn">Simpan</button>
                <button type="button" id="ccl_btn" hidden onclick="cancelUpdate()">Batal</button>
            </form>
            <br/>

            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Sekolah</th>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['sch'] as $key => $sch ) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $sch['nama']; ?></td>
                        <td><?= $sch['kelas']; ?></td>
                        <td><?= $sch['jumlah']; ?></td>
                        <td><?= $sch['bayar']; ?></td>
                        <td>
                            <button onclick="setEdit(<?= $sch['id']; ?>, '<?= $sch['nama']; ?>', <?= $sch['kelas']; ?>, <?= $sch['jumlah']; ?>)">Edit</button>
                            <button onclick="setDelete(<?= $sch['id'] ?>)"  data-toggle="modal" data-target="#delModal">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="judlModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Hapus Data Distribus</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>Anda yakin mau menghapus data distribusi ini? Dihapusnya data ini tidak akan menambah jumlah stok.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="delBtn" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>
<textarea id="data" hidden>
<?php echo json_encode($data['stk']); ?>
</textarea>
<textarea id="dataschool" hidden>
<?php echo json_encode($data['sch']); ?>
</textarea>


<script type='text/javascript'>
function setDelete(id){
    document.getElementById('delBtn').setAttribute('href', "<?= BASEURL; ?>/School/hapus/" + id.toString());
}
var data_stock = JSON.parse(document.getElementById('data').value);
var data_school = JSON.parse(document.getElementById('dataschool').value);
var data_sold = []; 
var up_id = document.getElementById('up_id');
var stock_id = document.getElementById('stock_id');
var up_nama = document.getElementById('nama');
var up_jumlah = document.getElementById('jumlah');
var sisa = document.getElementById('sisa');
var harga = document.getElementById('harga');
var up_bayar = document.getElementById('bayar');
var kelass = document.getElementById('kelas').children;
var cancl = document.getElementById('ccl_btn');
var form = document.getElementById('form');

var harga_terpilih = 0;
getDataSold();

function getDataSold(){
    data_stock.map(item => {
        var total_kelas = 0;
        data_school.filter(itm => itm.kelas == item.kelas).map(item2 => {
            total_kelas = total_kelas + parseInt(item2.jumlah);
        })
        data_sold.push({kelas: item.kelas, terdistribusi: total_kelas.toString()});
    })
    tersedia();
}

function tersedia(){
    var sold_out = [];
    data_stock.map(item => {
        if(data_sold.filter(item2 => item2.kelas === item.kelas)[0].terdistribusi === item.jumlah){
            sold_out.push(item.kelas);
        }
    })
    for(var a = 0; a <= 5; a++){
        var opt = kelass[a].children[0];
        var ada = data_stock.filter(item => item.kelas === opt.value);
        if(ada.length > 0 && ada[0].jumlah > 0 && sold_out.includes(ada[0].kelas) == false){
            kelass[a].hidden = false
        }else{
            kelass[a].hidden = true
        }
    }
}

function pilihHarga(kel){
    harga_terpilih = parseInt(data_stock.filter(item => item.kelas === kel)[0].harga);
    harga.innerHTML = `Harga: ${harga_terpilih}/1 item`;
    up_jumlah.max = parseInt(data_stock.filter(item => item.kelas === kel)[0].jumlah);
    stock_id.value = parseInt(data_stock.filter(item => item.kelas === kel)[0].id);
    hitungBayar();
}

function hitungBayar(){
    up_bayar.value = harga_terpilih * up_jumlah.value;
    sisa.value = up_jumlah.max - up_jumlah.value;
}

function setEdit(id, nama, kelas, jumlah){
    for(var a = 0; a <= 5; a++){
        if(kelass[a].children[0].value === kelas.toString()){
            kelass[a].children[0].checked = true;
            pilihHarga(kelass[a].children[0].value);
        }
    }
    up_nama.value = nama;
    up_id.value = id;
    up_jumlah.value = jumlah;
    up_jumlah.max = (data_stock.filter(item => item.kelas === kelas.toString())[0].jumlah - data_sold.filter(item => item.kelas === kelas.toString())[0].terdistribusi) + jumlah;
    cancl.hidden = false;
    hitungBayar();
    form.action = "<?= BASEURL; ?>/school/edit";
}

function cancelUpdate(){
    for(var a = 0; a <= 5; a++){
        if(kelass[a].children[0].checked == true){
            kelass[a].children[0].checked = false;
        }
    }
    nama.value = "";
    up_jumlah.max = 0;
    harga.innerHTML = `Harga: `;
    up_id.value = "";
    stock_id.value = "";
    up_jumlah.value = "";
    cancl.hidden = true;
    bayar.value = "";
    form.action = "<?= BASEURL; ?>/school/tambah"
}
</script>