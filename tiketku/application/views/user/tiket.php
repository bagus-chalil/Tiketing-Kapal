
    
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <!-- Form -->
          <div class="card mb-3">
					<div class="card-header">
            <h5>Form Registrasi Reservasi Tiket Kapal</h5>
					</div>
					<div class="card-body">

					<form action="<?= base_url('user/cari_tiket_ok') ?>" method="POST">
              
              <div class="form-group">
                <label for="tujuan">Pilih Tujuan*</label>
                  <div class="input-group-prepend">
                    <div class="input-group-text" style="width: 7%;">Dari</div>
                    <select name="asal" class="form-control" style="width: 60%;" id="validationTooltip04" required>
                    <option>Pilih Pelabuhan Asal</option>
                      <?php foreach ($pelabuhan as $pl){ ?>
                      <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                      <?php } ?>
                    </select>
								<div class="invalid-feedback">
								</div>
							</div>
            </div>
            
              <div class="input-group-prepend">
                    <div class="input-group-text" style="width: 7%;">Ke</div> 
                    <select name="tujuan" class="form-control" style="width: 60%;" id="validationTooltip04" required>
                    <option>Pilih Tujuan Pelabuhan</option>
                      <?php foreach ($pelabuhan as $pl){ ?>
                      <option value="<?= $pl->id ?>"><?= $pl->nama_pelabuhan ?></option>
                      <?php } ?>
                    </select>
              </div>

              <br>
							<div class="form-group">
								<label for="keberangkatan">Keberangkatan*</label>
								<input type="date" style="width: 60%;" class="form-control" name="tanggal" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
								<div class="invalid-feedback">
								</div>
              </div>
              
              <div class="form-group">
              <label for="keberangkatan">Masukkan Jumlah Penumpang</label>
              <div class="input-group-prepend" >
                    <select name="jumlah" class="form-control" style="width: 20%;">
                      <?php for ($i=1; $i<= 10 ;$i++){ ?>
                      <option value="<?= $i ?>"><?= $i ?> Penumpang</option>
                      <?php } ?>
                    </select>
              </div>
              </div>

							<button  type="submit" class="btn btn-primary btn-block">Cari Tiket</button>
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


        </div>
        <HR>
                        
    
       

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
