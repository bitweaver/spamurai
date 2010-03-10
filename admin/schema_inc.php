<?php

$tables = array(
  'spamurai_log' => "
	ip C(39) NOTNULL,
    user_id I4 NOTNULL,
    email C(255) NOTNULL,
	subject C(255),
	data    X NOTNULL,
	posted_date I8 NOTNULL
  ",
);

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( SPAMURAI_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( SPAMURAI_PKG_NAME, array(
	'description' => "A spam fighting package that uses the Akismet spam service",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );

// ### Default UserPermissions
$gBitInstaller->registerUserPermissions( SPAMURAI_PKG_NAME, array(
	array( 'p_spamurai_admin', 'Can admin spam', 'admin', SPAMURAI_PKG_NAME ),
	array( 'p_spamurai_moderate', 'Can moderate spam', 'editors', SPAMURAI_PKG_NAME ),
) );
?>
