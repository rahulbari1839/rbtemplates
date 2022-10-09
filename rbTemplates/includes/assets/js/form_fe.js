
jQuery(document).ready(function(){
	rbt_submit_form();
	jQuery('.rb_field_input_file_class').on('change',function(){
		RBTUploadfileShow(this,show_image_class = '');
	});

	if(jQuery('.rbt_gallery_template_wrapper').length != 0){
		jQuery('.rbt_gallery_template_wrapper').each(function(){

			new Viewer(document.getElementById(jQuery(this).closest('.rbt_form_outer_gallery').attr('id')));
		});
		
	}

	jQuery('.rbt_temp_button_click_show').on('click',function(event){
		event.preventDefault();
		console.log("rbt_temp_button_click_show call");
		if(jQuery(this).closest('.rbt_frontend_outer_div').length == 1){
			jQuery(this).hide();
			jQuery(this).closest('.rbt_frontend_outer_div').find('#rbt_form_template_wrapper').fadeIn();
		}
	});


	jQuery('.rbt_close_template_popup').on('click',function(event){
		event.preventDefault();
		console.log("rbt_temp_button_click_show call");
		if(jQuery(this).closest('.rbt_frontend_outer_div').length == 1){
			jQuery(this).hide();
			jQuery(this).closest('.rbt_frontend_outer_div').hide('slow');
		}
	});

});


function rbt_submit_form(){	
	//console.log('rbt_submit_form call');
	jQuery('.rbt_temp_form_submit_btn input').keypress(function (e) {
		if (e.which == 13) {
			var parent_id = jQuery(this).closest('.rbt_frontend_outer_div').attr('id');
			var parent_obj = jQuery('#'+parent_id);
			parent_obj.find('form#rbt_temp_form .rbt_temp_form_submit_btn').trigger('click');
			return false; 
		}
	});
	
	jQuery(document).on('click','.rbt_temp_form_submit_btn',function(event){
		console.log('rbt_submit_form call click');
		event.preventDefault();
		var parent_id = jQuery(this).closest('.rbt_frontend_outer_div').attr('id');
		var parent_obj = jQuery('#'+parent_id);
		if(parent_obj.hasClass('rbt_form_submited')){
			return false;
		}

		var validation_status = rbt_form_validation(parent_id);
		if(validation_status){
			return false;
		}
		var error_msg = '';
		var validation_status = false;
		var input_values = {};
		parent_obj.find('form#rbt_temp_form input:visible').each(function(){
			var field_error_status =  false;
			var value = jQuery(this).val();
			var name = jQuery(this).attr('name');
			var type = jQuery(this).attr('type');
			if(type == 'file'){
				value = '';
				if(jQuery(this).closest('.rbt_field_wrapper').find('.rbt_field_file_html img').length == 1){
					value = rtb_image_base64_url;
				}
			}
			var value_info = {type:type,value:value};
			input_values[name] =  value_info;	
		});

		
		var form_id = parent_obj.find('input[name="rbt_form_id"]').val();
		
		
		var send_data = {action_name:'save_form_fe',form_id:form_id,input_values:input_values,action_type:'form_submite'};

		var output = rbt_call_ajax_data(this,send_data,'');
		//console.log("output===");
		//console.log(output);
		if(output && output.success){
			parent_obj.find('.rbt_error_response').removeClass('rbt_error_response'); 
			parent_obj.find('.error_message_div .rbt_error_div_info').html(output.success); 
			parent_obj.find('.error_message_div').show(); 
			jQuery(this).addClass('rbt_disabled_pointer_event');
			parent_obj.addClass('rbt_form_submited');
		}else if(output && output.error){
			parent_obj.find('.error_message_div .rbt_error_div_info').addClass('rbt_error_response').html(output.error); 
			parent_obj.find('.error_message_div').show(); 
			return false;
		}
		//console.log(output);
		//console.log('save data');
	});
	
}
