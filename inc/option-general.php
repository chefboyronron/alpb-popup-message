<h1>ALPB Popup Message Content</h1>
<?php settings_errors(); ?>
<?php
	$services = esc_attr( get_option( 'general_popup_message_title' ) );
?>
<form method="post" action="options.php">
	<?php settings_fields( 'alpb-popup-message-general-group' ); ?>
	<?php do_settings_sections( 'popup_message' ); ?>
	<?php submit_button(); ?>
</form>