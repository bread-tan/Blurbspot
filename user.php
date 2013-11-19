<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  	<title>Profile | Blurbspot!</title>
  	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Bootstrap -->
  	<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  	<!-- Custom Styles -->
  	<link href="assets/css/styles.css" rel="stylesheet" media="screen">
  	<script src='assets/js/jquery.js'></script>
  	<script src='assets/js/bootstrap.min.js'></script>
    <script>
    </script>
</head>
<body style="background-color:#5599bb;">
  <?php
    require_once("navbar.php");
  ?>
  <div class='well'>
    <h1> <?php echo $_SESSION['username']; ?> </h1>
    <hr>
    <h1><small>Your Likes</small></h1>
    <hr>
    <?php
      require_once("dbAccess.php");
      mysqli_select_db($con, 'blurbspot') or die(mysqli_error($con));
      $query = mysqli_query($con, "select * from userlikes where username='".$_SESSION['username']."'");
      echo "<ul>";
      while($data = mysqli_fetch_array($query))
      {
        echo "<h3><li><a href='search.php?q=".$data[1]."'>".str_replace("_", " ", $data[1])."</a></li></h3>";
      }
      echo "</ul>";
    ?>
    <hr>
</body>
</html>