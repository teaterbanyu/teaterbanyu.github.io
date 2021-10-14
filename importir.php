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

$s = $_GET['s'];
switch($s){
    case "excel":
        $error = '';
        $total_line = '';
        $nama_file = $_FILES['excel']['name'];
        $allowed = 'data-c.xls';
        $file_array = explode(".", $_FILES["excel"]["name"]);
        $extension = end($file_array);
        //session_start();
        if($nama_file == ''){
            $error = 'Belum Ada File yang Dipilih !';
        }else{
            if($nama_file !== $allowed){
                $error = 'Pastikan Hanya Mengunggah File <br><b>data-c.xls  !</b>';
            }else{
                $new_file_name = 'dataExcel.' . $extension;
                move_uploaded_file($_FILES['excel']['tmp_name'], 'tmp/'.$new_file_name);
                /*
                //$new_file_name = rand() . '.' . $extension; //ubah nama file dg angka random

                //chmod($_FILES['excel']['name'],0777);
                $file_content = file('tmp/'. $new_file_name, FILE_SKIP_EMPTY_LINES); // pake csv
                $total_line = count($file_content); //csv
                */

                $reader = Asan\PHPExcel\Excel::load('tmp/'.$new_file_name, function(Asan\PHPExcel\Reader\Xls $reader) {
                    //$reader->setRowLimit(5);
                    //$reader->setColumnLimit(10);
                    $reader->ignoreEmptyRow(true);
                    //$reader->seek(2);
                    //$reader->setSheetIndex(1);
                });
                $total_line = $reader->count();
            }
        }

        if($error != ''){
            $output = array(
                'error'  => $error
            );
        }else{
            $output = array(
                'success'  => true,
                'total_line' => ($total_line - 1)
            );
        }
        echo json_encode($output);
        break;
    case "excelsppt":
        $error = '';
        $jumlah_baris = '';
        $link = '';
        $count ='';
        $nama_file = $_FILES['sppt']['name'];
        $allowed = 'data-sppt.xls';
        $file_array = explode(".", $_FILES["sppt"]["name"]);
        $extension = end($file_array);
        //session_start();
        if($nama_file == ''){
            $error = 'Belum Ada File yang Dipilih !';
        }else{
            if($nama_file !== $allowed){
                $error = 'Pastikan Hanya Mengunggah File <br><b>data-sppt.xls  !</b>';
            }else{

                $tahun   =$_POST['tahun'];
                $target = 'dataSppt.' . $extension ;
                //$target = basename($_FILES['sppt']['name']) ;
	            move_uploaded_file($_FILES['sppt']['tmp_name'],'tmp/'. $target);
	            //chmod($_FILES['sppt']['name'],0777);                  

                $reader = Asan\PHPExcel\Excel::load('tmp/'.$target, function(Asan\PHPExcel\Reader\Xls $reader) {
                    //$reader->setRowLimit(5);
                    //$reader->setColumnLimit(10);
                    $reader->ignoreEmptyRow(true);
                    //$reader->seek(2);
                    //$reader->setSheetIndex(1);
                });

                foreach ($reader as $row) {
                    if($row[0] == "NO") continue;
                    $dataTahun = $row[1];
                }
                if($tahun != $dataTahun){
                    $error = "Tahun yang anda masukan tidak sesuai dengan tahun di data excel, mohon periksa kembali";
                }
                $sqlite->inputtahunsek($tahun);
	            $jumlah_baris = $reader->count();

                /*$new_file_sppt = rand() . '.' . $extension; //ubah nama file dg angka random
                $file_content_sppt = file('tmp/'. $new_file_sppt, FILE_SKIP_EMPTY_LINES);
                $jumlah_baris = count($file_content_sppt);*/

                $rowfr = $selector->getNobar();
                foreach($rowfr as $dtnoi){
                    $row = $dtnoi['noi'];
                }
                if (isset($row)){
                    $link = "progExcelsppt";
                    $count = "getCountPraha";
                    
                }else{
                    $link = "progSpptKosong";
                    $count = "getCountsppt";
                }
                    
            }
        }
    
        if($error != ''){
            $output = array(
                'error'  => $error,
                //'tahun' => $_SESSION['sppt_tahun']
            );
        }else{
            $output = array(
                'success'  => true,
                'jumlah_baris' => ($jumlah_baris - 1),
                'tahun' => $tahun,
                'link' => $link,
                'count' => $count,
            );
        }
        echo json_encode($output);
            
        break;
    case "progExcel":
        //ambil jumlah riwayat
        $jmlriw1 = $selector->getcountriwayat();
        $jmlriw =  $jmlriw1 + 1;
        header('Content-type: text/html; charset=utf-8');
        header("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        set_time_limit(0);
        ob_implicit_flush(1);
        //session_start();
        
        if(file_exists("tmp/dataExcel.xls")){
            $duplikasi=0;
            $dno = [];
            /*
            // menggunakan file csv
            clearstatcache();
            $file_data = fopen('tmp/dataExcel.csv', 'r');
            fgetcsv($file_data);
            while($col = fgetcsv($file_data)){
                $warga = $selector->getWargaById($col[0]);
                if(count($warga) > 0){
                    foreach($warga as $w){
                        $cekwNo = $w['warga_id'];
                        $cekwNama = $w['nama'];
                    }
                    if($col[0] == $cekwNo && $col[1] != $cekwNama){
                        $duplikasi = $duplikasi + 1;
                        $dno[] = [$col[0],$col[1]];
                        continue;
                    }
                }else{
                    $sqlite->insertWarga($col[0], $col[1], $col[2]);
                }
                
                if ($col[4] == 'BASAH'){
                    $kelasan = 'S.'.$col[5];
                }else{
                    $kelasan = 'D.'.$col[5];
                }
                $setAset = $sqlite->insertAset($col[4], $col[3], $kelasan, $col[6]);
                $periwayatan = $sqlite->insertRiwayat($setAset, $col[3], $kelasan, $col[6], '', '', $col[0], '');
                $sqlite->insertRegulator($setAset, $setAset, $col[0], '');
                $sqlite->insertKolektor($periwayatan, $col[0], '');
                
                usleep(250000);
                if(ob_get_level() > 0){
                    ob_end_flush();
                }
            }*/

            // menggunakan file xls, di linux filed string tdak terbaca
            $reader = Asan\PHPExcel\Excel::load('tmp/dataExcel.xls', function(Asan\PHPExcel\Reader\Xls $reader) {
                //$reader->setRowLimit(5);
                //$reader->setColumnLimit(10);
                $reader->ignoreEmptyRow(true);
                //$reader->seek(2);
                //$reader->setSheetIndex(1);
            });
            
            foreach ($reader as $row) {
                $noC = $row[0]; //0
                $nama = $row[1]; //1
                $alamat = $row[2]; //2
                $persil = $row[3]; //3
                $kategori = $row[4]; //4
                $kelas = $row[5]; //5
                $luas = $row[6]; //6

                if($noC == "No. C") continue;

                $warga = $selector->getWargaById($noC);
                
                if(count($warga) > 0){
                    foreach($warga as $w){
                        $cekwNo = $w['warga_id'];
                        $cekwNama = $w['nama'];
                    }
                    if($noC == $cekwNo && $nama != $cekwNama){
                        $duplikasi = $duplikasi + 1;
                        $dno[] = [$noC,$nama];
                        continue;
                    }
                }else{
                    $sqlite->insertWarga($noC, $nama, $alamat);
                }                
               
                    if ($kategori == 'BASAH'){
                        $kelasan = 'S.'.$kelas;
                    }else{
                        $kelasan = 'D.'.$kelas;
                    }
                    $setAset = $sqlite->insertAset($kategori, $persil, $kelasan, $luas);
                    $periwayatan = $sqlite->insertRiwayat($setAset, $persil, $kelasan, $luas, '', '', $noC, '');
                    $sqlite->insertRegulator($setAset, $setAset, $noC, '', $jmlriw);
                    $sqlite->insertKolektor($periwayatan, $noC, '');
                
                usleep(250000);
                if(ob_get_level() > 0){
                    ob_end_flush();
                }
            }
            
            //unlink('tmp/dataExcel.csv');
            unlink('tmp/dataExcel.xls');
            $output = array(
                'duplikat'  => $duplikasi,
                'dno' => $dno,
            );
            echo json_encode($output);;
        }        
        break;
    case "getCount":
        $c = $_GET['c'];
        $duplikasi = $_GET['d'];
        $dataAset = $selector->getAsetCountTotal();
        $proc = $dataAset - $c + $duplikasi;
        $output = array(
            'proc'  => $proc,
            'duplikasi' => $duplikasi
        );
        echo json_encode($output);
        break;
    case "progSpptKosong":
        header('Content-type: text/html; charset=utf-8');
        header("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        set_time_limit(0);
        ob_implicit_flush(1);
        if(file_exists("tmp/dataSppt.xls")){
            //jika kosong----------------------------------------------------------------------
                // mulai looping
                $reader = Asan\PHPExcel\Excel::load('tmp/dataSppt.xls', function(Asan\PHPExcel\Reader\Xls $reader) {
                    //$reader->setRowLimit(5);
                    //$reader->setColumnLimit(10);
                    $reader->ignoreEmptyRow(true);
                    //$reader->seek(2);
                    //$reader->setSheetIndex(1);
                });
                
                foreach ($reader as $row) {
                    
                    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
                    $noi     = $row[0];

                    if($noi == "NO") continue;

                    $tahuni   = $row[1];
                    $nopi  = $row[2];
                    $no_induki  = $row[3];
                    //nama 
                    $nama_wajibi  = $row[4];
                    $pnamai = str_split($nama_wajibi);
                    $jmlni = count($pnamai);
                    $petiki = chr(39);
                    $namabarui = "";
                    for($pi=0;$pi<$jmlni;$pi++){
                        if($pnamai[$pi] == $petiki){
                            $pnamai[$pi] = '\'\'';
                        }
                        $namabarui .= $pnamai[$pi];
                    }
                    $alamat_wajibi  = $row[5];
                    $alamat_objeki  = $row[6];
                    $pajaki  = $row[7];
                    if($noi != ""){
                        $sqlite->insertSppt($noi, $tahuni, $nopi, $no_induki, $namabarui, $alamat_wajibi, $alamat_objeki, $pajaki);	 //di masukan ke data induk dan di tandai di tb_baru            
                    }
                    usleep(250000);
                    if(ob_get_level() > 0){
                        ob_end_flush();
                    }                 
                }
                //$halaman = "base.php?page=sppt&des=".$desaku ;

            unlink('tmp/dataSppt.xls');
        }
        break;   
    case "progExcelsppt":
        header('Content-type: text/html; charset=utf-8');
        header("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        set_time_limit(0);
        ob_implicit_flush(1);
        //session_start();
        $t = $_GET['t'];
        if(file_exists("tmp/dataSppt.xls")){
            
            $reader = Asan\PHPExcel\Excel::load('tmp/dataSppt.xls', function(Asan\PHPExcel\Reader\Xls $reader) {
                //$reader->setRowLimit(5);
                //$reader->setColumnLimit(10);
                $reader->ignoreEmptyRow(true);
                //$reader->seek(2);
                //$reader->setSheetIndex(1);
            });
            $tahun = $t;
                //$halaman="lanjut_hapus.php?th=$tahun&des=$desaku";
                //memasukan nop pra hapus
                //jika database tidak kosong-------
                foreach ($reader as $row) {
                    $nop_pra  = $row[2];
                     $sqlite->insertpraha($nop_pra);
                    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
                    $nop  = $row[2];
                    if($nop == "NOP") continue;

                    $pajak  = $row[7];
                    $nama_wajib  = $row[4];
                    $pnama = str_split($nama_wajib);
                    $jmln = count($pnama);
                    $petik = chr(39);
                    $namabaru = "";
                    for($p=0;$p<$jmln;$p++){
                        if($pnama[$p] == $petik){ $pnama[$p] = '\'';}
                        $namabaru .= $pnama[$p];
                    }
                    //melihat apahak nomer ada atau tidak	
                    $rowubah = $selector->getNop($nop);
                    foreach($rowubah as $dtnop){
                        $no_ubah_ini = $dtnop['nop'];
                    }
                    /* echo "<br>---<br>".$no_ubah_ini."-----------------------iki lohhhh<br>";
                    if ($no_ubah_ini !== $nop){
                        echo $nop."---tidak ada <br>".$no_ubah_ini."<br>";
                    }else{
                        echo $nop."-----adaa <br>".$no_ubah_ini."<br>";
                    }*/
                    if ($no_ubah_ini !== $nop){
                        //deklarasi isi tabel kecuali nop dan pajak
                        $no     = $row[0];
                        //nama 
                        $alamat_wajib  = $row[5];	
                        $no_induk  = $row[3];
                        $alamat_objek  = $row[6];
                        //jika tidak maka spp baru 
                        $sqlite->insertSppt($no, $tahun, $nop, $no_induk, $namabaru, $alamat_wajib, $alamat_objek, $pajak);	 //di masukan ke data induk dan di tandai di tb_baru
                        //	echo "sppt ".$nop." berhasil dimasukan ke induk";	
                        //di masukan ke data induk dan di tandai di tb_baru
                        $sqlite->insertSpptbaru($tahun, $nop, $namabaru);
                    }else{
                        //	echo "<br>";
                        //	echo ".  no.".$nop.". ada  nama  ";
                        //jika ada maka di cek
                        $perubahan = "";
                        $rowceknama = $selector->getNop($nop);
                        foreach($rowceknama as $dtnam){
                            $namak = $dtnam['nama_wp'];
                            $pajak_t = $dtnam['pajak_t'];
                        }
                       //priksa nama
                        if ($namabaru !== $namak ){
                            $perubahan = $perubahan."- pindah tangan dari ".$namak." kepada ".$namabaru.".";  //$perubahan belum di pakai
                            $sqlite->updateSpptNama($namabaru,$nop);
                        }
                        //		echo $namabaru."-------<br>-----".$namak."<br><br>";
                        //periksa pajak
                        $var_pajak = $pajak_t ;
						$enter = "<br/>";
						if ($var_pajak == $pajak ){

							
						}else{
						//jika perubhan nama isi maka enter di tambah 
						if ($perubahan !== ""){
							$perubahan = $perubahan.$enter."- pajak berubah dari ".$var_pajak." menjadi ".$pajak."."; 
						}else{
						$perubahan = $perubahan."- pajak berubah dari ".$var_pajak." menjadi ".$pajak."."; 
						}
							$sqlite->updateSpptPajak($pajak,$nop);
							
						}
                        //	echo "-----------".$pajak."<br>-----".$var_pajak."<br>";
                        //periksa perubahan
                        //jika ada yg berubah maka
                        if($perubahan !== ""){
                            $namak1 = $perubahan;
                            $sqlite->insertperu($nop, $namak1, $tahun);
                            //	echo "<br>";
                            //	echo "----".$perubahan."---------------------------------------------------------------------------<br>";       
                        }
                        //input perubahan
                        //jika tdk ada perubahan 
                        //lanjut
                    }
                    usleep(250000);
                    if(ob_get_level() > 0){
                        ob_end_flush();
                    }  
                }
            
                unlink('tmp/dataSppt.xls');
        }
        break;
    case "getCountsppt":
        $dataAset = $selector->getSpptCountTotal();
        $proc = $dataAset;
        echo $proc;
        break;
    case "getCountPraha":
        $dataAset = $selector->getPrahaCountTotal();
        $proc = $dataAset;
        echo $proc;
        break;
    case "dbs":
        $error = '';
        $dst = $_FILES['dbs']['name'];
        session_start();
        if($dst == ''){
            $error = 'Belum Ada File yang Dipilih !';
        }else{
            $zip = new ZipArchive;
            $zip->open($dst);
            $zip->extractTo('db/'); 
            $zip->close();
        }

        if($error !== ''){
            $output = array(
                'error'  => $error
            );
        }else{
            $output = array(
                'success'  => true,
            );
        }
        echo json_encode($output);
        break;
}
?>
