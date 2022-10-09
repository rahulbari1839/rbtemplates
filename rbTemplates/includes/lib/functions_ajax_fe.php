<?php

add_action('wp_ajax_rbt_call_ajax_data_fe', 'RBTCallAjaxData');
add_action('wp_ajax_nopriv_rbt_call_ajax_data_fe', 'RBTCallAjaxData');

function RBTCallAjaxData(){

	$output = array();
    $has_error = true;
	if(isset($_POST) && isset($_POST['token']) && ($_POST['token'] != '')  &&  isset($_POST['fields']['action_name'])){
		$fields = $_POST['fields']; 
		$action_name = $fields['action_name']; 
		$token = $_POST['token'];

		$token_verification = RBTVerificationToken($token);

		if(!isset($token_verification)){
			$output['error'] = 'Something Wrong in token.';
			RBTlogToFile("functions_ajax_fe.php: RBTCallAjaxData,  Token issue", RBT_ERROR_LOG);
			echo json_encode($output);die;

		}else if($action_name == 'save_form_fe'){
			$has_error = false;
			$output = RBTSaveFormFe($fields);
		}
	}

	if($has_error){
		$output['error'] = 'Something Wrong!';	
	}

	echo json_encode($output);die;
}

function RBTSaveFormFe($data){
	
	
	$output = array();
	if(isset($data['action_type'])){

		$form_id = rbtGetSessionValueByKey($data['form_id']);
		$formObj =  RBT_Form::loadById($form_id); 
		if(!isset($formObj)){
			$output['error'] = 'Something Wrong!';	
			return $output;
		}

		$type = $formObj->getType();
		if($type == 'contact'){
			$output = rbtSaveContactFormFe($data);

		}else if($type == 'registration'){
			$output = rbtSaveUserRegistrationFormFe($data);

		}else if($type == 'login'){
			$output = rbtLoginFormFe($data);
		}else if($type == 'subscribe'){
			$output = rbtSaveUserSubscribeFormFe($data);	
		}else{
			$output['error'] = 'Something Wrong!';	
			return $output;
		}
		
	}
	return $output;

}


function rbtLoginFormFe($data){
	$output = array();
	if(isset($data['action_type'])){

		$form_id = rbtGetSessionValueByKey($data['form_id']);
		$formObj =  RBT_Form::loadById($form_id); 
		if(!isset($formObj)){
			$output['error'] = 'Something Wrong!';	
			return $output;
		}
		$email_template_id = $formObj->getEmailTemplateId();
		
		
		$name1 = 'email';
		$name2 = 'password';
		$fields_obj = RBT_Fields::loadByFieldName($name1);
		if(!isset($fields_obj)){
			$output['field_errors'][] = 'Something Wrong in '.$name1.' field';
			
		}

		$fields_obj = RBT_Fields::loadByFieldName($name2);
		if(!isset($fields_obj)){
			$output['field_errors'][] =  'Something Wrong in '.$name2.' field';
		}

		if(isset($output['field_errors'])){
			$html_error = '';
			foreach($output['field_errors'] as $error){
				$html_error .= $error."<br>";
			}
			$output['error'] = $html_error;	
		}else{

			$password = "";
			$email = "";
			if(isset($data['input_values'][$name1]) && isset($data['input_values'][$name1]['value']) ){
				$email = $data['input_values'][$name1]['value'];
			}
		
			if(isset($data['input_values'][$name2]) && isset($data['input_values'][$name2]['value'])){
				$password = $data['input_values'][$name2]['value'];
			}
			
			$login_status = wp_authenticate($email,$password );

			if ( $login_status instanceof WP_User ) {
       		
       			$user_id = $login_status->data->ID;
       			$user = get_user_by( 'id',  $user_id ); 
				if( $user ) {
					$output['success'] = "User Login successfully.";	
				    wp_set_current_user( $user_id, $user->user_login );
				    wp_set_auth_cookie( $user_id );
				    do_action( 'wp_login', $user->user_login );
				}else{
					$output['error'] = "Something Wrong in system";	
				}
				
  			}else{
  				$output['error'] = "Please check your email and password.";	
  			}
		}
	}else{
		$output['error'] = 'Something Wrong!';	
	}
    
    return $output;	
	

}


