<?php

include('db.php') ;

if(isset($_GET['name'])){
    $sql = "SELECT forests.id, forests.name AS name, forests.url, forests.image, forests.lat,forests.lng,forests.area,forests.created_at, countries.name AS country_name,forests.description from forests Inner Join countries On forests.country_id = countries.id where forests.name LIKE '{$_GET['name']}%' OR countries.name LIKE '{$_GET['name']}%' LIMIT 6";
    $results = mysqli_query($conn, $sql);
    $searches = mysqli_fetch_all($results, MYSQLI_ASSOC);
    echo json_encode($searches);
    mysqli_close($conn);
}


if(isset($_GET['id'])){
    $sql = "SELECT forests.id, forests.name AS name, forests.url, forests.image, forests.lat,forests.lng,forests.area,forests.created_at, countries.name AS country_name,forests.description from forests Inner Join countries On forests.country_id = countries.id where forests.id LIKE '{$_GET['id']}' ";
    $results = mysqli_query($conn, $sql);
    $searche = mysqli_fetch_row($results);
    echo json_encode($searche);
    mysqli_close($conn);
}

