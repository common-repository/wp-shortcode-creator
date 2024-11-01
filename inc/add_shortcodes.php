<?php
function add_shortcodes() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwshortcodecreator");
    if( $result ) {
         foreach( $result as $row ) {
            $bwshortcodecreator_shortcode_title = $row->shortcode_title;
            $bwshortcodecreator_shortcode_content= $row->shortcode_content;
            $bwshortcodecreator_shortcode_attributes = $row->shortcode_attributes;
            $bwshortcodecreator_shortcode_enable_php = $row->shortcode_enable_php;
			$bwshortcodecreator_shortcode_php = $row->shortcode_php;
            $id = $row->id;
            $bwshortcodecreator_function_name = 'bwshortcodecreator_'.$id;
            eval("add_shortcode( '".$bwshortcodecreator_shortcode_title."', '".$bwshortcodecreator_function_name."' );");
            if($bwshortcodecreator_shortcode_enable_php == 1) {
                eval(" function ".$bwshortcodecreator_function_name."() {
                    \$custom_php = ".$bwshortcodecreator_shortcode_php.";
                    return bwshortcodecreator_mynl2br(\$custom_php);
                    }"
                );
            } else {
                eval(" function ".$bwshortcodecreator_function_name."() {   
                    return '".bwshortcodecreator_mynl2br($bwshortcodecreator_shortcode_content)."';
                    }"
                );
            }
         }
    }
}
?>