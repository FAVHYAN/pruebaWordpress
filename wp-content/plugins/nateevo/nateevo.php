<?php
/*
	Plugin Name: Nateevo
	Plugin URI: testing
	Description: Wordpress testing, multilanguage support
	Author: Favhyan
	Version: 1.0

*/


/*
* Creating a function to create our CPT
*/
 
add_action( 'init', 'custom_post_type', 0 );

function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
                'name' => 'Products',
                'singular_name' => 'Products',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Products',
                'edit' => 'Edit',
                'edit_item' => 'Edit Products',
                'new_item' => 'New Products',
                'view' => 'View',
                'view_item' => 'View Products',
                'search_items' => 'Search Products',
                'not_found' => 'No Products found',
                'not_found_in_trash' => 'No Products found in Trash',
                'parent' => 'Parent Products'
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Products', 'twentythirteen' ),
        'description'         => __( 'Products news and reviews', 'twentythirteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 
        	'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'          => array( 'genres','Attributes' ),

        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 15,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'menu_icon' => 'dashicons-cart',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'products', $args );
	


    /*******************************************************
	
	// Add new taxonomy, Genreshierarchical 


	*******************************************************/
	register_taxonomy( 'genre', array( 'products' ), $args );

	$labels = array(
		'name'                       => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Genres', 'textdomain' ),
		'popular_items'              => __( 'Popular Genres', 'textdomain' ),
		'all_items'                  => __( 'All Genres', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Genre', 'textdomain' ),
		'update_item'                => __( 'Update Genre', 'textdomain' ),
		'add_new_item'               => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'              => __( 'New Genre Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
		'not_found'                  => __( 'No writers found.', 'textdomain' ),
		'menu_name'                  => __( 'Genres', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'Genre' ),
	);

    register_taxonomy( 'genre', array( 'products' ), $args );


    /*******************************************************
	
	// Add new taxonomy, Attribute NOT hierarchical (like tags)


	*******************************************************/

	$labels = array(
		'name'                       => _x( 'Attributes', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'attribute', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Attributes', 'textdomain' ),
		'popular_items'              => __( 'Popular Attributes', 'textdomain' ),
		'all_items'                  => __( 'All Attributes', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit attribute', 'textdomain' ),
		'update_item'                => __( 'Update attribute', 'textdomain' ),
		'add_new_item'               => __( 'Add New attribute', 'textdomain' ),
		'new_item_name'              => __( 'New attribute Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
		'not_found'                  => __( 'No writers found.', 'textdomain' ),
		'menu_name'                  => __( 'Attributes', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'attribute' ),
	);

    register_taxonomy( 'attributes', array( 'products' ), $args );


    /*******************************************************
	
	// Add new taxonomy, Attribute 


	*******************************************************/

    $labels = array(
		'name'                       => _x( 'Attribute', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'attribute', 'taxonomy singular name', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit attribute', 'textdomain' ),
		'update_item'                => __( 'Update attribute', 'textdomain' ),
		'add_new_item'               => __( 'Add New attribute', 'textdomain' ),
		'new_item_name'              => __( 'New attribute Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
		'not_found'                  => __( 'No writers found.', 'textdomain' ),
		'menu_name'                  => __( 'Attribute', 'textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'args'				  => array('orderby' => 'term_order'),
        'public'              => true,
        'has_archive'         => true,
        'show_ui'             => true,
        'show_in_menu'        => false,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'publicly_queryable'  => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
        'exclude_from_search' => false,
	);

    register_taxonomy( 'attribute', array( 'products' ), $args );
 
}
    /*******************************************************
	
	// Add new taxonomy, Images 


	*******************************************************/

add_image_size( 'admin-list-thumb', 80, 80, false );

// add featured thumbnail to admin post columns
function wpcs_add_thumbnail_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'author' => 'Author',
        'Genres' => 'Genres',
        'Attributes' => 'Attributes',
        'featured_thumb' => 'Thumbnail',
        'date' => 'Date'
    );
    return $columns;
}

function add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_thumb':
        echo '<a href="' . get_edit_post_link() . '">';
        // echo the_post_thumbnail( 'admin-list-thumb' );
          $key_values = get_post_custom_values( 'cf_image_post' );
		  foreach ( $key_values as $key => $value ) {
		    echo '<img src="'.$value.'"  style="width:150px;" />'; 
		  }
        echo '</a>';
        break;
    }
}


if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'wpcs_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'add_thumbnail_columns_data', 10, 2 );
    add_filter( 'manage_pages_columns' , 'wpcs_add_thumbnail_columns' );
    add_action( 'manage_pages_custom_column' , 'add_thumbnail_columns_data', 10, 2 );
}


   /*******************************************************
	
	// Register the Meta box


	*******************************************************/

function cf_get_custom_field( $value ) {
	global $post;

    $custom_field = get_post_meta( $post->ID, $value, true );
    if ( !empty( $custom_field ) )
	    return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    return false;
}


function add_custom_meta_box() {
	add_meta_box( 'cf-meta-box', __( 'Campos Adicionales', 'cf' ), 'custom_fields', 'products', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );


/**
 * Output the Meta box
 */
function custom_fields( $post ) {
	// create a nonce field
	wp_nonce_field( 'meta_box_nonce', 'meta_box_nonce' ); ?>
	
	<p>
		<label for="cf_date"><?php _e( 'Selecciona Fecha', 'cf' ); ?>:</label>
		<input type="date" name="cf_date" id="cf_date" value="<?php echo cf_get_custom_field( 'cf_date' ); ?>" size="50" />
    </p>
	
	<p>
	<?php
		  $url =get_post_meta($post->ID,'cf_image_post', true);   
    ?>
        <label>Selecciona Imagen: </label>
    <input id="cf_image" name="cf_image" type="text" value="<?php echo $url;?>"  style="width:400px;" />

    <input id="btn-send" type="button" value="Upload Image" /><br/><img src="<?php echo $url;?>" style="width:200px;" id="cf_image_thumbnail" />
    <script>
    jQuery(document).ready( function( $ ) {
        jQuery('#btn-send').click(function() {

            window.send_to_editor = function(html) {
                imgurl = jQuery(html).attr('src')
                jQuery('#cf_image').val(imgurl);
                jQuery('#cf_image_thumbnail').attr("src",imgurl);
                tb_remove();
            }

            formfield = jQuery('#cf_image').attr('name');
            tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
            return false;
        });

    });
    </script>
    </p>
	
	<p>
		<label for="cf_description"><?php _e( 'Texto Enriquecido', 'cf' ); ?>:</label><br />
		<textarea name="cf_description" id="cf_description" cols="100" rows="4"><?php echo cf_get_custom_field( 'cf_description' ); ?></textarea>
    </p>
    
	<?php


}


/**
 * Save the Meta box values
 */
function cf_meta_box_save( $post_id ) {
	// Stop the script when doing autosave
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Verify the nonce. If insn't there, stop the script
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'meta_box_nonce' ) ) return;

	// Stop the script if the user does not have edit permissions
	if( !current_user_can( 'edit_post', get_the_id() ) ) return;

    // Save the textfield
	if( isset( $_POST['cf_date'] ) )
		update_post_meta( $post_id, 'cf_date', esc_attr( $_POST['cf_date'] ) );

    // Save the Image
	 if (isset($_POST['cf_image'])){
        update_post_meta($post_id, 'cf_image_post',$_POST['cf_image']);
    }

    // Save the textarea
	if( isset( $_POST['cf_description'] ) )
		update_post_meta( $post_id, 'cf_description', esc_attr( $_POST['cf_description'] ) );
}


add_action( 'save_post', 'cf_meta_box_save' );




?>