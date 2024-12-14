<?php
require_once "../../connect.php";
if(!isset($_SESSION['username'])|| $_SESSION['username']==""){
    header("location: ../../index.php");
}


if(isset($_POST['for'])){
    if($_POST['for'] == 'getAll'){
        $sql = "SELECT * FROM admin";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        return;
    }

    if($_POST['for'] == 'getAdmin' && !empty($_POST['id']) ){
        $id = $_POST['id'];
        $sql = "SELECT * FROM admin where id= ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        return;
    }

    else if($_POST['for'] == 'insertAdmin' && !empty($_POST['username']) && !empty($_POST['nama'])&& !empty($_POST['password'])){
        //logic insert admin
        // tidak boleh user double
        $sql = "SELECT * FROM admin where username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['username']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'false', 'message'=>'Username sudah ada']);
            return;
        }

        // masukkan data
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin VALUES(null,?,?,?,1)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,$nama,$password]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false', 'message'=>'Gagal menambahkan data']);
        }
        return;
    }

    else if($_POST['for'] == 'updateAdmin' && !empty($_POST['nama'])&& !empty($_POST['password']) && !empty($_POST['id']) ){
        //logic insert Resi
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET nama=?,password = ?  WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama,$password,$id]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false']);
        }
        return;
    }

    
    else if($_POST['for'] == 'updateStatus' && !empty($_POST['id']) && isset($_POST['status'])){
        //logic delete resi

        $id = $_POST['id'];
        $status = $_POST['status'];
        $kestatus;
        if($status == 0){
            $kestatus = 1;
        }else if($status == 1){
            $kestatus = 0;
        }else{
            echo json_encode(['status'=>'false']);
            return;
        }

        $sql = "UPDATE admin set status=? where id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$kestatus,$id]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false']);
        }
        return;
    }

    

    


}