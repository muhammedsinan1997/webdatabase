<?php
if(session_status() == PHP_SESSION_NONE ){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
// Check if useremail is empty
    if (empty(trim($_POST["user_email"]))) {
        $useremail_err = "Please enter username.";
    } else {

        $useremail = trim($_POST["user_email"]);
    }

    if (empty(trim($_POST["user_password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["user_password"]);
    }

    // Validate credentials

    if (empty($useremail_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT * FROM login WHERE email='{$useremail}'&& password='{$password}'";
        $results = mysqli_query($conn, $sql);
        $user = mysqli_fetch_all($results, MYSQLI_ASSOC);

        if(isset($user) && count($user) === 1 ){
            //user log in
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['user'] = $user[0];
            echo "<script>window.location.href = 'welcome.php' </script>";
            //header("Location: welcome.php");
        }else{
            //no user
            $_SESSION['noUserRegistered'] = true;
        }
    }else{

    }

}


