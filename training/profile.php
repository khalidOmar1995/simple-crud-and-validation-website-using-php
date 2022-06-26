<?php
    $pageName = 'Profile';
    session_start();
    include 'layout\header.php';
    if(isset($_SESSION ['userID'])){
        $id = $_SESSION ['userID']; 
        $sel = "SELECT * FROM  users WHERE id = '$id'";
        $result = mysqli_fetch_array(mysqli_query($conn , $sel));
        if(isset($_POST['update'])){
            $firstName = $_POST['first_name'] ;
            $lastName = $_POST['last_name'] ;
            $email = $_POST['email'];
            $success;

            $up ="UPDATE
                        users 
                    SET 
                        first_name = '$firstName' ,
                        last_name = '$lastName' ,
                        email='$email'
                    WHERE 
                        id =$id
                    ";

            if(mysqli_query($conn , $up)){
                $success = 'your data has updated';
            }
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
            <?php if(isset($success) && !empty($success)):?>
                <div class="alert alert-success">
                    <?php
                    
                    echo $success ;
                    
                    $success = ''
                    ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3>User Info</h3>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-2">
                            <input value="<?= $result['first_name'] ?>" placeholder="First Name" type="text" name="first_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?= $result['last_name'] ?>" placeholder="Last Name" type="text" name="last_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input value="<?= $result['email'] ?>" placeholder="Email" type="text" name="email" class="form-control">
                        </div>
                        <div class="mt-2">
                            <input class="btn btn-primary" name="update" value="Update" type="submit" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout\footer.php' ?>