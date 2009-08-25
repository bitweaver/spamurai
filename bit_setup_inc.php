<?php

define ('SPAM_CHECKING', 'spam_checking');

global $gBitSystem, $gBitUser, $gBitThemes;

$registerHash = array(
	'package_name' => 'spamurai',
	'package_path' => dirname( __FILE__ ).'/',
);

$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'spamurai' ) ) {

	$menuHash = array(
		'package_name'  => SPAMURAI_PKG_NAME,
	);

	$gBitSystem->registerAppMenu( $menuHash );

	require_once(SPAMURAI_PKG_PATH.'Spamurai.php');
	
	$registerArray = array(
		'content_verify_function' => 'spamurai_content_verify',
	);

	$gLibertySystem->registerService( SPAM_CHECKING , SPAMURAI_PKG_NAME, $registerArray );

}
