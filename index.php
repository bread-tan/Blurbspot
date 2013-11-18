<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  	<title>Blurbspot!</title>
  	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Bootstrap -->
  	<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  	<!-- Custom Styles -->
  	<link href="assets/css/styles.css" rel="stylesheet" media="screen">
  	<script src='assets/js/jquery.js'></script>
  	<script src='assets/js/bootstrap.min.js'></script>
  	<script>
  	var turn = 0;
    var oneFifthWidth = window.innerWidth/5;

  	function changePictures()
    {
      if(turn == 0)
      {
        var element = document.getElementById('imagePlaceholder' + (turn + 1));
        if(element.innerHTML == '<br><br><div class="well" style="width:80%;padding:0px"><br><br><h2>Artist of the Week!</h2><br><br></div><br><br>')
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html("<div class='well' style='padding:10px;'><img src='assets/img/aristotw/1.jpg' height='200px' ></div>");
            $(this).fadeTo(600, 1);
            });
        }
        else
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html("<br><br><div class='well' style='width:80%;padding:0px'><br><br><h2>Artist of the Week!</h2><br><br></div><br><br>");
            $(this).fadeTo(600, 1);
            });
        }
      }
      else if(turn == 1)
      {
        var element = document.getElementById('imagePlaceholder' + (turn + 1));
        if(element.innerHTML == '<br><br><div class="well" style="width:80%;padding:0px"><br><br><h2>Band of the Week!</h2><br><br></div><br><br>')
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html("<div class='well' style='padding:10px;'><img src='assets/img/bandotw/1.jpg' height='200px'></div>");
            $(this).fadeTo(600, 1);
            });
        }
        else
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html('<br><br><div class="well" style="width:80%;padding:0px"><br><br><h2>Band of the Week!</h2><br><br></div><br><br>');
            $(this).fadeTo(600, 1);
            });
        }
      }
      else
      {
        var element = document.getElementById('imagePlaceholder' + (turn + 1));
        if(element.innerHTML == '<br><br><div class="well" style="width:80%;padding:0px"><br><br><h2>Top 10 this Week!</h2><br><br></div><br><br>')
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html("<div class='well' style='padding:10px;'><img src='assets/img/top10/1.jpg' height='200px'></div>");
            $(this).fadeTo(600, 1);
            });
        }
        else
        {
          $('#imagePlaceholder' + (turn + 1)).fadeTo("slow", 0, function () {
            $(this).delay(600);
            $(this).html('<br><br><div class="well" style="width:80%;padding:0px"><br><br><h2>Top 10 this Week!</h2><br><br></div><br><br>');
            $(this).fadeTo(600, 1);
            });
        }
      }
      turn++;
      turn = turn % 3;
    }

    function searchBand(source)
    {
      if(source != "nav")
        window.location="search.php?q="+document.getElementById('queryText').value;
    }

    callID = setInterval(changePictures, 3000);

  	</script>
</head>
<body style="background-color:#5599bb">
	<div clas='container' style="margin-left:20px;margin-right:20px">
		<?php require_once("navbar.php"); ?>
	</div>

	<br><br><br><br><br>

	<div class='container' align='center'>
		<img src='assets/img/Logo.png' alt='Welcome to Blurbspot!' height="150">
	</div>

	<br>

	<div id='searchBar' class='input-group' style='margin-left:60px;margin-right:60px'>
		<input type='text' class='form-control' id='queryText' placeholder='Search for the latest updates of your favourite bands' autofocus>
		<span class="input-group-btn">
			<button class='btn btn-primary' onclick='searchBand("notnav")'><span class='glyphicon glyphicon-search'></span> Search! </button>
		</span>
	</div>

	<br><br><br><br><br>

	<table align='center' style='width:100%;'>
		<tr>
    <td id='imagePlaceholder1' style='width:33%;' align='center'><br><br><div class='well' style='width:80%;padding:0px'><br><br><h2>Artist of the Week!</h2><br><br></div><br><br></td>
		<td id='imagePlaceholder2' style='width:33%;' align='center'><br><br><div class='well' style='width:80%;padding:0px'><br><br><h2>Band of the Week!</h2><br><br></div><br><br></div></td>
		<td id='imagePlaceholder3' style='width:33%;' align='center'><br><br><div class='well' style='width:80%;padding:0px'><br><br><h2>Top 10 this Week!</h2><br><br></div><br><br></div></td>
  </tr>
	</table>
</body>
</html>
