		add_shortcode( 'affiliates_logout_redirect', 'custom_affiliates_logout_redirect' );

	/**
	 * Renders a link to log out.
	 * 
	 * @param array $atts
	 * @param string $content not used
	 * @return string rendered logout link or empty if not logged in
	 */
 function custom_affiliates_logout_redirect( $atts, $content = null ) {
	  extract( shortcode_atts( array( 'redirect_url' => '' ), $atts ) );
		if ( is_user_logged_in() ) {
			return '<a href="' . esc_url( wp_logout_url( $redirect_url ) ) .'">' . __( 'Log out', AFFILIATES_PLUGIN_DOMAIN ) . '</a>';
		} else {
			return '';
		}
	}
