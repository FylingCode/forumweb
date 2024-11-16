<?php

$showError = "false";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "dbconnect.php";

    $username = $_POST['signupemail'];
    $password = $_POST['signuppass'];
    $cpassword = $_POST['cpass'];

    // check if email address already there
    $exists = "SELECT * FROM `users` WHERE user_email = '$username'";
    $resultt = mysqli_query($conn,$exists);
    $numrow = mysqli_num_rows($resultt);
    if($numrow > 0){
      $showError = "Email already used";
    }else{

        if($password == $cpassword){

            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `users` ( `user_email`, `user_pass`, `timeofsignup`) VALUES ( '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if($result){
                $showAlert = true;
                header("Location: /forumweb/index.php?signupsuccess=true");
                exit();
              
            }
             
        }else{
           $showError = "Passwords do not match ";
        }
    }
     header("Location:/forumweb/index.php?signupsuccess=false&error=$showError");
    
    
}


?>
