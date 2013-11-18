<?php
  session_start();
  require_once("dbAccess.php");
  mysqli_select_db($con, 'blurbspot') or die(mysqli_error($con));
  $query = mysqli_query($con, "select * from likes order by numberOfLikes desc");
  $data = mysqli_fetch_array($query);
  header("Location:search.php?q=".$data[0]);
?>