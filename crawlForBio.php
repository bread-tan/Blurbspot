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
	$string = shell_exec($pythonSource."python scripts\\biocrawler.py $bandname");
	echo str_replace("\n", "<br>", $string);
?>