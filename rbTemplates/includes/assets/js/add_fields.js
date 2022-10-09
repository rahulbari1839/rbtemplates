jQuery(document).ready(function(){
	rbt_datatable_call_by_table_id('rbt_manage_fields_table_id');
});



function rbt_field_edit_by_id(edit_id = 0){
	rbt_show_loader();
	jQuery.post(ajaxurl, {
		action: 'rbt_field_edit_by_id_ajax',
		edit_id: edit_id,   
		}, function(response) {
			rbt_hide_loader();
			
			response = JSON.parse(response);
			if(response.error){
				rbt_swal_message('',response.error,'');
				return false;
			}
			if(response.success){
				if(response.fields_value){
					var data = response.fields_value;
					var fields_value_checked = response.fields_value_checked;
					for (var key in data) {
						if(jQuery('#'+key).length != 0){
							jQuery('#'+key).val(data[key]);
						}
					}

					for (var key in fields_value_checked) {
						if(jQuery('#'+key).length != 0){
							console.log(fields_value_checked[key]);
							if(fields_value_checked[key] == 1){
								console.log(333333);
								jQuery('#'+key).prop('checked',false).trigger('click');
							}else{
								jQuery('#'+key).prop('checked',true).trigger('click');
							}
							
						}
					}
					jQuery("#rbt_field_name").attr('readonly',true);
					jQuery("#rbt_field_type").attr('readonly',true);
					rbt_next_tab_show('rbt_tab_2');
				}	
			}
		}
	);
}


function rbt_delete_field_by_id(delete_id = 0){
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
				rbt_show_loader();
				jQuery.post(ajaxurl, {
					action: 'rbt_delete_field_by_id_ajax',
					delete_id: delete_id,   
					}, function(response) {
						rbt_hide_loader();
						
						response = JSON.parse(response);
						if(response.error){
							rbt_swal_message('',response.error,'');
							return false;
						}
						if(response.success){
							jQuery('.rbt_manage_fields_table_id_wrapper').html(response.table_html);
							rbt_datatable_call_by_table_id('rbt_manage_fields_table_id');
						}
					}
				);
		
			}
		});
		
		
				
	
}

function rbt_add_field(obj = ''){
	var current_obj = obj;
	var rbt_add_fields_form_selector = jQuery('.rbt_add_fields_outer_div');
	var validation_status = rbt_form_validation("rbt_add_fields_outer_div",'');
	if( validation_status ){
		return false;
	}
	var field_name = rbt_add_fields_form_selector.find('#rbt_field_name').val();
	var field_type = rbt_add_fields_form_selector.find('#rbt_field_type').val();
	var field_label = rbt_add_fields_form_selector.find('#rbt_field_label').val();
	var field_placeholder = rbt_add_fields_form_selector.find('#rbt_field_placeholder').val();
	var field_default_value = rbt_add_fields_form_selector.find('#rbt_field_default_value').val();
	var field_edit_id = rbt_add_fields_form_selector.find('#rbt_field_edit_id').val();
	var field_is_required = rbt_add_fields_form_selector.find('#rbt_field_is_required').prop('checked');
	var field_required_msg = rbt_add_fields_form_selector.find('#rbt_field_required_msg').val();
	if(field_is_required){
		field_is_required = 1;
	}else{
		field_is_required = 0;
	}
	if(field_name == ''){
		rbt_swal_message('','Please enter field name','');
		return false;
	}
	
	if(field_type == ''){
		rbt_swal_message('','Please select field type','');
		return false;
	}
	
	var button_text = jQuery(current_obj).text();
	jQuery(current_obj).text('Please Wait..');
	rbt_show_loader();
	jQuery.post(ajaxurl, {
		action: 'rbt_add_field_ajax',
		field_name: field_name,   
		field_type: field_type,   
		field_label: field_label,   
		field_placeholder: field_placeholder,   
		field_default_value: field_default_value,   
		field_edit_id: field_edit_id,   
		field_is_required: field_is_required,   
		field_required_msg: field_required_msg,   
	}, function(response) {
		rbt_hide_loader();
		jQuery(current_obj).text(button_text);
		response = JSON.parse(response);
		if(response.error){
			rbt_swal_message('',response.error,'');
			return false;
		}
		
		if(response.success){
			
			rbt_swal_message('',response.success,'');
			if(response.field_edit_id){
				rbt_add_fields_form_selector.find('#rbt_field_edit_id').val(response.field_edit_id);
				jQuery('.rbt_manage_fields_table_id_wrapper').html(response.table_html);
				rbt_datatable_call_by_table_id('rbt_manage_fields_table_id');
			}
		}
	});
}

function rbtFieldRequiredClick(obj){
	if(jQuery(obj).prop('checked')){
		jQuery('.rbt_field_required_msg_wrapper').show();
	}else{
		jQuery('.rbt_field_required_msg_wrapper').hide();
	}

}