function rbtSaveUserRegistrationFormFe($data){
	
	
	$output = array();
	if(isset($data['action_type'])){

		$form_id = rbtGetSessionValueByKey($data['form_id']);
		$formObj =  RBT_Form::loadById($form_id); 
		if(!isset($formObj)){
			$output['error'] = 'Something Wrong!';	
			return $output;
		}
		$email_template_id = $formObj->getEmailTemplateId();
		$temp_type = $formObj->getType();
		$name = "";
		$email = "";
		$fields_info = '';
		if(isset($data['input_values']['name']) && isset($data['input_values']['name']['value']) ){
			$name = $data['input_values']['name']['value'];
		}
		
		if(isset($data['input_values']['email']) && isset($data['input_values']['email']['value'])){
			$email = $data['input_values']['email']['value'];
		}
		
		if(isset($data['input_values'])){
			$fields_info = $data['input_values'];
		}

		$user_register_id = register_new_user($name,$email);
		if ( $user_register_id instanceof WP_Error  ) {
			$user_register_status_error = $user_register_id;
			$error_msg = 'Something is Wrong with user name and password.';
			if(is_array($user_register_status_error->errors)){
					$error_msg = '';
				foreach($user_register_status_error->errors as $errors){
				

					foreach($errors as $error){

						$error_msg .= $error.'<br>';

					}
				}
			}
			$output['error'] = $error_msg;	
			return $output;
		}

	    $user_obj = get_userdata( $user_register_id );
	    if ( $user_obj instanceof WP_Error  ) {
	    	$output['error'] = "Something is Wrong";	
			return $output;
	    }
	    	

	    $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
        $reset = wp_set_password($random_password, $user_register_id);

		
		$obj = new RBT_UsersInfo();
		$obj->setName($name);
		$obj->setEmail($email);
		$obj->setType($temp_type);
		$parent_id = $obj->create();
		$email_data = array();
		if(is_numeric($parent_id) && $parent_id != 0 && is_array($fields_info)){
         
			$insert_data_obj = new RBT_DataNameValuePair();
			foreach ($fields_info as $name => $field_info) {
				if(!isset($field_info['value'])){
					continue;
				}
				$fields_obj = RBT_Fields::loadByFieldName($name);
				if(!isset($fields_obj)){
					$output['field_errors'][] =  'Something Wrong in '.$name.' field';
					continue;
				}

				if(isset($fields_obj) && ($fields_obj->getIsRequired() == 1) && ($field_info['value'] == '')){
					$output['field_errors'][] = "Field ".$name." is required.";
					continue;
				}
				$insert_data_obj->setType($data['action_type']);
				$insert_data_obj->setName($name);
				$insert_data_obj->setValue($field_info['value']);
				$insert_data_obj->setParentId($parent_id);
				$insert_data_obj->setDataType($field_info['type']);
				$insert_data_obj->create();
				$email_data[$name] = $field_info['value'];
			}
		}

		
		
		if(isset($output['field_errors'])){
			$html_error = '';
			foreach($output['field_errors'] as $error){
				$html_error .= $error."<br>";
			}
			$output['error'] = $html_error;	
		}else{

			$insert_data_obj->setType($data['action_type']);
			$insert_data_obj->setName('user_register_id');
			$insert_data_obj->setValue($user_register_id);
			$insert_data_obj->setParentId($parent_id);
			$insert_data_obj->setDataType('hidden');
			$insert_data_obj->create();
			
			$email_data['password'] = $random_password; 

			$output['mail_status'] = rbtSendMail($email_data,$email_template_id);
			$output['success'] = 'Your Registration is successfully. For login <a href="'.site_url('wp-login.php').'">Click here</a>';	
		}
	}else{
		$output['error'] = 'Something Wrong!';	
	}
    
    return $output;

}

