<?php
/*
Plugin Name: Cleared All Layered Nav Selections for WooCommerce
Plugin URI: 
Description: Gives you a widget that produces a 'clear all' link when using WooCommerce layered nav
Version: 1.0
Author: SFNdesign, Curtis McHale
Author URI: http://sfndesign.ca
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class Woo_Clear_Layered_Nav{

	private static $instance;

	/**
	 * Spins up the instance of the plugin so that we don't get many instances running at once
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 *
	 * @uses $instance->init()                      The main get it running function
	 */
	public static function instance(){

		if ( ! self::$instance ){
			self::$instance = new Woo_Clear_Layered_Nav();
			self::$instance->init();
		}

	} // instance

	/**
	 * Spins up all the actions/filters in the plugin to really get the engine running
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 *
	 * @uses $this->constants()                 Defines our constants
	 * @uses $this->includes()                  Gets any includes we have
	 */
	public function init(){

		$this->constants();
		$this->includes();

		add_action( 'admin_notices', array( $this, 'check_required_plugins' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );

	} // init

	/**
	 * Checks for plugin requirements and deactivates plugin if requirements not found
	 *
	 * @since   1.0
	 * @author  SFNdesign, Curtis McHale
	 *
	 * @uses is_plugin_active()             Returns true if the given plugin is active
	 * @uses deactivate_plugins()           Deactivates plugins given string or array of plugins
	 */
	public function check_required_plugins(){

		if( ! class_exists( 'WooCommerce' ) ){ ?>

			<div id="message" class="error">
				<p>Clear Layered Nav expects Woocommerce Library to be active. This plugin has been deactivated.</p>
			</div>

			<?php
			deactivate_plugins( '/woo-clear-all-layered-filters/woo-clear-all-layered-filters.php' );
		}

	} // check_required_plugins

	/**
	 * Gives us any constants we need in the plugin
	 *
	 * @since 1.0
	 */
	public function constants(){

		define( 'WOO_CLEAR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'WOO_CLEAR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

	}

	/**
	 * Includes any externals
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 */
	public function includes(){
		require_once( 'inc/widget-clear-all.php' );
	}

	/**
	 * Fired when plugin is activated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function activate( $network_wide ){

	} // activate

	/**
	 * Fired when plugin is deactivated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function deactivate( $network_wide ){

	} // deactivate

	/**
	 * Fired when plugin is uninstalled
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function uninstall( $network_wide ){

	} // uninstall

} // Woo_Clear_Layered_Nav

Woo_Clear_Layered_Nav::instance();