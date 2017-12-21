<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Nateevo_Sab_Admin_Form{

	private $options;


	public function nateevo_sab_create_admin_form(){

		$this->options = get_option( 'nateevo_sab_bd_options' );

		?>
		<div class="wrap">

			<h2><?php _e('Simple Author Bio','simple-author-bio') ?></h2>
			
			<form action="options.php" method="post">
				<?php
					
					settings_fields('nateevo_sab_options_group');
					do_settings_sections('nateevo_sab_options');

					submit_button();
				?>
			</form>
		</div>

		<?php

	}

	
	public function nateevo_sab_admin_init(){

		register_setting('nateevo_sab_options_group', 
							'nateevo_sab_bd_options');
		
		// Basic
		add_settings_section('nateevo_sab_basic_section', 
							__('Basic Configuration','simple-author-bio'), 
							[$this,'nateevo_sab_section_callback_basic'], 
							'nateevo_sab_options' );

		// Advanced
		add_settings_section('nateevo_sab_advanced_section', 
							__('Advanced Configuration','simple-author-bio'), 
							[$this, 'nateevo_sab_section_callback_advanced'], 
							'nateevo_sab_options' );

		// Fields
		$this->nateevo_sab_add_setting_field( __('Hide author without description','simple-author-bio'), 
											'nateevo_sab_chk_hide_author', 
											'nateevo_sab_basic_section',
											__('You can fill this info in your profile','simple-author-bio'));

		$this->nateevo_sab_add_setting_field( __('Show social network box','simple-author-bio'), 
											'nateevo_sab_chk_show_social', 
											'nateevo_sab_basic_section',
											__('social icons in front-end','simple-author-bio'));

		$this->nateevo_sab_add_setting_field( __('Show link view all posts','simple-author-bio'), 
											'nateevo_sab_chk_show_view_all', 
											'nateevo_sab_basic_section',
											__('author\'s posts link in front-end','simple-author-bio'));
		
		$this->nateevo_sab_add_setting_field( __('Load FontAwesome','simple-author-bio'), 
											'nateevo_sab_chk_load_fontawesome', 
											'nateevo_sab_advanced_section',
											__('If your theme loads FontAwesome uncheck this','simple-author-bio'));
		
		$this->nateevo_sab_add_setting_field( __('Load Default CSS','simple-author-bio'), 
											'nateevo_sab_chk_load_css', 
											'nateevo_sab_advanced_section',
											__('Default CSS file plugin','simple-author-bio'));

	}


	public function nateevo_sab_check_fields( $args ){

		$field 		 = $args[0];
		$msg		 = $args[1];

		$field_value = isset($this->options[$field]);

		echo '<input id="'.$field.'" name="nateevo_sab_bd_options['.$field.']" '.checked($field_value, true, false).' type="checkbox" />';
		
		if ( !empty($msg) ) echo ' <i>'.$msg.'</i>';

	}


	public function nateevo_sab_add_setting_field( $field_text , $field_name , $section , $message = '', $type = 'check'){

		add_settings_field('nateevo_sab_fields_'.$field_name, 

							__( $field_text ,'simple-author-bio'), 

							[$this,'nateevo_sab_'.$type.'_fields'], 
							'nateevo_sab_options', 
							$section,
							[ $field_name, $message ]);
	}


	public function nateevo_sab_section_callback_advanced(){
		echo '<hr/>';
		echo '<span><span class="dashicons dashicons-arrow-right"></span>'.sprintf(__('You can modify the template: %s', 'simple-author-bio'),'  /wp-content/plugins/nateevo_simple_author_bio/template/box-author-bio.txt').'</span>';
	}

	public function nateevo_sab_section_callback_basic(){
		echo '<hr/>';
		echo '<span><span class="dashicons dashicons-arrow-right"></span>'.__('You can see additional social networks in your profile', 'simple-author-bio').'</span>';
	}

}

