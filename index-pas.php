<?php
header('Location: base.php?page=home');
/*require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteCreateTable as SQLiteCreateTable;
use App\SQLiteQuerySelect as SQLiteQuerySelect;
use App\SQLiteTabulation;
$pdo = (new SQLiteConnection())->connect();
$pdo1 = (new SQLiteConnection())->connect1();
$create = new SQLiteCreateTable($pdo);
$create->createTables();
$sqlite = new SQLiteQuerySelect($pdo1);
$sqlitetab = new SQLiteTabulation($pdo1);


//baca record unik coba select db
$dataun = $sqlite->getAkt1();
foreach($dataun as $dtun){     
    $idhvalun=$dtun['aktif'];
}


if(!isset($idhvalun)){
//insert
$unun = uniqid();
$sqlitetab->insertAkodecoba($unun);

$idhvalun = $unun;

}

//baca record aktivasi select db
$data = $sqlite->getAkt();
foreach($data as $dt){     
    $idhval=$dt['aktif'];
}

//user
$dataser = $sqlite->getseri($idhvalun) ;
foreach($dataser as $dts){    
    $isi2=$dts['reg'];
}

if(isset($idhval)){
 
    $data2 = $sqlite->getUser();
    foreach($data2 as $dt2){
      
        $user = $dt2['username_id'];
    
    }

    //BATAS KELOLA PER HURUP

    //batas
    //$pack= 't';
    //$kilab2 = (strrev($pack));

    $z = "";
    $PecahStr = explode("-", $isi2);

    for ( $p = 0; $p < count( $PecahStr ); $p++ ) {

    $blok1 = str_split($PecahStr[$p]);

    for ( $x = 0; $x < count( $blok1 ); $x++ ) {
    $h1 = ord( $blok1[$x] );
    if($h1>75){
        if($h1%2 == 0){$h2 = $h1-7;}else{$h2 = $h1-5;}
    
    }else{
    if($h1%2 == 0){$h2 = $h1+4;}else{$h2 = $h1+8;}

    }
    $h3 = chr($h2);
    $z .= $h3;

    }

    }

    //penambahan strip

    $bg1=(substr($z,0,3)); 
    $bg2=(substr($z,3,3)); 
    $bg3=(substr($z,-3)); 

    $aktif1 = $bg1 ."-". $bg2 ."-". $bg3;


    //batasssssss




    if($aktif1==$idhval){
    
    if($user==''){
      //  echo "user kosong";
        header('Location: login.php?page=regist');
        }else{
            //echo  $user."user ada";
             header('Location: login.php?page=login');
        }
    }else{
    echo "Mohon Maaf..." ;
    echo "<br>";
    echo "Kode Aktivasi tidak sesuai dengan perangkat yang anda gunakan";
    echo "<br>";
  

    
    }
        
}else{
    header('Location: login.php?page=aktif&isi='.$isi2);



}/* */

?>
