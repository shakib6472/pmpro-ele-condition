<?php
/*
 * Plugin Name:       Membership Visibility Control for Elementor (PMPro) – by Shakib
 * Plugin URI:        https://github.com/shakib6472/pmpro-ele-condition
 * Description:       Add conditional visibility to Elementor sections and widgets based on Paid Memberships Pro membership levels. This is an unofficial integration.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Requires Plugins:  elementor
 * Author:            Shakib Shown
 * Author URI:        https://github.com/shakib6472/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       membership-visibility-for-elementor-pmpro-shakib
 * Domain Path:       /languages
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('MEMBVICO_VERSION', '1.0.0');
define('MEMBVICO_FILE', __FILE__);
define('MEMBVICO_DIR', plugin_dir_path(__FILE__));
define('MEMBVICO_URL', plugin_dir_url(__FILE__)); 
function membvico_activation()
{
    add_option('membvico_activated', true);
}


function membvico_deactivation()
{
    delete_option('membvico_activated');
} 

add_action('elementor/frontend/after_enqueue_scripts', function () {
    wp_enqueue_script(
        'membvico_pmpro_ele_visibility',
        plugin_dir_url(__FILE__) . 'assets/js/pmpro-ele-visibility.js',
        ['elementor-frontend'],
        '1.0',
        true
    );
});


register_activation_hook(__FILE__, 'membvico_activation');
register_deactivation_hook(__FILE__, 'membvico_deactivation');


 $is_pmpro_active = is_plugin_active( 'paid-memberships-pro/paid-memberships-pro.php' );

// Check if Paid Memberships Pro is available
if ($is_pmpro_active) {
    // Load main logic only if PMPro is active
    include_once MEMBVICO_DIR . 'classes/main.php';
} else {
    // Show a safe admin notice only
    add_action('admin_notices', function () {
        if (current_user_can('activate_plugins')) {
            echo '<div class="notice notice-error"><p>';
            echo wp_kses_post(
                __(
                    '<big><b>Membership Visibility Control:</b></big> Paid Memberships Pro is not active. Features depending on PMPro are disabled.',
                    'membership-visibility-for-elementor-pmpro-shakib'
                )
            );
            echo '</p></div>';
        }
    });

}