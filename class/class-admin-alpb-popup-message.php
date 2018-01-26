<?php
/**
 * The file that defines the admin core plugin class
 *
 * A class definition that includes attributes and functions used across the
 * admin side of the site.
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
class Admin {

	static public function enqueue_scripts(){

		function alpb_popup_message_load_admin_scripts( $hook ){

			/*=============================
				enqueue admin stylesheet
			===============================*/
			wp_register_style(
				'alpb_admin_popup_message_style_css', 
				plugin_dir_url(__FILE__) . '../css/alpb_admin_popup_message_script.css', 
				array(), 
				'1.0.0', 
				'all'
			);
			wp_enqueue_style( 'alpb_admin_popup_message_style_css' );

			wp_enqueue_style(
				'alpha-color-picker', 
				plugin_dir_url(__FILE__) . '../css/alpha-color-picker.css',
				array( 'wp-color-picker' )
			);

			/*=============================
				enqueue admin scripts
			===============================*/
			wp_register_script(
				'alpb_admin_popup_message_script', 
				plugin_dir_url(__FILE__) . '../js/alpb_admin_popup_message_script.js', 
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script( 'alpb_admin_popup_message_script' );

			global $post;
		    wp_enqueue_media( array( 
		        'post' => $post->ID, 
		    ) );
  
        	wp_enqueue_style( 'wp-color-picker' ); 

        	wp_enqueue_script(
				'alpha-color-picker',
				plugin_dir_url(__FILE__) . '../js/alpha-color-picker.js', 
				array( 'jquery', 'wp-color-picker' ), 
				null,
				true
			);

		}
		add_action( 'admin_enqueue_scripts', 'alpb_popup_message_load_admin_scripts' );

	}

	static public function generate_settings(){

		function alpb_popup_message_option_menu_page(){

			/*==================================
				Create ALPB popup message menu
			====================================*/
			add_menu_page(
				'ALPB Theme Options',
				'ALPB Popup Message Options',
				'manage_options',
				'popup_message',
				'alpb_popup_message_theme_create_page',
				plugin_dir_url(__FILE__) . '../img/favicon.ico',
				110
			);

			/*===============================
				Create ALPB Reality Submenu
			=================================*/
			add_submenu_page( 'popup_message', 'ALPB Popup Message Options', 'General', 'manage_options', 'popup_message', 'alpb_popup_message_general_page' );

			/*====================================
				Add Fields to General Options
			======================================*/
			add_action( 'admin_init', 'alpb_popup_message_theme_general_settings');


		}
		add_action( 'admin_menu', 'alpb_popup_message_option_menu_page' );

		function alpb_popup_message_theme_create_page(){}

		function alpb_popup_message_general_page(){
			require_once( plugin_dir_path(__FILE__) . '../inc/option-general.php' );
		}


		function alpb_popup_message_theme_general_settings(){

			/*===============================================
				Register General Settings - Status
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_status', 'alpb_popup_message_general_status_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_status_section', 'popup_message' );
			add_settings_field( 'general-popup-message-status-name', 'Status', 'alpb_popup_message_general_status_field', 'popup_message', 'alpb-general-content-options' );

			/*===============================================
				Register General Settings - Wrapper background color
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_container_bg_color', 'alpb_popup_message_general_container_bg_color_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_container_bg_color_section', 'popup_message' );
			add_settings_field( 'general-popup-message-container_bg_color-name', 'Background', 'alpb_popup_message_general_container_bg_color_field', 'popup_message', 'alpb-general-content-options' );

			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_bg_image', 'alpb_popup_message_general_container_bg_color_callback' );

			/*===============================================
				Register General Settings - Title
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_title', 'alpb_popup_message_general_title_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_title_section', 'popup_message' );
			add_settings_field( 'general-popup-message-title-name', 'Title', 'alpb_popup_message_general_title_field', 'popup_message', 'alpb-general-content-options' );
			/*title text_color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_text_color_title', 'alpb_popup_message_general_title_callback' );
			/*===============================================
				Register General Settings - Subtitle
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_subtitle', 'alpb_popup_message_general_subtitle_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_subtitle_section', 'popup_message' );
			add_settings_field( 'general-popup-message-subtitle-name', 'Subtitle', 'alpb_popup_message_general_subtitle_field', 'popup_message', 'alpb-general-content-options' );
			/*subtitle text_color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_text_color_subtitle', 'alpb_popup_message_general_subtitle_callback' );
			/*===============================================
				Register General Settings - Descriptions
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_descriptions', 'alpb_popup_message_general_descriptions_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_descriptions_section', 'popup_message' );
			add_settings_field( 'general-popup-message-descriptions-name', 'Descriptions', 'alpb_popup_message_general_descriptions_field', 'popup_message', 'alpb-general-content-options' );
			/*desc color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_descriptions_color', 'alpb_popup_message_general_descriptions_callback' );
			/*===============================================
				Register General Settings - lists
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_lists', 'alpb_popup_message_general_lists_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_lists_section', 'popup_message' );
			add_settings_field( 'general-popup-message-lists-name', 'Lists', 'alpb_popup_message_general_lists_field', 'popup_message', 'alpb-general-content-options' );
			/*list color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_lists_color', 'alpb_popup_message_general_lists_callback' );
			/*list style color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_lists_style_color', 'alpb_popup_message_general_lists_callback' );
			/*===============================================
				Register General Settings - postscript
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_ps', 'alpb_popup_message_general_ps_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_ps_section', 'popup_message' );
			add_settings_field( 'general-popup-message-ps-name', 'Postscript (PS)', 'alpb_popup_message_general_ps_field', 'popup_message', 'alpb-general-content-options' );
			/*ps color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_ps_color', 'alpb_popup_message_general_ps_callback' );
			/*===============================================
				Register General Settings - button text
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_btn_label', 'alpb_popup_message_general_btn_label_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_btn_label_section', 'popup_message' );
			add_settings_field( 'general-popup-message-btn_label-name', 'Button Label', 'alpb_popup_message_general_btn_label_field', 'popup_message', 'alpb-general-content-options' );
			/*btn text color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_btn_label_color', 'alpb_popup_message_general_btn_label_callback' );
			/*btn bg color*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_btn_label_bg_color', 'alpb_popup_message_general_btn_label_callback' );
			/*===============================================
				Register General Settings - button link
			=================================================*/
			register_setting( 'alpb-popup-message-general-group', 'general_popup_message_btn_link', 'alpb_popup_message_general_btn_link_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_btn_link_section', 'popup_message' );
			add_settings_field( 'general-popup-message-btn_link-name', 'Button Link', 'alpb_popup_message_general_btn_link_field', 'popup_message', 'alpb-general-content-options' );
			/*===============================================
				Register General Settings - background image
			=================================================*/
			/*register_setting( 'alpb-popup-message-general-group', 'general_popup_message_bg_image', 'alpb_popup_message_general_bg_image_callback' );
			add_settings_section( 'alpb-general-content-options', '', 'alpb_popup_message_general_bg_image_section', 'popup_message' );
			add_settings_field( 'general-popup-message-bg_image-name', 'Background Image', 'alpb_popup_message_general_bg_image_field', 'popup_message', 'alpb-general-content-options' );*/

			

		}

		//Popup status option
		function alpb_popup_message_general_status_callback( $input ){ return $input; }

		function alpb_popup_message_general_status_section(){}

		function alpb_popup_message_general_status_field(){
			$option = get_option( 'general_popup_message_status' );
			$check = ( @$option == 1 ) ? 'checked' : '';
			echo '
				<label>
					<input type="checkbox" id="general_popup_message_status" name="general_popup_message_status" value="1" '.$check.'/> 
					Activate popup message
				</label>
			';
		}

		//Popup wrapper background option
		function alpb_popup_message_general_container_bg_color_callback( $input ){ return $input; }

		function alpb_popup_message_general_container_bg_color_section(){}

		function alpb_popup_message_general_container_bg_color_field(){
			$color = get_option( 'general_popup_message_container_bg_color' );
			$picture = esc_attr( get_option( 'general_popup_message_bg_image' ) );
			$output = '
				<input type="text" class="alpha-color-picker" data-alpha="true" name="general_popup_message_container_bg_color" value="' . sanitize_text_field($color) . '"/><br>
				<input type="hidden" id="alpb-popup-message-bg-image" name="general_popup_message_bg_image" value="'.$picture.'">
				<input type="button" value="Upload Background Image" id="alpb-popup-message-upload-button" class="button button-secondary">
				<div id="alpb-popup-message-bg-preview" 
					style="
						border: 1px solid #ccc; 
						width:150px; 
						height:150px; 
						margin-top:20px; 
						background-image:url('.$picture.'); 
						background-size:cover; 
						background-position:center; 
						background-repeat:no-repeat;
					"
				></div><br>
				<input type="button" value="Remove" id="alpb-popup-message-remove-image-button" class="button button-secondary">
			';
			echo $output;
		}

		//Popup title option
		function alpb_popup_message_general_title_callback( $input ){ return $input; }

		function alpb_popup_message_general_title_section(){}

		function alpb_popup_message_general_title_field(){
			$option = get_option( 'general_popup_message_title' );
			$color = get_option( 'general_popup_message_text_color_title' );
			$output = '
				<input type="text" id="alpb_popup_message_title" name="general_popup_message_title" class="regular-text" value="'.$option.'" autocomplete="off" />
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_text_color_title" class="popup-message-custom-color-field" value="'.$color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup subtitle option
		function alpb_popup_message_general_subtitle_callback( $input ){ return $input; }

		function alpb_popup_message_general_subtitle_section(){}

		function alpb_popup_message_general_subtitle_field(){
			$option = get_option( 'general_popup_message_subtitle' );
			$color = get_option( 'general_popup_message_text_color_subtitle' );
			$output = '
				<textarea id="alpb_popup_message_subtitle" name="general_popup_message_subtitle" class="regular-text" cols="20" rows="5">'.$option.'</textarea>
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_text_color_subtitle" class="popup-message-custom-color-field" value="'.$color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup descriptions option
		function alpb_popup_message_general_descriptions_callback( $input ){ return $input; }

		function alpb_popup_message_general_descriptions_section(){}

		function alpb_popup_message_general_descriptions_field(){
			$option = get_option( 'general_popup_message_descriptions' );
			$color = get_option( 'general_popup_message_descriptions_color' );
			$output = '
				<textarea id="alpb_popup_message_descriptions" name="general_popup_message_descriptions" class="regular-text" cols="20" rows="5">'.$option.'</textarea>
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_descriptions_color" class="popup-message-custom-color-field" value="'.$color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup lists option
		function alpb_popup_message_general_lists_callback( $input ){ return $input; }

		function alpb_popup_message_general_lists_section(){}

		function alpb_popup_message_general_lists_field(){
			$color = get_option( 'general_popup_message_lists_color' );
			$list_style_color = get_option('general_popup_message_lists_style_color');
			$options = get_option( 'general_popup_message_lists' );
			$option_count = count($options);
			$output = '<div class="popup-message-list-container">';
			if($options != ""){
				foreach($options as $key => $val){
					if($option_count <= 1){
						$output .= '
							<div>
								<input type="text" name="general_popup_message_lists[]" class="regular-text" value="'.$val.'" autocomplete="off"/>
							</div>
						';
					}else{
						$output .= '
							<div>
								<input type="text" name="general_popup_message_lists[]" class="regular-text" value="'.$val.'" autocomplete="off"/> 
								<a href="#" class="popup_message_remove_list_btn delete" style="color:#a00;">remove</a>
							</div>
						';
					}
				}
			}else{
				$output .= '
					<div>
						<input type="text" name="general_popup_message_lists[]" class="regular-text" value="'.$val.'" autocomplete="off"/>
					</div>
				';
			}
			$output .= '</div><br>
				<button class="button button-secondary popup-message-add-list-btn">Add</button>
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_lists_color" class="popup-message-custom-color-field" value="'.$color.'" /></td>
					</tr>
					<tr>
						<td valign="top"><strong><small>List Style Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_lists_style_color" class="popup-message-custom-color-field" value="'.$list_style_color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup ps option
		function alpb_popup_message_general_ps_callback( $input ){ return $input; }

		function alpb_popup_message_general_ps_section(){}

		function alpb_popup_message_general_ps_field(){
			$option = get_option( 'general_popup_message_ps' );
			$color = get_option( 'general_popup_message_ps_color' );
			$output = '
				<input type="text" id="alpb_popup_message_ps" name="general_popup_message_ps" class="regular-text" value="'.$option.'" autocomplete="off"/>
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_ps_color" class="popup-message-custom-color-field" value="'.$color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup button text option
		function alpb_popup_message_general_btn_label_callback( $input ){ return $input; }

		function alpb_popup_message_general_btn_label_section(){}

		function alpb_popup_message_general_btn_label_field(){
			$option = get_option( 'general_popup_message_btn_label' );
			$text_color = get_option( 'general_popup_message_btn_label_color' );
			$bg_color = get_option( 'general_popup_message_btn_label_bg_color' );
			$output = '
				<input type="text" id="alpb_popup_message_ps" name="general_popup_message_btn_label" class="regular-text" value="'.$option.'" autocomplete="off"/>
				<table>
					<tr>
						<td valign="top"><strong><small>Text Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_btn_label_color" class="popup-message-custom-color-field" value="'.$text_color.'" /></td>
					</tr>
					<tr>
						<td valign="top"><strong><small>Background Color</small></strong></td>
						<td valign="top"><input type="text" name="general_popup_message_btn_label_bg_color" class="popup-message-custom-color-field" value="'.$bg_color.'" /></td>
					</tr>
				</table>
			';
			echo $output;
		}

		//Popup button link option
		function alpb_popup_message_general_btn_link_callback( $input ){ return $input; }

		function alpb_popup_message_general_btn_link_section(){}

		function alpb_popup_message_general_btn_link_field(){
			$option = get_option( 'general_popup_message_btn_link' );
			$output = '<input type="text" id="alpb_popup_message_link" name="general_popup_message_btn_link" class="regular-text" value="'.$option.'" autocomplete="off"/>';
			echo $output;
		}

		//Popup background image

		function alpb_popup_message_general_bg_image_callback( $input ){ return $input; }

		function alpb_popup_message_general_bg_image_section(){}

		function alpb_popup_message_general_bg_image_field(){
			
		}

	}

}

?>