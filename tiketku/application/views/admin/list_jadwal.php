<!-- Tabel Jadwal-->
<div class="row">
<div class="col-md-12">
<div class="card">
          <div class="card-header">
            <h5>Daftar Pelabuhan Indonesia</h5>
          </div>
          
          <div class="card-body">
          <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#ModalTambah">Tambah Jadwal</button>
            <table class="table table-condensed table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kapal</th>
                        <th>Asal</th> 
                        <th>Tujuan</th> 
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Sampai</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
        
                <tbody>
                    
                    <?php $no = 1; ?>
                    <?php foreach ($jadwal as $jd): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $jd->nama_kapal ?></td>
                        <td><?= $jd->ASAL ?></td>
                        <td><?= $jd->TUJUAN ?></td>
                        <td><?= $jd->tgl_berangkat ?></td>
                        <td><?= $jd->tgl_sampai ?></td>
                        <td><?= $jd->kelas ?></td>
                        <td>
                            <a class="btn btn-danger" href="<?= base_url('admin/hapus_jadwal/' .$jd->id) ?>">Hapus</a>
                            <a class="btn btn-success" href="<?= base_url('admin/edit_jadwal/' .$jd->id) ?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                 
                </tbody>
        
            </table>
            
          </div>

          <div class="card-footer small text-muted">
          </div>
      </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="card">
            <form action="<?= base_url('admin/tambah_jadwal_ok') ?>" method="post" required>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Kapal</label>
                    <input type="text" class="form-control" name="nama_kapal" placeholder="Nama Kapal" required>
                </div>
                <div class="form-group">
                    <label>Pelabuhan Asal</label>
                    <select name="asal" id="" class="form-control" required>
                        <?php foreach ($pelabuhan as $pl): ?>
                            <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pelabuhan Tujuan</label>
                    <select name="tujuan" id="" class="form-control"required>
                        <?php foreach ($pelabuhan as $pl): ?>
                            <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Berangkat</label>
                    <input type="datetime-local" class="form-control" name="tgl_berangkat" min="<?= date('Y-m-d\TH:1') ?>" value="<?= date('Y-m-d\TH:i') ?>" placeholder="Stasiun Tujuan" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Sampai</label>
                    <input type="datetime-local" class="form-control" name="tgl_sampai" min="<?= date('Y-m-d\TH:1') ?>" value="<?= date('Y-m-d\TH:i') ?>" placeholder="Stasiun Tujuan" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" id="" class="form-control" required>
                        <option value="EKONOMI">EKONOMI</option>
                        <option value="BISNIS">BISNIS</option>
                        <option value="EKSKUTIF">EKSKUTIF</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" style="width: 65%;" class="form-control" name="harga" placeholder="Harga" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah Jadwal</button>
            </div>
            </form>
            </div>
            </div>
            </div>
        </div>
        </div>
    <br>
   