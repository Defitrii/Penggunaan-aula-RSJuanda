<?php
include "db_conn.php";
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
      .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 50px;
        background-color: #033B22;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
      }

      .marquee-text {
        white-space: nowrap;
        overflow: hidden;
        width: 100%;
        background-color: #033B22;
        color: white;
        font-size: 20px;
        font-weight: bold;
        animation: marquee 50s linear infinite;
      }

      @keyframes marquee {
        0% {
          transform: translateX(100%);
        }

        100% {
          transform: translateX(-100%);
        }
      }
    </style>
    <title>Penggunanan Ruangan</title>


  </head>

  <body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #033B22; color: white;">
      JADWAL PENGGUNAAN RUANG RAPAT
    </nav>

    <div class="container">
      <?php
      if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      }
      ?>
      <a href="add-new.php" class="btn btn-success mb-3">+ Tambah Baru</a>

      <table class="table table-hover text-center" id="datatable">
        <thead class="table">
          <tr>
            <th scope="col">Kode</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Hari</th>
            <th scope="col">Waktu</th>
            <th scope="col">Kegiatan</th>
            <th scope="col">PIC</th>
            <th scope="col">Ruang</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tfoot>
      <tr>
    <td colspan="8">*Untuk konfirmasi jadwal silakan menghubungi bagian kesekretariatan (0838-2331-0614)</td>
  </tr>
  </tfoot> -->
          <?php
          $sql = "SELECT * FROM `crud`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["kd_booking"] ?></td>
              <td><?php echo $row["tanggal"] ?></td>
              <td><?php echo $row["hari"] ?></td>
              <td><?php echo $row["jam"] ?></td>
              <td><?php echo $row["kegiatan"] ?></td>
              <td><?php echo $row["pic"] ?></td>
              <td><?php echo $row["ruang"] ?></td>
              <td>
                <a href="edit.php?kd_booking=<?php echo $row["kd_booking"] ?>" class="link-primary"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete.php?kd_booking=<?php echo $row["kd_booking"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <body>
      <div class="container">
        <a href="logout.php" class="btn btn-outline-danger mt-4">Logout</a>
      </div>
    </body>
    <div class="footer">
      <div class="marquee-text" scrollamount="5">
        Untuk konfirmasi jadwal silakan menghubungi bagian kesekretariatan (0838-2331-0614)
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('#datatable').DataTable();
      });
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  </body>

  </html>

<?php
} else {
  header("Location: index.php");
  exit();
}
?>