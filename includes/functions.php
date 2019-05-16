<?php
namespace lsx_health_plan\functions;
/**
 * LSX Health Plan functions.
 *
 * @package lsx-health-plan
 */


/**
 * Checks to see if the current item has connected values.
 *
 * @param string $post_id
 * @param string $meta_key
 * @param boolean $single
 * @return boolean
 */
function has_attached_post( $post_id = '', $meta_key = '', $single = true ){
    $has_post = false;
    if ( '' === $post_id ) {
        $post_id = get_the_ID();
	}
	$items = get_post_meta( $post_id, $meta_key, $single );
	if ( '' !== $items && false !== $items && 0 !== $items ) {
		$has_post = true;
	}
    return $has_post;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( 'lsx_health_plan_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'lsx_health_plan_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}


/**
 * Add Lets Enrypt and Peach Payments logos to cart
 **/

add_action( 'woocommerce_checkout_after_order_review', function() {
	$encript_image = LSX_HEALTH_PLAN_URL . 'assets/images/le-logo.svg';
	$peach_image   = LSX_HEALTH_PLAN_URL . 'assets/images/peach-payments-logo.svg';
	?>
	<div class="row text-center vertical-align">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<img src="<?php echo esc_url( $encript_image ); ?>" alt="lets_encrypt"/>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<img src="<?php echo esc_url( $peach_image ); ?>" alt="peach_payments"/>
		</div>
	</div>
	<?php
});
