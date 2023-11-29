<?php
include "db_conn.php";
$kd_booking = $_GET["kd_booking"];

if (isset($_POST["submit"])) {
   $tanggal = $_POST['tanggal'];
   $hari = $_POST['hari'];
   $jam = $_POST['waktu'];
   $kegiatan = $_POST['kegiatan'];
   $pic = $_POST['pic'];

   $sql = "UPDATE `crud` SET `tanggal`='$tanggal',`hari`='$hari',`jam`='$jam',`kegiatan`='$kegiatan',`pic`='$pic'WHERE kd_booking = '$kd_booking'";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: dashboard.php?msg=Record updated successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
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
   <title>Edit data baru ruangan</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #033B22; color: white;">
      JADWAL PENGGUNAAN RUANG RAPAT
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Edit data baru ruangan</h3>
      </div>

      <?php
      $sql = "SELECT * FROM `crud` WHERE kd_booking = '$kd_booking'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:1000px; min-width:500px;">
            <div class="row">
               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Tanggal:</label>
                     <input id="datepicker" name="tanggal" value="<?php echo $row['tanggal'] ?>" />
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
                        <option value="Senin" <?php echo ($row['hari'] == "Senin") ? 'selected' : ''; ?>>Senin</option>
                        <option value="Selasa" <?php echo ($row['hari'] == "Selasa") ? 'selected' : ''; ?>>Selasa</option>
                        <option value="Rabu" <?php echo ($row['hari'] == "Rabu") ? 'selected' : ''; ?>>Rabu</option>
                        <option value="Kamis" <?php echo ($row['hari'] == "Kamis") ? 'selected' : ''; ?>>Kamis</option>
                        <option value="Jumat" <?php echo ($row['hari'] == "Jumat") ? 'selected' : ''; ?>>Jumat</option>
                        <option value="Sabtu" <?php echo ($row['hari'] == "Sabtu") ? 'selected' : ''; ?>>Sabtu</option>
                        <option value="Minggu" <?php echo ($row['hari'] == "Minggu") ? 'selected' : ''; ?>>Minggu</option>
                     </select>
                  </div>
               </div><!--end col-->

               <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Waktu</label>
                     <input type="time" class="form-control" name="waktu" value="<?php echo $row['jam'] ?>" />
                  </div>
               </div><!--end col-->

               <div class="col-md-6">
                  <div class="mb-3">
                     <label class="form-label">Kegiatan</label>
                     <textarea name="kegiatan" id="kegiatan" rows="1" class="form-control" required><?php echo $row['kegiatan'] ?></textarea>
                  </div>
               </div><!--end col-->

               <div class="col-md-6">
                  <div class="mb-3">
                     <label class="form-label">PIC</label>
                     <input name="pic" id="pic" type="text" class="form-control" required value="<?php echo $row['pic'] ?>">
                  </div>
               </div><!--end col-->

               <!-- <div class="col-md-4">
                  <div class="mb-3">
                     <label class="form-label">Ruangan</label>
                     <select class="form-select" name="ruang">
                        <option value="Auditorium" <?php echo ($row['ruang'] == 'Auditorium') ? 'selected' : ''; ?>>Auditorium</option>
                        <option value="Komite" <?php echo ($row['ruang'] == 'Komite') ? 'selected' : ''; ?>>Komite</option>
                     </select>
                  </div>
               </div> -->

               <div>
                  <button type="submit" class="btn btn-success" name="submit">Save</button>
                  <a href="dashboard.php" class="btn btn-danger">Cancel</a>
               </div>
            </div><!--end row-->
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>