<?php  
require 'vendor/autoload.php';
use Dompdf\Dompdf;

function tgl_indo ($tgl){
  $bulan = array (
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecah = explode('-',$tgl);
    return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}

function asalindo ($tgl){
  $bulan = array (
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecah = explode('-',$tgl);
    return $pecah[0].' '.$bulan[(int)$pecah[1]].' '.$pecah[2];
}
?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cetak PDF</title>
   <style>
   p {font-size: 12pt}

   </style>
</head>
<body style="margin-top:-1cm; margin-bottom: -1px">
<div>
  <h3 style="text-align: center; ">SURAT PERNYATAAN PENGAKUAN</h3>
  <h3 style="text-align: center; line-height:0; margin-top:10px">TELAH MENJUAL TANAH</h3>
 
</div>
 <hr>

<p>Yang bertanda tangan / cap jempol di bawah ini, saya :</p>
<table style="font-size: 12pt; text-align: justify; line-height: 20px; width:100%">
  <tr>
    <td style="width:25%">Nama</td>
    <td style="width:10px">:</td>
    <td><?php if(!isset($_POST['namapet'])){ echo $_POST['namasaya'] ;}else {echo $_POST['namapet'] ;} ?></td>    
    
  </tr>
  <tr>
    <td style="padding-right: 30px">Tanggal Lahir</td>
    <td>:</td>
     <td><?php echo $_POST['tglsaya'] ?></td>
  </tr>
  <tr>
    <td >Pekerjaan</td>
    <td>:</td>
     <td><?php echo $_POST['pekerjaansaya'] ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
     <td><?php echo $_POST['alamatsaya'] ?></td>
  </tr>
</table >
<p>Dengan ini menyatakan sebenarnya (Jika diperlukan sanggup diangkat sumpah) bahwa :</p>
<table style="font-size: 12pt">
  <tr> 

    <td width=20 valign="top" >1. </td>
   <td colspan=6 >Saya memiliki sebidang tanah Hak Milik Adat No. C <span style='text-decoration:line-through'> / Verponding Indonesia / SPPT</span> No. <span style="font-weight:bold"><?php echo $_POST['nomorsaya'] ?></span> Persil <span style="font-weight:bold"><?php echo $_POST['nomeriki'] ?></span> Kelas <span style="font-weight:bold"><?php echo $_POST['kelasiki'] ?></span> <span style='text-decoration:line-through'>/ Tanah Negara * ) </span> seluas <span style="font-weight:bold"><?php echo $_POST['luasiki'] ?></span> M² yang terletak di <span style="font-weight:bold"> <?php if($_POST['lokasiiki'] != ''){echo $_POST['lokasiiki'];}else{echo "………………………";} ?></span></td>
  </tr>
 <tr><td colspan=7></td></tr>
  <tr>
    <td >2. </td>
    <td colspan=6 >Tanah tersebut pada butir ( 1 ) di atas seluruhnya / sebagian seluas <span style="font-weight:bold"> <?php if($_POST['luasan'] != ''){echo $_POST['luasan'];}else{echo "………………………";} ?></span></span> M² </td>
  </tr>
  <tr><td colspan=7></td></tr>
  <tr>
    <td></td>
    <td colspan=6 >dengan batas-batas  :</td>
  </tr>
  <tr>

    <td></td>
    <td style="width:50px">Utara</td>
    <td style="text-align:center; width:10px">:</td>
    <td><?php echo $_POST['utara'] ?></span></td>

    <td style="width:50px">Timur</td>
    <td style="text-align:center; width:10px">:</td>
    <td><?php echo $_POST['timur'] ?></span></td>
  </tr>
  <tr>
    <td ></td>
    <td >Selatan</td>
    <td style="text-align:center">:</td>
    <td ><?php echo $_POST['selatan'] ?></span></td>
    <td >Barat</td>
    <td style="text-align:center">:</td>
    <td ><?php echo $_POST['barat'] ?></span></td>
  </tr>
</table>
<p style="text-align:center">Telah saya jual pada tahun <?php if($_POST['tahunan'] != ''){echo $_POST['tahunan'];}else{echo "………………………";} ?></span> kepada :</p>
<table style="font-size: 12pt; text-align: justify; line-height: 20px; width:100%">
  <tr>
    <td >Nama</td>
    <td>:</td>    
    <td><<?php echo $_POST['namanya'] ?></span></td>    
  </tr>
  <tr>
    <td style="padding-right: 30px">Tanggal Lahir</td>
    <td>:</td>
    <td><?php echo $_POST['tglnya'] ?></span></td>
  </tr>
  <tr>
    <td >Pekerjaan</td>
    <td>:</td>
    <td><?php echo $_POST['pekerjaanya'] ?></span></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td style="width: 75%"><?php echo $_POST['alamatnya'] ?></span></td> 
  </tr>
</table >
<br>
<p>Uang hasil penjualan tanah tersebut sejumlah Rp. <?php if($_POST['jualan'] != ''){echo $_POST['jualan'];}else{echo "………………………";} ?> (<?php if($_POST['bilangan'] != ''){echo $_POST['bilangan'];}else{echo "………………………………………………………………………";} ?>) telah saya terima  dan surat ini berfungsi pula sebagai tanda  Bukti  Pelunasan yang sah.</p>
<table style="font-size: 12pt">
  <tr>
    <td width=20 valign="top" >3. </td>
    <td >Tanah tersebut belum pernah didaftarkan sertipikatnya/bersertipikat.</td>
  </tr>
  <tr>
    <td width=20 valign="top" >4. </td>
    <td >Saya menjamin tanah tersebut tidak sengketa, bebas  dari sitaan  dan tidak  terikat sebagai  
      jaminan hutang, bukan merupakan harta warisan yang belum terbagi.</td>
  </tr>
  <tr>
    <td width=20 valign="top" >5. </td>
    <td >Segala hak dan kewajiban atas tanah tersebut telah beralih menjadi hak dan kewajiban dari penerima hibah, termasuk  Pemohon sertipikat hak atas tanah tersebut, keatas namanya sendiri.</td>
  </tr>
</table >
<p>Demikian surat ini dibuat dengan sesungguhnya dan apabila ternyata pernyataan ini tidak benar, kami bersedia dituntut dimuka hakim secara perdata maupun pidana karena memberikan keterangan palsu.</p>
<br>
<p style="text-align:right;margin-top:-5px; padding-bottom:15px"><?php echo $_POST['kabkab'] ?></span>, <?php echo tgl_indo( date('Y-m-d')); ?></p>
<table style="font-size: 12pt;width:100%; margin-top:-75px">
<tr>
<td style="width: 70%;">
<p style="margin:0">Saksi-saksi :</p>
<br>
1. ……………………… (………………………)
<br>
<br>
2. ……………………… (………………………)
<br>
<br>
3. ……………………… (………………………)
</td>
<td style="text-align: center;">
Yang Menyatakan,
<br>
    <br>
    <p style=" margin:0; font-size:12px">materai 6000</p>
    <br>
    <br>
    (<?php echo $_POST['namasaya'] ?></span>)
</td>
</tr>
</table>

<p style="text-align:center; margin:0; margin-top:10px">Mengetahui :</p>
<p style="text-align:center; margin:0; margin-top:5px">Kepala Desa <?php echo $_POST['desaku'] ?></span> </p>
<div style="text-align: center; width: 100%; font-size: 12pt;">
<br>
<br>
<br>
<br>
<br>
<?php echo $_POST['kepala'] ?></span>
</div>
<p style="margin:0; margin-top:45px">*) Coret yang tidak perlu</p>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Legal', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("dddd",array("Attachment"=>0));
?>