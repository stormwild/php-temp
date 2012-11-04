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


function curl($url, $cookie = null){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

$opts = array('http' => array(
 'method' => 'GET',
		'header' => array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Charset:ISO-8859-1,utf-8;
Connection:keep-alive
Cookie:initial_anon_referrer=http://www.google.com.ph/imgres%3fhl%3den%26sa%3dX%26rlz%3d1C1CHMO_tlPH502PH502%26biw%3d1920%26bih%3d955%26tbm%3disch%26prmd%3dimvns%26tbnid%3dh3LklStRRmgP3M:%26imgrefurl%3dhttp://chacuyong.multiply.com/photos/photo/197/10%26docid%3dTqs0XuQ4BpGZXM%26imgurl%3dhttp://multiply.com/mu/chacuyong/image/2/photos/197/400x400/10/p9-001.jpg%25253Fet%25253DSTmtUR5bCqCe0c3qyl2PSg%252526nmid%25253D185061077%26w%3d296%26h%3d400%26ei%3db5lYUPTNK-m5iQfW8oGABA%26zoom%3d1%26iact%3dhc%26vpx%3d1292%26vpy%3d117%26dur%3d3717%26hovh%3d261%26hovw%3d193%26tx%3d119%26ty%3d113%26sig%3d111867394586272386334%26page%3d1%26tbnh%3d137%26tbnw%3d105%26start%3d0%26ndsp%3d52%26ved%3d1t:429,r:7,s:0,i:91; language=en; __gads=ID=dac8d30496ab63f3:T=1347983742:S=ALNI_MbqQtl4j0aIfxFOx_Mhnhk9jip-Xw; remembermenocheck=0; uid=N:1:U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5cFHacCfM8JU%3d:cdtrealestate; sid=cdtrealestate:U2FsdGVkX1-ad6lK6q4zMEaYj-47oo7XVVvYplXUPPEkpNfE-0cOcxQ8MCIm-Y6i; mcim=cdtrealestate%26U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5RRQiw9ccb.XPzpS7WunOU.WEorYdIjlT; __utma=40390974.803256610.1347983740.1349949199.1350022409.21; __utmb=40390974.1.10.1350022409; __utmc=40390974; __utmz=40390974.1349949199.20.5.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); meebo-cim-session=25e6f3ba96d02ba21548; last_access=1350022424; session=1349877438:1349877438:1350022541:21:cdtrealestate:604800000
Host:cdtrealestate.multiply.com
Referer:http://cdtrealestate.multiply.com/
User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4')
));

$cookie = 'initial_anon_referrer=http://www.google.com.ph/imgres%3fhl%3den%26sa%3dX%26rlz%3d1C1CHMO_tlPH502PH502%26biw%3d1920%26bih%3d955%26tbm%3disch%26prmd%3dimvns%26tbnid%3dh3LklStRRmgP3M:%26imgrefurl%3dhttp://chacuyong.multiply.com/photos/photo/197/10%26docid%3dTqs0XuQ4BpGZXM%26imgurl%3dhttp://multiply.com/mu/chacuyong/image/2/photos/197/400x400/10/p9-001.jpg%25253Fet%25253DSTmtUR5bCqCe0c3qyl2PSg%252526nmid%25253D185061077%26w%3d296%26h%3d400%26ei%3db5lYUPTNK-m5iQfW8oGABA%26zoom%3d1%26iact%3dhc%26vpx%3d1292%26vpy%3d117%26dur%3d3717%26hovh%3d261%26hovw%3d193%26tx%3d119%26ty%3d113%26sig%3d111867394586272386334%26page%3d1%26tbnh%3d137%26tbnw%3d105%26start%3d0%26ndsp%3d52%26ved%3d1t:429,r:7,s:0,i:91; language=en; __gads=ID=dac8d30496ab63f3:T=1347983742:S=ALNI_MbqQtl4j0aIfxFOx_Mhnhk9jip-Xw; remembermenocheck=0; uid=N:1:U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5cFHacCfM8JU%3d:cdtrealestate; sid=cdtrealestate:U2FsdGVkX1-ad6lK6q4zMEaYj-47oo7XVVvYplXUPPEkpNfE-0cOcxQ8MCIm-Y6i; mcim=cdtrealestate%26U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5RRQiw9ccb.XPzpS7WunOU.WEorYdIjlT; __utma=40390974.803256610.1347983740.1349949199.1350022409.21; __utmb=40390974.1.10.1350022409; __utmc=40390974; __utmz=40390974.1349949199.20.5.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); meebo-cim-session=25e6f3ba96d02ba21548; last_access=1350022424; session=1349877438:1349877438:1350022541:21:cdtrealestate:604800000';
 
$context  = stream_context_create($opts);

$filename = 'http://cdtrealestate.multiply.com/download-media';

//$content = file_get_contents($filename, false, $context);

$content = curl($filename, $cookie);

//echo $content;

//die();

//$pattern = "/<a[^>]+>[^<]+<\/a>/i"; // 1457 this gets all links 

//$pattern = "/<a[^>]+href\=[\"'`][http:]?\/\/[^\"'`]+[\"'`]>([^<]+)<\/a>/i"; // 1330

$pattern = "/<a href\='([^>]+)'>([^<]+)<\/a>/i"; // 1453 this gets all media links

$subject = $content;

preg_match_all($pattern, $subject, $matches);

//print_r($matches);

//var_dump($matches);

foreach ($matches[1] as $match) : ?>

<p><?php echo $match; ?></p>

<?php endforeach; 

// parse content for matches for the url
// then download the file, see /Regex/temp/temp/CopyOfindex.php

foreach ($matches[1] as $match) : ?>

<p><?php echo $match; ?></p>


<?php 

// get the file and write it
$opts = array('http' => array(
		'method' => 'GET',
		'header' => array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3
Accept-Encoding:gzip,deflate,sdch
Accept-Language:en-US,en;q=0.8
Connection:keep-alive
Cookie:initial_anon_referrer=http://www.google.com.ph/imgres%3fhl%3den%26sa%3dX%26rlz%3d1C1CHMO_tlPH502PH502%26biw%3d1920%26bih%3d955%26tbm%3disch%26prmd%3dimvns%26tbnid%3dh3LklStRRmgP3M:%26imgrefurl%3dhttp://chacuyong.multiply.com/photos/photo/197/10%26docid%3dTqs0XuQ4BpGZXM%26imgurl%3dhttp://multiply.com/mu/chacuyong/image/2/photos/197/400x400/10/p9-001.jpg%25253Fet%25253DSTmtUR5bCqCe0c3qyl2PSg%252526nmid%25253D185061077%26w%3d296%26h%3d400%26ei%3db5lYUPTNK-m5iQfW8oGABA%26zoom%3d1%26iact%3dhc%26vpx%3d1292%26vpy%3d117%26dur%3d3717%26hovh%3d261%26hovw%3d193%26tx%3d119%26ty%3d113%26sig%3d111867394586272386334%26page%3d1%26tbnh%3d137%26tbnw%3d105%26start%3d0%26ndsp%3d52%26ved%3d1t:429,r:7,s:0,i:91; language=en; __gads=ID=dac8d30496ab63f3:T=1347983742:S=ALNI_MbqQtl4j0aIfxFOx_Mhnhk9jip-Xw; remembermenocheck=0; uid=N:1:U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5cFHacCfM8JU%3d:cdtrealestate; sid=cdtrealestate:U2FsdGVkX1-ad6lK6q4zMCwbdJFMiE6Fujq-kld9tV0PTFEjnx.9VL4CnIeb-kcH; mcim=cdtrealestate%26U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5RRQiw9ccb.XHwfLv-hsoYfLDZK3YO8ml; last_access=1351928464; __utma=40390974.803256610.1347983740.1351924078.1351928448.26; __utmb=40390974.1.10.1351928448; __utmc=40390974; __utmz=40390974.1351319369.23.7.utmcsr=facebook.com|utmccn=(referral)|utmcmd=referral|utmcct=/; session=1349877438:1349877438:1351928470:40:cdtrealestate:604800000
Host:multiply.com
User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4')
));

$context  = stream_context_create($opts);


echo 'http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG';

//$file = curl($match);

$file = curl('http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG');

//$file = file_get_contents('http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG', false, $context);

//$file = file_get_contents($match, false, $context);
//echo $match;

//echo $file;

$fp = fopen('images/downloadedfile.jpg', 'w');

fwrite($fp, $file);

fclose($fp);

break;
 
?>

<?php endforeach; 
