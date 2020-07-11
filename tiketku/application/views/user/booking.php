
    
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?php
            if($this->session->flashdata('nomor') === null): ?>
            <div class="row">
          <div class="col-md-10">
              <div class="alert alert-danger">
                  <h5 class="text-center">Halaman telah terefresh.Apabila belum mendapat kode pembayaran</h5>
                  <h5 class="text-center">Maaf Anda dapat melakukan pemesanan kembali !</h5>
                  
              </div>
          </div>
            </div>
            <?php else: ?>
          
          <!-- Content -->
          <div class="row">
          <div class="col-md-10">
              <div class="alert alert-danger">
                  <h5 class="text-center">Peringatan !! Jangan Refresh Halaman</h5>
                  <h6 class="text-center">Untuk menghindari kehilangan kode pembayaran</h6>
              </div>
              <div class="card">
                  <div class="card-body">
                        <h2 class="text-center text-success">Selamat Pesanan Tiket telah Berhasil ! </h2>
                            <hr>
                        <h5 class="text-danger text-center">Silahkan segera lakukan pembayaran!</h5>
                        <h3 class="text-center">A2202918189</h3>
                        <h5 class="text-center font-weight-bold"> PT Pelni Indonesia</h5>
                        <h5 class="text-center"> BNI Kode Bank :002</h5>
                            <hr>
                        <h5 class="text-center">Total pembayaran</h5>
                        <h2 class="text-center"><?= $this->session->flashdata('total') ?></h2>
                            <br>
                        <h5 class="text-center">Kode Pembayaran Anda</h5>
                        <h2 class="text-center"><?= $this->session->flashdata('nomor') ?></h2>
                            <br><br>
                        <h6 class="text-center text-danger">*Jika Telah Selesai Melakukan Pembayaran lakukan
                            <a target="blank" href="<?= base_url("user/pembayaran") ?>">Konfirmasi Pembayaran</a>
                        </h6>
                        <h4 class="text-center">Terima Kasih </h4>
                            <br>
                        <h5 class="text-center">Jika Telah mendapat kode pembayaran segera catat!</h5>
                        <h5 class="text-center">Untuk Menghindari kehilangan kode pembayaran</h5>

                    </div>
              </div>
          </div>
          </div>        
    
       
            <?php endif; ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
