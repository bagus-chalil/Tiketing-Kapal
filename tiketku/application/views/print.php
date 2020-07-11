<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Tiketku</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <br><h6>Nama Pemesan : <strong><?= $detail->nama_pemesan ?></strong></h6>
                        </div>
                        <div class="col-md-6">
                            <?php $date = date_create($detail->tanggal); ?>
                            <h6 class="text-right"><strong><?= date_format($date, 'd F Y h:i:s') ?></strong></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Jumlah Penumpang : <strong><?= $jml_penumpang ?></strong></p>
                            <p>Harga per Tiket : <strong><?= 'Rp ' .number_format($detail->harga, 0, ',', '.') ?></strong></p>
                            <p>Harga total : <strong><?= 'Rp ' .number_format($detail->harga*$jml_penumpang, 0, ',', '.') ?></strong></p>
                            <p>Status : <strong>Sudah terbayar</strong></p>
                            </div>
                    </div>
                        <hr>
                                <p>Nama Kapal : <strong><?= $detail->nama_kapal ?></strong></p>
                                <p>Kelas : <strong><?= $detail->kelas ?></p>
                                <?php $date = date_create($detail->tgl_berangkat); ?>
                                <p>Berangkat : <strong><?= date_format($date, 'd F Y h:i:s') ?></strong></p>
                                <?php $date = date_create($detail->tgl_sampai); ?>
                                <p>Tiba : <strong><?= $detail->tgl_sampai ?></strong></p>
                    <hr>
                    <p class="text-center">Rute : <strong><?= $detail->ASAL ?> - <strong><?= $detail->TUJUAN ?></p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
		window.print();
	</script>
