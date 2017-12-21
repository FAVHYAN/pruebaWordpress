<?php

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


?>