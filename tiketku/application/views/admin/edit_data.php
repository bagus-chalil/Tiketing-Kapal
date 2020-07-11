<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


<div class="row">
    
<div class="col-md-7">
        <div class="card">
            <div class="card-header">Form Edit Jadwal</div>
            <div class="card-body">
            <form action="<?= base_url('admin/ubah_jadwal') ?>" method="post" required>
                <input type="hidden" name="id" value="<?= $data_edit->id ?>">
                <div class="form-group">
                    <label>Nama Kapal</label>
                    <input type="text" value="<?= $data_edit->nama_kapal ?>" style="width: 65%;" class="form-control" name="nama_kapal" placeholder="Nama Kapal" required>
                </div>
                <div class="form-group">
                    <label>Pelabuhan Asal</label>
                    <select name="asal" class="form-control" style="width: 65%" required>
                        <optgroup label="TERPILIH">
                            <option value="<?= $data_edit->asal ?>"><?= $data_edit->ASAL ?></option>
                        </optgroup>
                        <optgroup label="PILIHAN">
                        <?php foreach ($pelabuhan as $pl): ?>
                            <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                        <?php endforeach ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pelabuhan Tujuan</label>
                    <select name="tujuan" class="form-control" style="width: 65%" required>
                    <optgroup label="TERPILIH">
                            <option value="<?= $data_edit->tujuan ?>"><?= $data_edit->TUJUAN ?></option>
                        </optgroup>
                        <optgroup label="PILIHAN">
                        <?php foreach ($pelabuhan as $pl): ?>
                            <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                        <?php endforeach ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Berangkat</label>
                    <?php $date = date_create($data_edit->tgl_berangkat); ?>
                    <input type="datetime-local" style="width: 65%;" class="form-control" name="tgl_berangkat" min="<?= date_format($date,'Y-m-d\TH:i') ?>" value="<?= date_format($date,'Y-m-d\TH:i') ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Sampai</label>
                    <?php $date = date_create($data_edit->tgl_sampai); ?>
                    <input type="datetime-local" style="width: 65%;" class="form-control" name="tgl_sampai" min="<?= date_format($date,'Y-m-d\TH:i') ?>" value="<?= date_format($date,'Y-m-d\TH:i') ?>" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" id="" class="form-control" style="width: 40%" required>
                    <optgroup label="TERPILIH">
                            <option value="<?= $data_edit->kelas ?>"><?= $data_edit->kelas ?></option>
                        </optgroup>
                        <optgroup label="PILIHAN">
                            <option value="EKONOMI">EKONOMI</option>
                            <option value="BISNIS">BISNIS</option>
                            <option value="EKSKUTIF">EKSKUTIF</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" value="<?= $data_edit->harga ?>" style="width: 65%;" class="form-control" name="harga" required>
                </div>
                    <button type="submit" class="btn btn-block btn-primary">Edit Jadwal</button>
               
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
