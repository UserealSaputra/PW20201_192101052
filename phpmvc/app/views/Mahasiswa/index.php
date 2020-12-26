<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <?php Flasher::flash(); ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                Tambah Data Mahasiswa
            </button>
            <br><br>

            <h3>Daftar Mahasiswa</h3>
            <form action="<?= BASEURL; ?>/mahasiswa/index" method="post">
                <input type="text" value="<?= ($_POST['src'] ?? '');?>" placeholder="Cari nama..." name="src" />
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <?php foreach ($data['mhs'] as $mhs) : ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                        <?= $mhs['nama']; ?>
                        <div class="row">
                            <a class="badge badge-primary" onclick="setEdit(<?= $mhs['id']; ?>, '<?= $mhs['nama']; ?>', '<?= $mhs['nim']; ?>', '<?= $mhs['email']; ?>', '<?= $mhs['jurusan']; ?>')" data-toggle="modal" data-target="#updModal">edit</a>
                            <a class="badge badge-danger" onclick="setDelete(<?= $mhs['id']; ?>)" data-toggle="modal" data-target="#delModal">hapus</a>
                            <a href="<?= BASEURL; ?>/Mahasiswa/detail/<?= $mhs['id']; ?>" class="badge badge-primary">detail</a>
                        </div>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judlModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control" id="nim" name="nim">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" name="jurusan" id="jurusan">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                    <option value="Teknik Kimia">Teknik Kimia</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="updModal" tabindex="-1" aria-labelledby="judlModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/mahasiswa/edit" method="post">
                <input type="hidden" id="up_id" name="id">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="up_nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control" id="up_nim" name="nim">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="up_email" name="email">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" name="jurusan" id="up_jurusan">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="judlModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Hapus Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin mau menghapus data mahasiswa ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="delBtn" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
function setDelete(id){
    document.getElementById('delBtn').setAttribute('href', "<?= BASEURL; ?>/Mahasiswa/hapus/" + id.toString());
}

function setEdit(id, nama, nim, email, jurusan){
    var up_id = document.getElementById('up_id');
    var up_nama = document.getElementById('up_nama');
    var up_nim = document.getElementById('up_nim');
    var up_email = document.getElementById('up_email');
    var jurusans = document.getElementById('up_jurusan').children;
    for(var a = 0; a <= 4; a++){
        if(jurusans[a].value == jurusan){
            jurusans[a].selected = true;
        }
    }
    up_id.value = id;
    up_nama.value = nama;
    up_nim.value = nim;
    up_email.value = email;
}
</script>