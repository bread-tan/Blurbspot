<?php
	session_start();
	$username = strtolower($_POST['username']);
	$password = $_POST['password'];
	$hashedPassword = hash("md5", $password);

	require_once("dbAccess.php");
	mysqli_select_db($con, 'blurbspot') or die(mysqli_error($con));
	$query = mysqli_query($con, "select * from login where username='$username'");
	$data = mysqli_fetch_array($query);
	
	if(empty($data))
	{
		echo "<br><b>Invalid Username or Password.</b> Please check the values entered and try again.<br><br>";
		echo "<strong>Don't have an account?</strong><button class='btn-link' onclick='signInModalBringUp();signUpModalBringUp();'><span class='text-success'>Click here to register!</span></button>";
		session_destroy();
	}
	else
	{
		if($hashedPassword == $data['password'])
		{
			$_SESSION['username'] = $username;
			echo "success";
		}
		else
		{
			echo "<br><b>Invalid Username or Password.</b> Please check the values entered and try again.<br><br>";
			echo "<strong>Don't have an account?</strong><button class='btn-link' onclick='signInModalBringUp();signUpModalBringUp();'><span class='text-success'>Click here to register!</span></button>";
			session_destroy();
		}
	}
	mysqli_close($con);
?>