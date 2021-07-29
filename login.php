<?php if(session_status() == PHP_SESSION_NONE  ){
    session_start();

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
        header("Location: welcome.php");
    }


} ?>
<?php  $title = 'Login' ; ?>

<?php include('./includes/header.php') ?>
<?php include('./includes/nav.php') ?>

<?php include('db.php') ?>

<?php include('login_model.php') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">

            <?php if(isset($_SESSION['isRegistered']) && $_SESSION['isRegistered'] === true ) : ?>
                <div class="alert alert-success" role="alert">
                    <span>
                        You have successfully registered. <br> Please login with your email.
                    </span>
                </div>
                <?php  $_SESSION['isRegistered'] = false;  ?>
            <?php endif;?>

            <?php if(isset($_SESSION['noUserRegistered']) && $_SESSION['noUserRegistered'] === true ) : ?>
                <div class="alert alert-danger" role="alert">
                    <span>
                        Please check the email and password and try again.
                    </span>
                </div>
                <?php  $_SESSION['noUserRegistered'] = false;  ?>
            <?php endif;?>

            <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ) : ?>
                <div class="alert alert-danger" role="alert">
                    <span>
                        Logged in
                    </span>
                </div>

            <?php endif;?>

            <div class="mb-4">
                <h3>Login Form</h3>
            </div>


            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input  name="user_email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="user_password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="mt-4">
                   <span><span>Don't have an account? </span> <a class="" href="register.php" tabindex="-1">Register</a></span>

                </div>
            </form>
        </div>
    </div>
</div>




<?php include('./includes/footer.php') ?>