<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iDiscuss - Coding Forum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
  .header {
    padding: 10px;
    text-align: center;
    background: #20BC79;
    color: white;
    font-size: 30px;
  }
  .ques {
        min-height: 620px;
    }
</style>

<body>
<?php include "partials/dbconnect.php" ?>
  <?php include "partials/_header.php" ?>
          
 
  <div class="container my-3 ques shadow-lg p-3 mb-5 bg-white rounded">
  <h1>Search Results for ➤ <em style="color: #20BC79;">"<?php echo $_GET['search'] ?>"</em></h1>
  <hr>

  <?php
$noselut = true;
$search = mysqli_real_escape_string($conn, $_GET["search"]); // Escape the input
$sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) AGAINST ('$search')";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $noselut = false;
  $threadtitle = $row['thread_title'];
  $threaddesc = $row['thread_desc'];
  $threadid = $row['thread_id'];
  $url = "thread.php?threadno=".$threadid;
 
  echo '
  <div class="result shadow-lg p-3 mb-5 bg-white rounded">
          <h3> <a href="'.$url.'" class="text-dark text-decoration-none">➜ '.$threadtitle.'</a></h3>
          <p>'.$threaddesc.'</p>
    </div>
  ';
}

if($noselut){
  echo '
  <div class="result shadow-lg p-3 mb-5 bg-white rounded">
          <h3>Ooopss!!! No thread found 😔 </a></h3>
          <p>Suggestions:</p>
          <ul>
          <li>Make sure that all words are spelled correctly. </li>
          <li>Try different keywords. </li>
          <li>Try more general keywords. </li>
          </ul>
    </div>
  ';

}
 ?>

    
  </div>

 
  <?php include "partials/_footer.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>