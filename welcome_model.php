<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "SELECT * FROM countries ORDER BY name ASC";
$results = mysqli_query($conn, $sql);
$countries = mysqli_fetch_all($results, MYSQLI_ASSOC);


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    if (empty(trim($_POST["country"])) || trim($_POST["country"] <= 0)) {
        $errors['country'] =  "Please select a country.";
        $_SESSION['country'] = [];
    } else {
        $country = trim($_POST["country"]);
        $_SESSION['country'] = $country;
    }

    if (empty(trim($_POST["forest"]))) {
       $errors['forest'] =  "Please enter forest name.";
        $_SESSION['forest'] = [];
    } else {
        $forestname = mysqli_real_escape_string($conn,trim($_POST["forest"]));
        $_SESSION['forest'] = $forestname;
    }


    try {

        if(!empty($_FILES["image"]["tmp_name"])){
            //image save
            $targetDir = "uploads/";
            $targetFile = $targetDir . generateRandomString() . '-'. $_FILES["image"]["name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check === false) {
                $errors['image'] =  "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($targetFile)) {
                $targetFile = $targetDir . generateRandomString() . '-'. $_FILES["image"]["name"];
            }

            // Check file size
            if ($_FILES["image"]["size"] > 5000000) {
                $errors['image'] = "Sorry, your file is too large. Image should be less than 5MB";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $errors['image'] = "Sorry, only JPG, JPEG & PNG  files are allowed.";
                $uploadOk = 0;
            }

            if($uploadOk == 1){
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            }
        }else{
            $targetFile=null;
        }

    }catch (Exception $e){
        $errors['image'] = "Sorry, Error happens. Please try again.";
    }


    if (!$errors) {
            $sql = "INSERT INTO forests(country_id,name,description,url,image,area,lat,lng) VALUES ('" . $country . "','" . $forestname . "','" . mysqli_real_escape_string($conn, $_POST['description'])  . "','" . $_POST['link'] . "','" . $targetFile . "','" . $_POST['area'] . "','" . $_POST['lat'] . "','" . $_POST['lng'] . "')";
            $results = mysqli_query($conn, $sql);
            $_SESSION['errors'] = [];
            $_SESSION['country'] = [];
            $_SESSION['forest'] = [];
            $_SESSION['recordAdded'] = true;
            mysqli_close($conn);
    } else {
        $_SESSION['errors'] = $errors;

    }

}


