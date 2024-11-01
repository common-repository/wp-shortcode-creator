jQuery(document).ready(function(){
    jQuery('.bwsc_content').first().slideDown('fast');
      
	jQuery('.bwsc_button').on('click',function() {
		jQuery('.bwsc_content').slideUp('fast');
        var sectionID = jQuery(this).attr("id");
        if (sectionID == 'section_last') {
            jQuery('#section_last').removeClass("section_last");
        } else {
            jQuery('#section_last').addClass("section_last");
        }
		jQuery(this).next('.bwsc_content').slideDown('fast');
	});
    
    jQuery('#bwshortcodecreator_shortcode_enable_php').change(function() {
        if(this.checked) {
             jQuery('#bwshortcodecreator_shortcode_php').removeAttr("disabled");
             jQuery('#bwshortcodecreator_shortcode_content').attr("disabled", "disabled");
        } else {
             jQuery('#bwshortcodecreator_shortcode_php').attr("disabled", "disabled");
             jQuery('#bwshortcodecreator_shortcode_content').removeAttr("disabled");
        }
    });
});