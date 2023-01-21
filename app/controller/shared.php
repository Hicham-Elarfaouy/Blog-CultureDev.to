<?php

session_start();

require_once __DIR__.'/../model/Connection.php';
require_once __DIR__.'/../controller/User_controller.php';
require_once __DIR__.'/../controller/Categories_controller.php';
require_once __DIR__.'/../controller/Post_controller.php';

function validate_input($input, $type): string
{
    return match ($type) {
        "text" => preg_match("/^[a-zA-Z0-9\s]+$/", $input) ? $input : 'null',
        "price" => preg_match("/^[0-9.]+$/", $input) ? $input : 'null',
        "pass" => preg_match("/^[a-zA-Z0-9$#@.%]{8,}$/", $input) ? $input : 'null',
        "email" => filter_var($input, FILTER_VALIDATE_EMAIL) ? $input : 'null',
        "select" => preg_match("/^[0-9]+$/", $input) ? $input : 'null',
        "selectAlphabet" => preg_match("/^[A-Z]+$/", $input) ? $input : 'null',
        default => "null",
    };
}

function upload_image($image): string
{
    if (!$image["size"] > 0) {
        return '';
    }

    $target_dir = __DIR__."/../../public/assets/images/posts/";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG files are allowed !";
        header('location: ./public/dashboard/Posts.php');
        die();
    }

    if ($image["size"] > 10048576) {
        $_SESSION['message'] = "Sorry, your image is large than 1mb !";
        header('location: ./public/dashboard/Posts.php');
        die();
    }

    // change file name
    $random = rand(0, 100000);
    $rename = "Image" . date('ymd') . "$random.$imageFileType";

    if (file_exists($target_dir . $rename)) {
        $_SESSION['message'] = "Sorry, file already exists !";
        header('location: ./public/dashboard/Posts.php');
        die();
    }

    if (move_uploaded_file($image["tmp_name"], $target_dir . $rename)) {
        return $rename;
    } else {
        $_SESSION['message'] = "Sorry, there was an error uploading your image.";
        header('location: ./public/dashboard/Posts.php');
        die();
    }

    return '';
}

function delete_image($image): void
{
    $target_dir = __DIR__."/../../public/assets/images/posts/";
    unlink($target_dir . $image);
}