<?php

namespace Stormwild\Multiply;

/**
 * Downloads media files from Multiply download-media page
 * @author Alexander R. Torrijos
 *
 */
class Downloader
{
    protected $pattern = "/<a href\='([^>]+)'>([^<]+)<\/a>/i";

    protected $content = "";

    protected $cookie = 'initial_anon_referrer=http://www.google.com.ph/imgres%3fhl%3den%26sa%3dX%26rlz%3d1C1CHMO_tlPH502PH502%26biw%3d1920%26bih%3d955%26tbm%3disch%26prmd%3dimvns%26tbnid%3dh3LklStRRmgP3M:%26imgrefurl%3dhttp://chacuyong.multiply.com/photos/photo/197/10%26docid%3dTqs0XuQ4BpGZXM%26imgurl%3dhttp://multiply.com/mu/chacuyong/image/2/photos/197/400x400/10/p9-001.jpg%25253Fet%25253DSTmtUR5bCqCe0c3qyl2PSg%252526nmid%25253D185061077%26w%3d296%26h%3d400%26ei%3db5lYUPTNK-m5iQfW8oGABA%26zoom%3d1%26iact%3dhc%26vpx%3d1292%26vpy%3d117%26dur%3d3717%26hovh%3d261%26hovw%3d193%26tx%3d119%26ty%3d113%26sig%3d111867394586272386334%26page%3d1%26tbnh%3d137%26tbnw%3d105%26start%3d0%26ndsp%3d52%26ved%3d1t:429,r:7,s:0,i:91; language=en; __gads=ID=dac8d30496ab63f3:T=1347983742:S=ALNI_MbqQtl4j0aIfxFOx_Mhnhk9jip-Xw; remembermenocheck=0; uid=N:1:U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5cFHacCfM8JU%3d:cdtrealestate; sid=cdtrealestate:U2FsdGVkX1-ad6lK6q4zMEaYj-47oo7XVVvYplXUPPEkpNfE-0cOcxQ8MCIm-Y6i; mcim=cdtrealestate%26U2FsdGVkX1-ad6lK6q4zMI10cqvzGvx5RRQiw9ccb.XPzpS7WunOU.WEorYdIjlT; __utma=40390974.803256610.1347983740.1349949199.1350022409.21; __utmb=40390974.1.10.1350022409; __utmc=40390974; __utmz=40390974.1349949199.20.5.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); meebo-cim-session=25e6f3ba96d02ba21548; last_access=1350022424; session=1349877438:1349877438:1350022541:21:cdtrealestate:604800000';

    protected $url = 'http://cdtrealestate.multiply.com/download-media';

    public function __construct()
    {
    }

    /**
     * Convenience method for curl
     * @param  string $url
     * @param  string $cookie
     * @return mixed
     */
    protected function curl($url, $cookie = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * Downloads the Multiply Media Download page.
     * The page contains all the links to the media files uploaded by the user.
     * We need to get the page to be able to get all the links to the files to be downloaded.
     *
     */
    public function getPage()
    {
        return $this->curl($this->url, $this->cookie);
    }

    /**
     * Returns matches to the pattern
     * @return array
     */
    public function getMatches()
    {
        preg_match_all($this->pattern, $this->getPage(), $matches);

        return $matches;
    }

    /**
     * Before we can download the files we need to fix the url passed to curl.
     * There are two kinds of url:
     *
     * '//multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE RESIDENCES PENTHOUSE 28-B.JPG'
     * 'http://images.cdtrealestate.multiply.com/content/movie/cdtrealestate:video:2/cdtrealestate/2.avi/6L,oC,xvgmSRj4dzPtgJ0w/Antel%20Group%20Presentation.avi?nmid=&name=/32-Antel Group Presentation.avi'
     *
     * The above urls fail to load.
     *
     * This one works because it has an http: and the name value is url encoded
     * http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG
      * http://multiply.com/mu/cdtrealestate/image/dpUPQaux4VpuBfs0osqmVw/photos/62/orig/1/A.VENUE-RESIDENCES-PENTHOUSE-28-B.JPG?et=h8l89aAisIdjy0PXR%2CiIZA&nmid=0&name=/541-A.VENUE%20RESIDENCES%20PENTHOUSE%2028-B.JPG
     *
     * We need a function to fix the urls in the matched urls prior to download.
     *
     *
     */

    /**
     * Fixes url by prepending http: and url encoding name
     * @param  string $url
     * @return string $url
     */
    public function fixUrl($url)
    {
        // Add http: if none found
        if (strpos($url, 'http:') === false) {
            $url = 'http:' . $url;
        }

        // Get the name value in the url
        $pos = strpos($url, '&name=/');

        $name = substr($url, $pos + 7);

        $fixed = rawurlencode($name);

        $url = substr_replace($url, $fixed, $pos + 7);

        return $url;
    }

    public function downloadFile($url)
    {
        $file = curl($url);
        
        // @TODO get the file name from the url and use it when creating the file
        $fp = fopen('path/to/download/filename.ext', 'w');
        
        fwrite($fp, $file);
    }

}
