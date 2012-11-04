<?php

use Stormwild\Multiply\Downloader;

require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

class DownloaderTest extends PHPUnit_Framework_TestCase {

	protected $downloader;
	
	public function setUp(){ 
		$this->downloader = new Stormwild/Multiply/Downloader();
	}
	
	public function tearDown(){ }
	
	public function testGetPageReturnsDownloadPage()
	{
		$content = $this->downloader->getPage();
		
		$this->assertTrue(strpos($content, 'Multiply Media Download') !== false);
	}
}