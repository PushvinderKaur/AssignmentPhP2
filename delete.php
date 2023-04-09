<?php
include 'conn.php';
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "delete from `students` where student_id = $id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location: view.php');
    }else{
        echo "fail";
    }
}
?>
