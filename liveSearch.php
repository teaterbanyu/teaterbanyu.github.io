<?php
require "vendor/autoload.php";

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteQuerySelect as SQLiteQuerySelect;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteQuerySelect($pdo);
//get the q parameter from URL
$p = $_GET["p"];
$q = $_GET["q"];
$f = $_GET["f"];

//lookup all links from the xml file if length of q>0
if (strlen($q) > 0) {
  $hint = "";
  switch ($f) {
    case "warga_id":
      $search = $sqlite->getWargaSearchByid($q);
      $hint = "<table class='table table-bordered table-hover'>";
      foreach ($search as $ws) {
        
     
        if($p == 1){
          $hint .= "<tr onclick=\"window.location='base.php?page=profiling&q=" . $ws["warga_id"] . "&r=0'\" style='cursor:pointer;'>";
        }else{
          $namama = $ws['nama'];
          $pnama = str_split($namama);
          $jmln = count($pnama);
          $petik = chr(39);
          $namabaru = "";
              for($p=0;$p<$jmln;$p++){
                
                $namabaru .= ord($pnama[$p])."-";
                  }
          $hint .= "<tr onclick=\"display('".$ws['warga_id']."','".$namabaru."','".$ws['alamat']."');\" style='cursor:pointer;'>";
        }
        $hint .= "<td style='width: 20%'>" . $ws["warga_id"] . "</td>";
        $hint .=
          "<td style='text-align:left;padding-left:20px; width: 30%'>" .
          $ws["nama"] .
          "</td>";
        $hint .=
          "<td style='text-align:left;padding-left:20px;'>" .
          $ws["alamat"] .
          "</td>";
        $hint .= "</tr>";
      }
      $hint .=
        "<tfoot><tr><th class='danger'>Nomor C</th><th class='info'>Nama</th><th class='danger'>Alamat</th></tfoot></tr>";
      $hint .= "</table>";
      break;
    case "persil":
      $search = $sqlite->getAsetSearchBypersil($q);
      $hint = "<table class='table table-bordered table-hover'>";
      foreach ($search as $ws) {
        $hint .= "<tr onclick=\"window.location='base.php?page=riwayat&q=" . $ws["asal_id"] . "'\" style='cursor:pointer;'>";
        $hint .= "<td style='width: 20%'>" . $ws["persil"] . "</td>";
        $hint .=
          "<td style='text-align:left;padding-left:20px; width: 20%'>" .
          $ws["kelas"] .
          "</td>";
        $hint .=
          "<td style='text-align:left;padding-left:20px; width: 20%''>" .
          $ws["luas"] .
          "</td>";
        if ($ws["petikan_id"] != null) {
          $getName = $sqlite->getPetikanById($ws["petikan_id"]);
          foreach ($getName as $gn) {
            $hint .=
              "<td style='text-align:left;padding-left:20px;'>" .
              $gn["nama"] .
              "</td>";
          }
        } else {
          $getName = $sqlite->getWargaById($ws["warga_id"]);
          foreach ($getName as $gn) {
            $hint .=
              "<td style='text-align:left;padding-left:20px;'>" .
              $gn["nama"] .
              "</td>";
          }
        }
        $hint .= "</tr>";
      }
      $hint .=
        "<tfoot><tr><th class='danger'>Persil</th><th class='info'>Kelas</th><th class='danger'>Luas</th><th class='info'>Pemilik</th></tfoot></tr>";
      $hint .= "</table>";
      break;
    case "nama":
      $search = $sqlite->getWargaSearchBYname($q);
      $hint = "<table class='table table-bordered table-hover'>";
      foreach ($search as $ws) {
        $hint .=
          "<tr onclick=\"window.location='base.php?page=profiling&q=" .
          $ws["warga_id"] .
          "&r=0'\" style='cursor:pointer'>";
        $hint .=
          "<td style='text-align:left;padding-left:20px;'>" .
          $ws["nama"] .
          "</td>";
        $hint .=
          "<td style='text-align:left;padding-left:20px;'>" .
          $ws["alamat"] .
          "</td>";
        $hint .= "</tr>";
      }
      $hint .=
        "<tfoot><tr><th class='danger'>Nama</th><th class='info'>Alamat</th></tr></tfoot>";
      $hint .= "</table>";
      break;
    case "sppt":
        $search = $sqlite->getSpptSearchBYno($q);
        $hint = "<table class='table table-bordered table-hover'>";
        foreach ($search as $ws) {
          $hint .=
            "<tr onclick=\"window.location='base.php?page=profiling_sppt&nop=" .
            $ws["nop"] .
            "&r=0'\" style='cursor:pointer'>";

            $hint .=
            "<td style='text-align:left;padding-left:20px;'>" .
            $ws["noi"] .
            "</td>";
   
          $hint .=
            "<td style='text-align:left;padding-left:20px;'>" .
            $ws["nop"] .
            "</td>";
          $hint .=
            "<td style='text-align:left;padding-left:20px;'>" .
            $ws["nama_wp"] .
            "</td>";
          $hint .= "</tr>";
        }
        $hint .=
          "<tfoot><tr><th class='danger'>No</th><th class='info'>NOP</th><th class='info'>Nama Wp</th></tr></tfoot>";
        $hint .= "</table>";
        break;
        case "spptnama":
          $search = $sqlite->getSpptSearchBYnam($q);
          $hint = "<table class='table table-bordered table-hover'>";
          foreach ($search as $ws) {
            $hint .=
              "<tr onclick=\"window.location='base.php?page=profiling_sppt&nop=" .
              $ws["nop"] .
              "&r=0'\" style='cursor:pointer'>";
            
              $hint .=
              "<td style='text-align:left;padding-left:20px;'>" .
              $ws["noi"] .
              "</td>";
            $hint .=
              "<td style='text-align:left;padding-left:20px;'>" .
              $ws["nop"] .
              "</td>";
            $hint .=
              "<td style='text-align:left;padding-left:20px;'>" .
              $ws["nama_wp"] .
              "</td>";
            $hint .= "</tr>";
          }
          $hint .=
          "<tfoot><tr><th class='danger'>No</th><th class='info'>NOP</th><th class='info'>Nama Wp</th></tr></tfoot>";
          $hint .= "</table>";
          break;
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint == "" || strlen($hint) < 300) {
  if ($p == 1) {
    $response =
      "<table class='table table-bordered'><tr style='background-color: red; color: white;'><td>Data Tidak Ditemukan, Gunakan Kata Kunci Lain</td></tr></table>";
  } else {
    $response = "";
  }
} else {
  //$response=var_dump($hint);
  $response = $hint;
}

//output the response
echo $response;
?>
