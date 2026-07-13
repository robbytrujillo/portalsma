<?php

$host="localhost";
$user="root";
$pass="";
$db="db_portalsma";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die(mysqli_connect_error());
}