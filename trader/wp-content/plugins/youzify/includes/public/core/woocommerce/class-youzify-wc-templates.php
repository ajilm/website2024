<?php

class Youzify_WC_Templates {

    public function __construct() {

		// Call Payments Script.
		add_action( 'wp_enqueue_scripts', array( $this, 'get_payments_scripts' ) );

        // Add Social Login Query Var.
        add_action( 'template_redirect', array( $this, 'set_edit_address_custom_vars' ), 1 );

    	// Shortcodes.
		add_shortcode( 'youzify_woocommerce_orders', array( $this, 'orders' ) );
		add_shortcode( 'youzify_woocommerce_addresses', array( $this, 'addresses' ) );
		add_shortcode( 'youzify_woocommerce_downloads', array( $this, 'downloads' ) );
		add_shortcode( 'youzify_payment_methods',  array( $this, 'payment_methods' ) );
		add_shortcode( 'youzify_woocommerce_edit_account',  array( $this, 'edit_account' ) );

		// Template Filters.
		add_filter( 'woocommerce_locate_template', array( $this, 'locate_template' ), 0, 3 );
		add_filter( 'wc_get_template',  array( $this, 'disable_themes_templates_on_profile' ), 10, 5 );

	}

	/**
	 * "Edit Account" Template
	 */
	function edit_account( $atts ) {
		wc_print_notices();
		wc_get_template(
	   		'myaccount/form-edit-account.php',
	   		array( 'user' => get_user_by( 'id', get_current_user_id() ) )
	   	);
	}

	/**
	 * Account Template
	 */
	function addresses( $atts ) {
		global $wp;
		wc_print_notices();
		$address_type = isset( $wp->query_vars['bp_member_action_variables'] ) ? $wp->query_vars['bp_member_action_variables'] : '';
		woocommerce_account_edit_address( $address_type );
	}


	/**
	 * Downloads Template.
	 */
	function downloads( $atts ) {
		ob_start();
		wc_print_notices();
		woocommerce_account_downloads();
    	return ob_get_clean();
	}

	/**
	 * Orders ShortCode
	 */
	function orders( $atts ) {
		global $wp;
		wc_print_notices();
		// Get Current Page.
		$current_page = isset( $wp->query_vars['orders'] ) ? $wp->query_vars['orders'] : 1;
		woocommerce_account_orders( $current_page );
	}

	/**
	 * Payment Methods
	 */
	function payment_methods( $atts ) {

		wc_print_notices();

		$defaults = array(
			'type'     => 'get',
			'param'    => 'add-payment-method',
		);

		$args = wp_parse_args( $atts, $defaults );

		if ( isset( $_GET['add-payment-method'] ) ) {

			// Woocommerce Payments Scripts.
			$this->woocommerce_scripts();

			// Stripe Script.
			$this->stripe_scritps();

			woocommerce_account_add_payment_method();

		} else {
			woocommerce_account_payment_methods();
		}
	}

	/**
	 * Disable Theme Template.
	 */
	function disable_themes_templates_on_profile( $located, $template_name, $args, $template_path, $default_path ) {

		if ( ! youzify_is_woocommerce_tab() ) {
			return $located;
		}

		// Get Youzify Template
		$youzify_template = youzify_wc_template_path();

		// Get Template Location.
		$located = wc_locate_template( $template_name, $youzify_template, $default_path );

		return $located;
	}

	/**
	 * Locate Woocommerce Template Path.
	 */
	function locate_template( $template, $template_name, $template_path ) {

		if ( ! youzify_is_woocommerce_tab() ) {
			return $template;
		}

		global $woocommerce;

		$_template = $template;

		if ( ! $template_path ) $template_path = $woocommerce->template_url;

		$plugin_path = youzify_wc_template_path();

		// Look within passed path within the theme - this is priority
		$template = locate_template( array( $template_path . $template_name, $template_name ) );

		// Modification: Get the template from this plugin, if it exists
		if ( ! $template && file_exists( $plugin_path . $template_name ) )
		$template = $plugin_path . $template_name;

		// Use default template
		if ( ! $template )
		$template = $_template;

		// Return what we found
		return $template;
	}



	/**
	 * Get Payments Script.
	 */
	function get_payments_scripts() {

		// Is Checkout Page
		if ( youzify_is_woocommerce_tab( 'checkout' ) ) {
			$this->woocommerce_scripts();
		}

	}

	/**
	 * Get Payments Script.
	 */
	function woocommerce_scripts() {

		// Get Suffix
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register Script.
		wp_register_script( 'wc-add-payment-method', WC()->plugin_url() . 'assets/js/frontend/add-payment-method' . $suffix . '.js', array( 'jquery', 'woocommerce' ), WC()->versio, true );

		// Call Script.
		wp_enqueue_script( 'wc-add-payment-method' );

	}


	/**
	 * Get Stripe Script.
	 */
	function stripe_scritps() {

		if ( class_exists( 'WC_Gateway_Stripe' )  ) {


			$payment_management = new WC_Gateway_Stripe();

			if ( $payment_management->settings['enabled'] === 'yes' ) {

				add_filter( 'woocommerce_is_checkout', '__return_true');
		
				if ( isset( $_GET['add-payment-method'] ) ) {
					$_GET['pay_for_order'] = 1;
				}

				$payment_management->payment_scripts();

			}

		}

	}

	/**
	 * Set Address Custom Vars to allow address saving
	 **/
	function set_edit_address_custom_vars() {

        global $wp;

		if ( isset( $wp->query_vars['bp_member_action'] ) && $wp->query_vars['bp_member_action'] == 'edit-address' && isset( $_POST['woocommerce-edit-address-nonce'] ) && isset( $_POST['action'] ) && $_POST['action'] == 'edit_address' ) {
            $wp->query_vars['edit-address'] = isset( $wp->query_vars['bp_member_action_variables'] ) ? $wp->query_vars['bp_member_action_variables'] : 'billing';
			add_filter( 'determine_current_user', array( $this , 'change_current_user_to_displayed_user' )  );
        }

	}

	/**
	 * Override current user ID with displayed user id
	 **/
	function change_current_user_to_displayed_user( $user_id ) {
	    return bp_displayed_user_id();
	}
	

}