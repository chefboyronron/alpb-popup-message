<?php
/**
 * The file that defines the front-end core plugin class
 *
 * A class definition that includes attributes and functions used across the
 * public-facing side of the site.
 *
 * @link       alpb-rc.com
 * @since      1.0.0
 *
 * @package    alpb_popup_message
 * @subpackage alpb_popup_message/class
 */

/**
 * @since      1.0.0
 * @package    alpb_popup_message
 * @subpackage alpb_popup_message/class
 * @author     Ron Seminiano <rseminiano@alpb-rc.com>
 */

class Front {

	static public function enqueue_scripts(){

		function alpb_popup_message_front_script( $hook ){
			/*=============================
				enqueue front stylesheet
			===============================*/
			//style
			wp_register_style(
				'alpb_popup_message_style_css',
				plugin_dir_url(__FILE__) . '../css/alpb_popup_message_script.css',
				array(),
				'1.0.0',
				'all'
			);
			wp_enqueue_style( 'alpb_popup_message_style_css' );

			/*=============================
				enqueue front scripts
			===============================*/
			wp_register_script(
				'alpb_popup_message_script', 
				plugin_dir_url(__FILE__) . '../js/alpb_popup_message_script.js', 
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script( 'alpb_popup_message_script' );
		}
		$status = get_option( 'general_popup_message_status' );
		if($status == TRUE){
			add_action( 'wp_enqueue_scripts', 'alpb_popup_message_front_script' );
		}
	}

	static public function html_popup_message(){ 
		
		function popup_elements() { 
			//is_user_logged_in() | bool" 
			if(!is_user_logged_in()){
				if(is_single()){
					echo '<input type="hidden" id="alpb-popup-message-login-checker" value="0" />';
					$bg_color = get_option( 'general_popup_message_container_bg_color' );
					$title = get_option( 'general_popup_message_title' );
					$title_color = get_option( 'general_popup_message_text_color_title' );
					$subtitle = get_option( 'general_popup_message_subtitle' );
					$subtitle_color = get_option( 'general_popup_message_text_color_subtitle' );
					$descriptions = get_option( 'general_popup_message_descriptions' );
					$descriptions_color = get_option( 'general_popup_message_descriptions_color' );
					$lists = get_option( 'general_popup_message_lists' );
					$lists_color = get_option( 'general_popup_message_lists_color' );
					$list_style_color = get_option('general_popup_message_lists_style_color');
					$ps = get_option( 'general_popup_message_ps' );
					$ps_color = get_option( 'general_popup_message_ps_color' );
					$btn_label = get_option( 'general_popup_message_btn_label' );
					$btn_text_color = get_option( 'general_popup_message_btn_label_color' );
					$btn_bg_color = get_option( 'general_popup_message_btn_label_bg_color' );
					$backgound_image = esc_attr( get_option( 'general_popup_message_bg_image' ) );
					$link = get_option( 'general_popup_message_btn_link' );

				    echo '
				    	<style>
					    	.fa-popup-messge::before {
								color: '.$list_style_color.' !important; 
							}
				    	</style>
				    	<div class="alpb-popup-message-wrapper" style="background-color:'.$bg_color.' !important; background: url('.$backgound_image.') no-repeat; background-size:cover;">
				    		<div class="alpb-popup-message-container">
								
								<div class="alpb-popup-message-content">

									<p class="alpb-popup-message-content-title" style="color:'.$title_color.' !important;">'.$title.'</p>
									<p class="alpb-popup-message-content-subtitle" style="color:'.$subtitle_color.' !important;">'.nl2br($subtitle).'</p>
									<p class="alpb-popup-message-content-description" style="color:'.$descriptions_color.' !important;">'.nl2br($descriptions).'</p>
									<ul class="alpb-popup-message-content-lists">
					';
									if($lists != ""){
										foreach($lists as $key => $val){
											echo '<li style="color:'.$lists_color.' !important;"><span class="fa fa-check fa-popup-messge"></span> '.$val.'</li>';
										}
									}
					echo			'</ul>
									<p class="alpb-popup-message-content-button-ps" style="color:'.$ps_color.' !important;">'.$ps.'</p>
									<a href="'.$link.'" class="alpb-popup-message-content-button" style="background:'.$btn_bg_color.' !important; color:'.$btn_text_color.' !important;">'.$btn_label.'</a>
									<a href="#" class="alpb-popup-message-close">Close</a>

								</div>

				    		</div>
				    	</div>
				    ';
				}else{
					echo '<input type="hidden" id="alpb-popup-message-login-checker" value="1" />';
				}
			}else{
				echo '<input type="hidden" id="alpb-popup-message-login-checker" value="1" />';
			}

		}
		$status = get_option( 'general_popup_message_status' );
		if($status == TRUE){
			add_action('wp_footer', 'popup_elements');
		}
		
	}

}

?>