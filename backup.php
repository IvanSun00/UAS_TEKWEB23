<?php
require_once "connect.php";
if(isset($_SESSION['username']) && $_SESSION['username']!=""){
    header("location: admin/index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengiriman Resi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .rows{
            display: flex;
            justify-content: center;
            margin-top: 120pt;
        }

        .box{
            -webkit-box-shadow: 1px 0px 14px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
            min-width: 300px;
            width: 30vw;
            
            
        }
    </style>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $sql = "Select * from admin where username = ? and status = 1";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$username]);
    $data = $stmt->fetch();
    if($data){
        if(password_verify($_POST['password'],$data['password'])){
            $_SESSION['username'] = $username;
            header("location: admin/index.php");
            exit();
        }
    }

    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username atau Password salah!',
            })
        </script>
    ";
}   
?>


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
            <a class="nav-link active" aria-current="page" href="loginAdmin.php">Login Admin</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <!-- login form -->
    <div class="container-fluid">
        <div class="rows" style="width:100%">
            <div class="box px-5 py-4 row-cols-10">
                <div class="bg-dark py-1 px-3" id="header">
                    <h1 class="text-white text-center ">WELCOME</h1>
                </div>
                <form method="post" action="" class="mt-3">
                    <div class="mb-3">
                        <input type="text" class="form-control text-center" id="username" name="username" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control text-center " id="password" name="password" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Sign In</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>