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
	$string = str_replace("\n", "<br>", shell_exec($pythonSource."python scripts\\biocrawler.py $bandname"));
	// echo str_replace("\n", "<br>", $string);
	preg_match_all("(http:[/][/][a-zA-Z0-9./]*)", $string, $matches);
	foreach($matches[0] as $match)
	{
		$string = str_replace($match, "<a href='$match'><span style='color:#5555ee'>$match</span></a>", $string);
	}
	echo $string;
?>