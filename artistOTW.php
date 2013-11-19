<?php
	$handle = fopen("config/config.txt", "r");
	$contents = fread($handle, filesize("config/config.txt"));
	$configurations = explode("\r\n", $contents);
	foreach($configurations as $config)
	{
		$parts = explode("=", $config);
		if($parts[0] == "aotw")
			$aotw = $parts[1];
	}
	if(empty($aotw))
		return;
	header("Location:search.php?q=$aotw");
?>