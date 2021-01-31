<div class="container mt-5">
    <div class="row">
        <div class="col-9">
            <h3>DATA LOGISTIK LEMBAR KERJA SISWA(LKS)</h3>
            <h4>Programmer: Yusril Saputra</h4>
            <?php Flasher::flash(); ?>
            <br/>

            <div style="display: flex;justify-content: space-between;">
                <a>Input Stock</a>
                <a href="<?= BASEURL; ?>/school">Distribusi</a>
                <a href="<?= BASEURL; ?>/stock/check">Check Stock</a>
            </div>
            <br/>
            <br/>

            <h4>Form Input Stock LKS</h4>
            <br/>
            <form action="<?= BASEURL; ?>/stock/tambah" method="post" id="form">
                <input type="hidden" name="id" id="up_id" />
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Kelas</label>
                    <select id="kelas" name="kelas" required>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                    </select>
                </div>
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Jumlah</label>
                    <input id="jumlah" name="jumlah" type="number" min="0" required/>
                </div>
                <div style="display: flex;justify-content: space-between; width: 50%;">
                    <label>Harga</label>
                    <input id="harga" name="harga" type="number" min="0" required/>
                </div>
                <button type="submit" id="sub_btn">Simpan</button>
                <button type="button" id="ccl_btn" hidden onclick="cancelUpdate()">Batal</button>
            </form>
            <br/>

            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Nilai Persediaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_jumlah = 0; $total_nilai = 0; foreach ($data['stk'] as $key => $stk ) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $stk['kelas']; ?></td>
                        <td><?= $stk['jumlah']; ?></td>
                        <td><?= $stk['harga']; ?></td>
                        <td><?= $stk['harga'] * $stk['jumlah']; ?></td>
                        <td>
                            <button onclick="setEdit(<?= $stk['id']; ?>, <?= $stk['kelas']; ?>, <?= $stk['jumlah']; ?>, <?= $stk['harga']; ?>)">Edit</button>
                            <button onclick="setDelete(<?= $stk['id'] ?>)"  data-toggle="modal" data-target="#delModal">Hapus</button>
                        </td>
                    </tr>
                    <?php $total_jumlah += $stk['jumlah'];
                        $total_nilai += $stk['harga'] * $stk['jumlah'];
                        endforeach; ?>
                </tbody>
            </table>
            <h6>Jumlah LKS Seluruh <input value="<?= $total_jumlah;?>" /></h6>
            <h6>Total Nilai Persediaan <input value="<?= $total_nilai;?>" /></h6>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="judlModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Hapus Data Stock</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>Anda yakin mau menghapus data stock ini? Data tidak akan muncul di Cek Stock jika Anda menghapusnya.</p>
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

<script type='text/javascript'>
function setDelete(id){
    document.getElementById('delBtn').setAttribute('href', "<?= BASEURL; ?>/Stock/hapus/" + id.toString());
}
var data_stock = JSON.parse(document.getElementById('data').value);
var up_id = document.getElementById('up_id');
var up_jumlah = document.getElementById('jumlah');
var up_harga = document.getElementById('harga');
var kelass = document.getElementById('kelas').children;
var cancl = document.getElementById('ccl_btn');
var form = document.getElementById('form');

disabling();

function disabling(){
    for(var a = 0; a <= 5; a++){
        var opt = kelass[a];
        console.log(opt)
        var ada = data_stock.filter(item => item.kelas === opt.value);
        if(ada.length > 0 && ada[0].jumlah > 0){
            kelass[a].disabled = true
        }else{
            kelass[a].disabled = false
        }
    }
}

function setEdit(id, kelas, jumlah, harga){
    disabling();
    for(var a = 0; a <= 5; a++){
        if(kelass[a].value === kelas.toString()){
            if(kelass[a].disabled == true){
                kelass[a].disabled = false;
            }
            kelass[a].selected = true;
        }
    }
    up_id.value = id;
    up_jumlah.value = jumlah;
    up_harga.value = harga;
    cancl.hidden = false;
    form.action = "<?= BASEURL; ?>/stock/edit";
}

function cancelUpdate(){
    for(var a = 0; a <= 5; a++){
        if(kelass[a].selected == true){
            kelass[a].selected = false;
        }
    }
    up_id.value = "";
    up_jumlah.value = "";
    up_harga.value = "";
    cancl.hidden = true;
    form.action = "<?= BASEURL; ?>/stock/tambah"
}
</script>