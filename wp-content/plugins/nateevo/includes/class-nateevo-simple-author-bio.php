<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


require_once NATEEVO_SAB_PATH_INCLUDE.'class-nateevo-sab-admin-form.php';
require_once NATEEVO_SAB_PATH_INCLUDE.'class-nateevo-sab-contact-methods.php';
require_once NATEEVO_SAB_PATH_INCLUDE.'simple_html_dom.php';

class nateevo_Simple_Author_Bio{


	private $nateevo_admin_form;
	private $nateevo_contact_methods;
	private $nateevo_options;

	public function __construct(){

		$this->nateevo_admin_form  	= new nateevo_Sab_Admin_Form();
		$this->nateevo_contact_methods = new nateevo_Contact_Methods();
		$this->nateevo_options 		= get_option( 'nateevo_sab_bd_options' );

		add_action( 'admin_init', 			[$this->nateevo_admin_form,'nateevo_sab_admin_init'] );
		add_action( 'init',					[$this,'nateevo_sab_tranlation'] );
		add_action( 'admin_menu',			[$this,'nateevo_sab_add_menu'] );
		add_action( 'wp_enqueue_scripts', 	[$this,'nateevo_sab_load_scripts_css'] );

		add_filter( 'the_content',			[$this,'nateevo_sab_add_content_bio'] );
		add_filter( 'plugin_action_links_'. plugin_basename(NATEEVO_SAB_PATH_PLUGIN),  [$this,'nateevo_sab_add_link_settings']);
		add_filter( 'user_contactmethods', 	[$this->nateevo_contact_methods,'nateevo_sab_add_social_fields'] );

		register_activation_hook( nateevo_SAB_PATH_PLUGIN, [ $this, 'nateevo_sab_activate' ] );

	}


	/*
	*  Load CSS
	*/
    public function nateevo_sab_load_scripts_css() {

    	if ( isset( $this->nateevo_options['nateevo_sab_chk_load_fontawesome'] ) ){
        	wp_enqueue_style( 'sab_font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    	}

    	if ( isset( $this->nateevo_options['nateevo_sab_chk_load_css'] ) ){
        	wp_enqueue_style( 'sab_custom_css', plugins_url( '../css/style.css', __FILE__ )  );
    	}
    
    }


	/*
	*  Create item menu plugin
	*/
	public function nateevo_sab_add_menu(){

		add_options_page(__('Author Biography Options','nateevo-simple-author-bio'), 
							__('Author Bio','nateevo-simple-author-bio'), 
							'manage_options', 
							'nateevo_sab_options', 
							[$this, 'nateevo_sab_settings_page'] 
							);
	}



	/*
	*	Add settings link in list plugins
	*/
	public function nateevo_sab_add_link_settings( $links ) 
	{
        $links[] = '<a href="'.admin_url( 'options-general.php?page=nateevo_sab_options' ).'">'.__('Settings').'</a>';

	    return $links;
	}


	/*
	*  Create plugin controls
	*/
	public function nateevo_sab_settings_page(){
		$this->nateevo_admin_form->nateevo_sab_create_admin_form();	
	}

	
	/*
	*  Add info author to content
	*/
	public function nateevo_sab_add_content_bio( $content ){

		if ( is_single() ){

			remove_filter( current_filter(), __FUNCTION__ );

			$hide_author	= isset( $this->nateevo_options['nateevo_sab_chk_hide_author'] );

			$show_all_posts	= isset( $this->nateevo_options['nateevo_sab_chk_show_view_all'] );
			$show_social 	= isset( $this->nateevo_options['nateevo_sab_chk_show_social'] );

			
			if ( get_the_author_meta('description') == '' &&  $hide_author ){
				return $content;
			}

			return $content.$this->get_author_bio( $show_social, $show_all_posts );

		}
		
		return $content;

	}


	/*
	*  Replace strings in template box-author-bio.txt
	*/
	private function get_author_bio( $show_social, $show_all_posts ){
		
		$template = file_get_html( NATEEVO_SAB_PATH_TEMPLATE );

		// General validation
		if ( empty($template) ) 	return;

		if ( ! $show_all_posts )	$template->find('.nateevo_author-show-all')[0]->outertext = '';
		if ( ! $show_social ) 		$template->find('.nateevo_author-social')[0]->outertext = '';


		$search		= ['{title}','{avatar}','{description}'];

		$replace 	= [];
		$replace[] 	= get_the_author();
		$replace[] 	= get_avatar( get_the_author_meta( 'user_email' ) );
		$replace[] 	= get_the_author_meta( 'description');



		if ( $show_all_posts ){
			$search 	=  array_merge($search, ['{show-all-author-url}','{show-all-author-text}']);
			
			$replace[]	= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$replace[]	= __('View all posts','nateevo_simple_author_bio');
		}


		if ( $show_social ){

			$social_networks = $this->nateevo_contact_methods->nateevo_sab_social;
			
			foreach ( $social_networks as $key => $value){

				$social_url = get_the_author_meta($key);

				if ( empty($social_url) ){
					$template->find('.author-'.$key)[0]->outertext = '';
				}
				else{
					$search[]	= '{'.$key.'}';
					$replace[]	= filter_var( $social_url  , FILTER_VALIDATE_URL) ? $social_url : 'https://'.$key.'.com/'.$social_url;
				}

			}

		}

		return str_replace( $search, $replace, $template );
	}


	/*
	*  Load traduction
	*/
	public function nateevo_sab_tranlation(){

		load_plugin_textdomain('simple-author-bio', false, NATEEVO_SAB_PATH_LANGUAGE );

	}


	/*
	*  Activation function
	*/
	public function nateevo_sab_activate(){
			
			//delete_option('nateevo_sab_bd_options');

			$options 	= get_option('nateevo_sab_bd_options');

			if ( empty($options) ){

			 	$options = [
			 				'nateevo_sab_chk_show_social' 		=> 'on',
			 				'nateevo_sab_chk_show_view_all'	=> 'on',
			 				'nateevo_sab_chk_load_css'			=> 'on',
			 				'nateevo_sab_chk_load_fontawesome'	=> 'on',
		 			];

				update_option('nateevo_sab_bd_options',$options);

			}
	}

	
}



