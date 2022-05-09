<?php
function true_image_uploader_field( $args ) {
	$value = get_option( $args[ 'name' ] );
	$value = $args[ 'value' ];
	$default = get_stylesheet_directory_uri() . '/placeholder.png';
 
	if( $value && ( $image_attributes = wp_get_attachment_image_src( $value, array( 150, 110 ) ) ) ) {
		$src = $image_attributes[0];
	} else {
		$src = $default;
	}
	echo '
	<div>
		<img data-src="' . $default . '" src="' . $src . '" width="150" />
		<div>
			<input type="hidden" name="' . $args[ 'name' ] . '" id="' . $args[ 'name' ] . '" value="' . $value . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">×</button>
		</div>
	</div>
	';
}

/*
 * Добавляем метабокс
 */
add_action( 'add_meta_boxes', 'true_meta_boxes_u' );
function true_meta_boxes_u() {
	add_meta_box( 'truediv', 'Настройки', 'true_print_box_u', 'product', 'normal', 'high' );
}
 
/*
 * Заполняем метабокс
 */
function true_print_box_u( $post ) {
	if( function_exists( 'true_image_uploader_field' ) ) {
		true_image_uploader_field( array(
			'name' => 'uploader_custom',
			'value' => get_post_meta( $post->ID, 'uploader_custom', true ),
		) );
	}
}
 
/*
 * Сохраняем данные произвольного поля
 */
add_action('save_post', 'true_save_box_data_u');
function true_save_box_data_u( $post_id ) {
	if( isset( $_POST[ 'uploader_custom' ] ) ) {
		update_post_meta( $post_id, 'uploader_custom', absint( $_POST[ 'uploader_custom' ] ) );
	}
	return $post_id;
}
?>