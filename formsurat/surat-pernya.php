<?php 
foreach ($tabForm as $ua){
    $uak = $ua['kelas'];
	$uap = $ua['persil'];
	$uae = $ua['aset_id'];
	$uaa = $ua['asal_id'];
	$ual = $ua['luas'];
	$uaw = $ua['warga_id'];
	$uar = $ua['riwayat_id'];
}

$riwayatkan = $sqlite->getRiwayatByid($uar);
foreach ($riwayatkan as $rw){
	$sebabkan = $rw['sebab'];
	$darikan = $rw['dari'];
	$kekan = $rw['ke'];
	$tglkan = $rw['tgl'];
}
if ($darikan != ''){
$riwdari = $sqlite->getWargaById($darikan);
foreach ($riwdari as $rd){
	$ndari = $rd['nama'];
}
}else{
	$ndari = '';
}
$warga = $sqlite->getWargaById($uaw);
foreach ($warga as $wa){
	$nwa = $wa['nama'];
	$awa = $wa['alamat'];
}
?>
<form method="post" action="sur_pernya.php" target="_blank">
<div class="row">
	<div class="col-md-6">
		<h3 style="margin-top:5px">Cetak Surat Pernyataan Untuk tanah :</h3>
	</div>
	<div class="col-md-6">
		<div class="input-group" style="padding:0">
				<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 15px">Persil</span>
				<input type="text" class="form-control" id="basic-alamat" aria-describedby="basic-addon3" name="nomeriki" value="<?php echo $uap ?>" readonly>
				<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 15px">Luas</span>
				<input type="text" class="form-control" id="basic-alamat2" aria-describedby="basic-addon3" name="luasiki" value="<?php echo $ual ?>" readonly>
				<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 15px">Kelas</span>
				<input type="text" class="form-control" id="basic-alamat3" aria-describedby="basic-addon3" name="kelasiki" value="<?php echo $uak ?>" readonly>
		</div>
	</div>
	
</div>
<hr style="margin:0; border-top:2px solid #ccc">
<h3 style="text-align:center; font-weight: bold">Silahkan Lengkapi Data Terlebih Dahulu</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="input-group" style="padding:0">
				 <input type="hidden" name="desaku" value='<?php echo $desaku ?>'>
				 <input type="hidden" name="kepala" value='<?php echo $kepala ?>'>
				 <input type="hidden" name="kabkab" value='<?php echo $kabupaten ?>'>

				 <input type="hidden" name="sebabkan" value='<?php echo $sebabkan ?>'>
				 <input type="hidden" name="darikan" value='<?php echo $ndari ?>'>
				 <input type="hidden" name="tglkan"  value='<?php echo $tglkan ?>'>

				 <input type="hidden" name="nomorsaya" value='<?php echo $uaw ?>'>
				 <input type="hidden" name="namasaya" value='<?php echo $nwa ?>'>
			</div>
			<h4>Informasi Pemilik : </h4>
			<div class="input-group" style="padding:0 ;  <?php echo $display;?>">
				<span class="input-group-addon" id="basic-addon0" style="font-weight: bold; padding-right: 19px">Nama Petikan</span>
				<input type="text" class="form-control" name="<?php echo $namapet ;?>"  style='text-align:center; ' aria-describedby="basic-addon0" value="<?php echo $r ?>" readonly>
			</div>
			<div class="input-group" style="padding:0">
				<span class="input-group-addon" id="basic-addon0" style="font-weight: bold; padding-right: 51px">Tgl Lahir</span>
				<input type="text" class="form-control tglahir"  id="tgl" name="tglsaya"  style='text-align:center' aria-describedby="basic-addon0" >
			</div>
			<div class="input-group" style="padding:0">
				<span class="input-group-addon" id="basic-addon0" style="font-weight: bold; padding-right: 45px">Pekerjaan</span>
				<input type="text" class="form-control" id="basic-persil" name="pekerjaansaya" aria-describedby="basic-addon0" >
			</div>
			<div class="input-group" style="padding:0">
				<span class="input-group-addon" id="basic-addon0" style="font-weight: bold; padding-right: 66px">Alamat</span>
				<input type="text" class="form-control" id="basic-persil" name="alamatsaya" aria-describedby="basic-addon0" value="<?php echo $awa ?>" >
			</div>
		</div>
		<div class="col-md-6" style="padding-top:0">
			
				 
			<div class="input-group" style="padding:0">
				<h4>Informasi Tanah : </h4>
			</div>
			<div class="input-group" style="padding:0">
				<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 15px">Lokasi</span>
				<textarea rows="4" class="form-control" id="basic-alamat" aria-describedby="basic-addon3" name="lokasiiki" value="" ></textarea>
			</div>
			<br>
			
			
		</div>

	</div>
	<hr style="margin-top:10px; border-top:2px solid #ccc">
	<div class="row">
	<h3 style="text-align:center; margin-top:-10px">Batas Tanah</h3>
	<div class="row">
 		<div class="col-md-6">
		<div class="input-group"style="padding:0">
			<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 30px">Utara</span>
				<input type="text" name="utara" class="form-control" id="basic-alamat5" aria-describedby="basic-addon3" >
		</div>
		<div class="input-group"style="padding:0">
			<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 27px">Timur</span>
				<input type="text" name="timur" class="form-control" id="basic-alamat6" aria-describedby="basic-addon3" >
		</div>
		</div>
		<div class="col-md-6">
		<div class="input-group" style="padding:0">
			<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 15px">Selatan</span>
				<input type="text" name="selatan" class="form-control" id="basic-alamat5" aria-describedby="basic-addon3" >
		</div>
		<div class="input-group"style="padding:0">
			<span class="input-group-addon" id="basic-addon3" style="font-weight: bold; padding-right: 28px">Barat</span>
				<input type="text" name="barat" class="form-control" id="basic-alamat6" aria-describedby="basic-addon3">
		</div>
	</div>
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-default" onclick="destroy();"><strong>Kembali</strong></button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
		<button type="submit" class="btn btn-primary" name="submit">Cetak</button>
	</div>

</form>