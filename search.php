<?php
  if(empty($_GET['q']))
    header("Location:index.php");
  $parts = preg_split("/\s+/", $_GET['q']);
  for($i = 0; $i < count($parts); $i++)
  {
    $parts[$i] = ucfirst($parts[$i]);
  }
  $bandname = implode("_", $parts);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  	<title>Search | Blurbspot!</title>
  	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Bootstrap -->
  	<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  	<!-- Custom Styles -->
  	<link href="assets/css/styles.css" rel="stylesheet" media="screen">
  	<script src='assets/js/jquery.js'></script>
  	<script src='assets/js/bootstrap.min.js'></script>
    <script>
      function crawlForData()
      {
        $.post("crawlForPics.php", { q: <?php echo '"'.$bandname.'"'; ?> })
      .done(function(data)
      {
        document.getElementById('picsDiv').innerHTML = data;
        var width = document.getElementById('crawlProgressBar').style.width;
        width = parseInt(width) + 325;
        if(width >= 99)
        {
          width = 100;
          document.getElementById('crawlProgressText').innerHTML="Fetching Complete!";
        }
        document.getElementById('crawlProgressBar').style.width=width+"%";
      });

        $.post("tweets.php", { screen_name: <?php echo '"'.$bandname.'"'; ?>, count: 10 })
      .done(function(data)
      {
        document.getElementById('tweetsDiv').innerHTML = data;
        var width = document.getElementById('crawlProgressBar').style.width;
        width = parseInt(width) + 25;
        if(width >= 99)
        {
          width = 100;
          document.getElementById('crawlProgressText').innerHTML="Fetching Complete!";
        }
        document.getElementById('crawlProgressBar').style.width=width+"%";
      });

        $.post("crawlForBio.php", { q: <?php echo '"'.$bandname.'"'; ?> })
      .done(function(data)
      {
        document.getElementById('bioDiv').innerHTML = data;
        var width = document.getElementById('crawlProgressBar').style.width;
        width = parseInt(width) + 25;
        if(width >= 99)
        {
          width = 100;
          document.getElementById('crawlProgressText').innerHTML="Fetching Complete!";
        }
        document.getElementById('crawlProgressBar').style.width=width+"%";
      });

      $.post("crawlForSongs.php", { q: <?php echo '"'.$bandname.'"'; ?> })
      .done(function(data)
      {
        document.getElementById('songsDiv').innerHTML = data;
        var width = document.getElementById('crawlProgressBar').style.width;
        width = parseInt(width) + 25;
        if(width >= 99)
        {
          width = 100;
          document.getElementById('crawlProgressText').innerHTML="Fetching Complete!";
        }
        document.getElementById('crawlProgressBar').style.width=width+"%";
      });

      }

      function likeThisBand()
      {

        $.post("like.php", { q: <?php echo '"'.$bandname.'"'; ?> })
      .done(function(data)
      {
        var targetButton = document.getElementById('likeButton');
        targetButton.onclick="";
        if(data != "success")
        {
          var parts = data.split("|");
          targetButton.className=parts[0];
          targetButton.innerHTML=parts[1];
          return;
        }
        targetButton.innerHTML="<span class='glyphicon glyphicon-check'> </span><strong> You like this band!</strong>";
        targetButton.className="btn btn-success";
        document.getElementById('numberOfLikes').innerHTML = (parseInt(document.getElementById('numberOfLikes').innerHTML) + 1) + "";
        });
      }
    </script>
</head>
<body onload='crawlForData()' style="background-color:#5599bb;">
  <?php
    require_once("navbar.php");
  ?>
  <div class='well'>
    <?php
      require_once("dbAccess.php");
      mysqli_select_db($con, 'blurbspot') or die(mysqli_error($con));
      $query = mysqli_query($con, "select * from likes where bandname='$bandname'");
      $data = mysqli_fetch_array($query);
      if(empty($_SESSION['username']))
      {
        if(empty($data[1]))
          $data[1] = 0;
        echo "<h1>".str_replace("_", " ", $bandname)."<small> <span id='numberOfLikes' >".$data[1]."</span><span class='glyphicon glyphicon-thumbs-up'></small></h1>";
        echo "<button class='btn btn-info' onclick='signInModalBringUp();' id='likeButton'><strong> Like this band! </strong></button>";
      }
      else
      {
        if(empty($data[1]))
          $data[1] = 0;
        echo "<h1>".str_replace("_", " ", $bandname)."<small> <span id='numberOfLikes' >".$data[1]."</span><span class='glyphicon glyphicon-thumbs-up'></small></h1>";
        $query = mysqli_query($con, "select * from userlikes where username='".$_SESSION['username']."' and bandname='$bandname'");
        $data = mysqli_fetch_array($query);
        if(empty($data))
          echo "<button class='btn btn-info' onclick='likeThisBand();' id='likeButton'><strong> Like this band! </strong></button>";
        else
          echo "<strong><input type='button' class='btn btn-success' id='likeButton' value='You liked this!' disabled></strong>";
      }
    ?>
    <hr>
    <h3 class='text-info' id='crawlProgressText'> Fetching data... </h3>
    <div class="progress progress-striped active">
      <div class="progress-bar progress-bar-success" id='crawlProgressBar' role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 2%">
      </div>
    </div>
    <hr>
    <h1><small>Pictures</small></h1>
    <hr>
    <div id='picsDiv'> </div>
    <h1><small>Latest Tweets</small></h1>
    <hr>
    <div id='tweetsDiv'> </div>
    <h1><small>Biography</small></h1>
    <hr>
    <div id='bioDiv'> </div>
    <h1><small>Songs</small></h1>
    <hr>
    <div id='songsDiv'> </div>
  </div>
</body>
</html>