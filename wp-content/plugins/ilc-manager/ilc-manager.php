<?php
/**
 * The file responsible for starting the Ilc Admin plugin
 *
 * The Icl Admin is a plugin that manage content type custom. This particular file is responsible for
 * including the necessary dependencies and starting the plugin.
 *
 * @package SPMM
 *
 * @wordpress-plugin
 * Plugin Name:       Icl Admin
 * Plugin URI:        http://github.com/jolupeza/ilc-admin
 * Description:       Ilc Admin manage content types custom.
 * Version:           1.0.0
 * Author:            José Pérez
 * Author URI:        http://watson.pe
 * Text Domain:       ilc-admin-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, then abort execution.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Include the core class responsible for loading all necessary components of the plugin.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ilc-manager.php';

/**
 * Instantiates the Ilc Manager class and then
 * calls its run method officially starting up the plugin.
 */
function run_ilc_manager() 
{
    $spmm = new Ilc_Manager();
    $spmm->run();
}

// Call the above function to begin execution of the plugin.
run_ilc_manager();