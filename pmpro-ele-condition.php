<?php
/*
 * Plugin Name:       PMPro ELE Condition
 * Plugin URI:        https://wordpress.org/plugins/pmpro-ele-condition/
 * Description:       A plugin to add PMPro membership level for Elementor conditions. Hide or show Elementor widgets based on PMPro membership levels.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shakib Shown
 * Author URI:        https://github.com/shakib6472/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pmpro-ele-condition
 * Domain Path:       /languages 
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function pmpro_ele_condition_activation()
{
    add_option('pmpro_ele_condition_activated', true);
}
function pmpro_ele_condition_deactivation()
{
    delete_option('pmpro_ele_condition_activated');
}

add_action('elementor/frontend/after_enqueue_scripts', function () {
    wp_enqueue_script(
        'pmpro-ele-visibility',
        plugin_dir_url(__FILE__) . 'assets/js/pmpro-ele-visibility.js',
        ['elementor-frontend'],
        '1.0',
        true
    );
});


register_activation_hook(__FILE__, 'pmpro_ele_condition_activation');
register_deactivation_hook(__FILE__, 'pmpro_ele_condition_deactivation');


include_once __DIR__ . '/classes/main.php'; 

