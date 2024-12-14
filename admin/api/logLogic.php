<?php
require_once "../../connect.php";
if(!isset($_SESSION['username'])|| $_SESSION['username']==""){
    header("location: ../../index.php");
}

if(!isset($_SESSION['no_res']) ||  $_SESSION['no_res'] == ""){
    header("location: ../index.php");
}


if(isset($_POST['for'])){
    if($_POST['for'] == 'getData'){
        
        $no = $_SESSION['no_res'];
        $sql = "SELECT * FROM detail_resi where no_resi = ? ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$no]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        return;
    }

    // insert data
    if($_POST['for']== 'insertData'){
        $no_resi = $_SESSION['no_res'];
        $tanggal = $_POST['tanggal'];
        $kota = $_POST['kota'];
        $keterangan = $_POST['keterangan'];
        $sql = "INSERT INTO detail_resi VALUES(null,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$no_resi,$tanggal,$kota,$keterangan]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false']);
        }   
    }

    // delete data
    if($_POST['for']== 'delete'){
        $id = $_POST['id'];
        $sql = "DELETE FROM `detail_resi` WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false']);
        }
    }
}