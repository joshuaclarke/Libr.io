<?php

libxml_use_internal_errors(true);
$myXMLData =
"<?xml version='1.0' encoding='UTF-8'?>
<document>
<user>John Doe</user>
<email>john@example.com</email>
</document>"; 

$xml = simplexml_load_file("https://framabookin.org/b/opds/newest/");
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    /*foreach ($truc as $xml) {
		echo $truc;
	}*/
	foreach($xml as $item){
		echo "<article><h2>".$item->title."</h2><p><i>".$item->author->name."</i></p><p>".$item->content."</p>";
	}
}

?>
