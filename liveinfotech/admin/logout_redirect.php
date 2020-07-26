<?php


session_start();


unset($_SESSION['login_id']);  //Is Used To Destroy Specified Session


unset($_SESSION['first_name']);  //Is Used To Destroy Specified Session


header('Location: http://infotechapp.com/result.php');