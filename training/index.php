<?php

    $pageName = 'Register';
    include 'layout\header.php';
    
    session_start();
    if(isset($_SESSION['userID'])){
        header('location: all_data.php');
        exit();
    }
    if(isset($_POST['SEND'])){
        $FirstName = filter_var($_POST['first_name'] , FILTER_SANITIZE_STRING);
        $Lastname = filter_var($_POST['last_name'] , FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'] , FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $FormError = [];
        $success ;

        if(strlen($FirstName) < 4){
            $FormError [] ='first name most be more than 4 number';
        }
        if(strlen($Lastname) < 5){
            $FormError [] ='last name most be more than 5 number';
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $FormError [] ='Please Enter a valid Email';
        }
        if(strlen($password) < 8){
            $FormError [] ='Password most be more than 8 number';
        }
        if(empty($FormError)){
            $ins = "INSERT INTO users(first_name,last_name,`password`,email) VALUES('$FirstName','$Lastname',' $password','$email')";
            $result = mysqli_query($conn,$ins);
            if($result){
                $success = 'register is done';
                header( "refresh:5;url=login.php" );
            }
        }
    }

?>
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 ">
            <?php if(! empty($FormError)):?>
                <?php foreach($FormError as $error): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endforeach ; ?>
            <?php endif ;?>
            <?php if(! empty($success)):?>
                <div class="alert alert-success ">
                    <?= $success ?>
                </div>
            <?php endif ;?>
            <div class="card">
                <div class="card-header">
                    <h3>Regiter</h3>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'] ;} ?>" placeholder="First Name" type="text" name="first_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'] ;} ?>" placeholder="Last Name" type="text" name="last_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>" placeholder="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['password'])){echo $_POST['password'] ;} ?>" placeholder="password" type="password" name="password" class="form-control">
                        </div>
                        <div class="mt-2">
                            <input class="btn btn-primary" name="SEND" value="SEND" type="submit" name="submit" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout\footer.php' ?>