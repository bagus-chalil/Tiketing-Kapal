
    
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
           
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                 <div class="card">
                     <div class="card-header bg-primary text-center text-white"><h5>Daftar Verifikasi Pelanggan Tiketku</h5></div>
                     <div class="card-body">
                     <div class="table-responsive">     
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">No Pembayaran</th>
                                <th class="text-center">No tiket</th>
                                <th class="text-center">Total Pembayaran</th>
                                <th width="20%" class="text-center">Bukti Pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $li): ?>
                            <tr>
                                <td class="text-center"><?= $li->no_pembayaran ?></td>
                                <td class="text-center"><?= $li->no_tiket ?></td>
                                <td class="text-center"><?= $li->total_pembayaran ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('assets/bukti/'. $li->bukti) ?>" target="blank">
                                    <img width="50%" src="<?= base_url('assets/bukti/'. $li->bukti) ?>" alt="">
                                    </a> 
                                </td>
                                <td class="text-center">
                                    <a onclick='return confirm("Yakin Ingin Memverifikasi No Pembayaran <?= $li->no_pembayaran ?> ?")' href="<?= base_url('admin/verifikasiPembayaran/'. $li->id) ?>" class="btn btn-sm btn-success">Verifikasi</a> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                     </div>
                 </div>
                 </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
