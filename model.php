<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    if (empty(trim($_POST['country']))) {
        array_push($errors,'Search field is required');
    }

    if(!$errors){
        $sql = "SELECT forests.id, forests.name AS name, forests.url, forests.image, forests.description, forests.lat,forests.lng,forests.area,forests.created_at, countries.name AS country_name from forests Inner Join countries On forests.country_id = countries.id where countries.name LIKE '%{$_POST['country']}%'";
        $results = mysqli_query($conn, $sql);
        $searches = mysqli_fetch_all($results, MYSQLI_ASSOC);
        mysqli_close($conn);
        $_SESSION['isSearched'] = true;
    }

}