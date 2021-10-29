 <?php
include('config.php');
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>
        alert('Anda belum login');
        document.location.href='login.php';
        </script>";
} 
$staff = $_SESSION['username'];
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
//mengambil data dari database berdasarkan session staff yang login
$query = mysqli_query($conn,"SELECT * FROM gaji WHERE nama='$staff'");
$row = mysqli_fetch_array($query);
$tanggal = date('d M Y');
//isi file yang keluar
$html = "<center><h3>Laporan Gaji Pegawai</h3><br>Human Resource Management System</center><hr/><br/>";
$html .= '<table border="" width="100%">
 <tr>
 <th> | ID</th>
 <th> Nama</th>
 <th> NIP</th>
 <th> Nominal</th>
 </tr>';
$no = 1;
 $html .= "<tr>
 <td> |".$no."</td>
 <td>".$row['nama']."</td>
 <td>".$row['nip']."</td>
 <td>".$row['nominal']."<br></td>
 </tr>
 <tr><td colspan='4'></td></tr><tr><td colspan='4'> |   </td></tr>
 <tr><td colspan='4'></td></tr><tr><td colspan='4'> |   </td></tr>
 <tr><td colspan='4'></td></tr><tr><td colspan='4'>  <hr> </td></tr>
 <tr><td colspan='4' align='center'>Surakarta,".$tanggal."</td></tr>
 <tr><td colspan='4' align='center'><img src='img/ttd.jpeg' width='100' height='auto'></td></tr>
 <tr><td colspan='4' align='center'>(Riyan Sutantio Bangkit Nugroho)</td></tr>
 <tr><td colspan='4' align='center'>General Manager</td></tr> 
 ";

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_Gaji_'.$staff.'.pdf');
?>