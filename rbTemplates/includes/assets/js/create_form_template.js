jQuery(document).ready(function(){
	rbt_tiny_mce_editor();
	rbt_add_temp_customizer_init();
	rbt_change_placehoder('rbt_field_change_placehoder');
	rbt_mediauploader_image(img_resizeable_call = 'Y');
	rbt_img_resizeable();
	rbt_template_drag_drop_element_customizer_init();
	rbt_template_drag_drop_element_customizer_level_2_init();
	rbt_drag_drop_element_delete();
	rbtValidateTabs(tab_class = 'rbt_tabs');
});


function rbt_add_temp_customizer_init(){
	var rbt_template_customzier_outer_selector = '.template_html_outer';
	var rbt_template_customzier_selector = '.rbt_template_wrapper_customizer_init';
	
	// temp style 
		jQuery('#rbt_temp_aligment').on('change',function() {
			jQuery(rbt_template_customzier_outer_selector).find('.rbt_form_wrapper_template').css('text-align',jQuery(this).val());
		});
		jQuery('#rbt_temp_background_color,#rbt_temp_background_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('background-color', jQuery(this).colorpicker('getValue'));
		});
		jQuery('#rbt_temp_wid').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('max-width', +this.value + 'px');
		});
	// temp border style
		jQuery('#rbt_temp_border_width').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('border-width', +this.value + 'px');
		});
		
		jQuery('#rbt_temp_border_style').on('change',function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('border-style',jQuery(this).val());
		});
		
		jQuery('#rbt_temp_border_color,#rbt_temp_border_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('border-color', jQuery(this).colorpicker('getValue'));
		});
		
		jQuery('#rbt_temp_border_radius').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_template_customzier_selector).css('border-radius', +this.value + 'px');
		});
	
	//temp External Shadow Customizer
		jQuery('#rbt_temp_shadow_vertical_length').bootstrapSlider().change(function() {
			rbt_temp_form_boxShadow();
		});
		jQuery('#rbt_temp_shadow_horizontal_length').bootstrapSlider().change(function() {
			rbt_temp_form_boxShadow();
		});
			jQuery('#rbt_temp_shadow_blur_radius').bootstrapSlider().change(function() {
			rbt_temp_form_boxShadow();
		});
			jQuery('#rbt_temp_shadow_spread_radius').bootstrapSlider().change(function() {
			rbt_temp_form_boxShadow();
		});
		jQuery('#rbt_temp_shadow_color,#rbt_temp_shadow_color_div').colorpicker().on('changeColor', function() {
			
			rbt_temp_form_boxShadow(jQuery(this).colorpicker('getValue'));
		});
	// submit buttton style 
		var rbt_signin_btn_selector = '.signin_btn';
		jQuery('#rbt_temp_submit_btn_width').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('max-width', +this.value + 'px');
		});
		
		jQuery('#rbt_temp_submit_btn_height').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('line-height', +this.value + 'px');
		});
		jQuery('#rbt_temp_submit_btn_border_width').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('border-width', +this.value + 'px');
		});
		jQuery('#rbt_temp_submit_btn_radius').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('border-radius', +this.value + 'px');
		});
		
		jQuery('#rbt_temp_submit_btn_background_color,#rbt_temp_submit_btn_background_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('background-color', jQuery(this).colorpicker('getValue'));
		});
		jQuery('#rbt_temp_submit_btn_border_color,#rbt_temp_submit_btn_border_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('border-color', jQuery(this).colorpicker('getValue'));
		});
		
		jQuery('#rbt_temp_submit_btn_border_style').on('change',function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('border-style',jQuery(this).val());
		});
		
		// error section   style 
		var rbt_error_div_info_selector = '.rbt_error_div_info';
		jQuery('#rbt_temp_error_width').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('max-width', +this.value + 'px');
		});
		jQuery('#rbt_temp_error_border_width').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_signin_btn_selector).css('border-width', +this.value + 'px');
		});
		jQuery('#rbt_temp_error_border_radius').bootstrapSlider().change(function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_error_div_info_selector).css('border-radius', +this.value + 'px');
		});
		
		jQuery('#rbt_temp_error_background_color,#rbt_temp_error_background_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_error_div_info_selector).css('background-color', jQuery(this).colorpicker('getValue'));
		});
		jQuery('#rbt_temp_error_border_color,#rbt_temp_error_border_color_div').colorpicker().on('changeColor', function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_error_div_info_selector).css('border-color', jQuery(this).colorpicker('getValue'));
		});
		
		jQuery('#rbt_temp_error_style').on('change',function() {
			jQuery(rbt_template_customzier_outer_selector).find(rbt_error_div_info_selector).css('border-style',jQuery(this).val());
		});
		
	
	

}


