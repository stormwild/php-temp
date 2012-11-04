<?php

/**
 * Add the images in each album to its corresponding post.
 * Download all images from the download-media page into your local hard drive.
 * Upload the images and attach to its corresponding post.
 * 
 * How do we download the images?
 * 
 * We use a php script to get each linked file.
 * 
 * What php function do we use, curl or fopen? 
 * 
 * What filename do we use?
 * 
 * What regex do we use?
 * 
 * Some file names may be the same but different files. 
 * 
 * We can use the name param to use as filename.
 * 
 */

/* $pattern = "/^(\(\d{3}\)|^\d{3}[.-]?)?\d{3}[.-]?\d{4}$/";

//$subject = "(707)-827-7019  707%827%7019  707|827|7019  (717)-827-7019";

$subject = "(707)-827-7019";

var_dump($pattern);

var_dump($subject);

echo "==========================<br>";

echo 'If matches is provided, then it is filled with the results of search. $matches[0] will contain the text that matched the full pattern, $matches[1] will have the text that matched the first captured parenthesized subpattern, and so on.<br>';

preg_match($pattern, $subject, $matches);

var_dump($matches);

echo "==========================";

preg_match_all($pattern, $subject, $matches);

var_dump($matches);
 */
echo "===========================<br>";

//$pattern = "/<a[^>]+href\=([\"'`])(http[^>]+(?:multiply\.com|blogger\.com)[^>]+\.(?:jpg|jpeg|gif|png|tif))\1[^<]*?<img[^>]*src\=([\"'`])(http[^>]+(?:blogspot\.com|blogger\.com)[^>]+\.(?:jpg|jpeg|gif|png|tif))\3[^>]*>/i";

// CDT post
//$pattern = "/<a[^>]+href\=([\"'`])(http[^>]+(?:multiply\.com)[^>]+)\\1[^<]*?<img[^>]*src\=([\"'`])(http[^>]+(?:multiply\.com)[^>]+\.(?:jpg|jpeg|gif|png|tif|avi|m4v|wmv)[^>]+)\\1[^>]*>/i";

$pattern = "/<a[^>]+>[^<]+<\/a>/i"; // 1457

//$pattern = "/<a[^>]+href\=[\"'`][http:]?\/\/[^\"'`]+[\"'`]>([^<]+)<\/a>/i"; // 1330

// CDT Post
//$subject = '<span><a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1477"><img src="http://multiply.com/mu/cdtrealestate/image/+I3FagJVs-JZm-8mlBtLPQ/photos/1M/300x300/1477/Slide07.jpg?et=noM2i%2B%2BsnXHSENQ0%2CU4RXA&amp;nmid=0" alt="" border="0" /></a></span><span><a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1478"><img src="http://multiply.com/mu/cdtrealestate/image/wCvFCbKnsmTCwk9d34QXuA/photos/1M/300x300/1478/Slide08.jpg?et=5%2C6NeyJHU1ZvUscWmz4iwQ&amp;nmid=0" alt="" border="0" /></a></span><span><a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1479"><img src="http://multiply.com/mu/cdtrealestate/image/w5j-LtDq5Pt+2XbOS9u9JA/photos/1M/300x300/1479/Slide09.jpg?et=%2C0Wbg%2Bku65pyhCXQsCZr0Q&amp;nmid=0" alt="" border="0" /></a></span><span><a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1481"><img src="http://multiply.com/mu/cdtrealestate/image/dbfnrswZdrRDkjKyzTmmuA/photos/1M/300x300/1481/Slide11.jpg?et=9%2B%2CnPcZ74%2CBdqom6kRMH5w&amp;nmid=0" alt="" border="0" /></a></span><div></div>';

// Download media
//$subject = '<a href="//multiply.com/mu/cdtrealestate/image/VAP2PwCS9leb93iPSlJy8g/photos/21/orig/19/Kitchen.JPG?et=tkd6K%2BZaRP2ojOtiK8FHDQ&amp;nmid=0&amp;name=/1016-Kitchen.JPG">1016-Kitchen.JPG</a>';

//$subject = file_get_contents('download-media.php');

//$subject = file_get_contents("http://cdtrealestate.multiply.com/download-media/"); // doesn't work properly
/* 
$ch = curl_init("http://cdtrealestate.multiply.com/download-media"); // didnt work properly - it got the home page instead of the media page
$fp = fopen("download-media-curl.html", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

 */
//$subject = file_get_contents("download-media.htm");

/* $fp = fopen('download-media.html', 'w');
fwrite($fp, $subject);
fclose($fp);
 */
//var_dump($subject);

//preg_match_all($pattern, $subject, $matches);

//var_dump($matches[0]);
//var_dump($matches);


/* $opts = array('http' => array(
		'method' => 'GET',
		'header' => array(
				'Accept: text/html' .
				'Cookie: uid2=U2FsdGVkX1-ad6IK6q4zMI10cqvzGvx5hWq7n9LoFCnHDCLdYFx.VaFTWOIjFaDm;
					sid=cdtrealestate:U2FsdGVkX1-ad6IK6q4zMFEyFeceSbpWmvnkwabtcmc8dau5THhbnZatlZvlQhnj')
));

$context  = stream_context_create($opts);

$filename = 'http://cdtrealestate.multiply.com/download-media';

$content = file_get_contents($filename, false, $context);

echo $content; */

 