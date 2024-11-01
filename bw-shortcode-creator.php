<?php
/*
 *	Plugin Name: WP Shortcode Creator
 *	Plugin URI: http://tech-centralhq.com/
 *	Description: Create shortcodes with ease
 *	Version: 1.2
 *	Author: Brendan Wolfe
 *	Author URI: http://tech-centralhq.com
 *	License: GPL2
 *
*/

/*
* Run when activated
*/
include('inc/bwshortcodecreator-dbcreate.php');
register_activation_hook(__FILE__,'bwshortcodecreator_dbcreate');

/*
* My Functions
*/
include('inc/functions.php');
include('inc/add_shortcodes.php');
add_shortcodes();

/*
* Add a link to plugin in the admin menu
* under 'Settings > Shortcode Creator'
*/
function bwshortcodecreator_menu() {
	/*
	* Use the add_options_page function
	* add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
	*/
	
	add_options_page(
		'Shortcode Creator',
		'Shortcode Creator',
		'manage_options',
		'bwshortcodecreator',
		'bwshortcodecreator_options_page'
	);
}
add_action( 'admin_menu', 'bwshortcodecreator_menu' );

function bwshortcodecreator_options_page() {
	if( !current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have sufficient permision to access this page' );
	}

	global $wpdb;
	
	if( isset( $_POST['bwshortcodecreator_new_shortcode_form_submitted'] ) ) {
		
		$hidden_field = esc_html($_POST['bwshortcodecreator_new_shortcode_form_submitted']);
		$hidden_field = esc_sql($hidden_field);
		
		if( $hidden_field == 'Y' ) {
			$bwshortcodecreator_shortcode_title = esc_sql($_POST['bwshortcodecreator_shortcode_title']);
			$bwshortcodecreator_shortcode_content = '';
			$bwshortcodecreator_timestamp = time();
			$bwshortcodecreator_shortcode_attributes = '';
			$bwshortcodecreator_shortcode_enable_php = '';
			$bwshortcodecreator_shortcode_php = '';
			$bwshortcodecreator_shortcode_nicename = esc_sql($_POST['bwshortcodecreator_shortcode_nicename']);
			
			$table_name = $wpdb->prefix . 'bwshortcodecreator';
			
			$wpdb->insert( 
				$table_name, 
				array( 
					'timestamp' => $bwshortcodecreator_timestamp, 
					'shortcode_title' => $bwshortcodecreator_shortcode_title, 
					'shortcode_content' => $bwshortcodecreator_shortcode_content,
					'shortcode_nicename' => $bwshortcodecreator_shortcode_nicename,
					'shortcode_attributes' => $bwshortcodecreator_shortcode_attributes,
					'shortcode_enable_php' => $bwshortcodecreator_shortcode_enable_php,
					'shortcode_php' => $bwshortcodecreator_shortcode_php
				) 
			);
		}
	}
	if( isset( $_POST['bwshortcodecreator_edit_shortcode_form_submitted'] ) ) {
		
		$hidden_field = esc_html($_POST['bwshortcodecreator_edit_shortcode_form_submitted']);
		$hidden_field = esc_sql($hidden_field);
		
		if( $hidden_field == 'Y' ) {
			$bwshortcodecreator_shortcode_title = esc_sql($_POST['bwshortcodecreator_shortcode_title']);
			$bwshortcodecreator_shortcode_content = htmlspecialchars($_POST['bwshortcodecreator_shortcode_content']);
			$bwshortcodecreator_timestamp = time();
			$bwshortcodecreator_shortcode_attributes = ''; //esc_sql($_POST['bwshortcodecreator_shortcode_attributes']);
			$bwshortcodecreator_shortcode_nicename = esc_sql($_POST['bwshortcodecreator_shortcode_nicename']);
			$bwshortcodecreator_id = esc_sql($_POST['bwshortcodecreator_edit_shortcode_id']);
			if(isset($_POST['bwshortcodecreator_shortcode_enable_php'])) {
				$bwshortcodecreator_shortcode_enable_php = 1;
				$bwshortcodecreator_shortcode_php = esc_sql($_POST['bwshortcodecreator_shortcode_php']);
			} else {
				$bwshortcodecreator_shortcode_enable_php = 0;
				$bwshortcodecreator_shortcode_php = esc_sql($_POST['bwshortcodecreator_shortcode_php']);
			}

			$table_name = $wpdb->prefix.'bwshortcodecreator';
			
			$wpdb->update( 
				$table_name,
				array( 
					'timestamp' => $bwshortcodecreator_timestamp, 
					'shortcode_title' => $bwshortcodecreator_shortcode_title, 
					'shortcode_content' => $bwshortcodecreator_shortcode_content,
					'shortcode_nicename' => $bwshortcodecreator_shortcode_nicename,
					'shortcode_attributes' => $bwshortcodecreator_shortcode_attributes,
					'shortcode_enable_php' => $bwshortcodecreator_shortcode_enable_php,
					'shortcode_php' => $bwshortcodecreator_shortcode_php
				),
				array( 'id' => $bwshortcodecreator_id )
			);
		}
	}
	if( isset( $_POST['bwshortcodecreator_delete_shortcode_form_submitted'] ) ) {
		
		$hidden_field = esc_html($_POST['bwshortcodecreator_delete_shortcode_form_submitted']);
		$hidden_field = esc_sql($hidden_field);
		
		if( $hidden_field == 'Y' ) {
			$bwshortcodecreator_id = esc_sql($_POST['bwshortcodecreator_shortcode_id']);
			
			$table_name = $wpdb->prefix . 'bwshortcodecreator';
			
			$wpdb->delete( 
				$table_name, 
				array('id' => $bwshortcodecreator_id)
			);
		}
	}
	
	require( 'inc/options-page-wrapper.php' );
}

function bwshortcodecreator_styles() {
	wp_enqueue_style( 'bwshortcodecreator_styles', plugins_url('/css/bw-shortcode-creator.css', __FILE__) );
}
add_action( 'admin_head', 'bwshortcodecreator_styles' );

function bwshortcodecreator_add_js() {
	wp_register_script('bwshortcodecreator_js_admin', plugins_url('/js/bwshortcodecreator_js.js', __FILE__), array('jquery'), true);
	wp_enqueue_script('bwshortcodecreator_js_admin');
}
add_action('admin_enqueue_scripts', 'bwshortcodecreator_add_js');
?>