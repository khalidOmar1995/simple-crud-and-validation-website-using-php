<?php

    $pageName = 'Edit';
    session_start();
    include 'layout\header.php';
    if(isset($_SESSION['userID'])){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sel = "SELECT * FROM  users WHERE id = $id";
            if(mysqli_query($conn,$sel)){
               $result= mysqli_fetch_array(mysqli_query($conn,$sel),MYSQLI_ASSOC);
            }
        }
    }
    else{
        header('location:login.php');
        exit();
    }


?>
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">
                    <h3>Edit</h3>
                </div>
                <?php if(isset($formError) && !empty($formError)){ ?>
                    <?php foreach($formError as $error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endforeach ;  ?>
                <?php } ?>
                <div class="card-body text-center">
                    <form method="POST" action="update.php">
                        <input type="hidden" name="id" value="<?php if(isset($result['id'])){echo $result['id'] ;} ?>">
                        <div class="mb-2">
                            <input value="<?php if(isset($result['first_name'])){echo $result['first_name'] ;} ?>" placeholder="First Name" type="text" name="first_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($result['last_name'])){echo $result['last_name'] ;} ?>" placeholder="Last Name " type="text" name="last_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?php if(isset($result['email'])){echo $result['email'] ;} ?>" placeholder="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="mt-2">
                            <input class="btn btn-primary" name="update" value="update" type="submit" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout\footer.php' ?>