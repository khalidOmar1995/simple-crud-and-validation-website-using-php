<?php

    $pageName = 'Add Users';
    session_start();
    include 'layout\header.php';
    if(!isset($_SESSION['userID'])){
        header('location: login.php');
        exit();
    }

    if(isset($_POST['Add'])){

        $users = $_POST['first_name'];
        var_dump($users);
        // for($i = 0 ; $i < count($users) ; $i++){
        //     $username = $users[$i];
        //     $ins = "INSERT INTO users(first_name) VALUES ('$username')"; 
        //     mysqli_query($conn,$ins);
        //     var_dump(mysqli_query($conn,$ins));
        // }
    }


?>
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">
                    <h3>Add Users</h3>
                </div>
                <div class="card-body text-center">
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <?php if(isset($_POST['first_name'])){
                                    $users = $_POST['first_name'];
                            ?>
                            <?php foreach($users as $user){?>
                                <div class="mb-2">
                                    <input value="<?php if(isset($user)){echo $user ;} ?>" placeholder="First Name" type="text" name="first_name[]" class="form-control">
                                </div>
                            <?php } ?>
                            <?php }else{?>
                                <div class="mb-2">
                                    <input value="" placeholder="First Name" type="text" name="first_name[]" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <input value="" placeholder="First Name" type="text" name="first_name[]" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <input value="" placeholder="First Name" type="text" name="first_name[]" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <input value="" placeholder="First Name" type="text" name="first_name[]" class="form-control">
                                </div>
                            <?php } ?>
                            <div class="mt-2">
                                <input class="btn btn-primary" name="Add" value="Add" type="submit">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout\footer.php' ?>