<?php
require_once __DIR__.'/../../app/controller/shared.php';
if(!isset($_SESSION['userId'])){
    header('location: ../../index.php');
}