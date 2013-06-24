<plaintext>
<?php
$urls = array(
	"svg" => "//html5sec.org/test.svg",
	"gif" => "//html5sec.org/test.gif",
	"xml" => "//htmlsec.org/test.xml",
	"jar" => "//html5sec.org/test.jar",
);

function parse_accept($header) {
	$media_ranges = explode(",", $header);
	foreach ($media_ranges as $mr) {
		$mr = array_reverse(explode(";", $mr)); // each media-request "type/subtype; q=xy" is now split and reversed
		if (count($mr) == 1) {
			$mr = array("q=1.0", $mr); // none = highest priority
		}
		$mr[0] = floatval(str_replace("q=","", $mr[0])); // make float out of q=xx
	}	
	arsort($media_ranges);
	print_r($media_ranges);

}

if (isset($_SERVER['HTTP_ACCEPT'])) {
	print_r ($_SERVER['HTTP_ACCEPT']);
	$h = parse_accept($_SERVER['HTTP_ACCEPT']);
//	switch ($h) {
//		case 
//	}
}
else {
// everything is accepted. use HTML
header("Location: "); 
}

?>
