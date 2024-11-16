<?php

$showErrorr = "false";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "dbconnect.php";

    $loginmail = $_POST['loginemail'];
    $loginpassword = $_POST['loginpass'];

    // check if email address already there
    $sql = "SELECT * FROM `users` WHERE user_email = '$loginmail'";
    $result = mysqli_query($conn,$sql);
    $numrow = mysqli_num_rows($result);
    if($numrow == 0){
      $showErrorr = "User Not Available";
     // echo  "User Not Available";
    }else{
       $row = mysqli_fetch_assoc($result);
           if(password_verify($loginpassword,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $loginmail;
           // header('Location: /forumweb/index.php');
           $showAlert = true;
           header("Location: /forumweb/index.php?loginsuccess=true");
            exit();
           // echo "logged in";
           }else{
                $showErrorr =  "Password do not match";
            // echo "Password do not match";
           }               
    } 
    header("Location:/forumweb/index.php?loginsuccess=false&error=$showErrorr");
}
?>
