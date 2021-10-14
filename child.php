<?php 
require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteQuerySelect as SQLiteQuerySelect;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteQuerySelect($pdo);

$form=$_GET["form"];

$pdo1 = (new SQLiteConnection())->connect1();
$selector1 = new SQLiteQuerySelect($pdo1);

$us = $selector1->getUser();
foreach($us as $dtus){
    $user = $dtus['username_id'];
    $pass = $dtus['password_id'];
    $desaku = $dtus['desa'];
    $kepala = $dtus['kepala'];
    $kabupaten = $dtus['kab'];
 }

switch($form){
    case "update":
        $q=$_GET["ref"];
        $sbm="upd";
        $title = "FORM PERUBAHAN DATA";
        $tabForm = $sqlite->getAsetById($q);
        include_once('rePage/asetForm.php');
        break;
    case "convert":
        $q=$_GET["ref"];
        $sbm="cnv";
        $title = "Data Tanah";
        echo "<h3 style='text-align:center;'><strong>Dipindahkan Kepada asu :</strong></h3>
            <table class='table table-bordered table-striped'>
                <tr><th style='width:10%;'>Nomor C</th><th style='width:25%;'>Nama</th><th>Alamat</th><th style='width:15%;'>Sebab</th><th style='width:20%;'>Tanggal</th></tr>
                <tr>
                    <td style='padding:0 '>
                        <input class='inputCell itemReq' id='nc' type='text' onkeyup='getResult(this.value);' />
                        <div id='search' style='padding:10px 0px; margin-top: -10px; position:absolute; width: calc(100% - 31px); z-index:1; display:none'>
                            <div id='livesearch' style='padding:0;background-color: white;'></div>
                        </div>
                    </td>
                    <td style='padding:0'>
                        <input class='inputCell itemReq'id='nm' type='text' onkeyup='this.value = this.value.toUpperCase();'/>
                    </td>
                    <td style='padding:0'>
                        <input class='inputCell itemReq' id='al' type='text' onkeyup='this.value=toTitleCase(this.value)'/>
                    </td>
                    <td style='padding:0'>
                        <select class='inputCell itemReq' id='sb' style='padding: 3.5px 0;'>
                            <option value='' disabled selected hidden>--Pilih--</option>
                            <option>Jual/Beli</option>
                            <option>Waris</option>
                            <option>Hibah</option>
                            <option>Wakaf</option>
                            <option>Tukar Guling</option>
                        </select>
                    </td>
                    <td style='padding:0;'>
                        <input style='text-align:center' class='inputCell itemReq' id='tgl' type='text'/> 
                    </td>
                </tr>
            </table>";
        $tabForm = $sqlite->getAsetById($q);
        include_once('rePage/asetForm.php');
        break;
        case "petikan":
            $q=$_GET["ref"];
            $sbm="pet";
            $title = "Data Tanah";

            echo "<h3 style='text-align:center;'><strong>Dipindahkan Kepada :</strong></h3>
                <table class='table table-bordered table-striped'>
                    <tr><th style='width:25%;'>Nama</th><th>Alamat</th><th style='width:15%;'>Sebab</th><th style='width:20%;'>Tanggal</th></tr>
                    <tr>
                        <td style='padding:0'>
                            <input class='inputCell itemReq'id='nm' type='text' onkeyup='this.value = this.value.toUpperCase();'/>
                        </td>
                        <td style='padding:0'>
                            <input class='inputCell itemReq' id='al' type='text' onkeyup='this.value=toTitleCase(this.value)'/>
                        </td>
                        <td style='padding:0'>
                            <select class='inputCell itemReq' id='sb' style='padding: 3.5px 0;'>
                                <option value='' disabled selected hidden>--Pilih--</option>
                                <option>Jual/Beli</option>
                                <option>Waris</option>
                                <option>Hibah</option>
                                <option>Wakaf</option>
                            </select>
                        </td>
                        <td style='padding:0;'>
                            <input style='text-align:center' class='inputCell itemReq' id='tgl' type='text'/>
                        </td>
                    </tr>
                </table>";
            $tabForm = $sqlite->getAsetById($q);
            include_once('rePage/asetForm.php');
            break;
            case "petikan-p":
                $q=$_GET["ref"];
                $q1=$_GET["petid"];
                $petid= explode('space',$q1);
                $idPet = explode("-", $petid[1]);
              //  $q1=$_GET["ref1"];
                $sbm="pet";
                $title = "Data Tanah";
                $tabForm = $sqlite->getAsetById($q);
                foreach ($tabForm as $ua1): 
                $asal = $ua1['asal_id'];
                endforeach;

                echo "<h3 style='text-align:center;'><strong>Dari ".$petid[0]."</strong> (petikan ".$idPet[0].")<strong> Dipindahkan Kepada :</strong></h3>
                    <input type='hidden' id='petasal' value=".$petid[1].">
                    <table class='table table-bordered table-striped'>
                        <tr><th style='width:25%;'>Nama</th><th>Alamat</th><th style='width:15%;'>Sebab</th><th style='width:20%;'>Tanggal</th></tr>
                        <tr>
                            <td style='padding:0'>
                                <input class='inputCell itemReq'id='nm' type='text' onkeyup='this.value = this.value.toUpperCase();'/>
                            </td>
                            <td style='padding:0'>
                                <input class='inputCell itemReq' id='al' type='text' onkeyup='this.value=toTitleCase(this.value)'/>
                            </td>
                            <td style='padding:0'>
                                <select class='inputCell itemReq' id='sb' style='padding: 3.5px 0;'>
                                    <option value='' disabled selected hidden>--Pilih--</option>
                                    <option>Jual/Beli</option>
                                    <option>Waris</option>
                                    <option>Hibah</option>
                                    <option>Wakaf</option>
                                </select>
                            </td>
                            <td style='padding:0;'>
                                <input style='text-align:center' class='inputCell itemReq' id='tgl' type='text'/>
                            </td>
                        </tr>
                    </table>";
               
                include_once('rePage/asetForm.php');
                break;
                case "petikan-c":
                    $q=$_GET["ref"];
                    $q1=$_GET["petid"];
                    $petid= explode('space',$q1);
                    $idPet = explode("-", $petid[1]);
                  //  $q1=$_GET["ref1"];
                    $sbm="petC";
                    $title = "Data Tanah";
                    $tabForm = $sqlite->getAsetById($q);
                    foreach ($tabForm as $ua1): 
                    $asal = $ua1['asal_id'];
                    endforeach;
    
                    echo "<h3 style='text-align:center;'><strong>Dari ".$petid[0]."</strong> (petikan ".$idPet[0].")<strong> Dipindahkan Kepada :</strong></h3>
                        <input type='hidden' id='petasal' value=".$petid[1].">
                        <table class='table table-bordered table-striped'>
                            <tr><th style='width:25%;'>Nama</th><th>Alamat</th><th style='width:15%;'>Sebab</th><th style='width:20%;'>Tanggal</th></tr>
                            <tr>
                                <td style='padding:0'>
                                    <input class='inputCell itemReq' id='nc' type='text' onkeyup='getResult(this.value);' />
                                    <div id='search' style='padding:10px 0px; margin-top: -10px; position:absolute; width: calc(100% - 31px); z-index:1; display:none'>
                                        <div id='livesearch' style='padding:0;background-color: white;'></div>
                                    </div>
                                </td>
                                <td style='padding:0'>
                                    <input class='inputCell itemReq'id='nm' type='text' onkeyup='this.value = this.value.toUpperCase();'/>
                                </td>
                                <td style='padding:0'>
                                    <input class='inputCell itemReq' id='al' type='text' onkeyup='this.value=toTitleCase(this.value)'/>
                                </td>
                                <td style='padding:0'>
                                    <select class='inputCell itemReq' id='sb' style='padding: 3.5px 0;'>
                                        <option value='' disabled selected hidden>--Pilih--</option>
                                        <option>Jual/Beli</option>
                                        <option>Waris</option>
                                        <option>Hibah</option>
                                        <option>Wakaf</option>
                                    </select>
                                </td>
                                <td style='padding:0;'>
                                    <input style='text-align:center' class='inputCell itemReq' id='tgl' type='text'/>
                                </td>
                            </tr>
                        </table>";
                   
                    include_once('rePage/asetForm.php');
                    break;
                  case "super":
                    $q=$_GET["ref"];
                    if (isset($_GET["petid"]) ){$namapet = "namapet"; $petid= explode('space',$_GET["petid"]);   $r=  $petid[0]; $display ="display:table";}else{ $display ="display:none";}
                    $tabForm = $sqlite->getAsetById($q);
                    include_once('formsurat/surat-pernya.php');
                    break;
                case "suju":
                    $q=$_GET["ref"];
                    if (isset($_GET["petid"]) ){$namapet = "namapet"; $petid= explode('space',$_GET["petid"]);   $r=  $petid[0]; $display ="display:table";}else{ $display ="display:none";}
                    $tabForm = $sqlite->getAsetById($q);
                    include_once('formsurat/surat-jual.php');
                    break;
                case "suhi":
                    $q=$_GET["ref"];
                    if (isset($_GET["petid"]) ){$namapet = "namapet"; $petid= explode('space',$_GET["petid"]);   $r=  $petid[0]; $display ="display:table";}else{$namapet = "namapetik"; $display ="display:none";}
                    $tabForm = $sqlite->getAsetById($q);
                    include_once('formsurat/surat-hibah.php');
                    break;
}
?>
