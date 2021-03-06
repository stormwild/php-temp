<?php

require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

use Stormwild\Multiply\Downloader;

/**
 * This serves more as an integration test since it actually downloads the external url
 * @author Torrijos
 *
 */
class DownloaderTest extends PHPUnit_Framework_TestCase
{
    protected $downloader;

    protected $content;

    protected $matches;

    public function setUp()
    {
        $this->downloader = new Downloader();

        $this->content = $this->downloader->getPage();

        $this->matches = $this->downloader->getMatches();

    }

    public function tearDown(){ }

    public function testGetPage()
    {
        $this->assertTrue(strpos($this->content, 'Multiply Media Download') !== false);
    }

    public function testGetMatches()
    {
        $this->assertGreaterThan(0, count($this->matches[0]));
    }

    public function testFixUrl()
    {
        $url = $this->downloader->fixUrl($this->matches[1][0]);
        $this->assertEquals($url, 'http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG');
    }
    
    public function testDownloadFile()
    {
        $url = $this->downloader->fixUrl($this->matches[1][0]);
        $this->downloader->downloadFile($url);
        
        $file = dirname(__DIR__) . '/public/downloads/541-A.VENUE RESIDENCES PENTHOUSE 28-B.JPG';
        $flag = file_exists($file);
        
        
        $this->assertTrue($flag, 'File exists');
        
    }
}
