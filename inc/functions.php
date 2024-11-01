<?php
/*
 * Cleans text from database
 */
function bwshortcodecreator_mynl2br($page_content) {
	//$page_content = nl2br($page_content);
	$page_content = htmlspecialchars_decode($page_content);
    $page_content = implode("",explode("\\",$page_content));
    $page_content = stripslashes(trim($page_content));
	return $page_content;
}
?>