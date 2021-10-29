 <?php  
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>
            alert('Anda belum login');
            document.location.href='login.php';
            </script>";
    } 
    $staff = $_SESSION['username'];
        require 'config.php';
        //query 
        $result = mysqli_query($conn,"SELECT*FROM pegawai WHERE nama='$staff'");
        $gaji = mysqli_query($conn,"SELECT*FROM gaji WHERE nama='$staff'");
        //memasukkan hasil query kedalam array
        $hasilgaji = mysqli_fetch_array($gaji);
        $hasil = mysqli_fetch_array($result);

        $nama = $hasil['nama'];
        $nip = $hasil['nip'];

        // menyesuaikan jam sesuai dengan lokasi WIB
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("Y-m-d");
        $check_in = date("H:i:s");
        $check_in = date("H:i:s", strtotime($check_in));
        $check_out = date("H:i:s");
        $check_out = date("H:i:s", strtotime($check_out));

        //ketika tombol check in ditekan
    if (isset($_POST['btn-check_in'])) {
        $absen = "INSERT INTO attandance(id, nama, nip, tanggal, check_in, check_out) VALUES (null,'$nama','$nip','$tanggal','$check_in','')";
        mysqli_query($conn,$absen);
        echo "<script>alert('Berhasil Absen Masuk');docuent.location.href ='staff_DataPegawai.php';</script>";
    }
    //ketika tombol check out ditekan
    if (isset($_POST['btn-check_out'])) {
        $absen = "UPDATE attandance SET check_out='$check_out' WHERE attandance.nama='$staff'";
        mysqli_query($conn,$absen);
        echo "<script>alert('Berhasil Absen Keluar');docuent.location.href ='staff_DataPegawai.php';</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
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
        <div class="sidebar" data-image="img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="homestaff.php" class="simple-text">
                      Human Resource Management
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="staff_DataPegawai.php">
                            <i class="nc-icon nc-icon nc-paper-2"></i>
                            <p>Data Pegawai</p>
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
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item"></li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                            </li>
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
            <!-- isi content -->
            <div class="content">
                <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-gambar">
                                    <form method="POST" enctype="multipart/form-data">
                                        <?php  
                                            if ($hasil['foto']=='') {
                                                ?>
                                                <img src="img/faces/face-0.jpg" width="150" height="150">
                                            <?php } else{?>
                                                <img src="img/faces/<?= $hasil['foto'];?>" width='150' height='150' >
                                            <?php }
                                        ?>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head"><br><br>
                                            <h5>
                                                <p><?= $nama;?></p>
                                            </h5>
                                            <h6>
                                                <p><?=$hasil['divisi'];?></p>
                                            </h6>
                                            <hr><br>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gaji</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2"><br><br><br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit Profile</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-work">
                                    <form method="post">
                                        Tanggal & Jam <br>
                                        <input type="date" name="tanggal" value="<?php echo date("Y-m-d",time()); ?>" disabled>
                                        <input type="datetime"  value="<?php echo date("H:i:s",time()); ?>" disabled><br><br>
                                        <p>Presensi Masuk</p>
                                        <button type="submit" class="btn btn-primary" name="btn-check_in" onclick="return confirm('Absensi Cukup 1x!')">Check In</button><br><br>
                                        <p>Presensi Keluar</p>
                                        <button type="submit" class="btn btn-danger" name="btn-check_out">Check Out</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6"><br>
                                                        <label>User Id</label>
                                                    </div>
                                                    <div class="col-md-6"><br>
                                                        <p><?= $hasil['nama'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?= $hasil['nama'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?= $hasil['email'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?= $hasil['no_hp'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Division</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?= $hasil['divisi'];?></p>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="row">
                                                    <div class="col-md-6"><br>
                                                        <label>NIP</label>
                                                    </div>
                                                    <div class="col-md-6"><br>
                                                        <p><?= $hasil['nip'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Gaji</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?=$hasilgaji['nominal'];?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Tanggal Hari ini</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?=date('d M Y');?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6">
                                                        <a href="report.php?id=<?=$staff?>"><input type="submit" class="btn btn-primary" name="cetakgaji" value="Cetak Gaji"></a>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
            <!-- footer start -->
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="homestaff.php">
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
<!-- Pop up modal tambah data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="uploadprofilstaff.php?id=<?=$hasil['id'];?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="<?=$hasil['nama'];?>" disabled>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">E-Mail</label>
                          <input type="text" class="form-control" name="email" placeholder="Masukkan E-mail">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Foto</label>
                          <input type="file" name="foto" id="foto">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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