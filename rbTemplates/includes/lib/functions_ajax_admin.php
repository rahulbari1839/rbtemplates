<?php 

add_action('wp_ajax_rbt_call_ajax_data_admin', 'RBTCallAjaxDataAdmin');

function RBTCallAjaxDataAdmin(){
	$output = array();
	$has_error = false;
	if(isset($_POST) && isset($_POST['data'])){
		$data = $_POST['data'];
		if(isset($data['action']) && isset($data['type'])){
			
				
			if($data['action'] == 'form_template'){
				$delete_id = $data['delete_id'];
				$output = rbtFormDelete($delete_id);
			}else if($data['action'] == 'contact_user_delete'){
				$delete_id = $data['delete_id'];			
				$output = rbtUsersInfoDelete($delete_id);
			}else if($data['action'] == 'contact_user_view'){
				$id = $data['id'];
				$output =  rbtUserInfoHtml($id);
			}else if($data['action'] == 'email_notification_templates'){
				$delete_id = $data['delete_id'];			
				$output = rbtDeleteEmailTemplateById($delete_id);
			}else if($data['action'] == 'save_email_template'){
				$output = rbtSaveEmailTemplate($data);
			}else if($data['action'] == 'load_slider_item_html'){
				$output = rbtLoadSliderItemHtml($data);	
			}else if($data['action'] == 'load_add_slider_form_html'){
				$output = rbtLoadAddSliderFormHtml($data);	
			}else{
				$has_error = true;
			
			}

		}


	}else {	
		$has_error = true;		
	}	

	if($has_error){
		$output['error'] = 'Something Went Wrong';	
	}

	echo json_encode($output);die;	
	
}


add_action('wp_ajax_rbt_delete_all_logs_ajax', 'RBTDeleteAllLogsAjax');
add_action('wp_ajax_nopriv_rbt_delete_all_logs_ajax', 'RBTDeleteAllLogsAjax');

function RBTDeleteAllLogsAjax(){
	$output = array();
	RBT_Logs::deleteAll();
	$output['success'] = 'Deleted Successfully';	
	echo json_encode($output);die;
	
}

add_action('wp_ajax_rbt_add_field_ajax', 'RBTAddFieldAjax');
add_action('wp_ajax_nopriv_rbt_add_field_ajax', 'RBTAddFieldAjax');


function RBTAddFieldAjax(){
	$output = array();
	if(isset($_POST['field_name'])){
		
		$field_name = $_POST['field_name'];
		$field_type = $_POST['field_type'];
		$field_label = $_POST['field_label'];
		$field_placeholder = $_POST['field_placeholder'];
		$field_default_value = $_POST['field_default_value'];
		$field_edit_id = $_POST['field_edit_id'];
		$field_is_required = $_POST['field_is_required'];
		$field_required_msg = $_POST['field_required_msg'];
		
		$field_name = str_replace(' ','-',$field_name);
		$field_obj = new RBT_Fields();
		$field_obj->setName($field_name);
		$field_obj->setLabel($field_label);
		$field_obj->setType($field_type);
		$field_obj->setValue($field_default_value);
		$field_obj->setPlaceholder($field_placeholder);
		$field_obj->setIsRequired($field_is_required);
		$field_obj->setRequiredMsg($field_required_msg);
		$hasData = RBT_Fields::loadByFieldName($field_name);
		if(isset($hasData) && ($hasData->getId() != $field_edit_id)){
			$output['error'] = 'Field Name already exists';	
		}else{
			$hasData = RBT_Fields::loadById($field_edit_id);
			if(isset($hasData)){
				$field_obj->setId($hasData->getId());
				$field_obj->update();
				$output['success'] = 'Successfully Updated';
			}else{
				$field_edit_id = $field_obj->create();
				$output['success'] = 'Successfully Added';
			}
			$output['field_edit_id'] = $field_edit_id;
			$output['table_html'] = RBTGetManageFieldTableHtml();
		}
		
		
	}else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
}


add_action('wp_ajax_rbt_create_form_template_ajax', 'rbtAddFormTemplatesAjax');
add_action('wp_ajax_nopriv_rbt_create_form_template_ajax', 'rbtAddFormTemplatesAjax');


