<?php

require __DIR__ . '/../model/Post.php';

if (isset($_POST['get_post'])) get_post();
if (isset($_POST['specific_post'])) get_specific_post();
if (isset($_POST['save_post'])) save_post();
if (isset($_POST['update_post'])) update_post();
if (isset($_POST['delete_post'])) delete_post();

function get_specific_post(): void
{
    $post = new Post();
    $post->setId($_POST['specific_post']);
    echo json_encode($post->specific_post());
    die();
}

function get_post(): bool|array
{
    $post = new Post();
    return $post->read();
}

function save_post(): void
{
    $post_title = validate_input($_POST["post-title"], 'text');
    $post_desc = validate_input($_POST["post-desc"], 'text');

    if ($post_title == 'null' || $post_desc == 'null') {
        $_SESSION['message'] = "Invalid inputs When Add Post !";
        if($_POST['save_post'] == 'true'){
            echo 'error';
            die;
        }
        header('location: ./public/dashboard/Posts.php');
        die;
    }

    $post = new Post();
    $post->setTitle($post_title);
    $post->setCat($_POST['post-cat']);
    $post->setDescription($post_desc);
    $post->setDate(date("Y-m-d h:i:s"));
    $post->setAuteur($_POST['post-auteur']);
    $post->setImage(upload_image($_FILES["post-img"]));

    if ($post->add()) {
        $_SESSION['message'] = "Post has been added successfully !";
    } else {
        $_SESSION['message'] = "Error when add Post !";
    }
    header('location: ./public/dashboard/Posts.php');
}

function update_post(): void
{
    $post_title = validate_input($_POST["post-title"], 'text');
    $post_desc = validate_input($_POST["post-desc"], 'text');

    if ($post_title == 'null' || $post_desc == 'null') {
        $_SESSION['message'] = "Invalid inputs When Update Post !";
        header('location: ./public/dashboard/Posts.php');
        die;
    }

    $post = new Post();
    $post->setId($_POST['post-id']);
    $post->setTitle($post_title);
    $post->setCat($_POST['post-cat']);
    $post->setDescription($post_desc);
    $post->setDate(date("Y-m-d h:i:s"));
    $post->setAuteur($_POST['post-auteur']);
    $post->setImage(upload_image($_FILES["post-img"]));


    if ($post->update()) {
        $_SESSION['message'] = "Post has been updated successfully !";
    } else {
        $_SESSION['message'] = "Error when update Post !";
    }
    header('location: ./public/dashboard/Posts.php');
}

function delete_post(): void
{
    try {
        $post = new Post();
        $post->setId($_POST['delete_post']);
        $image = $post->specific_post()['image'];
        delete_image($image);
        $post->delete();
    }catch (Exception $exception){
        echo $exception;
    }
}