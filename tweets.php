<?php
require_once('twitter_library/twitteroauth.php'); // Get it from: https://github.com/themattharris/tmhOAuth
 
// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)
 	$consumer_key = 'gwAWD1g2nqdL43JE5SYe8Q';
	$consumer_secret = 'MYpnBZS2iLEKZSkmvxbFxWOX67m98QpGAx6z6LvM';
	$user_token = '2198271439-HZ6Ps7zeJzHT3IrnGyhR7KSbeV76nvz8Alnv5gZ'; //access token
	$user_secret = '8nWXAPHeiKuOL37xoOpczWzouEunTk3pwD8wwwYEWiItn';
 
$connection = new TwitterOAuth($consumer_key,$consumer_secret,$user_token,$user_secret);
 
// set up parameters to pass

 
if (isset($_POST['count'])) {
	$count = strip_tags($_POST['count']);
}
 
if (isset($_POST['screen_name'])) {
	$screen_name = strip_tags($_POST['screen_name']);
}

$handle = fopen("config/config.txt", "r");
$contents = fread($handle, filesize("config/config.txt"));
$configurations = explode("\r\n", $contents);
foreach($configurations as $config)
{
	$parts = explode("=", $config);
	if($parts[0] == "python")
		$pythonSource = $parts[1];
}

$new_screen_name = rtrim(shell_exec($pythonSource."python scripts/twitterusercrawler.py $screen_name"));

if($new_screen_name == '$none$')
{
	echo "<h3 class='text-danger'>This band does not have a Twitter account!</h3>";
	return;
}

$tweets = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$new_screen_name.'&count='.$count);
// print_r($tweets);
echo '<div class="col-md-2" align="center"><h3>Name: <span class="text-info">'.ucwords(strtolower($tweets[0]->user->name)).'</span></h3><br>';
echo '<img src='.$tweets[0]->user->profile_image_url_https.' height="100" ><br>';
echo '<br><h3>Followers: <span class="text-info">'.$tweets[0]->user->followers_count.'</span></h3><br></div>';
echo "<div class='col-md-10'><table>";
$counter = 0;
foreach($tweets as $tweet)
{
		if($counter%2 == 0)
		{
			echo "<tr>";
		}
		echo '<td><strong>Date: </strong>';
		$t = strtotime($tweet->created_at);
		echo date('d/m/y H:i:s',$t).'<br>';
		echo '<h4>Tweet: </h4>';
		echo "<p class='text-info'>".$tweet->text."</p></td>";
		if($counter%2 == 1)
		{
			echo "</tr>";
		}
		$counter++;
}
echo "</div>";
 
?>