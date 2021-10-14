<?php
require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;

use App\SQLiteQuerySelect as SQLiteQuerySelect;
$pdo = (new SQLiteConnection())->connect();
$pdo1 = (new SQLiteConnection())->connect1();


$sqlite = new SQLiteQuerySelect($pdo1);


$data = $sqlite->getUser();
foreach($data as $dt){
      
    $celeng=$dt['desa'];
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>


		<?php
            $page = $_GET["page"];
            switch ($page) {
			case "login":	?>
<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">			
<link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
	<div class="main">
	<div class="container">
		<center>
				<div class="middle">
					<div id="login">
<form class="form-signin" method="post" action="trigger.php?s=log">

							<fieldset class="clearfix">

								<p ><span class="fa fa-user"></span><input type="text" name="username_user"  Placeholder="Username" required autofocus></p> <!-- JS because of IE support; better: placeholder="Username" -->
								<p><span class="fa fa-lock"></span><input type="password" name="password_user" Placeholder="Password" required ></p> <!-- JS because of IE support; better: placeholder="Password" -->
            
								<div>
									<span style="width:50%; text-align:right;  display: inline-block; float:right">
										<input type="submit" value="Masuk">
									</span>
								</div>

							</fieldset>
							<div class="clearfix"></div>
						</form>

						<div class="clearfix"></div>

					</div> <!-- end login -->
					<div class="logo">
						<span style="border-bottom: 3px solid white; padding-bottom: 30px">
							<img src="assets/simpleC-01.svg" style="max-width:250px ; max-height:200px; padding-bottom:15px">
						</span>
						<strong style="line-height: 70px; text-align:center; font-size: 36px;margin-left:10px"><?php echo $celeng?></strong>
						<div class="clearfix"></div>
						
					</div>
				</div>
			

		<?php	break;
		
		case "regist":
		?>
	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">			
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/regist.css">
</head>
<body>
	<div class="main">
	<div class="container">
		<center>
    		<div style="padding-bottom: 50px">
				<img src="assets/simpleC-01.svg" style="max-width:250px ; max-height:200px">
			</div>
				<div class="middle">
					<div id="login">
  <form class="form-signin" method="post" action="trigger.php?s=reg">
  <fieldset class="clearfix">
						<div class="col-md-6" style="margin-top: 20px">
							
								
								<p style="margin-top: 20px"><span class="fa fa-map-marker"></span><input type="text" name="desa" Placeholder="Nama Desa" required autofocus></p> 
								<p style="margin-top: 20px"><span class="fa fa-map-marker"></span><input type="text" name="kabupaten" Placeholder="Kabupaten" required autofocus></p> 
								<p style="margin-top: 20px"><span class="fa fa-user"></span><input type="text" name="kepala" Placeholder="Nama Kepala Desa" ></p> 
							</div>
							<div class="col-md-6" style="border-left: 3px solid white">
								<p style="margin-top: 20px; margin-left: 20px"><span class="fa fa-user"></span><input type="text" name="username_user" Placeholder="Username" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
								<p style="margin-top: 20px; margin-left: 20px"><span class="fa fa-lock"></span><input type="password" name="password_user" Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
								<p style="margin-left: 20px"><span class="fa fa-lock"></span><input type="password" name="password_user2" Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            
									

							
						</div>
						<span style="width:100%; text-align:center;  display: inline-block; margin-top: 30px">
							<input type="submit" value="Registrasi">
						</span>
							</fieldset>
						</form>
					</div> <!-- end login -->
					
				</div>
			
		
		<?php	break;
		
		case "aktif":
			$isi1 = $_GET["isi"];
		
		?>		
					<link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/regist.css">
</head>
<body>

	<div class="main">
	<div class="container">
		<center>
    		<div style="padding-bottom: 50px">
				<img src="../../assets/simpleC-01.svg" style="max-width:250px ; max-height:200px">
			</div>
				<div class="middle">
					<div id="login">
  <form class="form-signin" method="post" action="trigger.php?s=akt">
  <fieldset class="clearfix">
							
							
								<h4 style="color: white"> Kode Verifikasi</h4>
								<input type="text"  value='<?php echo $isi1 ;?>' disabled style="width: 230px; text-align:center; border-radius: 3px">
								<h4 style="color: white"> Kode Aktivasi</h4>
								<input type="text" name="serayu" Placeholder="Kode Aktivasi" required style="width: 230px; text-align:center; border-radius: 3px">
							
							
							</fieldset>
							<div class="clearfix"></div>
							<div style="margin-top: 20px">
									
									<button type="submit" value="Registrasi" class="btn btn-danger" style="width: 230px; font-weight: bold">Aktifkan</button>
									
							</div>
						</form>
					</div> <!-- end login -->
					
				</div>
			

		<?php	break;}?>
		</center>
		</div>
		<div id="footer">
			<p>Informasi Pemesanan dan Bantuan Penggunaan Aplikasi<br> Hubungi : 0856	4179	0359 (DAT Official)</P>
		</div>
	
	</div>
</body>

</html>

