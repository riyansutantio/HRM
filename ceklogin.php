 <?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($conn,"SELECT * FROM admin WHERE nama='$username' AND password='$password'");

//mendeteksi admin atau staff
$deteksi = mysqli_fetch_array($data);
 
// membedakan level user ketika login
$cek = mysqli_num_rows($data);
	if($cek > 0){
		if ($deteksi['level']=='admin') {
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			$_SESSION['level'] = "admin";
			echo "<script>alert('Berhasil melakukan proses login');document.location.href='home.php?$username';</script>";
		}else{
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			$_SESSION['level'] = "staff";
			echo "<script>alert('Berhasil melakukan proses login');document.location.href='homestaff.php?$username';</script>";
		}
	}else{
		echo "<script>alert('Gagal melakukan login, coba lagi');</script>";
		header("location:login.php?pesan=gagal");
	}
?>