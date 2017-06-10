<?php

$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_db='mydb';

$conn=mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(!$conn){
    die('There was an error connecting to the database!');
}


?>