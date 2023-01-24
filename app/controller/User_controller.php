<?php

require __DIR__ . '/../model/User.php';

if (isset($_POST["signup"])) signup();
if (isset($_POST["login"])) Login($_POST["email"], $_POST["pass"]);

function Signup(): void
{
    $first_name = validate_input($_POST["first_name"], 'text');
    $last_name = validate_input($_POST["last_name"], 'text');
    $email = validate_input($_POST["email"], 'email');
    $pass = validate_input($_POST["pass"], 'pass');

    if ($first_name == 'null' || $last_name == 'null' || $email == 'null' || $pass == 'null') {
        $_SESSION['message'] = "Invalid inputs When Sign Up !";
        header('location: ./public/pages/signup.php');
        die;
    }

    $user = new User();
    $user->setFirstName($first_name);
    $user->setLastName($last_name);
    $user->setEmail($email);
    $user->setPassword(password_hash($pass, PASSWORD_DEFAULT));

    if ($user->signup()) {
        Login($email, $pass);
    } else {
        $_SESSION['message'] = "Already exist this email, login !";
        header('location: ./public/pages/login.php');
        die;
    }
}

function Login($email, $pass): void
{
    if (validate_input($email, 'email') == 'null' || validate_input($pass, 'pass') == 'null') {
        $_SESSION['message'] = "Invalid inputs When Login !";
        header('location: ./public/pages/login.php');
        die;
    }

    $user = new User();
    $user->setEmail($email);

    if ($result = $user->login()) {
        if (password_verify($pass, $result['pass'])) {
            $_SESSION['userId'] = $result['id'];
            $_SESSION['userName'] = $result['first_name'];

            header('location: ./public/dashboard/statistics.php');
            die;
        }
    }

    $_SESSION['message'] = "Incorrect information, please check it !";
    header('location: ./public/pages/login.php');
    die;
}