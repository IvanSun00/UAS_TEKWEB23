<?php
require_once "connect.php";

if(isset($_POST['no_res'])){
    $no = $_POST['no_res'];
    $sql = "SELECT * FROM detail_resi where no_resi = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$no]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($data){
        foreach($data as $row){
            echo "<tr>";
            echo "<td>".$row['tanggal']."</td>";
            echo "<td>".$row['kota']."</td>";
            echo "<td>".$row['keterangan']."</td>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td colspan = '3' class='text-center text-danger'><strong>Resi tidak ditemukan</strong></td>";
        echo "</tr>";
    }
    return;

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengiriman Resi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Halo,Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="loginAdmin.php">Login Admin</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    
    <div class="container-fluid p-4">
        <h1>Cek Resi Pengiriman</h1>
        <div class="row my-4">
            <div class="mb-3 col-3">
                <input type="text" class="form-control" id="no_res" name ="no_res" placeholder="Nomor Resi">
            </div>
            <div class="col-2"><button class="btn btn-dark" id="cari">Cari</button></div>
        </div>
        <div class="row p-2">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kota</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="table-light" id= "list">
                    <tr>
                      <td colspan = "3" class="text-center text-danger"><strong>Silahkan Input no resi terlebih dahulu</strong></td>
                  </tr>
                </tbody>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function(){
        // ketika tombol cari di klik
        $("#cari").click(function(){
          var no = $("#no_res").val();
          $.ajax({
            method: "POST",
            data: {
              no_res:no, 
            },
            success: function(data){
              $("#list").html(data);
            }
          })
        })
      })
    </script>
  </body>
</html>