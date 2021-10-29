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
    require 'config.php';
    if (isset($_POST['search-btn'])) {
            $cari = $_POST['search'];
            $result = mysqli_query($conn,"SELECT*FROM attandance WHERE nama LIKE '%$cari%' OR nip LIKE '%$cari%'");
        }else{
            $result = mysqli_query($conn,"SELECT*FROM attandance ORDER BY tanggal");
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
                    <a href="home.php" class="simple-text">
                      Human Resource Management
                    </a>
                </div>
                <ul class="nav">
                    <li>
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
                    <li class="nav-item active">
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
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <nav class="navbar navbar-light bg-light">
                                  <form class="form-inline" method="post">
                                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search nama/NIP" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search-btn">Search</button>
                                  </form>
                                </nav>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Edit Data</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Tambah Data Presensi</button>
                                </div>
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
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                        <p align="center" class="content-data">Data Pegawai</p>  
                        <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nama Pegawai</th>
                              <th scope="col">NIP</th>
                              <th scope="col">Tanggal Absensi</th>
                              <th scope="col">Check In</th>
                              <th scope="col">Check Out</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php  
                            $i =1;
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tbody>
                                    <td><?= $i ?></td>
                                    <td><?= $row["nama"]; ?></td>
                                    <td><?= $row["nip"]; ?></td>
                                    <td><?= $row["tanggal"]; ?></td>
                                    <td><?= $row["check_in"]; ?></td>
                                    <td><?= $row["check_out"]; ?></td>
                                    <td>
                                        <a href="editpresensi.php?id=<?= $row['id'];?>">
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </a>
                                        <a href="hapuspresensi.php?id=<?= $row['id'];?>" onclick='return confirm("apakah anda ingin menghapus data?")'>
                                            <button type="button" class="btn btn-danger" style="margin-left: 10px;">Hapus</button>
                                        </a>
                                    </td>
                                    <?php $i++; } ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Pop up modal tambah data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama</label>
                        <select name='nama'>
                            <option value="">---Pilih Nama---</option>
                            <?php  
                                $sql = "SELECT*FROM pegawai";
                                $retval = mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_array($retval)) {
                                    echo "<option value='$row[nama]'>($row[nama])</option>";
                                }
                            ?>
                        </select><br>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NIP</label>
                            <select name='nip'>
                                <option value="">---Pilih NIP---</option>
                                <?php  
                                    $sql = "SELECT*FROM pegawai";
                                    $retval = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($retval)) {
                                        echo "<option value='$row[nip]'>($row[nip])-->$row[nama]</option>";
                                    }
                                ?>
                            </select><br>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Nominal Gaji">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Check In</label>
                            <input type="time" class="form-control" name="check_in">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Check Out</label>
                            <input type="time" class="form-control" name="check_out" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php  
        error_reporting(E_ALL^E_NOTICE);
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $tanggal = $_POST['tanggal'];
        
        $check_in = $_POST['check_in'];
        $check_in = date("H:i:s", strtotime($check_in));
        
        $check_out = $_POST['check_out'];
        $check_out = date("H:i:s", strtotime($check_out));

        $submit = $_POST['submit'];

        $insert ="INSERT INTO attandance(id, nama, nip, tanggal, check_in, check_out) VALUES (null,'$nama','$nip','$tanggal','$check_in','$check_out')"; 

        if (isset($submit)) {
            mysqli_query($conn,$insert);
            echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href='DataPresensi.php';
            </script>";
            }
        ?>
    </div>
            <!-- Footer start -->
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