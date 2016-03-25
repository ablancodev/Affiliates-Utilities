add_action( 'user_register', 'my_admin_user_register' );
function my_admin_user_register( $user_id ) {
	require_once AFFILIATES_CORE_LIB . '/class-affiliates-service.php';
	remove_filter( 'affiliates_service_affiliate_id', array( 'Affiliates_Permanent', 'affiliates_service_affiliate_id' ) );
	$affiliate_id = Affiliates_Service::get_referrer_id();
	add_filter( 'affiliates_service_affiliate_id', array( 'Affiliates_Permanent', 'affiliates_service_affiliate_id' ), 10, 2 );
	if ( $affiliate_id ) {
		$permanent_referrer_id = my_get_referrer( $user_id );
		if ( $permanent_referrer_id === null ) {
			my_set_referrer( $user_id, $affiliate_id );
		}
	}
}

function my_set_referrer( $user_id, $affiliate_id ) {
	delete_user_meta( $user_id, Affiliates_Permanent::REFERRER );
	add_user_meta( $user_id, Affiliates_Permanent::REFERRER, $affiliate_id );
}
function my_get_referrer( $user_id ) {
	$result = null;
	$id = get_user_meta( $user_id, Affiliates_Permanent::REFERRER, true );
	if ( $id ) {
		$result = $id;
	}
	return $result;
}
