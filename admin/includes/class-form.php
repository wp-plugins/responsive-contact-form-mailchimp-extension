<?php
/**
* Get MailChimp Lists to subscribe to
* 
* @return array Array of selected MailChimp lists
*/
function get_lists(){
	require_once('AIMCAPI.class.php');
	
	$apikey = esc_attr(get_option('ai_me_contactform_api_key'));
	
	$api = new AIMCAPI($apikey);
	
    $lists = $api->lists();

	return $lists;
	
}
?>
