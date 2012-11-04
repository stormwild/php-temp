<?php

use Stormwild\Multiply\Downloader;

require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

$downloader = new Downloader();

//echo $downloader->getPage();

var_dump($downloader->getMatches());