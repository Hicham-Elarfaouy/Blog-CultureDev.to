<?php

use JetBrains\PhpStorm\NoReturn;

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
    $post = new Post();
    $post->setTitle($_POST['post-title']);
    $post->setCat($_POST['post-cat']);
    $post->setDescription($_POST['post-desc']);
    $post->setDate(date("Y-m-d h:i:s"));
    $post->setAuteur($_POST['post-auteur']);




    if ($post->add()) {
        $_SESSION['message'] = "Post has been added successfully !";
    } else {
        $_SESSION['message'] = "Error when add Post !";
    }
    header('location: ./public/dashboard/Posts.php');
}

function update_post(): void
{
    $post = new Post();
    $post->setId($_POST['post-id']);
    $post->setTitle($_POST['post-title']);
    $post->setCat($_POST['post-cat']);
    $post->setDescription($_POST['post-desc']);
    $post->setDate(date("Y-m-d h:i:s"));
    $post->setAuteur($_POST['post-auteur']);


    if ($post->update()) {
        $_SESSION['message'] = "Post has been updated successfully !";
    } else {
        $_SESSION['message'] = "Error when update Post !";
    }
    header('location: ./public/dashboard/Posts.php');
}

function delete_post(): void
{
    $post = new Post();
    $post->setId($_POST['delete_post']);
    $post->delete();
}