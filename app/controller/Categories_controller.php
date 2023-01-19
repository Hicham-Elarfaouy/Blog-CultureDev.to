<?php
require __DIR__ . '/../model/Categories.php';

if (isset($_POST['get_cat'])) get_cat();
if (isset($_POST['save_cat'])) save_cat();
if (isset($_POST['update_cat'])) update_cat();
if (isset($_POST['delete_cat'])) delete_cat();

function get_cat(): bool|array
{
    $cat = new Categories();
    return $cat->read();
}

function save_cat(): void
{
    $cat = new Categories();
    $cat->setName($_POST['cat-name']);


    if ($cat->add()) {
        $_SESSION['message'] = "Categorie has been added successfully !";
    } else {
        $_SESSION['message'] = "Error when add Categorie !";
    }
    header('location: ./public/dashboard/categorie.php');
}

function update_cat(): void
{
    $cat = new Categories();
    $cat->setId($_POST['cat-id']);
    $cat->setName($_POST['cat-name']);


    if ($cat->update()) {
        $_SESSION['message'] = "Categorie has been updated successfully !";
    } else {
        $_SESSION['message'] = "Error when update Categorie !";
    }
    header('location: ./public/dashboard/categorie.php');
}

function delete_cat(): void
{
    $cat = new Categories();
    $cat->setId($_POST['delete_cat']);
    $cat->delete();
}
