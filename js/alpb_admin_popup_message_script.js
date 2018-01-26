jQuery(document).ready(function($){
	$('.popup-message-add-list-btn').on('click', function(e){
		e.preventDefault();
		$('.popup-message-list-container').append(
			'<div>' +
				'<input type="text" name="general_popup_message_lists[]" class="regular-text"/> ' + 
				'<a href="#" class="popup_message_remove_list_btn delete" style="color:#a00;">remove</a>' +
			'</div>'
		);
	});

	$('.popup_message_remove_list_btn').live('click',function(e){
		e.preventDefault();
		$(this).parent().remove();
	});

	/*Background uploader*/
	var mediaUploader;
	$( '#alpb-popup-message-upload-button' ).on('click',function(e){

		e.preventDefault();

		if( mediaUploader ){
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Profile Picture',
			button: {
				text: 'Choose Picture',
			},
			multiple: false,
		});

		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#alpb-popup-message-bg-image').val(attachment.url);
			$('#alpb-popup-message-bg-preview').css('background-image', 'url('+attachment.url+')');
		});

		mediaUploader.open();

	});

	$('#alpb-popup-message-remove-image-button').on('click', function(e){
		$('#alpb-popup-message-bg-preview').css('background-image', '');
		$('#alpb-popup-message-bg-image').val('');
	});

});

(function( $ ) {

    $(function() {
        $('.popup-message-custom-color-field').wpColorPicker();
        $( 'input.alpha-color-picker' ).alphaColorPicker();
    });
     
})( jQuery );