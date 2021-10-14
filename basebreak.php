<?php


require "vendor/autoload.php";

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteQuerySelect as SQLiteQuerySelect;
use App\SQLiteTabulation;
$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteQuerySelect($pdo);


$pdo1 = (new SQLiteConnection())->connect1();
$selector1 = new SQLiteQuerySelect($pdo1);
$sqlite1 = new SQLiteTabulation($pdo1);
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php include "inclution/heading.php"; ?>
        <script>
            $(document).ready(function(){
                $(".preloader").fadeOut('slow');
            });
        </script>
    </head>
    <body>


    
        <?php 
        
        
        $us = $selector1->getUser();
	        
     
         
          foreach($us as $dtus){
             $user = $dtus['username_id'];
             $pass = $dtus['password_id'];
             $desaku = $dtus['desa'];
             $kepala = $dtus['kepala'];
          }

        
       



        include "inclution/header.php"; 
        ?>
        <div class="preloader" id="loadIt">
            <div class="loading">
                <div class="spinner">
		            <div class="dot1"></div>
		            <div class="dot2"></div>
	            </div>
                <h3><strong>Memuat Data...</strong></h3>
            </div>
        </div>
        <div class="content">
            
            <?php
            $page = $_GET["page"];
            switch ($page) {
              case "persil":
                $aset = $sqlite->getAsetList();
                $sub = "";
                include_once "rePage/persilA.php";
                break;
              case "warga":
                $tables = $sqlite->getWargaList();
                $title = "DATA LETTER C";
                include_once "rePage/personList.php";
                break;
              case "petikan":
                $tables = $sqlite->getPetikanList();
                $title = "DATA PETIKAN LETTER C";
                include_once "rePage/personList.php";
                break;
              case "populate":
                include_once "rePage/populate.php";
                break;
              case "kategori":
                $q = $_GET["q"];
                $sub = $q;
                $aset = $sqlite->getAsetByKategori($q);
                include_once "rePage/persilA.php";
                break;
              case "riwayat":
                $q = $_GET["q"];
                $riwayatAset = $sqlite->getRiwayatByaset($q);
                include_once "rePage/persilR.php";
                break;
              case "profiling":
                $q = $_GET["q"];
                $r = $_GET["r"];
                $kolektor = $sqlite->readKolektor($q);
                foreach ($kolektor as $klek){
                  if($klek['petikan_id'] !== ''){
                    $c = $klek['petikan_id'];
                  }else{
                    $c = '';
                  }
                }
                $riwayatAset = $sqlite->getRiwayatByWarga($q,$c);
                $warga = $sqlite->getWargaById($q);
                $aset = $sqlite->getAsetByWarga($q);
                $petikan = $sqlite->getPetikanByWargaId($q);
                $images = $sqlite->readBolob($q);
                include_once "rePage/profiling.php";
                break;
              case "tambahkan":
                $asetCount = $sqlite->getAsetCountTotal();
                include_once "rePage/tambahkan.php";
                break;
              case "aturan":
                include_once "rePage/aturan.php";
                break;
              case "home":
                include_once "rePage/home.php";
                break;
              case "sppt":
                $asetCountSppt = $sqlite->getSpptCountTotal();
                include_once "rePage/sppt.php";
                break;
            }
            ?>
            
        </div>
    </body>
</html>