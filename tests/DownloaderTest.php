<?php

use Stormwild\Multiply\Downloader;

require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

class DownloaderTest extends PHPUnit_Framework_TestCase {

	protected $downloader;
	
	public function setUp() 
	{ 
		$this->downloader = new Downloader();
	}
	
	public function tearDown(){ }
	
	public function testGetPage()
	{
		$content = $this->downloader->getPage();		
		$this->assertTrue(strpos($content, 'Multiply Media Download') !== false);
	}
	
	public function testGetMatches()
	{		
		$matches = $this->downloader->getMatches();		
		$this->assertGreaterThan(0, count($matches[0]));
	}
}