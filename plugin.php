<?php
/*
Plugin Name: Mentor Starter
Plugin URI: https://github.com/arifpavel/Mentor-Starter
Description: A starter plugin to create an awesome Elementor addon.
Version: 1.0.0
Author: Arif Pavel
Author URI: https://github.com/arifpavel
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: metnorstarter
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

if (!class_exists('MentorStarter', false)) {
    //load Main plugin class
    require_once 'MentorStarter.php';
    /**
     * initiate the plugin class
     */
    $instance = MentorStarter::initiateMentorStarter();
}
