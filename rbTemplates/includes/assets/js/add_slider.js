function rbtAddSliderButtonTrigger(obj = ''){
	console.log("rbtAddSlider call");
	var send_data = {'type':'load_add_slider_form_html','action':'load_add_slider_form_html'};
	var response = rbt_call_ajax_data(obj, send_data);
	if(response.success){
		body_html = response.html;
		rbt_show_modal('<h1>Select Slider Options<h1>', body_html);
		rbt_tiny_mce_editor();
	}
}

function rbtAddSliderSection(obj = ''){

	
	var parent_selector = jQuery(obj).closest('.rbt_modal_outer');
	var form_id = parent_selector.attr('id');
	var validation_status_tab = rbt_form_validation(form_id);
	if(validation_status_tab){
		not_has_error = false;
		return false;
	}

	var heading_checked = parent_selector.find('input[name="slider_heading_y"]').prop('checked');
	var heading_text_html =  parent_selector.find('.slider_heading_html').html();
	if(heading_checked){
			heading_checked = 'Y';
	}else{
			heading_checked = 'N';
	}

	var description_checked = parent_selector.find('input[name="slider_description_y"]').prop('checked');
	var description_text_html =  parent_selector.find('.slider_description_html').html();
	if(description_checked){
			description_checked = 'Y';
	}else{
			description_checked = 'N';
	}
	heading_text_html = rbt_remove_unused_html_content(heading_text_html);
	heading_text_html = rbtTinymceRemoveIds(heading_text_html);


	description_text_html = rbt_remove_unused_html_content(description_text_html);
	description_text_html = rbtTinymceRemoveIds(description_text_html);
	

	var slider_img_id = parent_selector.find('input[name="slider_img_id"]').val();
	var slider_img_url = parent_selector.find('.add_slider_img_preview_html img').attr('src');
	
	var send_data = {'type':'load_slider_item_html','action':'load_slider_item_html','slider_img_url':slider_img_url
, 'slider_img_id':slider_img_id,'heading_checked':heading_checked,'heading_text_html':heading_text_html,'description_checked':description_checked,'description_text_html':description_text_html};
	var response = rbt_call_ajax_data(obj, send_data);
	if(response.success){
		if(jQuery('.template_html_wrapper_backend').find('.slider_item_edit_active').length == 1){
				jQuery('.template_html_wrapper_backend .slider_item_edit_active').after(response.html);
				jQuery('.template_html_wrapper_backend .slider_item_edit_active').remove();
		}else{
				jQuery('.template_html_wrapper_backend').append(response.html);
		}

		rbt_hide_modal();
	}
	// call ajax 

}


function rbtSliderEditItem(obj = ''){
  jQuery('.slider_item_edit_active').removeClass('slider_item_edit_active');
	var parent_obj = jQuery(obj).closest('.slider_item');
	parent_obj.addClass('slider_item_edit_active')
	var slider_item_img_id = parent_obj.find('.slider_item_img_id').val();
	var slider_item_heading_checked = parent_obj.find('.slider_item_heading_checked').val();
	

	var slider_item_heading_text_html = parent_obj.find('.slider_item_heading_text_html').html();
	var slider_item_description_checked = parent_obj.find('.slider_item_description_checked').val();
	var slider_item_description_text_html = parent_obj.find('.slider_item_description_text_html').html();
	var slider_item_img_src = parent_obj.find('.slider_item_img_src').attr('src');

	

	var send_data = {'type':'load_add_slider_form_html','action':'load_add_slider_form_html','slider_item_img_id':slider_item_img_id,'slider_item_heading_checked':slider_item_heading_checked,'slider_item_heading_text_html':slider_item_heading_text_html,	'slider_item_description_checked':slider_item_description_checked,'slider_item_description_text_html':slider_item_description_text_html,'slider_item_img_src':slider_item_img_src};
	var response = rbt_call_ajax_data(obj, send_data);
	if(response.success){
		body_html = response.html;
		body_html = rbtTinymceRemoveIds(body_html);
	//	body_html = body_html.stripSlashes();
		rbt_show_modal('<h1>Select Slider Options<h1>', body_html);

		rbt_tiny_mce_editor();
	}

}

function rbtSliderDeleteItem(obj = ''){
		var current_obj = obj;
		swal({
			title: "Are you sure you want to delete ?",
			text: "You cannot recover the settings.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: 'rbt_swal_custom_class',
			
		}).then((result) => {
			if (result.value) {		
				jQuery(current_obj).closest('.slider_item').remove();
		
			}
		});
			
}

function rbtSaveSliderSortcode(obj = null,current_tab_id = '',next_tab_id = ''){
	
	var current_obj = obj;
	var form_name = jQuery('#rbt_form_name').val();
	var validation_status = rbt_form_validation(form_id = 'rbt_tab_1', validation_show_type = '');
	if(validation_status){
		rbt_next_tab_show('rbt_tab_1');
		return false;
	}
	
	var selected_template_number = jQuery('ul.rbt_templates_list .rbt_selcted_temp').attr('data-temp');
	var temp_html = '';
	if(jQuery('.template_html_wrapper_backend .slider_item').length != 0){

			slider_item = '';
			jQuery('.template_html_wrapper_backend .slider_item').each(function(slider_index){
				var slider_item_obj =  jQuery(this);
				var slider_item_img_id = slider_item_obj.find('.slider_item_img_id').val();
				var slider_item_heading_checked = slider_item_obj.find('.slider_item_heading_checked').val();
				var slider_item_heading_text_html = slider_item_obj.find('.slider_item_heading_text_html').html();
				var slider_item_description_checked = slider_item_obj.find('.slider_item_description_checked').val();
				var slider_item_description_text_html = slider_item_obj.find('.slider_item_description_text_html').html();

				slider_item = slider_item_img_id+'||||'+slider_item_heading_checked+'||||'+slider_item_heading_text_html+'||||'+slider_item_description_checked+'||||'+slider_item_description_text_html;
				if(slider_index == 0){
					temp_html = slider_item;
				}else{
					temp_html = temp_html+'||||||'+slider_item;
				}

		});

  }

	temp_html = rbt_remove_unused_html_content(temp_html);
	temp_html = rbtTinymceRemoveIds(temp_html);
	temp_html = btoa(temp_html);
	var image_per_screen = jQuery('#rbt_image_per_screen').val();
	var customizer_values = '';

	customizer_values = image_per_screen+'||||';
	
	var edit_id = jQuery('#rbt_form_edit_id').val();
	
	var email_template_id = '';
	if(jQuery('#email_template_id').length == 1){
		var email_template_id = jQuery('#email_template_id').val();
	}
	var template_type = jQuery('#template_type').val();
	var form_data = {
				edit_id: edit_id,
				form_name : form_name,
				selected_template_number : selected_template_number,
				temp_html : temp_html,
				customizer_values : customizer_values,
				email_template_id : email_template_id,
				template_type : template_type,
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


