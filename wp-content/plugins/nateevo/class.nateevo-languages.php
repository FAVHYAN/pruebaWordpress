<?php



add_action('init', 'plugin_load_textdomain');

function plugin_load_textdomain() {
	
	$text_domain	= 'nateevo-author-bio';
	$path_languages = basename(dirname(__FILE__)).'/languages/';

	load_plugin_textdomain($text_domain, false, $path_languages );
}


?>