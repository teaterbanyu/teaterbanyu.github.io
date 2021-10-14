<?php
require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteTabulation;
use App\SQLiteQuerySelect;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteTabulation($pdo);
$selector = new SQLiteQuerySelect($pdo);

$pdo1 = (new SQLiteConnection())->connect1();
$selector1 = new SQLiteQuerySelect($pdo1);
$sqlite1 = new SQLiteTabulation($pdo1);

//mengambil jumlah riwayat
$jmlriw1 = $selector->getcountriwayat();
$jmlriw = $jmlriw1 + 1;

$s = $_GET['s'];
switch($s){
    case "create-table":
    
        $sqlite-> createtable();
    break;
  case "log":
       
            $username_user = htmlspecialchars($_POST['username_user']);
            $password_user = htmlspecialchars($_POST['password_user']);
            $password_user2 = md5($password_user);
            $password_user3 = md5($password_user2);

        // periksa username dan password

            $us = $selector1->getUser();
	        
	        $data_user_c= count($us);

            $us1 = $selector1->getUserByus( $username_user );
          foreach($us1 as $dtus){
              $data_uuser=$dtus['username_id'];
               $data_upass=$dtus['password_id'];
               $desa=$dtus['desa'];
            } 

                // cek login proc_close

              
                if($data_user_c >1){
		
	              
	            echo "<script>window.alert('FATAL ERROR !!!!!!!!   SILAHKAN HUBUNGI TIM PENGEMBANG '); window.location.href='index.php'</script>";
	
                }else{
                    if(isset($dtus['username_id'])){
                        $data_uuser=$dtus['username_id'];

                     }else{

                        $data_uuser="salah";
                     }
                    if ($username_user == $data_uuser) {
                    // jika user dan password cocok

                    if(isset($dtus['password_id'])){
                        $data_upass=$dtus['password_id'];

                     }else{

                        $data_upass="salah";
                     }
                         if($password_user3 == $data_upass){ 
                          $_SESSION['users'] = "kadal";

                        header("Location: base.php?page=home&des=".$desa);  
 
                         }else{
	
	                     echo "<script>window.alert('Login gagal! Password Salah !!'); window.location.href='index.php'</script>";

                        die;
                	    }

                  } 

                    echo "<script>window.alert('Login gagal! Username  Salah !!'); window.location.href='index.php'</script>";
                }
        
                   
    break;
   
    case "reg":
        $password = $_POST['password_user'];
		$password2 = $_POST['password_user2'];
	
		if($password != $password2){
		
		echo "<script>window.alert('password verifikasi belum sama'); window.location.href='index.php?'</script>";
		}else{
            // ambil data
            $desa = htmlspecialchars($_POST['desa']); 
            $pala = htmlspecialchars($_POST['kepala']); 
            $kab = htmlspecialchars($_POST['kabupaten']); 
            $pnama = str_split($pala);
			    $jmln = count($pnama);
		    	$petik = chr(39);
		    	$namabaru = "";
			        for($p=0;$p<$jmln;$p++){
			        	if($pnama[$p] == $petik){
			        	$pnama[$p] = '\'\'';
			        	}
			        	$namabaru .= $pnama[$p];
		            	}
                $username_user = htmlspecialchars($_POST['username_user']);
                $password_user = htmlspecialchars($_POST['password_user']);
                $password_user2 = md5($password_user);
                $password_user3 = md5($password_user2);

            // periksa username dan password
                       $row = $selector1->getUserByus($username_user);
                     

                if ($row[0] = "" ){
                         
                    echo "<script>window.alert('user kosong sudah dipakai'); window.location.href='index.php'</script>";
                    die;
                    }else{


// cek
$sqlite1->insertRegist($desa,$username_user,$password_user3,$namabaru,$kab) ;
echo "<script>window.alert('regist admin berhasil'); window.location.href='login.php?page=login'</script>";



}
        }


    break;
    case  "akt":
        
        $serayu = $_POST['serayu']; 

        // cek
        $sqlite1->insertAkode($serayu);
         echo "<script>window.alert('regist admin berhasil'); window.location.href='index.php'</script>";

    break;
    case  "upuser":
       $getpas = $_GET["paspas"];
       $getdes = $_GET["des"];
        $kep = $_POST["inkepala"];
        $user = $_POST["inuser"];
        $paslam = $_POST["inpaslam"];
        $pasbar = $_POST["inpasbar"];
        $kon    = $_POST["inkon"];

        $password_user = htmlspecialchars($paslam);
        $password_user2 = md5($password_user);
        $paspas = md5($password_user2);

        $password_baru = htmlspecialchars($pasbar);
        $password_baru1 = md5($password_baru);
        $paspas1 = md5($password_baru1);

    if($paslam !==""){
        if($getpas == $paspas)
        {
            if($pasbar == $kon){

                $sqlite1->upUser($kep,$user,$paspas1,$getdes);
                echo "<script>window.alert('regist berhasil'); window.location.href='index.php'</script>";
            }else{

                echo "<script>window.alert('konfirmasi pasbord baru belum sama ,mohon 'harap masukan password dengan kata yang mudah anda ingat); window.location.href='base.php?page=home'</script>";
            }
            //echo "pasword benar".$paslam."------------".$getpas."---------".$paspas;
        }else{

            echo "paswot salah";
        }
    }else{
            //cuma ganti user kepala
            $sqlite1->upUser1($kep,$user,$getdes);
            echo "<script>window.alert('regist berhasil'); window.location.href='index.php'</script>";
    }
       // $sqlite1->upUser($kep,$user,$paslam,$pasbar,$kon);
       // echo "<script>window.alert('regist berhasil'); window.location.href='index.php'</script>";


    break;
    case "logout":
        echo "<script> window.location.href='index.php'</script>";

    break;
    case "new":     
       
        $aPersil = $_POST["aPersil"];
        $aKategori = $_POST["aKategori"];
        $aKelas = $_POST["aKelas"];
        $aLuas = $_POST["aLuas"];
        
 
           
            for($c = 0; $c<count($aPersil); $c++){

                $warga = $selector->getWargabanyuBynowa($aLuas[$c]);
                $response = "";
                if(count($warga) == 0){
                    $setAset[$c] = $sqlite->insertAnggota($aPersil[$c], $aKategori[$c], $aLuas[$c]);
                    $response = 0;        
                    }else{$response = 1;}  
            }
    
            
        
        echo $response;
        break;
    case "aset":
        $wNoC = $_POST["wNoC"];
        $aPersil = $_POST["nPersil"];
        $aKategori = $_POST["nKategori"];
        $aKelas = $_POST["nKelas"];
        $aLuas = $_POST["nLuas"];
        for($c = 0; $c<count($aPersil); $c++){
            if ($aKategori[$c] == 'BASAH'){$kelasan[$c] = 'S.'.$aKelas[$c];}else{$kelasan[$c] = 'D.'.$aKelas[$c];}

            $setAset[$c] = $sqlite->insertAset($aKategori[$c], $aPersil[$c], $kelasan[$c], $aLuas[$c] );

            $periwayatan[$c] = $sqlite->insertRiwayat($setAset[$c], $aPersil[$c], $kelasan[$c], $aLuas[$c], '', '', $wNoC, '');

            $sqlite->insertRegulator($setAset[$c], $setAset[$c], $wNoC, '', $jmlriw);
            $sqlite->insertKolektor($periwayatan[$c], $wNoC, '');
        }
        break;
    case "upd":
        $asetId = $_POST['aset_id'];
        $asalId = $_POST['asal_id'];
        $wargaId = $_POST['warga_id'];
        $aKategori = $_POST['aKategori'];
        $aKelas = $_POST['aKelas'];
        $aLuas = $_POST['aLuas']; 
        $aPersil = $_POST['aPersil'];
        $tgl = date("d-m-Y");
        if ($aKategori == 'BASAH'){$kelasan = 'S.'.$aKelas;}else{$kelasan = 'D.'.$aKelas;}
        $sqlite->updateAset($asetId, $aKategori, $kelasan, $aLuas, $aPersil);
        $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, 'Perubahan Data', '', $wargaId, $tgl);
        $sqlite->insertKolektor($periwayatan, $wargaId, '');
        break;
    case "cnv":

        //mengambil jumlah riwayat 
        $asetId = $_POST['aset_id'];
        $asalId = $_POST['asal_id'];
        $cAsal = $_POST['cAsal'];

        $nc = $_POST['nc'];
        $nm = $_POST['nm'];
        $al = $_POST['al'];

        $sb = $_POST['sb'];
        $tgl = $_POST['tgl'];

        $aPersil = $_POST['aPersil'];
        $aKategori = $_POST['aKategori'];
        $aKelas = $_POST['aKelas'];
        $aLuas = $_POST['aLuas'];

        $warga = $selector->getWargaById($nc);
        if(count($warga) == 0){
            $sqlite->insertWarga($nc, $nm, $al);
        }
        if ($aKategori == 'BASAH'){$kelasan = 'S.'.$aKelas;}else{$kelasan = 'D.'.$aKelas;}
        $asetan = $selector->getAsetById($asetId);
        $luasOld = "";
        foreach($asetan as $ast){
            $luasOld .= $ast['luas'];
        }
            if($luasOld <= $aLuas){
                $sqlite->updateRegulator($asetId, $nc, '', $jmlriw); //hanya menghitung luas aset dari..., tdak melihat aset ke...
                $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal, $nc, $tgl);
                $sqlite->insertKolektor($periwayatan, $cAsal, '');
                $sqlite->insertKolektor($periwayatan, $nc, '');
                
            }else{
                $newLuas = $luasOld - $aLuas;
                $sqlite->updateAset($asetId, $aKategori, $kelasan, $newLuas, $aPersil);
                $newAset = $sqlite->insertAset($aKategori, $aPersil, $kelasan, $aLuas); //hanya menghitung luas aset dari..., tdak melihat aset ke...
                $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal, $nc, $tgl);
                $sqlite->insertRegulator($newAset, $asalId, $nc, '', $jmlriw);
                $sqlite->insertKolektor($periwayatan, $cAsal, '');
                $sqlite->insertKolektor($periwayatan, $nc, '');
            }
        break;
        case "pet":
            $asetId = $_POST['aset_id'];
            $asalId = $_POST['asal_id'];
            $cAsal = $_POST['cAsal'];
            $nm = $_POST['nm'];
            $al = $_POST['al'];
    
            $sb = $_POST['sb'];
            $tgl = $_POST['tgl'];
    
            $aPersil = $_POST['aPersil'];
            $aKategori = $_POST['aKategori'];
            $aKelas = $_POST['aKelas'];
            $aLuas = $_POST['aLuas'];

            $totpet = $selector->countpetik();
                $idPet =  ($totpet+1)."-p";
              //asal input petikan
            if ($aKategori == 'BASAH'){$kelasan = 'S.'.$aKelas;}else{$kelasan = 'D.'.$aKelas;}
            $asetan = $selector->getAsetById($asetId);
            $luasOld = "";
            foreach($asetan as $ast){
                $luasOld .= $ast['luas'];
            }

            if (isset($_POST['petasal'])){
                $cAsal1 = $_POST['petasal'];
            }else{
                $cAsal1 = $cAsal;
            }
            
                if($luasOld <= $aLuas){
                    $petikan = $sqlite->insertPetikan($idPet, $cAsal, $nm, $al);
                    $sqlite->updateRegulator($asetId, $cAsal, $idPet, $jmlriw);
                    $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal1, $idPet, $tgl);
                    $sqlite->insertKolektor($periwayatan, $cAsal, $idPet);
                }else{
                    $petikan = $sqlite->insertPetikan($idPet,$cAsal, $nm, $al);
                    $newLuas = $luasOld - $aLuas;
                    $sqlite->updateAset($asetId, $aKategori, $kelasan, $newLuas, $aPersil);
                    $newAset = $sqlite->insertAset($aKategori, $aPersil, $kelasan, $aLuas);
     
                    $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal1, $idPet, $tgl);
                    $sqlite->insertRegulator($newAset, $asalId, $cAsal, $idPet, $jmlriw);
                    $sqlite->insertKolektor($periwayatan, $cAsal, $idPet);
                }
            break;
        case "petC":
            $asetId = $_POST['aset_id'];
            $asalId = $_POST['asal_id'];
            $cAsal = $_POST['cAsal'];
            $nc = $_POST['nc'];
            $nm = $_POST['nm'];
            $al = $_POST['al'];
    
            $sb = $_POST['sb'];
            $tgl = $_POST['tgl'];
    
            $aPersil = $_POST['aPersil'];
            $aKategori = $_POST['aKategori'];
            $aKelas = $_POST['aKelas'];
            $aLuas = $_POST['aLuas'];

            $totpet = $selector->countpetik();
                $idPet =  ($totpet+1)."-p";
              //asal input petikan
            if ($aKategori == 'BASAH'){$kelasan = 'S.'.$aKelas;}else{$kelasan = 'D.'.$aKelas;}
            $asetan = $selector->getAsetById($asetId);
            $luasOld = "";
            foreach($asetan as $ast){
                $luasOld .= $ast['luas'];
            }

            if (isset($_POST['petasal'])){
                $cAsal1 = $_POST['petasal'];
            }else{
                $cAsal1 = $cAsal;
            }

            $warga = $selector->getWargaById($nc);
                if(count($warga) == 0){
                    $sqlite->insertWarga($nc, $nm, $al);
                }
            
                if($luasOld <= $aLuas){
                    $sqlite->updateRegulator($asetId, $nc, '', $jmlriw); //hanya menghitung luas aset dari..., tdak melihat aset ke...
                    $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal1, $nc, $tgl);
                    $sqlite->insertKolektor($periwayatan, $cAsal, $cAsal1);
                    $sqlite->insertKolektor($periwayatan, $nc, $cAsal1);
                }else{
                    $newLuas = $luasOld - $aLuas;
                    $sqlite->updateAset($asetId, $aKategori, $kelasan, $newLuas, $aPersil);
                    $newAset = $sqlite->insertAset($aKategori, $aPersil, $kelasan, $aLuas); //hanya menghitung luas aset dari..., tdak melihat aset ke...
                    $periwayatan = $sqlite->insertRiwayat($asalId, $aPersil, $kelasan, $aLuas, $sb, $cAsal1, $nc, $tgl);
                    $sqlite->insertRegulator($newAset, $asalId, $nc, $jmlriw);
                    $sqlite->insertKolektor($periwayatan, $cAsal, $cAsal1);
                    $sqlite->insertKolektor($periwayatan, $nc, $cAsal1);
                }
            break;
    case "bolob":
        $idImg = $_POST['idImg'];
        $file_name = $_FILES['imagin']['name'];
		$file_temp = $_FILES['imagin']['tmp_name'];
		$file_size = $_FILES['imagin']['size'];
			$file = explode('.', $file_name);
			$end = end($file); 
				$name = $idImg."-".date("Ymd").time();
				$location = 'db/mage/'.$name.".".$end;
				if(move_uploaded_file($file_temp, $location)){
                    $sqlite->insertBlob($idImg, $location);
                    
                    $html = '<a href="'.$location.'" data-lightbox="mygallery">
			                    <img src="'.$location.'" alt="first">
                            </a>';
                            
                    echo $html;
				}
        break;
        case "movebase":
            $file_temp = "apd/sampah/phpsqlite.db";
            $location = "db/phpsqlite.db";
            
				if(copy($file_temp, $location)){
                  //window alert
               
                  echo "<script>window.alert('database berhasil di kosonglkan'); window.location.href='index.php'</script>";

                
				}
        break;

}
?>