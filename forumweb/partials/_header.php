<?php

session_start();

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

echo '
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-1 mb-2 bg-white rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">iDiscussForum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
<a class="nav-link" href="./about.php">About</a>
</li>
<li class="nav-item">
<a class="nav-link " href="./contact.php">Contact Us</a>
</li>
        
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
           Top 3 Categories
          </a>
          <ul class="dropdown-menu">
        ';

        $sql = "SELECT category_name, category_id FROM categories LIMIT 3";
        $reslt = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($reslt)){
        echo '
            <li><a    onmousedown="this.style.backgroundColor=\'green\';" 
        onmouseup="this.style.backgroundColor=\'white\';" 

       class="dropdown-item" href="threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>
       ';
        }
       echo '
        </ul>
        </li>
        




      </ul> ';
    
      if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']) == true ){
        $username = explode('@', $_SESSION['useremail'])[0];
        echo '
        <form class="d-flex align-items-center" role="search" method="GET" action="searchResults.php">
            <!-- Search input -->
            <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <!-- Search button -->
            <button class="btn btn-success" type="submit">Search</button>
            
            <!-- Welcome message -->
            <p class="my-0 mx-2">Welcome, ' . htmlspecialchars($username) . '</p>
            
            <!-- Log Out button -->
             <a href="partials/logout.php" class="btn btn-outline-success mx-2">LogOut</a>
        </form>';
      }else{
        echo '
        <form class="d-flex" role="search" action="./searchResults.php" >
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search" maxlength="40" >
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <button class="btn btn-outline-success mx-2 my-2 " data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
      <button class="btn btn-outline-success mx-2 " data-bs-toggle="modal" data-bs-target="#signupModal" >Sign Up</button>
      ';
      }

       echo '
    </div>
  </div>
</nav>
';

include "_loginmodals.php";
include "_signupmodals.php";


if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Succcess!</strong> Registered Successfully .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else {
  if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && isset($_GET['error'])) {
      $showError = $_GET['error']; // Get the error message from the URL parameter
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Oops!</strong> ' . htmlspecialchars($showError) . '.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }
}

if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Succcess!</strong> Loggedin Successfully .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else {
  if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false" && isset($_GET['error'])) {
      $showError = $_GET['error']; // Get the error message from the URL parameter
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Oops!</strong> Login failed due to ' . htmlspecialchars($showError) . '.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }
}
?>