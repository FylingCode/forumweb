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
        min-height: 433px;
    }
</style>

<body>
<?php include "partials/dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    


    <div class="header my-3">
        <p> Read Thread </p>
    </div>

    <!-- <div class="conatiner">
  <img width="auto" height="300" src="https://www.svgrepo.com/show/530243/question-and-answer.svg" alt="">
 </div> -->


    <?php
    $id = $_GET['threadno'];
    $sql = "SELECT * FROM `threads` where thread_id=$id";
    $result = mysqli_query($conn, $sql);

    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noresult = false;
        $thtitle = $row['thread_title'];
        $thdes = $row['thread_desc'];
        $thdate = $row['timestamp'];
        $threadby = $row['thread_user_id'];

        // $thdate = $row['timestamp']; 
        // $datetimeUTC = new DateTime($thdate, new DateTimeZone('UTC'));
        // $datetimeUTC->setTimezone(new DateTimeZone('America/New_York'));
        // $localTime = $datetimeUTC->format('Y-m-d H:i:s');

         $sql2 = "SELECT user_email FROM users WHERE sno = '$threadby' ";
        $result2 = mysqli_query($conn, $sql2);
         $row2 = mysqli_fetch_assoc($result2);
         $posted_by = $row2['user_email'];
    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showalert = false;
    if ($method == "POST") {
        $commm = $_POST['comm'];
        $commm = str_replace("<","&lt",$commm);
        $commm = str_replace(">","&gt",$commm);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id` ,`coment_by`,`comment_time`) VALUES ( '$commm', '$id', ' $sno',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Comment submitted Successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
    }
    ?>
    <div class="container my-3 border shadow-lg p-3 mb-5 bg-white rounded">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $thtitle ?> </h1>
            <p class="lead"><?php echo $thdes ?></p>
            <hr class="my-4">
            <p>This Query is to Knowledge Sharing Only . Don't start a topic in wrong category. Don't cross-post the same thing in multiple topics. Don't post no-content replies. Don't divert a topic by changing it midstream.</p>
            <hr>
            <p>Posted By : <?php echo $posted_by ?>  </p>
            <p>Time of Posting Thread : <?php echo $thdate ?></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin']) == true) {
        echo '
  <div class="container my-3 border border-success">
        <h1>Give Comment</h1>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" class="my-3">
            <div class="mb-3">
                <label for="comm" class="form-label">Give Your Comment on this thread.</label>
                <textarea class="form-control" id="comm" name="comm" rpws="3"></textarea>
                <input type="hidden" name="sno" value=" '. $_SESSION["sno"] .'">
            </div>
            <button type="submit" class="btn btn-success">Submit Comment</button>
        </form>
    </div>
  ';
    } else {
        echo '<div class="container my-3 border border-success">
    <h1>Give Comment</h1>
     <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">oopss !</h4>
  <p>Login first to give Replies and Comment.</p>
  <hr>
   <button class="btn btn-outline-danger mx-2 my-2 " data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
</div>
  </div>';
    }

    ?>



    <div class="container ques">
        <h1>Browse Replies / Discussion </h1>
        <hr>
        <?php
        $id = $_GET['threadno'];
        $sql = "SELECT * FROM `comments` where thread_id=$id";
        $result = mysqli_query($conn, $sql);

        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $comid = $row['comment_id'];
            $commcon = $row['comment_content'];
            $commtime = $row['comment_time'];
            $commentbyid = $row['coment_by'];

            $sql2 = "SELECT user_email FROM users WHERE sno = '$commentbyid' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
            <div class="media my-1 border p-1 shadow-none p-3 mb-2 bg-light rounded">
  <div class="media-body">
  <h6 class="mt-0">    ' . $commcon . '</h6>
  <hr>
   <p class="font-weight-bold my-0"><img class="mr-3" src="https://www.svgrepo.com/show/498301/profile-circle.svg" width="20px" alt="Generic placeholder image"> '.$row2['user_email'].' at : ' . $commtime . '</p>
  </div>
</div>
          ';
        }
        if ($noresult) {
            echo '<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Ooopsss!</h4>
  <p>No Comment found !!!!</p>
  <hr>
  <p class="mb-0">be the first person to Comment something.</p>
</div>';
        }
        ?>
    </div>

    <?php include "partials/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>