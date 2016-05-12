add_action( 'woocommerce_before_cart', 'eggemplo_woocommerce_before_cart' );

function eggemplo_woocommerce_before_cart() {
	global $woocommerce;

	if ( !class_exists("Affiliates_Service" ) ) {
		require_once( AFFILIATES_CORE_LIB . '/class-affiliates-service.php' );
	}

	$affiliate_id = Affiliates_Service::get_referrer_id();
	if ( $affiliate_id ) {
		$affiliate = affiliates_get_affiliate( $affiliate_id );
	
		$coupons = Affiliates_Attributes_WordPress::get_coupons_for_affiliate( $affiliate_id );

		
		if ( isset( $coupons ) && ( sizeof( $coupons ) > 0 ) ) {
		    foreach ( $coupons as $coupon ) {
		    	$woocommerce->cart->add_discount( $coupon );
		    }
		}
	}

}
