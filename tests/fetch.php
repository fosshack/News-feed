<pre>
<?php

$db = new mysqli('localhost', 'root', 'root', 'fossnews');

$access_token = "454854978186521|lPS24dVPKcmSAUr81V_Xcn0uhwQ";

$news = "https://graph.facebook.com/?ids=FoxNews,CNNent,bbcnewsenglish,financialtimes,thehindu,logical.indian,thenewindianxpress&fields=feed.limit(15){message,caption,description,picture,link,updated_time}&access_token=$access_token";

$news_data = json_decode(file_get_contents($news),1);


$allarray = [];

echo "<hr>";

foreach ($news_data as $arr) 
{
	$allarray = array_merge($allarray, $arr['feed']['data']);
}

$c = 0;
$f = 0;

foreach ($allarray as $sub) {

	extract($sub);

	$query = sprintf("
		INSERT INTO tbl_news (object_id, message, caption, description, picture, link, updated_time) 
		VALUES 
		('%s','%s','%s','%s','%s','%s','%s');",
		d($id), d($message), d($caption), d($description), d($picture), d($link), d($updated_time)
		);

	if ($db->query($query)) 
	{
		$c++;
	} 
	else
	{
		$f++;
	}
}


function d($p)
{
	global $db;
	return $db->real_escape_string($p);
}

echo "[$c queries executed; $f queries failed]";