<?php

use Stormwild\Multiply\Downloader;

require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

$downloader = new Downloader();

//echo $downloader->getPage();

//var_dump($downloader->getMatches());

$matches = $downloader->getMatches();

//var_dump($matches);

?>
<p><?php echo $url = $matches[1][0]; ?></p>

<p><?php echo $pos = strpos($matches[1][0], '&name=/'); ?></p>

<p><?php echo $name = substr($matches[1][0], $pos + 7); ?></p>

<p><?php echo $fixed = rawurlencode($name); ?></p>

<p><?php echo substr_replace($url, $fixed, $pos + 7) ?></p>

