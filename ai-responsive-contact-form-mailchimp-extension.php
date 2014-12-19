<?php
/**
 *  Responsive Contact Form MailChimp Extension.
 *
 * @package   Responsive Contact Form MailChimp Extension

 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Contact Form MailChimp Extension
 * Plugin URI:        http://www.augustinfotech.com
 * Description:       It is extension of Responsive Contact Form.responsive contact form data subscribed to selected the mailchimp list(s) 
 * Version:           1.1
 * Author:            August Infotech
 * Author URI:        http://www.augustinfotech.com
 * Text Domain:       ai-me-contactform
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


if ( is_plugin_active( 'responsive-contact-form/ai-responsive-contact-form.php' ) ) { 

	require_once( plugin_dir_path( __FILE__ ) . 'public/class-ai-mailchimp.php' );

	register_activation_hook( __FILE__, array( 'AI_MailChimp', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'AI_MailChimp', 'deactivate' ) );  

	add_action( 'plugins_loaded', array( 'AI_MailChimp', 'get_instance' ) );

	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-ai-mailchimp-admin.php' );
		add_action( 'plugins_loaded', array( 'AI_MailChimp_Admin', 'get_instance' ) );

	}
}
else
{
	add_action('admin_notices', 'ai_plugin_admin_notices');
}

function ai_plugin_admin_notices() {
	   
	   $msg = sprintf( __( 'Please install or activate : %s.', $_SERVER['SERVER_NAME'] ), '<a href=https://wordpress.org/plugins/responsive-contact-form style="color: #ffffff;text-decoration:none;font-style: italic;" target="_blank"/><strong>Responsive Contact Form Plugin</strong></a>' );
	   echo '<div id="message" class="error" style="background-color: #DD3D36;"><p style="font-size: 16px;color: #ffffff">' . $msg . '</p></div>'; 
	   
	   deactivate_plugins('responsive-contact-form-mailchimp-extension/ai-responsive-contact-form-mailchimp-extension.php');
}