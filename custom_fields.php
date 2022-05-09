<?php
add_action( 'woocommerce_product_options_general_product_data', 'art_woo_add_custom_fields' );
function art_woo_add_custom_fields() {
	global $product, $post;
?>
	<h2><strong>Дополнительные данные о товаре:</strong></h2>
<?php
	woocommerce_wp_select( array(
		   'id'      => 'abelo_frequency',
		   'label'   => 'Product type',
		   'options' => array(
		      NULL   		=> __( '', 'woocommerce' ),
		      'rare'   		=> __( 'rare', 'woocommerce' ),
		      'frequent'   	=> __( 'frequent', 'woocommerce' ),
		      'unusual' 	=> __( 'unusual', 'woocommerce' ),
		   ),
		) );
?>

	<div class="options_group">
		<p class="form-field custom_field_type">
			<label for="custom_field_type">
				Дата товара:
			</label>
			<span class="wrap">
				<input 
					type="date"
					id="abelo_date"
					class="input-text wc_input_decimal"
					name="abelo_date"
					value="<?php echo esc_attr( get_post_meta( $post->ID, 'abelo_date', true ) ); ?>"
       				min="2018-01-01"
					style="width: 25%; margin-right: 2%;" />
			</span>
		</p>
	</div>

	<button 
		id="clear_fields" 
		type="button"
		class="button" 

	>
		Очистить поля
	</button>

	<button 
		id="update_product" 
		type="button"
		class="button" 
	>
		Обновить продукт
	</button>
<?php
}


add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );
function art_woo_custom_fields_save( $post_id ) {
	$product = wc_get_product( $post_id );

	$select_field = isset( $_POST['abelo_frequency'] ) ? sanitize_text_field( $_POST['abelo_frequency'] ) : '';
	$product->update_meta_data( 'abelo_frequency', $select_field );

	$text_field = isset( $_POST['abelo_date'] ) ? sanitize_text_field( $_POST['abelo_date'] ) : '';
	$product->update_meta_data( 'abelo_date', $text_field );

	$product->save();
}

add_action( 'woocommerce_before_add_to_cart_form', 'art_get_text_field_before_add_card' );
function art_get_text_field_before_add_card() {
	$product = wc_get_product();
	$pack_date = $product->get_meta( 'abelo_date', true );
	$frequency = $product->get_meta( 'abelo_frequency', true );

	if ($pack_date): ?>
		<div class="text-field">
			<strong>Дата: </strong>
			<?php echo $pack_date; ?>
		</div>
	<?php endif;
	if ($frequency): ?>
		<div class="text-field">
			<strong>Частота: </strong>
			<?php echo $frequency; ?>
		</div>
	<?php endif;
}
?>