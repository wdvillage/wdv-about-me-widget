<?php 
/*
Plugin Name: WDV About Me Widget
Plugin URI: http://wdvillage.com
Description: Adding About Me widget.
Author: wdvillage
Version: 1.0.0
Author URI: http://wdvillage.com
Text Domain: wdv-about-me-widget
Domain Path: /languages
*/


/*  Copyright 2019  wdvillage  (email : wdvillage100 {at} gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define ('WDV_ABOUT_ME_WIDGET_URL', trailingslashit(plugin_dir_url(__FILE__)));
define ('WDV_ABOUT_ME_WIDGET_DIR', trailingslashit(plugin_dir_path(__FILE__)));
define ('WDV_ABOUT_ME_WIDGET_VER', '1.0.0');


/* Initialize Widget */
if(!function_exists('wdv_about_me_widget_init')):
    function wdv_about_me_widget_init() {
	require_once(WDV_ABOUT_ME_WIDGET_DIR.'inc/class-wdv-about-me-widget.php');
	register_widget('WDV_About_Me_Widget');
    }
endif;

add_action('widgets_init','wdv_about_me_widget_init');