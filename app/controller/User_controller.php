<?php

require __DIR__ . '/../model/User.php';


if (isset($_POST["signup"])) signup();
if (isset($_POST["login"])) Login($_POST["email"], $_POST["pass"]);
//if (isset($_GET["updateId"])) Display();
//if (isset($_GET["logout"])) Logout();


function Signup(): void
{
    $user = new User();

    $user->setFirstName($_POST["first_name"]);
    $user->setLastName($_POST["last_name"]);
    $user->setEmail($_POST["email"]);
    $user->setPassword(password_hash($_POST["pass"], PASSWORD_DEFAULT));

    if ($user->signup()) {
        Login($_POST["email"], $_POST["pass"]);
    } else {
        $_SESSION['message'] = "Already exist this email, login !";
        header('location: ./public/pages/login.html');
    }
}

function Login($email, $pass): void
{
    $user = new User();

    $user->setEmail($email);

    if ($result = $user->login()) {
        if (password_verify($pass, $result['pass'])) {
            $_SESSION['userId'] = $result['id'];

            header('location: ./public/dashboard/categorie.php');
            die();
        }

    }

    $_SESSION['message'] = "Incorrect information, please check it !";
    header('location: ./public/pages/login.html');
}

//function Logout(): void
//{
//    $user = new User();
//    if (isset($_SESSION['userId'])) {
//        $user->logout();
//        var_dump($user);
//    }
//    header("Location: ../index.php");
//}
//
//function Display()
//{
//    $user = new User();
//    return $user->display($_SESSION['userId']);
//}