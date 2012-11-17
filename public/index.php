<?php

// @TODO use an autoloader 
require_once(dirname(__DIR__) . '/src/Stormwild/Multiply/Downloader.php');

use Stormwild\Multiply\Downloader;

$error = '';

if($_POST) {
    
    if($_POST['start'] == 1) {

        $downloader = new Downloader();

        $success = $download->run();
        
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
    <form action="">
        <input name="start" type="hidden" value="1">
        <input type="submit" value="Submit">
    </form>
    <p><?php echo $error ? $error : ''; ?></p>
    </body>
</html>

