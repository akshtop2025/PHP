<?php
/**
 * My Account Page.
 *
 * @package ShopPress
 */

namespace ShopPress\Templates;

defined( 'ABSPATH' ) || exit;

use Elementor\Plugin;
use ShopPress\Templates\Base;

class MyAccount extends Base {
	/**
	 * Init.
	 *
	 * @since 1.2.0
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
		add_filter( 'wc_get_template', array( __CLASS__, 'my_account_templates' ), 10, 2 );
		add_filter( 'template_include', array( __CLASS__, 'my_account_template' ), 99 );

		add_action( 'shoppress_my_account', array( __CLASS__, 'my_account_content' ) );
		add_action( 'shoppress_dashboard', array( __CLASS__, 'my_account_content' ) );
		add_action( 'shoppress_orders', array( __CLASS__, 'my_account_content' ) );
		add_action( 'shoppress_downloads', array( __CLASS__, 'my_account_content' ) );
		add_action( 'shoppress_addresses', array( __CLASS__, 'my_account_content' ) );
		add_action( 'shoppress_account_details', array( __CLASS__, 'my_account_content' ) );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0.0
	 */
	public static function enqueue() {

		if ( is_account_page() && sp_is_template_active( 'my_account' ) ) {
			wp_enqueue_style( 'sp-my-account' );
		}
	}

	/**
	 * My account templates.
	 *
	 * @since 1.0.0
	 */
	public static function my_account_templates( $located, $template_name ) {

		if ( 'myaccount/orders.php' === $template_name && self::is_builder( 'orders' ) ) {
			$located = sp_get_template_path( 'dashboard-endpoints/orders' );
		}

		if ( 'myaccount/dashboard.php' === $template_name && self::is_builder( 'dashboard' ) ) {
			$located = sp_get_template_path( 'dashboard-endpoints/dashboard' );
		}

		if ( 'myaccount/downloads.php' === $template_name && self::is_builder( 'downloads' ) ) {
			$located = sp_get_template_path( 'dashboard-endpoints/downloads' );
		}

		if ( 'myaccount/my-address.php' === $template_name && self::is_builder( 'addresses' ) ) {
			$located = sp_get_template_path( 'dashboard-endpoints/addresses' );
		}

		if ( 'myaccount/form-edit-account.php' === $template_name && self::is_builder( 'account_details' ) ) {
			$located = sp_get_template_path( 'dashboard-endpoints/edit-account' );
		}

		return $located;
	}

	/**
	 * My account template.
	 *
	 * @since 1.0.0
	 */
	public static function my_account_template( $template ) {

		if ( is_account_page() && self::is_builder( 'my_account' ) ) {
			return sp_get_template_path( 'dashboard-endpoints/my-account' );
		}

		return $template;
	}

	/**
	 * Return builder ID.
	 *
	 * @param string $name
	 *
	 * @since 1.2.0
	 *
	 * @return bool
	 */
	public static function get_builder_id( $name ) {

		return sp_get_template_settings( $name, 'page_builder' );
	}

	/**
	 * Check is builder.
	 *
	 * @since 1.2.0
	 *
	 * @return bool
	 */
	public static function is_builder( $name ) {

		$builder_id = self::get_builder_id( $name );

		return $builder_id ? true : false;
	}

	/**
	 * My Account Content
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public static function my_account_content() {

		$action = current_action();
		$name   = str_replace( 'shoppress_', '', $action );

		$builder_id = self::get_builder_id( $name );
		if ( $builder_id && self::is_builder( $name ) ) {

			echo '<div id="shoppress-wrap" class="shoppress-wrap container">';
				echo Plugin::instance()->frontend->get_builder_content_for_display( $builder_id, false );
			echo '</div>';
		}
	}
}
