<?php if(session_status() == PHP_SESSION_NONE ){
    session_start();
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
        header("Location: welcome.php");
    }
} ?>
<?php $title = 'Register'; ?>

<?php include('./includes/header.php') ?>
<?php include('./includes/nav.php') ?>

<?php include('db.php') ?>
<?php include('register_model.php') ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="mb-4">
                    <h3>Registration Form</h3>
                </div>


                <form action="register.php" method="post">
                <div class="form-group">
                    <label for="user">Name</label>
                    <input name="user_name" type="text" class="form-control">
                    <?php if(isset($_SESSION['error_username']) ) : ?>
                        <p> <?=  $_SESSION['error_username'] ?></p>
                    <?php endif;?>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="user_email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <?php if(isset($_SESSION['error_email']) ) : ?>
                        <p> <?=  $_SESSION['error_email'] ?></p>
                    <?php endif;?>
                    <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="user_password" type="password" class="form-control" id="exampleInputPassword1">
                    <?php if(isset($_SESSION['error_password']) ) : ?>
                        <p> <?=  $_SESSION['error_password'] ?></p>
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input name="user_confirm_password" type="password" class="form-control" id="exampleInputPassword1">
                    <?php if(isset($_SESSION['error_confirm_password']) ) : ?>
                        <p> <?=  $_SESSION['error_confirm_password'] ?></p>
                    <?php endif;?>
                </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>


                </form>

                <div class="mt-4">
                    <span><span>Already have an account? </span> <a class="" href="login.php" tabindex="-1">Login</a></span>

                </div>
            </div>
        </div>
    </div>
<?php include('./includes/footer.php'); ?>