function rbtSaveUserSubscribeFormFe($data){
	
	
	$output = array();
	if(isset($data['action_type'])){

		$form_id = rbtGetSessionValueByKey($data['form_id']);
		$formObj =  RBT_Form::loadById($form_id); 
		if(!isset($formObj)){
			$output['error'] = 'Something Wrong!';	
			return $output;
		}
		$email_template_id = $formObj->getEmailTemplateId();
		$temp_type = $formObj->getType();
		$email = "";
		$fields_info = '';
		$email_data = array();
		if(isset($data['input_values']['email']) && isset($data['input_values']['email']['value'])){
			$email = $data['input_values']['email']['value'];
		}
		$obj = new RBT_UsersInfo();
		$obj->setName('');
		$obj->setEmail($email);
		$obj->setType($temp_type);
		$obj->create();
		$output['success'] = 'Subscribed successfully.';	
		$email_data['email'] = $email;
		$output['mail_status'] = rbtSendMail($email_data,$email_template_id);

	}else{
		$output['error'] = 'Something Wrong!';	
	}
    
    return $output;

}


function rbtSaveContactFormFe($data){
	
	
	$output = array();
	if(isset($data['action_type'])){

		$form_id = rbtGetSessionValueByKey($data['form_id']);
		$formObj =  RBT_Form::loadById($form_id); 
		if(!isset($formObj)){
			$output['error'] = 'Something Wrong!';	
			return $output;
		}
		$email_template_id = $formObj->getEmailTemplateId();
		$temp_type = $formObj->getType();
		$name = "";
		$email = "";
		$fields_info = '';
		if(isset($data['input_values']['name']) && isset($data['input_values']['name']['value']) ){
			$name = $data['input_values']['name']['value'];
		}
		
		if(isset($data['input_values']['email']) && isset($data['input_values']['email']['value'])){
			$email = $data['input_values']['email']['value'];
		}
		
		if(isset($data['input_values'])){
			$fields_info = $data['input_values'];
		}

		$obj = new RBT_UsersInfo();
		$obj->setName($name);
		$obj->setEmail($email);
		$obj->setType($temp_type);
		$parent_id = $obj->create();
		$email_data = array();
		if(is_numeric($parent_id) && $parent_id != 0 && is_array($fields_info)){
         
			$insert_data_obj = new RBT_DataNameValuePair();
			foreach ($fields_info as $name => $field_info) {
				if(!isset($field_info['value'])){
					continue;
				}
				$fields_obj = RBT_Fields::loadByFieldName($name);
				if(!isset($fields_obj)){
					$output['field_errors'][] =  'Something Wrong in '.$name.' field';
					continue;
				}

				if(isset($fields_obj) && ($fields_obj->getIsRequired() == 1) && ($field_info['value'] == '')){
					$output['field_errors'][] = "Field ".$name." is required.";
					continue;
				}
				$insert_data_obj->setType($data['action_type']);
				$insert_data_obj->setName($name);
				$insert_data_obj->setValue($field_info['value']);
				$insert_data_obj->setParentId($parent_id);
				$insert_data_obj->setDataType($field_info['type']);
				$insert_data_obj->create();
				$email_data[$name] = $field_info['value'];
			}
		}
		
		if(isset($output['field_errors'])){
			$html_error = '';
			foreach($output['field_errors'] as $error){
				$html_error .= $error."<br>";
			}
			$output['error'] = $html_error;	
		}else{

			$output['mail_status'] = rbtSendMail($email_data,$email_template_id);
			$output['success'] = 'Your Request is submited.';	
		}
	}else{
		$output['error'] = 'Something Wrong!';	
	}
    
    return $output;

}
