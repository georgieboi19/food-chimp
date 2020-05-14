<?php
//removed for privacy
$dbhost = 'xxx';
$dbuser = 'xxx';
$dbpass = 'xxx';
$dbname = 'xxx';

//create a DB connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) ;
//if the DB connection fails, display an error message and exit
if (!$conn)
{
  die('Could not connect: ' . mysqli_error($conn));
}
//select the database
mysqli_select_db($conn, $dbname);
?>
