<?php 

session_start();
$conn = mysqli_connect('localhost','root','','codeigniter4');

if(isset($_SESSION['userID'])){
    if(isset($_GET['id'])){
        $id = $_GET['id'] ; 
        $del = "DELETE FROM  users WHERE id='$id'";
        if(mysqli_query($conn,$del)){
            header('location:all_data.php?sussess');
        }
    }
}
else{
    header('location:login.php');
    exit();
}




?>