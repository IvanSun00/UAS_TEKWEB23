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
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Halo,Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Data Resi Pengiriman</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="adminManagement.php">User Admin </a>
            </li>
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <!-- Button trigger modal -->
   
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=""  id="admin-form-update">
                <input id="identity" type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                    </div>
                </form>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-modal-save">Save changes</button>
            </div>
            </div>
        </div>
        </div>

    <div class="container-fluid">
        <form action="" style="width: 30%;" id="admin-form">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>  

        <div class="list mt-3">
            <table class="table table-striped ">
                <thead>
                    <tr class="table-dark">
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
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
                url: "api/adminLogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "getAll"
                },
                success: function(res){
                    console.log(res);
                    $(".list tbody tr").remove();
                    res.forEach(element => {
                        
                        $(".list tbody").append(`
                        <tr>
                            <td>${element.username}</td>
                            <td>${element.nama}</td>
                            <td>${element.status}</td>
                            <td>
                                <input class="identity" type="hidden" value=${element.id}>
                                <input class="status" type="hidden" value=${element.status}>
                                <button class="btn btn-warning btn-edit" >Edit</button>
                                <button class="btn ${element.status == 1? 'btn-danger' : 'btn-success'} btn-update" >${element.status == 1? 'non-aktifkan' : 'aktfikan'}</button>
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

        function addData(formData,idform){
            console.log(idform)
               // Data tambahan
            formData.append('for','insertAdmin')
            $.ajax({
                url: "api/adminLogic.php",
                method: "post",
                dataType: 'json',
                contentType: false, // ini penting kalau pakai new FormData() mbo lek ga error
                processData: false, // ini penting kalau pakai new FormData() mbo lek ga error
                data: formData,
                success: function(res){
                    console.log(res);
                    if(res.status == "true"){
                        getData();
                        // kosongkan form 
                        $(idform+" :input").val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Admin berhasil ditambahkan',
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
                    console.log(err)

                },      
            });
        }

        function updateStatus(id,status){
            $.ajax({
                url: "api/adminLogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "updateStatus",
                    id : id,
                    status: status,
                },
                success: function(res){
                    console.log("update");
                    console.log(res)
                    if(res.status)
                        getData();
                    
                },
                error: function(err){
                    alert("error")
                    console.log(err);

                },      
            });
        }
        // saat submit form
        $("#admin-form").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this)
            addData(formData,"#"+this.id);
        })

        // update status
        $(document).on("click", ".btn-update", function(){
            var id = $(this).parent().find("input.identity").val();
            var status = $(this).parent().find("input.status").val();
            console.log(id);
            updateStatus(id,status);
        });

        // edit data admin
        $(document).on("click", ".btn-edit", function(){
            var id = $(this).parent().find("input.identity").val();
            $.ajax({
                url: "api/adminLogic.php",
                method: "post",
                dataType: "json",
                data: {
                    for: "getAdmin",
                    id : id,
                },
                success: function(res){
                    console.log(res);
                    var form = $("#admin-form-update")
                    $("#myModal").modal('show');
                    form.find("#username").val(res[0].username);
                    form.find("#nama").val(res[0].nama);
                    form.find("#identity").val(res[0].id);
                },
                error: function(err){
                    alert("error")
                    console.log(err);

                },      
            });
        });

        // update data admin
        $(document).on("click", ".btn-modal-save", function(){
            var form = $("#admin-form-update")
            var formData = new FormData(form[0])
            formData.append('for','updateAdmin')
            if(form.find("#password").val().length == 0 || form.find("#nama").val().length == 0 || form.find("#identity").val().length == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data tidak boleh kosong',
                })
                return;
            }
            $.ajax({
                url: "api/adminLogic.php",
                method: "post",
                dataType: "json",
                contentType: false, // ini penting kalau pakai new FormData() mbo lek ga error
                processData: false, // ini penting kalau pakai new FormData() mbo lek ga error
                data: formData,
                success: function(res){
                    console.log(res);
                    if(res.status){
                        // kosongkan form 
                        form.find(":input").val('');
                        getData();
                        $("#myModal").modal('hide');
                    }
                    
                },
                error: function(err){
                    alert("error")
                    console.log(err);

                },      
            });
        });

    })
</script>


</body>
</html>