<?php
include "db_conn.php";

if (isset($_POST['submit'])) {
   $tanggal = $_POST['tanggal'];
   $hari = $_POST['hari'];
   $waktu = $_POST['waktu'];
   $kegiatan = $_POST['kegiatan'];
   $pic = $_POST['pic'];
   $ruang = $_POST['ruang'];

   if ($ruang == 'Auditorium') {
      $jenis_kode = 'A';
   } elseif ($ruang == 'Komite') {
      $jenis_kode = 'K';
   } else {
      $jenis_kode = 'Invalid';
   }

   $nomor_terakhir = getLastNumber($conn, $jenis_kode);

   // Buat kode otomatis
   $kode_otomatis = $jenis_kode . sprintf("%03d", $nomor_terakhir + 1);

   $sql = "INSERT INTO `crud`(`kd_booking`, `tanggal`, `hari`, `jam`, `kegiatan`, `pic`, `ruang`) VALUES ('$kode_otomatis','$tanggal','$hari','$waktu','$kegiatan','$pic','$ruang')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: dashboard.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

function getLastNumber($conn, $jenis_kode)
{
   $query = "SELECT MAX(CAST(SUBSTRING(kd_booking, 2) AS SIGNED)) as max_number FROM crud WHERE kd_booking LIKE '$jenis_kode%'";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $max_number = $row['max_number'];
   $nomor_terakhir = ($max_number !== null) ? intval($max_number) : 0;
   return $nomor_terakhir;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
   <title>Tambah data baru ruangan</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #033B22; color: white;">
      JADWAL PENGGUNAAN RUANG RAPAT
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Tambah data baru</h3>
      </div>
      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:1000px; min-width:500px;">
            <div class="row">
               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Tanggal:</label>
                     <input id="datepicker" name="tanggal" />
                     <script>
                        $('#datepicker').datepicker({
                           uiLibrary: 'bootstrap5'
                        });
                     </script>
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Hari</label>
                     <select class="form-select" name="hari">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                     </select>
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Waktu</label>
                     <input type="time" class="form-control" name="waktu" />
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Kegiatan</label>
                     <textarea name="kegiatan" id="kegiatan" rows="1" class="form-control" required></textarea>
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">PIC</label>
                     <input name="pic" id="pic" type="text" class="form-control" required>
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Ruangan</label>
                     <select class="form-select" name="ruang">
                        <option value="Auditorium">Auditorium</option>
                        <option value="Komite">Komite</option>
                     </select>
                  </div>
               </div><!--end col-->

               <div>
                  <button type="submit" class="btn btn-success" name="submit">Save</button>
                  <a href="dashboard.php" class="btn btn-danger">Cancel</a>
         </form>
      </div>
   </div><!--end col-->

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>