<?php

    $pageName = 'Login';
    include 'layout\header.php';
    session_start();
    if(isset($_SESSION['userID'])){
        header('location: all_data.php');
        exit();
    }
    if(isset($_POST['LOGIN'])){
        $email = filter_var($_POST['email'] , FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $FormError = [];

        if(strlen($password) < 8){
            $FormError [] ='Password most be more than 8 number';
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $FormError [] ='Please Enter a valid Email';
        }
        
        if(empty($FormError)){
            $sel = "SELECT * FROM users WHERE email = '$email'";
            $num = mysqli_num_rows(mysqli_query($conn,$sel));
            if($num == 1){
                $id = mysqli_fetch_array(mysqli_query($conn,$sel) , MYSQLI_ASSOC);
                if($id['password'] != $password){
                    $FormError[] ='passowrd is not correct' ; 
                }
                else{
                    $_SESSION ['userID'] = $id['id'];
                    header('Location: profile.php');
                }
            }
            else{
                echo 'You Have To Register First Of All';
            }
        }
    }

?>
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 ">
            <?php if( !empty($FormError)):?>
                <?php foreach($FormError as $error): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endforeach;?>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>" placeholder="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($_POST['password'])){echo $_POST['password'] ;} ?>" placeholder="password" type="password" name="password" class="form-control">
                        </div>
                        <div class="mt-2">
                            <input class="btn btn-primary" name="LOGIN" value="Login" type="submit" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout\footer.php' ?>