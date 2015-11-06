add_shortcode ( 'affiliates_post_referral', 'custom_affiliates_post_referral' );
function custom_affiliates_post_referral($atts, $content = null) {
	global $post;
	// net order amount
	// the commission is calculated based on that
	$net_amount = 100;
	
	// appropriate currency code for the referral
	$currency = 'USD';
	
	$data = array(
			'order_id' => array(
					'title' => 'Post #',
					'domain' => "",
					'value' => esc_sql( $post->ID )
			),
			'order_total' => array(
					'title' => 'Total',
					'domain' =>  "",
					'value' => esc_sql( $net_amount )
			),
			'order_currency' => array(
					'title' => 'Currency',
					'domain' =>  "",
					'value' => esc_sql( $currency )
			)
	);
	
	$r = new Affiliates_Referral_WordPress();
	$description = sprintf( 'Post #%s', $post->ID );
	$r->evaluate( $post->ID, $description, $data, $net_amount, null, $currency, null, 'sale' );
	
}
