<?php
/*
Plugin Name: Chart Mentor
Plugin URI: https://github.com/arifpavel/chartmentor
Description: A versatile chart widgets plugin for elementor.
Version: 1.0.0
Author: Arifur Rahman
Author URI: https://github.com/arifpavel
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: chartmentor
Domain Path: /languages
*/

/**
 * Copyright (c) 2020 Arifur Rahman (email: pavelpatiya@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress Elementor Plugin
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

if (!class_exists('ChartMentor', false)) {
    /**
     * ChartMentor.
     * Main plugin class that holds entire plugin.
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     */
    class ChartMentor
    {
        /**
         * Plugin version
         *
         * @var string
         */
        public $version = '1.0.0';

        /**
         * __construct.
         * Constructor function
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         * @return   void
         */
        public function __construct()
        {
            // set the constants first
            $this->setConstants();

            // check & load the autoloader
            if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
                require_once dirname(__FILE__) . '/vendor/autoload.php';
            }
            // register the activation
            register_activation_hook(__FILE__, [$this, 'activate']);

            // registser the deactivation
            register_deactivation_hook(__FILE__, [$this, 'deactivate']);

            // init plugin on loaded
            add_action('plugins_loaded', [$this, 'init'], 11);
        }

        /**
         * setConstants.
         * define default constants
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         * @return   void
         */
        public function setConstants()
        {
            define('CHARTMENTOR_VERSION', $this->version);
            define('CHARTMENTOR_TEXTDOMAIN', 'chartmentor');
            define('CHARTMENTOR_FILE', __FILE__);
            define('CHARTMENTOR_NAME', 'Chart Mentor');
            define('CHARTMENTOR_PATH', dirname(CHARTMENTOR_FILE));
            define('CHARTMENTOR_INC', CHARTMENTOR_PATH . '/inc');
            define('CHARTMENTOR_URL', plugins_url('', CHARTMENTOR_FILE));
            define('CHARTMENTOR_ASSETS', CHARTMENTOR_URL . '/assets');
        }

        /**
         * activate.
         * function that runs on plugin activation
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         * @return   void
         */
        public function activate()
        {
            // flush rewrite rules
            flush_rewrite_rules();

            $isInstalled = get_option('chartmentor_installed');

            if (!$isInstalled) {
                update_option('chartmentor_installed', time());
            }

            update_option('chartmentor_version', CHARTMENTOR_VERSION);
        }

        /**
         * deactivate.
         * function that runs on plugin deactivation
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         * @return   void
         */
        public function deactivate()
        {
            // Flush reqrite rules
            flush_rewrite_rules();
        }

        /**
         * init.
         * Initialize various classes
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         * @return   void
         */
        public function init()
        {
            /**
             * Check if elementor installed & active already.
             */
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', [$this, 'adminNoticeMissingElementor']);
            }
            /**
             * Initialize all the core classes of the plugin
             */
            if (class_exists("Inc\\Core")) {
                Inc\Core::registerServices();
            }
        }

        /* adminNoticeMissingElementor
         * Show admin notice if paranet plugin is missing.
         * @author Arif Pavel
         * @since 31 Mar 21
         * @version v1.0.0
         * @param mixed
         * @return null
        */
        public function adminNoticeMissingElementor()
        {
            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }

            $message = sprintf(
            /* translators: 1: Plugin Name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'text-domain'),
                '<strong>' . esc_html__(CHARTMENTOR_NAME, CHARTMENTOR_TEXTDOMAIN) . '</strong>',
                '<strong>' . esc_html__('Elementor', CHARTMENTOR_TEXTDOMAIN) . '</strong>'
            );

            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
        }

        /**
         * initiateChartMentor.
         * Return an instance if not intiated yet
         * @author   Arif Pavel
         * @since   v0.0.1
         * @version   v1.0.0   Wednesday, Mar 31th, 2021.
         * @access   public
         */
        public static function initiateChartMentor()
        {
            return new ChartMentor();
        }
    }

    /**
     * initiate the plugin class
     */
    $instance = ChartMentor::initiateChartMentor();
}
