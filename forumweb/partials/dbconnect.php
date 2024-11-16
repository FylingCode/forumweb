<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Database Connection failed " . mysqli_connect_error($conn));
}else{
   // echo "Database Connection Successfully";
}

?>