function rbt_temp_form_boxShadow(colorval = '') {
	
	var hor_lnth = parseFloat(jQuery('#rbt_temp_shadow_horizontal_length').val());
	var ver_lnth = parseFloat(jQuery('#rbt_temp_shadow_vertical_length').val());
	var blur_radius = parseFloat(jQuery('#rbt_temp_shadow_blur_radius').val());
	var sprd_radius = parseFloat(jQuery('#rbt_temp_shadow_spread_radius').val());
	var shad_clr = jQuery('#rbt_temp_shadow_color').val();
	hor_lnth = hor_lnth + 'px';
	ver_lnth = ver_lnth + 'px';
	blur_radius = blur_radius + 'px';
	sprd_radius = sprd_radius + 'px';
	var box_shadow = hor_lnth + ' ' + ver_lnth + ' ' + blur_radius + ' ' + sprd_radius + ' ' + shad_clr;
	var cs_customize_template_outer_Selector = '#rbt_form_template_wrapper .rbt_template_wrapper_customizer_init';
	jQuery(cs_customize_template_outer_Selector).css('-webkit-box-shadow', box_shadow);
	jQuery(cs_customize_template_outer_Selector).css('-moz-box-shadow', box_shadow);
	jQuery(cs_customize_template_outer_Selector).css('box-shadow', box_shadow);
}


