<?php
session_start();
include('head.php');
include('header.php');
unset($_SESSION['logged_in']);
unset($_SESSION['user_name']);
unset($_SESSION['user_id']);

echo "Logged out";

$URL="https://georgeharrison-webb.co.uk/mue/index.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
 ?>
