<?php

session_start();
session_destroy();
header("Location: /forumweb/index.php");
?>