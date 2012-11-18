<?php

set_time_limit(36000); // 10 hours

ini_set('memory_limit', '-1');

// @TODO use an autoloader 
require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

use Stormwild\Multiply\Downloader;

$error = '';

if($_POST) {
    
    if($_POST['start'] == 1) {

        $downloader = new Downloader();

        // This may take a long time. We need to find some way to show a progress bar or something.
        // To do that clicking submit should be an ajax call?
        $success = $downloader->run();
        
        // @TODO We should use try catch?
        // if success if false we see the same page
        // show an error message
        if($success) {            
            // redirect to success page
            http_redirect("success.html");
        } else {
            $error = "Something went wrong. We don't know what it is, check the downloads folder.";
        }
    }

}

?>
<!doctype html>
<html>
    <head>
        <title>Multiply Media Downloader</title>
    </head>
    <body>
    <h1>Multiply Media Downloader</h1>
    <p>If the download is successful you will be redirected to a success page. Otherwise an error message will be shown.</p>
    <form method="post" action="">
        <input name="start" type="hidden" value="1">
        <input type="submit" value="Submit">
    </form>
    <p><?php echo $error ? $error : ''; ?></p>
    </body>
</html>

