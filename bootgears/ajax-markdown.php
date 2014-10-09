<?php 
require_once dirname(__FILE__).'/inc/globals.php';

// TODO: implement that!
//authAllowAuthenticated();
header('Content-Type: text/html; charset=utf8');

$aText = isset($_REQUEST['text']) ? $_REQUEST['text'] : '';
$aHtml = MarkdownExtended($aText);

echo $aHtml;
?>