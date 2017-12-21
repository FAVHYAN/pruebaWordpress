<?php
/*
	Plugin Name: Nateevo
	Plugin URI: testing
	Description: Wordpress testing, multilanguage support
	Author: Favhyan
	Version: 1.0
	Text Domain:       nateevo-author-bio
    Domain Path:       /languages

*/


define( 'NATEEVO__PLUGIN_DIR', dirname(__FILE__) );

/*
* Language
*/
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( NATEEVO__PLUGIN_DIR . '\class.nateevo-languages.php' );
}
/*
* Creating a function to create CPT
*/
 
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( NATEEVO__PLUGIN_DIR . '\class.nateevo-admin.php' );
}
/*
* Creating a function to create Image
*/
 
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( NATEEVO__PLUGIN_DIR . '\class.nateevo-image.php' );
}
/*
* Creating a function to create custom field
*/
 
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( NATEEVO__PLUGIN_DIR . '\class.nateevo-custom-field.php' );
}


?>