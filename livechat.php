<?php
/*
Plugin Name: Live Chat Software for Wordpress
Plugin URI: http://www.livechatinc.com
Description: Live chat software for live help, online sales and customer support. This plugin allows to quickly install the live chat button and monitoring code on any WordPress website.
Author: LIVECHAT Software
Version: 2.0.0
Author URI: http://www.livechatinc.com
*/


//
// Admin panel
//

/**
 * Loads CSS styles for admin panel styling
 */

define ('LIVECHAT_PLUGIN_URL', WP_PLUGIN_URL . str_replace('\\', '/', strrchr(dirname(__FILE__), DIRECTORY_SEPARATOR)) . '/plugin_files');

function livechat_admin_head()
{
	echo '<style type="text/css">';
	echo '@import url('.LIVECHAT_PLUGIN_URL.'/css/styles.css);';
	echo '</style>';
}

/**
 * Loads jQuery scripts in admin panel
 */
function livechat_admin_footer()
{
	echo '<script type="text/javascript" src="'.LIVECHAT_PLUGIN_URL.'/js/scripts.js"></script>';
	echo '<script type="text/javascript" src="'.LIVECHAT_PLUGIN_URL.'/js/signup.js"></script>';
}

/**
 * Registers livechat settings variables
 */
function livechat_sanitize_license_number ($license_number)
{
	if (preg_match('/^\d{2,}$/', $license_number)) return $license_number;

	return '';;
}

function livechat_sanitize_lang ($lang)
{
	if (preg_match('/^[a-z]{2}$/', $lang)) return $lang;

	return 'en';
}

function livechat_admin_register_settings()
{
	register_setting ('livechat_license_information', 'livechat_license_number', 'livechat_sanitize_license_number');
	register_setting ('livechat_license_information', 'livechat_lang', 'livechat_sanitize_lang');
	register_setting ('livechat_license_information', 'livechat_groups');
	register_setting ('livechat_license_information', 'livechat_params');
	register_setting ('livechat_license_information', 'livechat_license_created_flag');
}

function livechat_read_options()
{
	$license_number = get_option('livechat_license_number');

	$lang = get_option('livechat_lang');
	if (empty ($lang)) $lang = 'en';

	$groups = get_option('livechat_groups');
	if (empty ($groups)) $groups = '0';

	$params = get_option('livechat_params');

	return array ($license_number, $lang, $groups, $params);
}

/**
 * Creates new admin menu
 */
function livechat_admin_menu()
{
	require_once (dirname(__FILE__).'/plugin_files/settings.php');

	add_menu_page ('Live chat settings', 'Live chat', 'administrator', '_livechat_settings', '_livechat_settings' /* live chat logo here */);
	add_submenu_page ('_livechat_settings', 'Live chat settings', 'Settings', 'administrator', '_livechat_settings', '_livechat_settings');
}

add_action ('admin_head', 'livechat_admin_head');
add_action ('admin_footer', 'livechat_admin_footer');
add_action ('admin_menu', 'livechat_admin_menu');
add_action ('admin_init', 'livechat_admin_register_settings');



//
// Monitoring code installation
//

function livechat_monitoring_code()
{
	require_once (dirname(__FILE__).'/plugin_files/monitoring_code.php');

	list ($license_number, $lang, $groups, $params) = livechat_read_options();

	_livechat_monitoring_code ($license_number, $lang, $groups, $params);
}

add_action ('get_footer', 'livechat_monitoring_code');


//
// Chat button code installation
//

function livechat_chat_button_code()
{
	require_once (dirname(__FILE__).'/plugin_files/chat_button_code.php');

	list ($license_number, $lang, $groups, $params) = livechat_read_options();

	_livechat_chat_button_code ($license_number, $lang, $groups);
}

function livechat_chat_button_code_control()
{
	require_once (dirname(__FILE__).'/plugin_files/chat_button_code.php');

	list ($license_number, $lang, $groups, $params) = livechat_read_options();

	_livechat_chat_button_code_control ($license_number, $lang, $groups);
}

wp_register_sidebar_widget ('livechat_widget', 'Live chat for Wordpress', 'livechat_chat_button_code');
wp_register_widget_control ('livechat_widget', 'Live chat for Wordpress', 'livechat_chat_button_code_control');
