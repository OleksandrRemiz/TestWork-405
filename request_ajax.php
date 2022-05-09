<?php
add_action( 'admin_print_footer_scripts', 'clear_fields_action_javascript', 98 );
function clear_fields_action_javascript() {
global $product, $post;
$post_id=$post->ID;
	?>
	<script>
	jQuery(document).ready( function(){
		jQuery("#clear_fields").click( function(){
			jQuery("#abelo_frequency").val("");
			jQuery("#abelo_date").val("");

			var data = {
				action: 'clear_fields',
				post_id: <?= $post_id; ?>
			};
	
			jQuery.post( ajaxurl, data, function( response ){
			} );
		} );
	} );
	</script>
	<?php
}

add_action( 'wp_ajax_clear_fields', 'clear_fields_callback' );
function clear_fields_callback(){
	global $product, $post;
	delete_post_meta( $_POST['post_id'], "abelo_frequency" );
	delete_post_meta( $_POST['post_id'], "abelo_date" );
	wp_die();
}
?>