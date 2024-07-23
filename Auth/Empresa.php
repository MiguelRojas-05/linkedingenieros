<?php

session_start();

if($_SESSION["auth"]!="3"  && $_SESSION["auth"]!="4")
{
    Header('Location: Login.php');
    exit();
}

?>