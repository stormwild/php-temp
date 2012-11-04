<?php
/* $matches;

$innerT = "http[^>]+(?:cdtrealestate\.multiply\.com)[^>]+\.(?:jpg|jpeg|gif|png|tif)";
$pattern = "/<a[^>]+href\=([\"'`])(".$innerT.")\\1[^<]*?<img[^>]*src\=([\"'`])(".$innerT.")\\3[^>]*>/i";
$subject = <<<EOD
<a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1477"><img class="colorbox-6" border="0" src="http://multiply.com/mu/cdtrealestate/image/+I3FagJVs-JZm-8mlBtLPQ/photos/1M/300x300/1477/Slide07.jpg?et=noM2i%2B%2BsnXHSENQ0%2CU4RXA&amp;nmid=0"></a>";
EOD;



preg_match($pattern, $subject, $matches);

var_dump($pattern);

var_dump($matches);
 */
echo "========================================================================================================";

$matches = array();

$pattern = "/<a[^>]+href\=([\"'`])(http:\/\/(cdtrealestate\.multiply\.com|multiply\.com)[^>])[^<]*?<img[^>]*src\=([\"'`])(http:\/\/(cdtrealestate\.multiply\.com|multiply\.com))[^>]*>/i";

$subject = <<<EOD
<a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1477"><img class="colorbox-6" border="0" src="http://multiply.com/mu/cdtrealestate/image/+I3FagJVs-JZm-8mlBtLPQ/photos/1M/300x300/1477/Slide07.jpg?et=noM2i%2B%2BsnXHSENQ0%2CU4RXA&amp;nmid=0"></a>";
<a href="http://cdtrealestate.multiply.com/photos/hi-res/1M/1478"><img class="colorbox-6" border="0" src="http://multiply.com/mu/cdtrealestate/image/wCvFCbKnsmTCwk9d34QXuA/photos/1M/300x300/1478/Slide08.jpg?et=5%2C6NeyJHU1ZvUscWmz4iwQ&amp;nmid=0"></a>
EOD;

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

var_dump($matches);
