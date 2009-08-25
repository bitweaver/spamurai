<?php

global $gBitSystem;
if (!empty($_REQUEST['spamurai_api_key'])){

	$gBitSystem->storeConfig('spamurai_api_key',$_REQUEST['spamurai_api_key'],SPAMURAI_PKG_NAME);

}

$gBitSmarty->assign('apiKey',$gBitSystem->getConfig('spamurai_api_key') );




?>
