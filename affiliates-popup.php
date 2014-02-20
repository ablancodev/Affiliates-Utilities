/*

STYLE: You can use "affiliates-popup" class to customize the popup. For example:

.affiliates-popup {
	position: absolute;
	top: 0px;
	left: 0px;
	padding: 20px 10px;
	background-color: #ccc;
	color: #000;
	width: 100%;
	text-align: center;
}

*/

/* 
  You must add this code in your functions.php file
  Uses $pretext to customize the pre text showed.
*/

add_action( 'init', 'show_affiliate_info' );
function show_affiliate_info( $data) {

	$pretext = "You come referred by ";
	if ( !is_admin() ) {
		if (!class_exists("Affiliates_Service"))
			include_once( AFFILIATES_CORE_LIB . '/class-affiliates-service.php' );

		$affiliate_id = Affiliates_Service::get_referrer_id();

		if ( $affiliate_id ) {
			if ( $affiliate_id !== affiliates_get_direct_id() ) {
				if ( $user_id = affiliates_get_affiliate_user( $affiliate_id ) ) {
					if ( $user = get_user_by( 'id', $user_id ) ) {
						echo '<div class="affiliates-popup">' . $pretext . $user->user_login . '</div>';
					}
				}
			}
		}
	}
}

