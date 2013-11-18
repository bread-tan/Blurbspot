<?php
	if(empty($_POST['q']))
		return;
	if(empty($_SESSION['username']))
	{
		echo "btn btn-danger|<span class='glyphicon glyphicon-warning-sign'> </span> <strong>Opps! </strong> You need to log in first.";
		return;
	}
	
	$bandname = $_POST['q'];

	require_once("dbAccess.php");
	mysqli_select_db($con, 'blurbspot') or die(mysqli_error($con));
	$query = mysqli_query($con, "select * from likes where bandname='$bandname'");
	$data = mysqli_fetch_array($query);
	
	if(empty($data))
	{
		mysqli_query($con, "insert into likes values('$bandname',1)");
	}
	else
	{
		mysqli_query($con, "update likes set numberOfLikes=numberOfLikes+1 where bandname='$bandname'");
	}
	mysqli_close($con);
	return "success";
?>