<?php
session_start();
session_destroy();
header('location: ../../public/pages/login.php');