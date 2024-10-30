<?php
/*
 * Plugin Name: Change Add to Cart All Text
 * Plugin URI: https://wordpress.org/plugins/change-add-to-cart-all-text/
 * Description: WooCommerce change the <strong>Add to Cart</strong> text on product <strong>archive</strong> and the <strong>single</strong> product page.
 * Author: Abu Saim
 * Author URI: https://profiles.wordpress.org/abusaim/
 * Version: 1.0.0
 * Text Domain: change-add-to-cart-all-text
 * Domain Path: /languages/
 * WC requires at least: 3.0.0
 * WC tested up to: 3.5.1
 * Tested up to: 5.2.2
 * Requires PHP: 5.6
 * Requires at least: 4.9
 * Stable tag: 1.0.0
 * License: GPL version 2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if WooCommerce is active
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // warning message if WooCommerce is not active
    add_action( 'admin_notices', 'wcatct_add_to_cart_text_admin_notice' );
    return;
}

function wcatct_add_to_cart_text_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php echo esc_html__( '"Change Add to Cart All Text" requires <strong>WooCommerce</strong> to be installed and active.', 'change-add-to-cart-all-text' ); ?></p>
    </div>
    <?php
}



// Load plugin textdomain
function wcatct_add_to_cart_text_load_textdomain() {
    load_plugin_textdomain( 'change-add-to-cart-all-text', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'wcatct_add_to_cart_text_load_textdomain' );

// Add settings link on plugin page
function wcatct_add_to_cart_text_settings_link( $links ) {
    $settings_link = '<a href="'. admin_url( 'admin.php?page=woo-change-add-to-cart-text' ) .'">' . esc_html__( 'Settings', 'change-add-to-cart-all-text' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wcatct_add_to_cart_text_settings_link' );

// include functions.php
require_once( plugin_dir_path( __FILE__ ) . 'include/functions.php' );