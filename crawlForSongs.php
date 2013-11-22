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
	$songString = shell_exec($pythonSource."python scripts\\songcrawler.py $bandname");
    $songs = explode("|", $songString);
    echo "<table class='table table-hover table-bordered table-striped'>";
    for($i = 0; $i < count($songs); $i++)
    {
    	if($i%5 == 0)
    		echo "<tr>";
    	echo "<td><span class='glyphicon glyphicon-music'></span> ".str_replace("%27", "'", $songs[$i])."</td>";
    	if($i%5 == 1)
    		echo "</td>";
    }
    echo "</table>"
?>