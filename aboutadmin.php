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
    <script src="https://kit.fontawesome.com/088ea2095a.js" crossorigin="anonymous"></script>
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
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item"></li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"></li>
                            <li class="nav-item dropdown"></li>
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
                <div class="container-fluid">
                    <div class="section">
                        <div class="bg-light py-5">
                          <div class="container py-6">
                            <div class="row mb-4">
                              <div class="col-lg-10">
                                <h2 class="display-4 font-weight-light ml-5" align="center">Our team</h2>
                                <p class="font-italic text-muted ml-5" align="center">Kelompok 4</p>
                              </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                          <div class="col-xl-4 col-sm-6 mb-5 ml-0">
                            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/anggota-1.jpeg" alt="" width="200" height="300" class="img-thumbnail mb-3 ml-0 img-thumbnail shadow-sm">
                              <h5 class="mb-0 ml-0">Khumaila </h5>
                              <span class="small text-uppercase text-muted ml-0">Anggota 1</span>
                              <span class="small text-uppercase text-muted ml-0">L200180198</span>
                              <ul class="social mb-0 list-inline mt-3 ml-0">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/my_khumaila?s=08" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://instagram.com/khumaila_my" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-xl-4 col-sm-6 mb-5 ml-0">
                            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/anggota-2.jpg" alt="" width="200" height="300" class="img-thumbnail mb-3 ml-0 img-thumbnail shadow-sm">
                              <h5 class="mb-0 ml-0">Riyan Sutantio B.N. </h5>
                              <span class="small text-uppercase text-muted ml-0">Anggota 2</span>
                              <span class="small text-uppercase text-muted ml-0">L200180180</span>
                              <ul class="social mb-0 list-inline mt-3 ml-0">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/riyanns001" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/riyansutantii" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-xl-4 col-sm-6 mb-5 ml-0">
                            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/anggota-3.jpeg" alt="" width="200" height="300" class="img-thumbnail mb-3 ml-0 img-thumbnail shadow-sm">
                              <h5 class="mb-0 ml-0">Ridho Malandi </h5>
                              <span class="small text-uppercase text-muted ml-0">Anggota 3</span>
                              <span class="small text-uppercase text-muted ml-0">L200180199</span>
                              <ul class="social mb-0 list-inline mt-3 ml-0">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/rdhmalandi" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- footer start -->
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