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
        if (isset($_POST['search-btn'])) {
            $cari = $_POST['search'];
            $result = mysqli_query($conn,"SELECT*FROM pegawai WHERE nama LIKE '%$cari%' OR nip LIKE '%$cari%'");
        }else{
            $result = mysqli_query($conn,"SELECT*FROM pegawai");
        }
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
                                <nav class="navbar navbar-light bg-light">
                                  <form class="form-inline" method="POST">
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Tambah Data Pegawai</button>
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

            <!-- isi Content -->
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
                              <th scope="col">Jenis Kelamin</th>
                              <th scope="col">Alamat</th>
                              <th scope="col">No Hp</th>
                              <th scope="col">Divisi</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php
                            $i =1;
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row["nama"]; ?></td>
                                        <td><?= $row["nip"]; ?></td>
                                        <td><?= $row["jenis_kelamin"]; ?></td>
                                        <td><?= $row["alamat"]; ?></td>
                                        <td><?= $row["no_hp"]; ?></td>
                                        <td><?= $row["divisi"]; ?></td>
                                        <td>
                                            <a href="editpegawai.php?id=<?= $row['id'];?>">
                                                <button type="button" class="btn btn-warning">Edit</button>
                                            </a>
                                            <a href="hapuspegawai.php?id=<?= $row['id'];?>" onclick='return confirm("apakah anda ingin menghapus data?")'>
                                                <button type="button" class="btn btn-danger" style="margin-left: 10px;">Hapus</button>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                        <?php $i++; } ?>
                        </table>
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
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" placeholder="Masukkan Jenis Kelamin">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nomor Hp</label>
                            <input type="text" class="form-control" name="no_hp" placeholder="Masukkan Nomor Hp">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Divisi</label>
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
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $divisi = $_POST['divisi'];
            $submit = $_POST['submit'];

            $insert ="INSERT INTO pegawai(id, nama, nip, jenis_kelamin, alamat, no_hp, divisi,email,foto) VALUES ('','$nama','$nip','$jenis_kelamin','$alamat','$no_hp','$divisi','','')"; 

            if (isset($submit)) {
                mysqli_query($conn,$insert);
                echo "<script>
                    alert('Data berhasil ditambahkan');
                    document.location.href='DataPegawai.php';
                </script>";
            }
        ?>
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