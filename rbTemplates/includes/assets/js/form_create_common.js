jQuery('document').ready(function(){
	if(jQuery('.rbt_tinymce_textarea_editor').length != 0){
		rbt_tinymce_textarea_editor();
	}

});


function rbt_add_emal_templates(obj){
	var form_id = 'rbt_add_email_template_outer_div';
	var validation_status = rbt_form_validation(form_id);
	if(validation_status){
		return false;
	}
	var inputes_values = rbtGetAllInputValues(form_id);
	var send_data = {'inputes_values':inputes_values, 'type':'save_email_template','action':'save_email_template'};
	var response = rbt_call_ajax_data('', send_data);
	if(response.success){
		if(response.edit_id){
			jQuery("#rbt_email_template_edit_id").val(response.edit_id);
			rbt_swal_message('success',response.success);

		}
	}

}