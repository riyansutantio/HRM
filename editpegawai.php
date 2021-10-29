<?php  
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>
            alert('Anda belum login');
            document.location.href='login.php';
            </script>";
    }else if ($_SESSION['level']=='staff') {
        echo "<script>
            alert('Anda bukan admin');
            document.location.href='homestaff.php';
            </script>";   
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php  
        require 'config.php';
        //menampilkan data pegawai
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE id=$id");
        $p = mysqli_fetch_array($result);
    ?>
	<title>Human Resource Management</title>
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
	<div class="wrapper">
        <!-- Side Bar -->
        <div class="sidebar" data-image="img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="home.php" class="simple-text">
                      Human Resource Management
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="DataPegawai.php">
                            <i class="nc-icon nc-icon nc-paper-2"></i>
                            <p>Data Pegawai</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="DataGaji.php">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Data Gaji Pegawai</p>
                        </a>
                    </li>
                        <li>
                        <a class="nav-link" href="DataPresensi.php">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Data Presensi Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item active active-pro">
                        <a class="nav-link active" href="javascript:;">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end SideBar -->
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                            </li>
                            <li class="dropdown nav-item">
                            </li>
                            <li class="nav-item">
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"></li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- isi Content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                        <p align="center" class="content-data">Data Pegawai</p>  
                        <p align="center" class="content-data">Form Edit Data</p> 
                        <form method="POST" action="?id=<?php echo $id; ?>">
                            <center>
                                <input type="hidden" name="id" disabled value="<?= $p['id'];?>">
                                <table>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="nama" value="<?= $p['nama']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="nip" value="<?= $p['nip']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="jenis_kelamin" value="<?= $p['jenis_kelamin']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="alamat" value="<?= $p['alamat']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No Hp</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="no_hp" value="<?= $p['no_hp']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Divisi</td>
                                        <td>:</td>
                                        <td>
                                            <select name='divisi'>
                                                <option value="">---Pilih Divisi---</option>
                                                <?php  
                                                    $sql = "SELECT*FROM divisi";
                                                    $retval = mysqli_query($conn,$sql);
                                                    while ($row = mysqli_fetch_array($retval)) {
                                                        echo "<option value='$row[nama_divisi]'>($row[nama_divisi])</option>";
                                                    }
                                                ?>
                                            </select><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="email" value="<?= $p['email']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?php 
                                            if ($p['foto']=='') {?>
                                                "Belum Mengisi Gambar"
                                            <?php }else{?>
                                                <img src="img/faces/<?=$p['foto'];?>" height='100' width='100'>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Foto</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="foto" value="<?= $p['foto']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <input type="submit" name="submit" value="Simpan Data">
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end content -->
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="home.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="aboutadmin.php">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="https://www.ums.ac.id/en/home/">
                                    Universitas
                                </a>
                            </li>
                            <li>
                                <a href="https://fki.ums.ac.id/">
                                    Fakultas
                                </a>
                            </li>
                            <li>
                                <a href="https://informatika.ums.ac.id/">
                                    Informatika
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="">Creative Tim</a>, made with love for tugas PWD
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<?php
        error_reporting(E_ALL^E_NOTICE);
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $divisi = $_POST['divisi'];
        $submit = $_POST['submit'];

        $query= "UPDATE pegawai SET nama='$nama', nip=$nip, jenis_kelamin='$jenis_kelamin', alamat='$alamat', no_hp='$no_hp', divisi='$divisi' WHERE pegawai.id=$id ";

        print_r($query);
        // apabila tombol submit di tekan
        if ($submit) {
            mysqli_query($conn, $query);
            echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href='DataPegawai.php';
            </script>";
        }
 ?>
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