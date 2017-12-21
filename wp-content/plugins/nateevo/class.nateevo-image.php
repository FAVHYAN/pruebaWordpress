<?php 


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
            echo '<img src="'.$value.'"  style="width:150px;height:100px" />'; 
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


?>