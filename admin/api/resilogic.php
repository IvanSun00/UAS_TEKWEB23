<?php
require_once "../../connect.php";
if(!isset($_SESSION['username'])|| $_SESSION['username']==""){
    header("location: ../../index.php");
}


if(isset($_POST['for'])){
    if($_POST['for'] == 'getData'){
        $sql = "SELECT * FROM resi";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        return;
    }

    else if($_POST['for'] == 'insertResi' && !empty($_POST['tanggal']) && !empty($_POST['resi'])){
        // check apakah resi sudah pernah terdaftar
        $sql = "SELECT * FROM resi where nomor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['resi']]);
        $data = $stmt->fetch();
        if($data){
            echo json_encode(['status'=>'false', 'message'=>'resi sudah terdaftar']);
            exit();
        }

        //logic insert Resi
        $tanggal = $_POST['tanggal'];
        $resi = $_POST['resi'];
        $sql = "INSERT INTO resi VALUES(null,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tanggal,$resi]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false', 'message'=>'gagal insert data']);
        }
    }

    else if($_POST['for'] == 'delete' && !empty($_POST['id'])){
        //logic delete resi
        $id = $_POST['id'];
        $sql = "DELETE FROM `resi` WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0){
            echo json_encode(['status'=>'true']);
        }
        else{
            echo json_encode(['status'=>'false']);
        }
    }

    else if($_POST['for'] = 'entryLog' ){
        $_SESSION['no_res'] = $_POST['no_res'];
        echo json_encode(['status'=>'true']);
        exit();
    }

}