function rbt_save_form_template(obj = null,current_tab_id = '',next_tab_id = ''){
	
	var current_obj = obj;
	var form_name = jQuery('#rbt_form_name').val();
	
	

	var validation_status = rbt_form_validation(form_id = 'rbt_tab_1', validation_show_type = '');
	if(validation_status){
		rbt_next_tab_show('rbt_tab_1');
		return false;
	}
	
	var selected_template_number = jQuery('ul.rbt_templates_list .rbt_selcted_temp').attr('data-temp');
	// remove customiser 
	rbt_remove_element_customizer();


	var temp_html = jQuery('.template_html_outer .template_html_wrapper').html();
	temp_html = rbt_remove_unused_html_content(temp_html);
	temp_html = rbtTinymceRemoveIds(temp_html);
	temp_html = btoa(temp_html);
	var template_type = jQuery('#template_type').val();
	var display_type = jQuery('#rbt_temp_display_type').val();
	
	if( typeof display_type === 'undefined'){	
		display_type = '';
	}
	var temp_html2 = '';
	if(display_type == 'button_click'){
		var temp_html2 = jQuery('.template_button_html_outer  .template_button_html_inner').html();
		temp_html2 = rbt_remove_unused_html_content(temp_html2);
		temp_html2 = rbtTinymceRemoveIds(temp_html2);
		temp_html2 = btoa(temp_html2);
	}

	var customizer_values = '';
	
	//Temp border section customizer
	var rbt_temp_aligment = jQuery('#rbt_temp_aligment').val();
	var rbt_temp_wid = jQuery('#rbt_temp_wid').val();
	var rbt_temp_background_color = jQuery('#rbt_temp_background_color').val();
	var customizer_value1 = rbt_temp_aligment+'||'+rbt_temp_wid+'||'+rbt_temp_background_color;
	//Temp border section customizer
	var rbt_temp_border_width = jQuery('#rbt_temp_border_width').val();
	var rbt_temp_border_style = jQuery('#rbt_temp_border_style').val();
	var rbt_temp_border_color = jQuery('#rbt_temp_border_color').val();
	var rbt_temp_border_radius = jQuery('#rbt_temp_border_radius').val();
	var customizer_value2 = rbt_temp_border_width+'||'+rbt_temp_border_style+'||'+rbt_temp_border_color+'||'+rbt_temp_border_radius;
	
	//Temp shadow section customizer
	var rbt_temp_shadow_color = jQuery('#rbt_temp_shadow_color').val();
	var rbt_temp_shadow_spread_radius = jQuery('#rbt_temp_shadow_spread_radius').val();
	var rbt_temp_shadow_blur_radius = jQuery('#rbt_temp_shadow_blur_radius').val();
	var rbt_temp_shadow_horizontal_length = jQuery('#rbt_temp_shadow_horizontal_length').val();
	var rbt_temp_shadow_vertical_length = jQuery('#rbt_temp_shadow_vertical_length').val();
	var customizer_value3 = rbt_temp_shadow_color+'||'+rbt_temp_shadow_spread_radius+'||'+rbt_temp_shadow_blur_radius+'||'+rbt_temp_shadow_horizontal_length+'||'+rbt_temp_shadow_vertical_length;
	//Temp submit button section customizer
	var rbt_temp_submit_btn_width = jQuery('#rbt_temp_submit_btn_width').val();
	var rbt_temp_submit_btn_height = jQuery('#rbt_temp_submit_btn_height').val();
	var rbt_temp_submit_btn_background_color = jQuery('#rbt_temp_submit_btn_background_color').val();
	var rbt_temp_submit_btn_border_width = jQuery('#rbt_temp_submit_btn_border_width').val();
	var rbt_temp_submit_btn_border_style = jQuery('#rbt_temp_submit_btn_border_style').val();
	var rbt_temp_submit_btn_border_color = jQuery('#rbt_temp_submit_btn_border_color').val();
	var rbt_temp_submit_btn_radius = jQuery('#rbt_temp_submit_btn_radius').val();
	var customizer_value4 = rbt_temp_submit_btn_width+'||'+rbt_temp_submit_btn_height+'||'+rbt_temp_submit_btn_background_color+'||'+rbt_temp_submit_btn_border_width+'||'+rbt_temp_submit_btn_border_style+'||'+rbt_temp_submit_btn_border_color+'||'+rbt_temp_submit_btn_radius;
	//error section customizer
	var rbt_temp_error_background_color = jQuery('#rbt_temp_error_background_color').val();
	var rbt_temp_error_width = jQuery('#rbt_temp_error_width').val();
	var rbt_temp_error_border_width = jQuery('#rbt_temp_error_border_width').val();
	var rbt_temp_error_style = jQuery('#rbt_temp_error_style').val();
	var rbt_temp_error_border_color = jQuery('#rbt_temp_error_border_color').val();
	var rbt_temp_error_border_radius = jQuery('#rbt_temp_error_border_radius').val();
	var customizer_value5 = rbt_temp_error_background_color+'||'+rbt_temp_error_width+'||'+rbt_temp_error_border_width+'||'+rbt_temp_error_style+'||'+rbt_temp_error_border_color+'||'+rbt_temp_error_border_radius;

	//template type click button show customizer
	var rbt_temp_click_button_values6 = '';
	if(display_type == 'button_click'){
		var rbt_temp_click_button_aligment = jQuery('input[name="rbt_temp_click_button_aligment"]').val();
		var rbt_temp_click_button_wid = jQuery('input[name="rbt_temp_click_button_wid"]').val();
		var rbt_temp_click_button_height = jQuery('input[name="rbt_temp_click_button_height"]').val();
		var rbt_temp_click_button_backgound_color = jQuery('input[name="rbt_temp_click_button_backgound_color"]').val();
		var rbt_temp_click_button_margin_top = jQuery('input[name="rbt_temp_click_button_margin_top"]').val();
		var rbt_temp_click_button_margin_bottom = jQuery('input[name="rbt_temp_click_button_margin_bottom"]').val();

	 	rbt_temp_click_button_values6 = rbt_temp_click_button_aligment+'||'+rbt_temp_click_button_wid+'||'+rbt_temp_click_button_height+'||'+rbt_temp_click_button_backgound_color+'||'+rbt_temp_click_button_margin_top+'||'+rbt_temp_click_button_margin_bottom;
	}

	
	var customizer_values =  customizer_value1+'||||'+customizer_value2+'||||'+customizer_value3+'||||'+customizer_value4+'||||'+customizer_value5+'||||'+rbt_temp_click_button_values6;
	
	var edit_id = jQuery('#rbt_form_edit_id').val();
	var email_template_id = '';
	if(jQuery('#email_template_id').length == 1){
		var email_template_id = jQuery('#email_template_id').val();
	}
	
	
	

	
	
	var form_data = {
				edit_id: edit_id,
				form_name : form_name,
				selected_template_number : selected_template_number,
				temp_html : temp_html,
				customizer_values : customizer_values,
				email_template_id : email_template_id,
				template_type : template_type,
				display_type : display_type,
				temp_html2 : temp_html2,
			}	
	
	var button_text = jQuery(current_obj).text();
	jQuery(current_obj).text('Please Wait..');
	rbt_show_loader();
	jQuery.post(ajaxurl, {
	action: 'rbt_create_form_template_ajax',
	form_data: form_data,   
	}, function(response) {
		rbt_hide_loader();
		response = JSON.parse(response);
		if(response.error){
			rbt_swal_message('',response.error,'');
			return false;
		}
		
		if(response.success){
			jQuery(current_obj).text(button_text);
			if(next_tab_id != ''){
				rbt_next_tab_show(next_tab_id);
			}
			jQuery('#rbt_form_edit_id').val(response.edit_id);
			if(response.shortcode_details){
				jQuery('.shortcode_details_div').html(response.shortcode_details);
			}
			
		}
	});
}



