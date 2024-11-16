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
        min-height: 493px;
    }

    /* Flexbox container to align cards */


</style>

<body>
<?php include "partials/dbconnect.php" ?>
  <?php include "partials/_header.php" ?>
  

  <div class="header my-3">
    <h1>iDiscuss</h1>
    <p> Browse Categories</p>
  </div>

  <!-- <div class="conatiner">
  <img width="auto" height="300" src="https://www.svgrepo.com/show/530243/question-and-answer.svg" alt="">
 </div> -->

  <div class="container my-3 ques shadow-lg p-3 mb-5 bg-white rounded ">
    <div class="row">
      <?php
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        // echo $row['category_id'];
        // echo $row['category_name'];
        $id = $row['category_id'];
        $cat = $row['category_name'];
        $des = $row['category_description'];
        echo ' <div class="col-md-6 my-2 ">
        <div class="card" ">
          <div class="card-body ">
            <h5 class="card-title "><a class="text-decoration-none text-dark" href="./threads.php?catid=' . $id . '">' . $cat . '</a></h5>
            <p class="card-text">' . substr($des, 0, 120) . ' ...</p>
            <a  href="./threads.php?catid=' . $id . '" class="btn btn-success">View Threads of ' . $cat . '</a>
          </div>
        </div>
      </div> ';
      }
      ?>
    </div>
  </div>

  <div class="container card shadow-lg p-3 mb-5 bg-white rounded">
  <div class="card-header">
    Quote
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>A well-known quote, contained in a blockquote element.</p>
      <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
    </blockquote>
  </div>
</div>

  <?php include "partials/_footer.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>