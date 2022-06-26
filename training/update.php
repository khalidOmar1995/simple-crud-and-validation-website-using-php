<?php 

session_start();

if(!isset($_SESSION['userID'])){
    header('location:login.php');
    exit();
}



if(isset($_POST['update'])){
    $id         = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $formError  = [];
    
    
    if(empty($first_name)){
        $formError[] ='Pleace Fill Name Felid'; 
    }
    elseif(strlen($first_name) < 5){
        $formError[] ='First Name Must Be More Than 5 Char'; 
    }
    if(empty($first_name)){
        $formError[] ='Pleace Fill Name Felid'; 
    }
    elseif(strlen($last_name) < 4){
        $formError[] ='Last Name Must Be More Than 5 Char'; 
    }
    if(empty($email)){
        $formError[] ='Pleace Fill Email Felid'; 
    }
    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $formError[] ='Pleace Enter a Valid Email'; 
    }        

    header('location:edit.php');
    
}


?>