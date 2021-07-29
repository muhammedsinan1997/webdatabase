<?php
if(session_status() == PHP_SESSION_NONE  ){
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    if (empty(trim($_POST['user_name']))) {
        array_push($errors, 'user name is empty');
        $_SESSION['error_username'] = 'user name is empty';
    } else {
        unset($_SESSION['error_username']);
    }

    if (empty(trim($_POST['user_password']))) {
        array_push($errors, 'password is empty');
        $_SESSION['error_password'] = 'user password is empty';
    } else {
        unset($_SESSION['error_password']);
    }

    if (empty(trim($_POST['user_confirm_password']))) {
        array_push($errors, 'password entered is not same');
        $_SESSION['error_confirm_password'] = 'user password is empty';
    } else {
        unset($_SESSION['error_confirm_password']);
    }

    if (trim($_POST['user_password']) !== trim($_POST['user_confirm_password'])) {
        array_push($errors, 'Confirm password should match');
    }

    if (empty(trim($_POST['user_email']))) {
        array_push($errors, 'email is empty');
        $_SESSION['error_email'] = 'user password is empty';
    } else {
        unset($_SESSION['error_email']);
        $sql = "SELECT id,username,password,email FROM login WHERE email='{$_POST['user_email']}'";
        $result = $conn->query($sql);

        if ($result->num_rows > 1) {
            array_push($errors, 'email email already exist');
            $_SESSION['error_email'] = 'email email already exist';
        }else{
            unset($_SESSION['error_email']);
        }
    }
    if (!$errors) {
        $sql = "INSERT INTO login(username,password,email) VALUES ('" . $_POST['user_name'] . "','" . $_POST['user_password'] . "','" . $_POST['user_email'] . "')";
        $results = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $_SESSION['isRegistered'] = true;
        echo "<script>window.location.href = 'login.php' </script>";
        //header("Location: login.php");
    }else{
        $_SESSION['errors'] = $errors;
    }

}

