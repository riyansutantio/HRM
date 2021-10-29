 <!DOCTYPE html>
<html>
<head>
	<?php  
		include 'config.php';

		if (isset($_POST['submit'])) {
			error_reporting(E_ALL^E_NOTICE);
            $username = $_POST['username'];
            $password = $_POST['password'];

            $cek = mysqli_query($conn,'SELECT * FROM pegawai');
            //ketika nama user sama dengan nama di database pegawai, maka user dapat membuat akun. jika tidak maka tidak bisa membuat akun.
            while ($result = mysqli_fetch_array($cek)) {
	            if ($result['nama'] == $username) {	
            		$insert ="INSERT INTO admin(id, nama, password,level) VALUES ('','$username','$password','staff')"; 
	                mysqli_query($conn,$insert);
	                echo "<script>
						alert('Berhasil Menambahkan Akun');
						document.location.href='login.php';
					</script>";
				}else{
					echo "<script>alert('Gagal Menambahkan Akun');document.location.href='buatakun.php';</script>";
				}
			}
		}
	?>
	<title>Form Buat Akun</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> -->
	<!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="css/demo.css" rel="stylesheet" />
</head>
<body>
	<div class="bg-login">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  	<a class="navbar-brand" href="https://en.wikipedia.org/wiki/Human_resource_management_system">HRMS</a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarText">
		    	<ul class="navbar-nav mr-auto">
		    		<a class="nav-link" href="login.php">Login<span class="sr-only"></span></a>
		    	</ul>
		    <span class="navbar-text">
		    	Project Pemrograman Web Dinamis
		    </span>
		  </div>
		</nav>
		<div class="bg-form">
			<p class="login-page">Form Buat Akun</p>
			<form method="post" action="buatakun.php">
				<table class="table-login" align="Center">
					<input type="hidden" name="level" >
					<tr >
						<td>Username</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="username" size="35" placeholder="Masukkan username">
						</td>
					</tr>
					<tr>
						<td>Password</td>
					</tr>
					<tr>
						<td>
							<input type="Password" name="password" size="35" placeholder="Masukkan password">
						</td>
					</tr>
					<tr>
						<td>
							<input class="btn-login" type="submit" name="submit" value="Buat Akun" size="20">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
<!--   Core JS Files   -->
<script src="js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="js/core/popper.min.js" type="text/javascript"></script>
<script src="js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!--  Chartist Plugin  -->
<script src="js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="js/demo.js"></script>
</html>