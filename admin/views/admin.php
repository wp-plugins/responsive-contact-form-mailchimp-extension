<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

<form action="options.php" method="post">	
<?php settings_fields( 'ai-me-contactform-settings-group' ); ?>
<?php do_settings_sections( 'ai-me-contactform-settings-group' ); ?>
<table class="form-table">
	<tbody>
	<tr valign="top">
		<th scope="row">
			<label><?php _e( 'Mailchimp API Key', 'ai-me-contactform' );?></label>
		</th>
		<td>
			<input type="text" id="ai_me_contactform_api_key" name="ai_me_contactform_api_key" value="<?php _e(esc_attr(get_option('ai_me_contactform_api_key')));?>" size="60"/>
		</td>
	</tr>
	
	<tr valign="top">
			<th scope="row">MailChimp list(s)</th>
		<?php 
		if(empty($lists)) { 
			?><td colspan="2">No lists found, are you connected to MailChimp?</td><?php
		} else { ?>
		<td>
			<ul id="aimc-lists">
			<?php 
			$options="";
			$options =  get_option('aimclists') ; ?>
			<?php 
			foreach($lists['data'] as $list) {?>
				<li>
					<label>
						<input type="checkbox" name="aimclists[<?php echo esc_attr($list['id']); ?>]" value="1" <?php if($options!=""):checked( 1 == $options[$list['id']] ); endif ?> /><?php echo $list['name'];?>
					</label>
				</li>
			<?php } ?>
			</ul>
		</td>
		<td class="desc">Select the list(s) to which people who tick the checkbox should be subscribed.</td>
		<?php } ?>
	</tr>	
	<tr valign="top">
		<td colspan="2">
			<?php submit_button( 'Submit' );?>
		</td>
	</tr>	
	</tbody>
</table>
</form>
</div>