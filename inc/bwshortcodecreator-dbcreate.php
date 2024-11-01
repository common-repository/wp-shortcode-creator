<?php
function bwshortcodecreator_dbcreate() {
	global $wpdb;
	$table_name = $wpdb->prefix . "bwshortcodecreator"; 
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  timestamp varchar(30) NOT NULL,
	  shortcode_title varchar(100) NOT NULL,
	  shortcode_nicename varchar(100) NOT NULL,
	  shortcode_attributes varchar(500) NOT NULL,
	  shortcode_enable_php int(1) NOT NULL,
	  shortcode_php varchar(5000) NOT NULL,
	  shortcode_content varchar(5000) NOT NULL,
	  UNIQUE KEY id (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
?>