function rbtAddFormTemplatesAjax(){
	$output = array();
	if(isset($_POST['form_data'])){
	
			$data = $_POST['form_data'];
			$edit_id = 0;
			$template_type = '';
			if(isset($data['template_type'])){
				$template_type = $data['template_type'];
			}

			if($template_type == ''){
				$output['error'] = 'Please Select Template.';	
				echo json_encode($output);die;
			}

			if(isset($data['edit_id'])){
				$edit_id = $data['edit_id'];
			}
			$form_name = '';
			if(isset($data['form_name'])){
				$form_name = $data['form_name'];
			}
			
			$selected_template_number = '';
			if(isset($data['selected_template_number'])){
				$selected_template_number = $data['selected_template_number'];
			}
			
			$temp_html = '';
			if(isset($data['temp_html'])){
				$temp_html = $data['temp_html'];
			}
			
			$customizer_values = '';
			if(isset($data['customizer_values'])){
				$customizer_values = $data['customizer_values'];
			}

			$email_template_id = '';
			if(isset($data['email_template_id'])){
				$email_template_id = $data['email_template_id'];
			}

			$display_type = '';
			if(isset($data['display_type'])){
				$display_type = $data['display_type'];
			}

			$html2 = '';
			if(isset($data['temp_html2'])){
				$html2 = $data['temp_html2'];
			}

			

			if(!in_array($template_type, rbtGetAllTemplatesTypesArr())){
				$output['error'] = 'Something Went Wrong with template';	
				echo json_encode($output);die;
			}
			$new_obj = new RBT_Form();
			$type = $template_type;
			$new_obj->setName($form_name);
			$new_obj->setType($type);
			$new_obj->setHtml(base64_decode($temp_html));
			$new_obj->setCustomizerValues($customizer_values);
			$new_obj->setTemplateNo($selected_template_number);
			$new_obj->setEmailTemplateId($email_template_id);
			$new_obj->setDisplayType($display_type);
			$new_obj->setHtml2(base64_decode($html2));
			
			$datahas = RBT_Form::loadById($edit_id);
			if(isset($datahas)){

				$new_obj->setId($edit_id);
				$new_obj->update();
				$output['db_action'] = 'update';	
				
			}else{
				$edit_id = $new_obj->create();
				$output['db_action'] = 'create';	
			}
			
			$output['edit_id'] = $edit_id;
			$output['success'] = 'Save Successfully';
			
			$shortcode_details  = RBTFormShortcodeDetailsHtml($edit_id,$type);
			$output['shortcode_details'] = $shortcode_details;
		
	}else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
	
}

function RBTFormShortcodeDetailsHtml($edit_id = 0,$type = ''){
	$shortcode = RBTGetShortcodeNameByIdAndType($edit_id,$type);
	$shortcode_details  = "<div class='rbt_shortcode_details'>";
	$shortcode_details .= "<span class='shortcode_details'>Here is your Shortcode:</span>";
	$shortcode_details .= '<p><span class="shortcode_display" id="dynamic_copyable_text_rbt_'.$edit_id.'">'.$shortcode.'</span><span data-id="dynamic_copyable_text_rbt_'.$edit_id.'" class="copy-btn " onclick="rbt_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p>';
	$shortcode_details .= "</div>";
	$output['shortcode_details'] = $shortcode_details;
	return $shortcode_details;
}

add_action('wp_ajax_rbt_select_template_ajax', 'RBTSelectTemplateAjax');
add_action('wp_ajax_nopriv_rbt_select_template_ajax', 'RBTSelectTemplateAjax');

function RBTSelectTemplateAjax(){
	$output = array();
	if(isset($_POST['tempplate_name'])){
	
		$tempplate_name = $_POST['tempplate_name'];
		$template_number = $_POST['template_number'];
		
		$template_path = plugin_dir_path(__FILE__) . "../templates/" . $tempplate_name . "/" . $template_number ."/". "template.php";
		
		if (file_exists($template_path)){
			include_once ($template_path);  
		}else{
			$output['template_path'] = $template_path;
			$output['error'] = 'File not found';	
		}		
		
	
	}else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
}



add_action('wp_ajax_rbt_delete_field_by_id_ajax', 'RBTDeleteFieldByIdAjax');
add_action('wp_ajax_nopriv_rbt_delete_field_by_id_ajax', 'RBTDeleteFieldByIdAjax');

function RBTDeleteFieldByIdAjax(){
	
	$output = array();
	if(isset($_POST['delete_id'])){
	
		$delete_id = $_POST['delete_id'];
		RBT_Fields::deleteById($delete_id);
		$output['success'] = 'Deleted Successfully';	
		$output['table_html'] = RBTGetManageFieldTalbeHtml();	
	
	}else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
}

add_action('wp_ajax_rbt_field_edit_by_id_ajax', 'RBTFildEditByIdAjax');
add_action('wp_ajax_nopriv_rbt_field_edit_by_id_ajax', 'RBTFildEditByIdAjax');

function RBTFildEditByIdAjax(){
	$output = array();
	if(isset($_POST['edit_id'])){
	
		$edit_id = $_POST['edit_id'];
	
		$datahas = RBT_Fields::loadById($edit_id);
		
		if(isset($datahas)){
			
			$output['success'] = 'data loaded';	
			$fields_value = array();
			$fields_value['rbt_field_name'] = $datahas->getName();	
			$fields_value['rbt_field_type'] = $datahas->getType();	
			$fields_value['rbt_field_label'] = $datahas->getLabel();	
			$fields_value['rbt_field_default_value'] = $datahas->getValue();	
			$fields_value['rbt_field_placeholder'] = $datahas->getPlaceholder();	
			$fields_value['rbt_field_edit_id'] = $datahas->getId();	
			
			$fields_value['rbt_field_required_msg'] = $datahas->getRequiredMsg();	
			$fields_value_checked['rbt_field_is_required'] = $datahas->getIsRequired();	
			$output['fields_value'] = $fields_value;
			$output['fields_value_checked'] = $fields_value_checked;
			
		}else{
			$output['error'] = 'Something Went Wrong';	
		}
		
		
	
	}else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
}


