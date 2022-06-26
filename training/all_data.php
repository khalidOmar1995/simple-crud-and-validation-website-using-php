<?php

    $pageName = 'All data';
    session_start();
    include 'layout\header.php';
    if(isset($_SESSION ['userID'])){
        $sel = "SELECT * FROM users";
        $result = mysqli_fetch_all(mysqli_query($conn,$sel) , MYSQLI_ASSOC);
        if(isset($_POST['Add'])){
            echo $_POST['Add'] ;
            // $FirstName = filter_var($_POST['first_name'] , FILTER_SANITIZE_STRING);
            // $Lastname = filter_var($_POST['last_name'] , FILTER_SANITIZE_STRING);
            // $email = filter_var($_POST['email'] , FILTER_SANITIZE_STRING);
            // $password = $_POST['password'];
            // $FormError = [];
            // $success ;
    
            // if(strlen($FirstName) < 5){
            //     $FormError [] ='first anme most be more than 10 number';
            // }
            // if(strlen($Lastname) < 5){
            //     $FormError [] ='last anme most be more than 10 number';
            // }
            // if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            //     $FormError [] ='Please Enter a valid Email';
            // }
            // if(strlen($password) < 8){
            //     $FormError [] ='Password most be more than 8 number';
            // }
            // if(empty($FormError)){
            //     $ins = "INSERT INTO users(first_name,last_name,`password`,email) VALUES('$FirstName','$Lastname',' $password','$email')";
            //     $result = mysqli_query($conn,$ins);
            //     $success = 'one user Added'; 
            //     header( "refresh:5;url=all_data.php" );
            // }
        }
    }
    else{
        header('location: login.php');
        exit();
    }


?>




<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>All Data</h3>
                    <a class="btn btn-info" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add</a>
                </div>
                <?php
                if(isset($_GET['sussess']) && !empty($_GET['sussess'])){ ?>
                        <div class="alert alert-danger">
                            <?php
                                echo 'one item deleted';
                                unset($_GET['sussess']);
                             ?>
                        </div>
                    <?php }?>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>no</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Config</th>
                            </tr>
                            <?php if(isset($result) && !empty($result)): ?> 
                                <?php $i = 0; foreach($result as $user): ?>
                                    <tr>
                                        <td><?= ++$i ?></td>
                                        <td><?= $user['first_name'] ?></td>
                                        <td><?= $user['last_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td>
                                            <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="edit.php?id=<?= $user['id']?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="w-100" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Fill Input</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if(isset($FormError)): ?>
                        <?php foreach($FormError as $error): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif;?>
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
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </div>
        </form>
  </div>
</div>

<?php include 'layout\footer.php' ?>