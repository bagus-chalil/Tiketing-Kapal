<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?php if($this->session->flashdata('pesan') !== null): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('pesan') ?>
    </div>
    <?php endif; ?>
<!-- Form -->
<div class="container mx-5 my-4">
<div class="col-md-10">
<div class="card mb-3">
          <div class="card-header bg-gradient-primary text-center text-white">
  <h5>Konfirmasi Pembayaran</h5>
          </div>
          <div class="card-body">
              <form action="<?= base_url('user/cekKonfirmasi') ?>" method="post" enctype="multipart/form-data" >
                <div class="form-group" >
                    <label for="">Kode Booking</label>
                    <input name="kode" style="width: 45%;" type="text" class="form-control " placeholder="Kode Booking">
                </div>
                  <button style="width: 45%;" class="btn btn-primary btn-block" type="submit" name="submit" value="Save" >Cek Kode Booking</button>
              </form>
          </div>
          <div class="card-footer small text-muted">
          </div>
      </div>
    <hr>
    <?php if(isset($_GET['kode'])): ?>
        <h5 class="text-center text-dark">Kode Pembayaran : <?= $_GET['kode']; ?></h5>
<div class="card">
    <div class="card-header bg-gradient-primary text-center text-white">
        <h5>Details Pembayaran Anda</h5>
    </div>
    <div class="card-body">
        <h3 class="text-center text-dark">
            <?php if ($no_tiket->status === '0' || $no_tiket->status === '1'): ?>
                <i class="fa fa-times text-danger"></i> Belum Bayar
            <?php elseif ($no_tiket->status === '2'): ?>
                <i class="fa fa-check text-success"></i> Sudah Bayar
            <?php endif; ?>
        </h3>
 
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Identitas</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($detail as $dt): ?>
                    <tr>
                        <td><?= $dt->nama ?></td>
                        <td><?= $dt->no_identitas ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <h5 class="font-font-weight-bold text-center text-dark">Total Pembayaran Anda : <?= 'Rp.' .number_format($no_tiket->total_pembayaran, 0, ',', '.') ?></h5>
            <?php if($no_tiket->status === '2'): ?>
                <form action="<?= base_url('user/cetakTiket') ?>" method="POST">
                    <input type="hidden"  name="no_tiket" value="<?= $no_tiket->no_tiket ?>">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-print"> Cetak Tiket</i></button>
                </form>
            <?php endif; ?>
            <?php if ($no_tiket->status === '0'): ?>
            <h6 class="text-danger">Silahkan Kirim Bukti Pembayaran Anda pada kolom di bawah</h6>
                    <?= form_open_multipart('user/kirimKonfirmasi'); ?>
                        <input type="hidden" name="no_pembayaran" value="<?= $no_tiket->no_pembayaran ?>">
                        <input type="file" required name="gambar" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-block btn-success">Kirim Bukti Pembayaran</button>    
                    <?= form_close(); ?>
                    <?php else: ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



