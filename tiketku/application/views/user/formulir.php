    
          
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="container my-3">
    <div class="card">
        <div class="card-header bg-gradient-primary text-white">INFO PERJALANAN</div>

        <div class="card-body">
            <table>
            <tr>
            <td>Nama Kapal</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $info->nama_kapal ?>"></td>
            </tr>   
            <tr>
            <td>Tanggal berangkat</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $info->tgl_berangkat ?>"></td>
            </tr>
            <tr>
            <td>Tanggal sampai</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $info->tgl_sampai ?>"></td>
            </tr>  
            <tr>
            <td>Perjalanan</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $info->ASAL ?>"></td>
            <td>Ke </td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $info->TUJUAN ?>"></td>
            </tr>
            <tr>
            <td>Jumlah penumpang</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= $_GET['p'] ?>"></td>
            </tr>
            <tr>
            <td>Harga per Tiket</td>
            <td>:</td>
            <td><input type="text" class="form-control" readonly disabled value="<?= 'Rp. ' .number_format($info->harga, 0, ',','.') ?>"></td>
            </tr>         
            </table>
        </div>
    </div>  
    <hr>
    <form action="<?= base_url('user/pesanTiket') ?>" method="POST">
    <input type="hidden" name="penumpang" value="<?= $_GET['p'] ?>">
    <input type="hidden" name="id_jadwal" value="<?= $id_jadwal ?>">
    <input type="hidden" name="harga" value="<?= $info->harga ?>">
    <div class="card">
    <div class="card-header bg-gradient-primary text-white">Detail Penumpang</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>>= 17 tahun Nomor ID(KTP,SIM,PASSPORT)*</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=1; $i<=$_GET['p'];$i++): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <input type="text" class="form-control" required name="nama<?= $i ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" required name="identitas<?= $i ?>">
                        </td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        </div>
       
        <hr>
        <div class="card">
    <div class="card-header bg-gradient-primary text-white">Detail Pemesan</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nama*</label>
                    <input class="form-control" type="text" value="<?= $user['name'] ?>" name="nama_pemesan" placeholder="Nama pemesan" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Email*</label>
                    <input class="form-control" type="text" readonly value="<?= $user['email'] ?>" name="email" placeholder="Email pemesan" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">No.Telp*</label>
                    <input class="form-control" type="text" name="no_telp" placeholder="Nomor Telephone" required>
                </div>
            </div>
           
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Alamat*</label> 
                    <textarea name="alamat" class="form-control" placeholder="Alamat pemesan" rows="10" required></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">Simpan Data</button>
    </div>    
    </div>
    </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->