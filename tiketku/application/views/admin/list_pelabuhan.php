<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


<div class="row">
<div class="col-md-7">
<div class="card">
          <div class="card-header">
            <h5>Daftar Pelabuhan Indonesia</h5>
          </div>
          
          <div class="card-body">
            <table class="table table-condensed table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelabuhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pelabuhan as $pl){ ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $pl->nama_pelabuhan ?></td>
                        <td>
                            <a href="<?= base_url('admin/hapus_pelabuhan/' .$pl->id) ?>" class="btn btn-small btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
          </div>

          <div class="card-footer small text-muted">
          </div>
      </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">Form Tambah Pelabuhan</div>
            <div class="card-body">
            <form action="<?= base_url('admin/tambah_pelabuhan') ?>" method="post">
                <div class="form-group">
                    <label for="">Nama Pelabuhan</label>
                    <input type="text" class="form-control" name="pelabuhan" placeholder="Nama Pelabuhan">
                    <br>
                    <button type="submit" class="btn btn-block btn-primary">Selesai</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    </div>

<br>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
