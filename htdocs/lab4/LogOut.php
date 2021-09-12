<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
$_SESSION['loggedIn']= false;

header("location:Homepage.php");
