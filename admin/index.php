<?php
require_once "../connect.php";
if(!isset($_SESSION['username'])|| $_SESSION['username']==""){
    header("location: ../index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
     
    </style>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Halo,Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Data Resi Pengiriman</a>
            </li>
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="adminManagement.php">User Admin </a>
            </li>
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container-fluid">
        <h2>Entry Nomor Resi</h2>
            <form action="" style="width: 30%;" id="form-submit" >
                <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="mb-3">
                <label for="nomor-resi" class="form-label">Nomor Resi</label>
                <input type="text" class="form-control" id="nomor-resi" name="resi" placeholder="nomor resi" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>

        <div class="list mt-3">
            <table class="table table-striped ">
                <thead>
                    <tr class="table-dark">
                    <th scope="col">Tanggal Resi</th>
                    <th scope="col">Nomor Resi</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                url: "api/resilogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "getData"
                },
                success: function(res){
                    console.log(res);
                    $(".list tbody tr").remove();
                    res.forEach(element => {
                        $(".list tbody").append(`
                        <tr>
                            <td>${element.tanggal}</td>
                            <td class="no_res">${element.nomor}</td>
                            <td>
                                <input class="identity" type="hidden" value=${element.id}>
                                <button class="btn btn-warning btn-log"  >Entry log</button>
                                <button class="btn btn-danger btn-delete" >Delete</button>

                            </td>
                        </tr>
                        `)
                    });
                    
                },
                error: function(err){

                },      
            });
        }
        getData();

        function addData(){
            var tanggal = $("#tanggal").val();
            var resi = $("#nomor-resi").val();
            console.log(resi)
            console.log(tanggal)
            if(tanggal.length == 0 || resi.length == 0){
                alert("tidak boleh kosong");
            }
            $.ajax({
                url: "api/resilogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "insertResi",
                    tanggal: tanggal,
                    resi: resi
                },
                success: function(res){
                    console.log("input")
                    console.log(res)
                    if(res.status == "true"){
                        getData();
                        // kosongkan form
                        $("#tanggal").val("");
                        $("#nomor-resi").val("");

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Resi berhasil ditambahkan',
                            timer: 1500,
                            showConfirmButton: true,
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message,
                        })
                    }
                    
                },
                error: function(err){
                    alert("error")
                },      
            });
        }

        function deleteData(id){
            $.ajax({
                url: "api/resilogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "delete",
                    id : id
                },
                success: function(res){
                    if(res.status)
                        getData();
                    
                },
                error: function(err){

                },      
            });
        }
        // saat submit form
        $("#form-submit").submit(function(e){
            e.preventDefault();
            addData();
        })

        // delete row
        $(document).on("click", ".btn-delete", function(){
            var id = $(this).parent().find("input.identity").val();
            console.log(id);
            deleteData(id);
        });

        // entry log click
        $(document).on("click", ".btn-log", function(){
            var no_res= $(this).parent().parent().find(".no_res").text();
            $.ajax({
                url: "api/resilogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "entryLog",
                    no_res : no_res
                },
                success: function(res){
                    console.log(res);
                    if(res.status)
                        window.location.href = "log.php";
                },    
            
            })
        });

    })
</script>
</body>
</html>