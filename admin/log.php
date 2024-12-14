<?php
require_once "../connect.php";
if(!isset($_SESSION['username'])|| $_SESSION['username']==""){
    header("location: ../index.php");
}

if(!isset($_SESSION['no_res']) ||  $_SESSION['no_res'] == ""){
    header("location: index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <a href="index.php" class="btn btn-primary  mt-2">Back</a>

        <h2>Entry Log</h2>
            <form action="" style="width: 30%;" id="form-submit" >
                <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" placeholder="nomor resi" required>
                </div>
                <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5" placeholder="keterangan"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-dark w-50">Submit</button>
                </div>
               
            </form>

        <div class="list mt-3">
            <table class="table table-striped ">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody id="list">
                    
                    
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
                url: "api/logLogic.php",
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
                            <td>${element.kota}</td>
                            <td>${element.keterangan}</td>
                            <td>
                                <input class="identity" type="hidden" value=${element.id}>
                                <button class="btn btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                        `)
                    });
                    
                },
                error: function(err){
                    console.log(err);
                },      
            });
        }
        getData();

        function addData(){
            var tanggal = $("#tanggal").val();
            var kota = $("#kota").val();
            var keterangan = $("#keterangan").val();
            $.ajax({
                url: "api/logLogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "insertData",
                    tanggal: tanggal,
                    kota: kota,
                    keterangan: keterangan
                },
                success: function(res){
                    if(res.status){
                        getData();
                        // kosongkan form
                        $("#tanggal").val("");
                        $("#kota").val("");
                        $("#keterangan").val("");
                    }
                },
                error: function(err){

                },      
            });
        }

        function deleteData(id){
            $.ajax({
                url: "api/logLogic.php",
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


        
    })
    </script>
