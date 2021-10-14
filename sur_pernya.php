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
<div styel="position: absolute; width:100%">
<p style="text-align: center; font-weight:bold; margin-top:10px; text-decoration:underline; font-size: 14pt">SURAT PERNYATAAN</p>
<p>Yang bertanda tangan / cap jempol di bawah ini, saya :</p>
<table style="font-size: 12pt; text-align: justify; line-height: 20px; width:100%">
  <tr>
    <td style="width: 25%">Nama</td>
    <td style="width:10px">:</td>    
    <td ><?php if(!isset($_POST['namapet'])){ echo $_POST['namasaya'] ;}else {echo $_POST['namapet'] ;} ?></td>    
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
<p>Dengan ini menyatakan :</p>
<table style="font-size: 12pt; text-align: justify; line-height: 20px">
  <tr>
    <td width=20 valign="top" >1. </td>
    
    <td >bahwa saya benar-benar memiliki sebidang tanah pertanian/non pertanian *) dengan alas hak berupa C. Nomor <span style="font-weight:bold"> <?php echo $_POST['nomorsaya'] ?> </span> Persil <span style="font-weight:bold"><?php echo $_POST['nomeriki'] ?></span> Kelas <span style="font-weight:bold"><?php echo $_POST['kelasiki'] ?></span> <span style='text-decoration:line-through'>/ Tanah Negara * ) </span> seluas <span style="font-weight:bold"><?php echo $_POST['luasiki'] ?></span> M² yang terletak di <span style="font-weight:bold"> <?php if($_POST['lokasiiki'] != ''){echo $_POST['lokasiiki'];}else{echo "………………………………………………………………………";} ?></span></td>
  </tr>
  <tr>
    <td></td>
  </tr>
   <tr>
    <td></td>
  </tr>
  <tr>
    <td width=20 valign="top" >2. </td>
    
    <td >bahwa alas hak yang saya lampirkan diatas adalah benar-benar untuk tanah yang saya ajukan permohonan sertipikatnya.</td>
  </tr>
   <tr>
    <td></td>
  </tr>
   <tr>
    <td></td>
  </tr>
  <tr>
    <td width=20 valign="top" >3. </td>
    <td >bahwa tanah tersebut seluruhnya benar-benar saya peroleh/berasal dari satu orang kepemilikan yaitu dari <span style="font-weight:bold"> <?php if($_POST['darikan'] != ''){echo $_POST['darikan'];}else{echo "………………………";} ?></span>  melalui/berdasarkan <span style="font-weight:bold"> <?php if($_POST['sebabkan'] != ''){echo $_POST['sebabkan'];}else{echo "………………………";} ?> </span> pada <span style="font-weight:bold"><?php if($_POST['tglkan'] != ''){echo asalindo($_POST['tglkan']);}else{echo "………………………";} ?></span>.</td>
  </tr>
   <tr>
    <td></td>
  </tr>
   <tr>
    <td></td>
  </tr>
  <tr>
    <td width=20 valign="top" >4. </td>
    <td >bahwa apabila setelah diadakan pengukuran dan penghitungan luas oleh Kantor Pertanahan terdapat kekurangan luas/kelebihan luas*) maka saya menerima dan menyetujui hasil pengukuran dan penghitungan luas tersebut dan tidak akan menuntut kekurangan luas tanah,  apabila ternyata di kemudian hari ada pihak-pihak yang mengakui dan keberatan atas luas hasil pengukuran terhadap tanah saya tersebut dengan menunjukkan bukti-bukti yang kuat, maka saya bersedia untuk mengembalikan luas tanah sesuai dengan luas tanah yang tercantum dalam alas hak.</td>
  </tr>
   <tr>
    <td></td>
  </tr>
   <tr>
    <td></td>
  </tr>
   <tr>
    <td width=20 valign="top" >5. </td>
    <td >bahwa apabila terdapat kekurangan luas/kelebihan luas*) hasil ukur merupakan tanggung jawab saya sepenuhnya tanpa melibatkan pihak lain khususnya petugas dari Kantor Pertanahan Kabupaten <?php echo $_POST['kabkab'] ?></td>
  </tr>
</table >
<p style="text-align:justify; line-height:20px">Demikian Surat Pernyataan ini saya buat dengan sebenar-benarnya dan saya bersedia dituntut baik pidana maupun perdata sesuai dengan peraturan perundangan yang berlaku apabila saya memalsukan isi surat pernyataan ini.</p>
<p style="text-align:right;margin-bottom:0"><?php echo $_POST['kabkab'] ?>, <?php echo tgl_indo( date('Y-m-d')); ?></p>
<table style="font-size: 12pt;width:100%">
<tr>
<td style="text-align: center; width: 70%;"></td>
<td style="text-align: center;">
Yang Menyatakan,
<br>
    <br>
    <p style=" margin:0; font-size:12px">materai 6000</p>
    <br>
    <br>
    <?php echo $_POST['namasaya'] ?>
</td>
</tr>
</table>
<br>
<br>
<p style="text-align:left;  margin:0">Menyetujui pemilik tanah berbatasan :</p>
<div style="display: block;">
<table style="font-size: 12pt">
  <tr>
    <td width=20>1. </td>
    <td >Utara</td>
    <td style="width:10px">:</td>    
    <td><?php if($_POST['utara'] != ''){echo $_POST['utara'];}else{echo "………………………";} ?> </td>    
    <td>(……………………… )</td>    
  </tr>
  <tr>
    <td >2. </td>
    <td style="padding-right: 30px">Timur</td>
    <td>:</td>
    <td><?php if($_POST['timur'] != ''){echo $_POST['timur'];}else{echo "………………………";} ?> </td>
    <td>(……………………… ) </td>
  </tr>
  <tr>
    <td>3. </td>
    <td >Selatan</td>
    <td>:</td>
    <td><?php if($_POST['selatan'] != ''){echo $_POST['selatan'];}else{echo "………………………";} ?> </td>
    <td>(……………………… )</td>
  </tr>
  <tr>
    <td >4. </td>
    <td>Barat</td>
    <td>:</td>
    <td><?php if($_POST['barat'] != ''){echo $_POST['barat'];}else{echo "………………………";} ?> </td>
    <td>(……………………… )</td>
  </tr>
</table >
</div>
<br>

<p style="text-align:center; margin:0;">Mengetahui dan Membenarkan:</p>
<p style="text-align:center; margin:0;">Kepala Desa <?php echo $_POST['desaku'] ?></p>
<div style="text-align: center; width: 100%; font-size: 12pt;">
<br>
<br>
<br>

<?php echo $_POST['kepala'] ?>
</div>
<p style="margin:0; margin-top:45px">*) Coret yang tidak perlu</p>
</div>
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
$dompdf->stream("Surat_pernyataan",array("Attachment"=>0));
?>