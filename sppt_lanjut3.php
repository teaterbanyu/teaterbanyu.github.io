<?php
				$database_name = "../img/myDB.db";
	$db = new SQLite3($database_name);
	$dari = $_GET['dari'];
$query_th= "select max(tahun) as maxi from sppt_baru ";
	$result_th = $db->query($query_th);
			 $row_th = $result_th->fetchArray();
			
			 $max_th =$row_th ['maxi'] ;
			 
			 if(isset ($_GET['semua'])){
				$max_sem = $_GET['semua'];
			 }else{
				$max_sem = "0";
			 }
			 echo "<script>window.location.href='../src/sppt.php?id=$max_th&semua=$max_sem&act=$dari'</script>";

?>