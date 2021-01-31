<div class="container mt-5">
    <div class="row">
        <div class="col-9">
            <h3>DATA LOGISTIK LEMBAR KERJA SISWA(LKS)</h3>
            <h4>Programmer: Yusril Saputra</h4>
            <?php Flasher::flash(); ?>
            <br/>

            <div style="display: flex;justify-content: space-between;">
                <a href="<?= BASEURL; ?>/stock">Input Stock</a>
                <a href="<?= BASEURL; ?>/school">Distribusi</a>
                <a>Check Stock</a>
            </div>
            <br/>
            <br/>

            <h4>Cek Stock</h4>
            <br/>

            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Nilai Persediaan</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php $total_jumlah = 0; $total_nilai = 0; foreach ($data['stk'] as $key => $stk ) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $stk['kelas']; ?></td>
                        <td><?= $stk['jumlah']; ?></td>
                        <td><?= $stk['harga']; ?></td>
                        <td><?= $stk['harga'] * $stk['jumlah']; ?></td>
                    </tr>
                    <?php $total_jumlah += $stk['jumlah'];
                        $total_nilai += $stk['harga'] * $stk['jumlah'];
                        endforeach; ?>
                </tbody>
            </table>
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
var data_stock = JSON.parse(document.getElementById('data').value);
var data_school = JSON.parse(document.getElementById('dataschool').value);
renderTable();

function renderTable(){
    data_stock.map(item => {
        var total_kelas = 0;
        data_school.filter(itm => itm.kelas == item.kelas).map(item2 => {
            total_kelas = total_kelas + parseInt(item2.jumlah);
        })
        item.sisa = parseInt(item.jumlah) - total_kelas;
        item.terdistribusi = total_kelas;
    })
    console.log(data_stock);
    var rows = '';
    data_stock.map((item, key) => {
        rows += `
            <tr>
                <td>${key + 1}</td>
                <td>${item['kelas']}</td>
                <td>
                    <div>Terdistribusi: ${item['terdistribusi']}</div>
                    <div style="border-top: 1px dashed;">Sisa: ${item['sisa']}</div>
                </td>
                <td>${item['harga']}</td>
                <td>
                    <div>Terdistribusi: ${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item['harga'] * item['terdistribusi'])}</div>
                    <div style="border-top: 1px dashed;">Sisa: ${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item['harga'] * item['sisa'])}</div>
                </td>
            </tr>
        `;
    })
    document.getElementById('table').innerHTML = rows;
}

</script>