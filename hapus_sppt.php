<html lang="id">
    <head>
        <?php include "inclution/heading.php"; ?>
       
    </head>
    <body>

<div class="preloader" id="dataLoad" style=" background-color: rgb(255, 255, 255, 0.8">
  <div class="loading">
    <div class="spinner">
		  <div class="dot1"></div>
		  <div class="dot2"></div>
    </div>
    <h3><strong>Memproses Data</strong></h3>
    <h3 style="margin-top:0"><span id="process_data">0</span> / <span id="total_data">0</span> Baris</h3>
    <div id="cekituk"></div>
  </div>
</div>
</body>
</html>
<?php
 require 'vendor/autoload.php';
 use App\SQLiteConnection;
 use App\SQLiteTabulation;
 use App\SQLiteQuerySelect;
 

 $th_sek = $_GET['th'];
 $pdo = (new SQLiteConnection())->connect();
 $sqlite = new SQLiteTabulation($pdo);
 $selector = new SQLiteQuerySelect($pdo);
  
// sekarang kurang hapus


	$count = $selector->getSpptCountTotal(); //mengambil jumlah sppt dari db
			
//echo $row['total'];
				$total_hapus = 0;
				$bug=0;
				//membaca data pra hapus
			for ($i=1; $i<=$count; $i++){
				$datas = $selector->getSppt($i);


				?>
				
				
		<script>
			var pro= <?php echo json_encode($i); ?>;
			$('#total_data').html(pro);

			var counter=setInterval(getpro, 100); 
			function getpro() {
				var count= <?php echo json_encode($count); ?>;
 				$('#process_data').html(count); 
			}



</script>
				
				<?php
				foreach($datas as $getdata){
					$dtno = $getdata['noi'];
					$dtahun = $getdata['tahun'];
					$dtnop = $getdata['nop'];
					$dtno_induk = $getdata['no_induk'];
					$dtnama_wp = $getdata['nama_wp'];
					$dtnama_wp = $getdata['nama_wp'];
					$dtalamat_wp = $getdata['alamat_wp'];
					$dtalamat_op = $getdata['alamat_op'];
					$dtpajak_t = $getdata['pajak_t'];


					
				 }
			
			$datNopPraha = $selector->getPraha($dtnop);
				foreach($datNopPraha as $getdataPraha){
					$g2 = $getdataPraha['nop'];
					}
					
					
					
						if ($g2 !== $dtnop){
							$total_hapus++;
						//test
								
							//test
					
							//maka
							//deklarasi variabel isi 
	
								
										$pnama = str_split($dtnama_wp);
										$jmln = count($pnama);
										$petik = chr(39);
										$namabaru = "";
											for($p=0;$p<$jmln;$p++){
												if($pnama[$p] == $petik){
													$pnama[$p] = '\'';
													}
											$namabaru .= $pnama[$p];
											}
											
				
								
							if (!isset($dtnop )){	
								continue;
								}else{
									//input hapus
									$sqlite->inputHapus($dtno, $dtahun, $dtnop, $dtno_induk, $namabaru, $dtalamat_wp, $dtalamat_op, $dtpajak_t, $th_sek);
								
								}
								//kurang tahun terhapus
								//input ke tabel sppt terhapus dengan nop = $row2['nop'];
								
								//hapus sppt di tabel sppt dengan nop = $row2['nop'];
								
								$sqlite->HapusSppt($dtnop);
					}else{
					
					$bug++;
					continue;
					}
				
}
//clear data pra hapus
	/*	
		$query_del_pra = "DROP TABLE sppt_pra_terhapus;";
		$db->query($query_del_pra);
		$query_cr_pra ="CREATE TABLE sppt_pra_terhapus (
    nop VARCHAR (25) PRIMARY KEY
);";

$db->query($query_cr_pra);
	// beda cara
		$result_del_pra = $db->query($query_del_pra);
			$rowdel = $result_del_pra->fetchArray();
				//delet data pra hapus
			for ($ii=1; $ii<=$rowdel['total']; $ii++){
				$query_del ="delete  FROM sppt_pra_terhapus where ROWID = '$ii'";
				$db->query($query_del);
			//echo "berhasil pra hapus terhapus <br>";
		}*/

/*	echo "cek sebanyak  :".$i;
	echo "<br>";
echo	"jumlah baris di sppt induk".$row['total'];
	echo "<br>";
	echo "total hapus       ". $total_hapus;
	echo "<br>";
	echo "total tdk hapus       ". $bug;

	*/
	
  
		
			//$input_hapus = "INSERT INTO sppt_baru (tahun,  nop) VALUES ('$tahun', '$nop');";	 //di masukan ke data induk dan di tandai di tb_baru
			//$db->exec ($input_hapus);
			
		
			
			$sqlite->HapusTabPraha();		
			$sqlite->BuatTabPraha();		
	

?>

<?php

echo "<script>window.location.href='base.php?page=sppt'</script>";  
//echo "<script><a window.location.href='base.php?page=sppt'>lanjut bosssssssssssssssssssssss</a></script>";

?>
