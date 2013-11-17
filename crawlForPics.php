<?php
	if(empty($_POST['q']))
	 	return;
	$bandname = $_POST['q'];
	$handle = fopen("config/config.txt", "r");
	$contents = fread($handle, filesize("config/config.txt"));
	$configurations = explode("\r\n", $contents);
	foreach($configurations as $config)
	{
		$parts = explode("=", $config);
		if($parts[0] == "python")
			$pythonSource = $parts[1];
	}
	$photoString = shell_exec($pythonSource."python scripts\\imagecrawler.py $bandname");
    $photos = explode("|", $photoString);
    foreach($photos as $photo)
    {
      echo "<img src='".$photo."' height='100px' >";
    }
?>