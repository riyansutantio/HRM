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
        $namaFile = $_FILES["foto"]["name"];
        $ukuranFile = $_FILES["foto"]["size"];
        $error = $_FILES["foto"]["error"];
        $tmpName = $_FILES["foto"]["tmp_name"];

        // cek apakah gambar sudah diupload
        if ($error === 4){
            echo "<script>
                    alert('gambar belum diupload');
                </script>";
            return false;
        }

        // cek apakah benar ekstensi gambar yang diupload
        $ekstensiGambarValid = ["jpeg", "jpg", "png"];
        $ekstensiGambar = explode(".", $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        // cek ekstensi masuk ke dalam ekstensi valid
        if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                    alert('ekstensi yang diperbolehkan adalah: jpg, jpeg, png');
                </script>";
            return false;    
        }

        if ($ukuranFile > 500000){
            echo "<script>
                alert('gambar melebihi size');
            </script>";
            return false;
        }

        // lolos pengecekan, file dimasukkan ke dalam database
        move_uploaded_file($tmpName, "img/faces/". $namaFile);

        error_reporting(E_ALL^E_NOTICE);
        $email = $_POST['email'];
        $foto = $namaFile;

        $insert ="UPDATE pegawai SET email='$email',foto='$foto' WHERE nama='$staff'"; 
        if (isset($_POST['submit'])) { 
          mysqli_query($conn,$insert);
          echo "<script>
              document.location.href='staff_DataPegawai.php';
          </script>";
        }
        return $namaFileBaru;

?>