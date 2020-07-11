    
          
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead class="bg-primary text-white text-center">
            <tr>
              <th>No</th>
              <th>Nama Kereta</th>
              <th>Tanggal Berangkat</th>
              <th>Tanggal Sampai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php $no = 1; ?>
            
            <?php foreach ($hasil_pencarian as $tk){ ?>
         
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $tk->nama_kapal ?></td>
              <td><?php $date = date_create($tk->tgl_berangkat); echo date_format($date, "d-m-Y h:i:s");  ?></td>
              <td><?php $date = date_create($tk->tgl_sampai); echo date_format($date, "d-m-Y h:i:s"); ?></td>
              <td>
                <a class="btn btn-primary" href="<?= base_url('user/pesan/'.$tk->id.'?p='.$penumpang ) ?>">Pesan</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

             

      </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->