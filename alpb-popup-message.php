<?php
/*
Plugin Name: ALPB Popup Message
Plugin URI: http://alpb-rc.com
description: Simple popup message for your marketing needs.
Version: 1.0
Author: Mr. Ronnn Seminiano
Author URI: https://www.facebook.com/rgpseminiano
License: GPL2
*/
function popup_message_front_functionalities(){
	require_once plugin_dir_path(__FILE__) . 'class/class-front-alpb-popup-message.php';
	Front::enqueue_scripts();
	Front:: html_popup_message();
}
popup_message_front_functionalities();


function popup_message_admin_functionalities(){
	require_once plugin_dir_path(__FILE__) . 'class/class-admin-alpb-popup-message.php';
	Admin::enqueue_scripts();
	Admin::generate_settings();
}
popup_message_admin_functionalities();


?>