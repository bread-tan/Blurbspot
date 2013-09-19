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
  <script>
  var first =1;
  function searchBarMoveUp()
  {
  	if(first)
  	{
  		document.getElementById('searchBar').class='well';
  		first = 0;
	}
  }
  </script>
</head>
<body style="background-color:#000000">
	<div clas='container'>
		<?php require_once("navbar.php"); ?>
	</div>

	<br><br><br><br><br><br>

	<div class='container' align='center'>
		<img src='assets/img/Logo.png' alt='Welcome to Blurbspot!' height='200'>
	</div>

	<br>
	<div id='searchBar' align='center'>
		<input type='text' class='form-control' onkeydown='searchBarMoveUp()' placeholder='Search for the latest updates of  band' style='width:60%;' autofocus>
	</div>
	<br><br><br><br><br><br><br><br>
	<!-- <div stlye='width=40%;'>
	</div> -->
</body>
</html>