<?php


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