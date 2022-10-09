<?php

// cheeck admin is login 
if (is_admin()) {

	add_action('admin_menu', 'rbtRegisterMenupage');

	function rbtRegisterMenupage(){

	  add_menu_page('RB-Templates', 'RB-Templates', 'manage_options', 'RBTemplates', 'RBTemplates'); 
	  add_submenu_page('RBTemplates', 'Manage Shortcode', 'Manage Shortcode', 'manage_options', 'rbt_manage_form', 'rbtAdminManageShortcodesPage');
	  add_submenu_page('RBTemplates', 'Create Shortcode', 'Create Shortcode', 'manage_options', 'rbt_select_form_page', 'rbtAdminShortcodesListPage');
	  add_submenu_page('RBTemplates', 'Manage Fields', 'Manage Fields', 'manage_options', 'rbt_add_fields', 'rbtAdminCreateFieldsPage');
	  add_submenu_page('RBTemplates', 'Social Share', 'Social Share', 'manage_options', 'rbt_social_share', 'rbtAdminSocialSharePage');
	  add_submenu_page('RBTemplates', 'Email Notification', 'Email Notification', 'manage_options', 'rbt_email_notification', 'rbtAdminEmailNotificationPage');
	  add_submenu_page('RBTemplates', 'Logs', 'Logs', 'manage_options', 'rbt_logs', 'rbtAdminLogsPage');
	  add_submenu_page('RBTemplates', 'Users', 'Users', 'manage_options', 'rbt_users', 'rbtAdminUsersPages');


	  add_submenu_page('RBTemplates', 'Page Visit', 'Page Visit', 'manage_options', 'rbt_page_visit', 'rbtAdminPageVisit');

	  //add menu not show in left side bar 
	   add_submenu_page('', 'Contact Shortcode', 'Contact Shortcode', 'manage_options', 'rbt_create_contact_shortcode', 'rbtAdminContactShortcodePage');
	  add_submenu_page('', 'Login Shortcode', 'Login Shortcode', 'manage_options', 'rbt_create_login_shortcode', 'rbtAdminLoginShortcodePage');

	  add_submenu_page('', 'Gallery Shortcode', 'Gallery Shortcode', 'manage_options', 'rbt_create_gallery_shortcode', 'rbtAdminGalleryShortcodePage');
	  add_submenu_page('', 'User Registration Shortcode', 'User Registration Shortcode', 'manage_options', 'rbt_create_registration_shortcode', 'rbtAdminRegistrationsShortcodePage');
	  add_submenu_page('', 'User Subscribe Shortcode', 'User Subscribe Shortcode', 'manage_options', 'rbt_create_subscribe_shortcode', 'rbtAdminSubscribeShortcodePage');
	  add_submenu_page('', 'Slider Shortcode', 'Slider Shortcode', 'manage_options', 'rbt_create_slider_shortcode', 'rbtAdminSliderShortcodePage');
	  //removed parent menu
	  remove_submenu_page('RBTemplates','RBTemplates');
	}

    

function rbtAdminPageVisit(){

	require_once plugin_dir_path(__FILE__) . '../admin/page_visit.php';
}

function rbtAdminLogsPage(){
 
  require_once plugin_dir_path(__FILE__) . '../admin/logs.php';
  
}

function rbtAdminManageShortcodesPage(){
  
  require_once plugin_dir_path(__FILE__) . '../admin/manage_shortcodes.php';
  
}

function rbtAdminShortcodesListPage(){

	 require_once plugin_dir_path(__FILE__) . '../admin/shortcodes_list_page.php';

}

function rbtAdminContactShortcodePage(){
   
  require_once plugin_dir_path(__FILE__) . '../admin/contact_shortcode.php';
  
}

function rbtAdminLoginShortcodePage(){

	require_once plugin_dir_path(__FILE__) . '../admin/login_shortcode.php';
}

function rbtAdminGalleryShortcodePage(){

	require_once plugin_dir_path(__FILE__) . '../admin/gallery_shortcode.php';
}

function rbtAdminRegistrationsShortcodePage(){

	require_once plugin_dir_path(__FILE__) . '../admin/registrations_shortcode.php';
}

function rbtAdminSubscribeShortcodePage(){
	require_once plugin_dir_path(__FILE__) . '../admin/subscribe_shortcode.php';
}



function rbtAdminSliderShortcodePage(){
	require_once plugin_dir_path(__FILE__) . '../admin/slider_shortcode.php';
}

function rbtAdminCreateFieldsPage(){
  require_once plugin_dir_path(__FILE__) . '../admin/create_fields.php';
}
function rbtAdminEmailNotificationPage(){
	  require_once plugin_dir_path(__FILE__) . '../admin/email_notification.php';
}
  
function rbtAdminSocialSharePage(){
  require_once plugin_dir_path(__FILE__) . '../admin/social_share.php';
}

function rbtAdminLogsPages(){
  require_once plugin_dir_path(__FILE__) . '../admin/logs.php';
}

function rbtAdminUsersPages(){
  require_once plugin_dir_path(__FILE__) . '../admin/users.php';
}



function RBTRemoveUnsedHtmlContentAdmin(){
	$html  = "<div class='rbt_remove_unused_html_content' style='display:none'></div>";
	return $html;

}

function RBTGetManageUserTableHtml(){		
	$table_body = '<table class="rbt_manage_table table-striped table-bordered" id="rbt_manage_table_id" style="display:none">
				<thead><tr><th>Name</th><th class="rb-align-center">Email</th><th class="rb-align-center" width="100px">Date</th><th class="rb-align-center">Type</th><th class="rb-align-center">Action</th></tr></thead>';			
	$data_list = RBT_UsersInfo::load();
	if(isset($data_list)){
		foreach($data_list as $data_info){
			
			$id = $data_info->getId();
			$email = $data_info->getEmail();
			$name = $data_info->getName();
			$type = $data_info->getType();
			$type = ucwords(str_replace('_', ' ', $type));
			$date = $data_info->getDate();
			
			$edit_btn = '<a class="rbt_edit_btn rbt_btn"  onclick="rbt_view_user_info_by_id('.$id.')"  href="javascript:void(0)"  onclick="rbt_show_loader();" ><i class="fas fa-eye"></i></a>';
			$table_body .= '<tr><td >'.$name.'</td><td class="">'.$email.'</td><td class="rb-align-center" >'.$date.'</td><td class="" >'.$type.'</td><td class="rb-align-center">'.$edit_btn.'<a class="rbt_delete_btn rbt_btn" href="havascript:void(0);" onclick="rbt_delete_table_row('.$id.',\'contact_user_delete\')"><i class="fas fa fa-trash"></i></a></td></tr>';
		}
	}
	$table_body .='</tbody></table>';

	return $table_body ;
}
function RBTGetManageFormTableHtml(){		
			
	$table_body = '<table class="rbt_manage_table table-striped table-bordered" id="rbt_manage_table_id" style="display:none">
				<thead><tr><th>Name</th><th class="rb-align-center">Shortcode</th><th class="rb-align-center">Date</th><th class="rb-align-center">Action</th></tr></thead>';			
	$data_list = RBT_Form::load();
	if(isset($data_list)){
		foreach($data_list as $data_info){
			
			$id = $data_info->getId();
			$date = $data_info->getDate();
			$name = $data_info->getName();
			$type = $data_info->getType();
			$all_types = rbtGetAllTemplatesTypesArr();

			if(!in_array($type, $all_types)){
					continue;
			}
		

			$shortcode = '<p><span class="shortcode_display" id="dynamic_copyable_text_rbt_'.$id.'">'.RBTGetShortcodeNameByIdAndType($id, $type).'</span><span data-id="dynamic_copyable_text_rbt_'.$id.'" class="rb-copy-btn" onclick="rbt_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p>';
			$edit_btn_link = 'javascript:void(0)';
			if($type == 'contact'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_contact_shortcode&id='.$id);
			}else if($type == 'login'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_login_shortcode&id='.$id);
			}else if($type == 'gallery'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_gallery_shortcode&id='.$id);
			}else if($type == 'registration'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_registration_shortcode&id='.$id);
			}else if($type == 'subscribe'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_subscribe_shortcode&id='.$id);
			}else if($type == 'slider'){
				$edit_btn_link = admin_url('admin.php?page=rbt_create_slider_shortcode&id='.$id);
			}
			$edit_btn = '<a class="rbt_edit_btn rbt_btn"   href="'.$edit_btn_link.'"  onclick="rbt_show_loader();" ><i class="fas fa-edit"></i></a>';
			$table_body .= '<tr><td>'.$name.'</td><td class="rb-align-center">'.$shortcode.'</td><td class="rb-align-center">'.$date.'</td><td class="rb-align-center">'.$edit_btn.'<a class="rbt_delete_btn rbt_btn" href="havascript:void(0);" onclick="rbt_delete_table_row('.$id.',\'form_template\')"><i class="fas fa fa-trash"></i></a></td></tr>';
		}
	}
	$table_body .='</tbody></table>';
	return $table_body;
}


function RBTLoaderHtmlAdmin(){
	
	$html  = '';
	$html  .= '<div class="rbt_laoder_wrapper ">';
	$html .= '<div id="rbt_loading_overlay"></div>';
	$html .= '<div id="rbt_loader_icon">';
	$html .= '<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="rbt_lds-dual-ring"><div></div></div></div>';
	$html .= '</div>';
	$html .= '</div>';
	return $html ;
	
}

function RBTModalHtmlAdmin($clas_name = ''){

  $id = 'rbt_modal_outer_'.rand(10,100);
	$html   = '';
	$html  .= '<div class="rbt_modal_outer '.$clas_name.'" id="'.$id.'">';
	$html  .= '<div class="rbt_modal_hide"><i class="fa fa-close"></i></div>';
	$html  .= '<div class="rbt_modal_header"></div>';
	$html  .= '<div class="rbt_modal_body"></div>';
	$html  .= '</div>';
	return $html ;
	
}

function RBTCommonVariableHtmlAdmin(){
	
	$html = '<input type="hidden" value="'.site_url().'" name="rbt_global_website_url">';
	$html .= '<input type="hidden" value="'.plugin_dir_url('').RBT_PLUGIN_NAME.'" name="rbt_global_plugin_url">';
	$html .= '<input type="hidden" value="'.plugin_dir_url('').RBT_PLUGIN_NAME.'/includes/assets/images" name="rbt_global_plugin_img_url">';
	return $html;
	
}


function RBTGetManageFieldTableHtml(){		
			
	$table_body = '<table class="rbt_manage_table" id="rbt_manage_fields_table_id" style="display:none">
				<thead><tr><th>Name</th><th>Type</th><th>Date</th><th>Action</th></tr></thead>';			
	$data_list = RBT_Fields::load();
	if(isset($data_list)){
		foreach($data_list as $data_info){
			
			$id = $data_info->getId();
			$date = $data_info->getDate();
			$name = $data_info->getName();
			$type = $data_info->getType();
			$created_by = $data_info->getCreatedBy();

			$delete_btn = '<a href="havascript:void(0);" class="rbt_delete_btn rbt_btn" onclick="rbt_delete_field_by_id('.$id.')"><i class="fas fa fa-trash"></i></a>';
			if($created_by ==  'default'){
					$delete_btn = '';
			}

			$edit_btn = '<a class="rbt_edit_btn rbt_btn"  data-edit-id="'.$id.'" href="javascript:void(0)"  onclick="rbt_field_edit_by_id('.$id.');" ><i class="fas fa-edit"></i></a>';
			$table_body .= '<tr><td>'.$name.'</td><td>'.$type.'</td><td>'.$date.'</td><td>'.$edit_btn.$delete_btn.'</td></tr>';
		}
	}
	$table_body .='</tbody></table>';
	return $table_body;
}


function rbtUsersInfoDelete($id = 0){
	RBT_UsersInfo::deleteById($id);
	RBT_DataNameValuePair::deleteByParentId($id);
	$output= array();
	$output['table_html'] = RBTGetManageUserTableHtml();
	return $output;

} 

function rbtFormDelete($id = 0){
	RBT_Form::deleteById($id);
	$output= array();
	$output['table_html'] = RBTGetManageFormTableHtml();
	return $output;

}

function rbtUserInfoHtml($id = 0){
	$output= array();
	$user_obj = RBT_UsersInfo::loadById($id);
	if($user_obj){
		$user_fields_obj	= RBT_DataNameValuePair::loadByParentId($id);
		$output['success'] = 'Data loaded';
		$html = '';
		$html = '';
		$output['heading'] = '<h1>User infomation</h1';

		$html .= '<div class="rbt_modal_content">';
		$html .= '<div class="row ">';
		$html .= '<div class="col-sm-4 p-0 m-0">';
		$html .= '<h5>Email: '.$user_obj->getEmail()."</h5>";

		$html .= '<h5>Date: '.$user_obj->getDate()."</h5>";
		$html .= '<h5>Type: '.$user_obj->getType()."</h5>";
		$html .= '</div>';
		$html .= '</div>';

		if(isset($user_fields_obj)){
			$html .= '<table class="table">';
			$html .= ' <thead class="thead-dark">';
	 	  $html .= ' <tr>';
	    $html .= ' <th scope="col">Name</th>';
	    $html .= '<th scope="col">Value</th>';
	 	  $html .= '</tr>';
			$html .= ' </thead>';
			$html .= ' <tbody>';
				foreach($user_fields_obj as $user_field_obj){
			
				$html .= '<tr>';
				if($user_field_obj->getDataType() == 'file'){
						$html .= '<td>'.$user_field_obj->getName().'</td><td><img class="user_upload_img" src="'.$user_field_obj->getValue().'"><td>';
				}else{
				
					$html .= '<td>'.$user_field_obj->getName().'</td><td>'.$user_field_obj->getValue().'</td>';
				}
				$html .= '</tr>';
			}
		
			$html .= '</tbody>';
			$html .= '</table>';
		}

		$html .= '</div>';
		$output['html'] = $html;
	}else{
		$output['error'] = 'data not found';
	}
	return $output;

}


function rbtGetManageEmailTemplatesHtml(){		
			
	$table_body = '<table class="rbt_manage_table table-striped table-bordered" id="rbt_manage_table_id" style="display:none">
				<thead><tr><th>Name</th><th class="rb-align-center">Type</th><th class="rb-align-center">Date</th><th class="rb-align-center">Action</th></tr></thead>';			
	$data_list = RBT_EmailNotificationTemplates::load();
	if(isset($data_list)){
		foreach($data_list as $data_info){
			
			$id = $data_info->getId();
			$date = $data_info->getDate();
			$name = $data_info->getTemplateName();
			$type = $data_info->getType();
			
			$edit_btn_link = admin_url('admin.php?page=rbt_email_notification&mode=add&id='.$id);
			$edit_btn = '<a class="rbt_edit_btn rbt_btn"   href="'.$edit_btn_link.'"  onclick="rbt_show_loader();" ><i class="fas fa-edit"></i></a>';
			$table_body .= '<tr><td>'.$name.'</td><td class="rb-align-center">'.$type.'</td><td class="rb-align-center">'.$date.'</td><td class="rb-align-center">'.$edit_btn.'<a class="rbt_delete_btn rbt_btn" href="havascript:void(0);" onclick="rbt_delete_table_row('.$id.',\'email_notification_templates\')"><i class="fas fa fa-trash"></i></a></td></tr>';
		}
	}
	$table_body .='</tbody></table>';
	return $table_body;
}

function rbtDeleteEmailTemplateById($id = 0){
	RBT_EmailNotificationTemplates::deleteById($id);
	$output= array();
	$output['table_html'] = rbtGetManageEmailTemplatesHtml();
	return $output;

} 



function rbtSaveEmailTemplate($data = ''){
	$output = array();
	
	if(isset($data['inputes_values'])){
		$tempalte_name = '';
		$from_name = '';
		$from_email = '';
		$subject = '';
		$body = '';
		$edit_id = 0;
		$type = '';
		$send_copy = '';
		if(isset($data['inputes_values']['email_send_copy']) && isset($data['inputes_values']['email_send_copy']['value'])){
			$send_copy = $data['inputes_values']['email_send_copy']['value'];
		}
		if(isset($data['inputes_values']['rbt_email_template_edit_id']) && isset($data['inputes_values']['rbt_email_template_edit_id']['value'])){
			$edit_id = $data['inputes_values']['rbt_email_template_edit_id']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_name']) && isset($data['inputes_values']['email_tmp_name']['value'])){
			$tempalte_name = $data['inputes_values']['email_tmp_name']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_type']) && isset($data['inputes_values']['email_tmp_type']['value'])){
			$type = $data['inputes_values']['email_tmp_type']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_from_email']) && isset($data['inputes_values']['email_tmp_from_email']['value'])){
			$from_email = $data['inputes_values']['email_tmp_from_email']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_from_name']) && isset($data['inputes_values']['email_tmp_from_name']['value'])){
			$from_name = $data['inputes_values']['email_tmp_from_name']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_subject']) && isset($data['inputes_values']['email_tmp_subject']['value'])){
			$subject = $data['inputes_values']['email_tmp_subject']['value'];
		}

		if(isset($data['inputes_values']['email_tmp_body']) && isset($data['inputes_values']['email_tmp_body']['value'])){
			$body = $data['inputes_values']['email_tmp_body']['value'];
		}

		$obj = new RBT_EmailNotificationTemplates();
		$obj->setTemplateName($tempalte_name);
		$obj->setFromName($from_name);
		$obj->setFromEmail($from_email);
		$obj->setType($type);
		$obj->setSendCopy($send_copy);
		$obj->setSubject($subject);
		$obj->setBody($body);
		$hasData = RBT_EmailNotificationTemplates::loadById($edit_id);
		if(isset($hasData)){
           $obj->setId($hasData->getId());
           $obj->update();
           $output['db_action'] = 'update';
		}else{
			$edit_id = $obj->create();
			$output['db_action'] = 'create';
			
		}

		$output['edit_id'] = $edit_id;	
		$output['success'] = 'Save Successfully';	


	}else{
		$output['error'] = 'Something Went Wrong';	
	}

	return $output;
}

function rbtLoadSliderItemHtml($data = ''){
	$output = array();	
	$html = '';
  if(is_array($data) && isset($data['slider_img_id'])){

			$slider_img_url =  $data['slider_img_url'];
			$slider_img_id =  $data['slider_img_id'];
			$heading_checked =  $data['heading_checked'];

			$heading_text_html =  stripslashes($data['heading_text_html']);
			$description_checked =  $data['description_checked'];
			$description_text_html =  stripslashes($data['description_text_html']);

			$html  = '<div class="slider_item">';
			$html  .= '<div class="slider_item_inner_wrapper">';

			$html  .= '<div class="" style="display:none">';
			$html  .= '<input type="hidden" value="'.$slider_img_id.'" class="slider_item_img_id">';
			$html  .= '<input type="hidden" value="'.$heading_checked.'" class="slider_item_heading_checked">';
			$html  .= '<div class="slider_item_heading_text_html">'.$heading_text_html.'</div>';

			$html  .= '<input type="hidden" value="'.$description_checked.'" class="slider_item_description_checked">';
			$html  .= '<div class="slider_item_description_text_html">'.$description_text_html.'</div>';

			$html  .= '</div>';
			$html  .= '<div class="slider_item_img"><img class="slider_item_img_src" src="'.$slider_img_url.'"></div>';
			$html  .= '<div class="slider_item_action"><span class="rbt_anchor_btn rbt_edit_btn rbt_btn" onclick="rbtSliderEditItem(this);"><i class="fas fa-edit"></i></span> <span class="rbt_anchor_btn rbt_delete_btn rbt_btn" onclick="rbtSliderDeleteItem(this);"><i class="fas fa fa-trash"></i></span></div>';
			$html  .= '</div>';
			$html  .= '</div>';
			$output['html'] = $html;

			$output['success'] = 'Save Successfully';	

	}else{
			$output['error'] = 'Something Went Wrong';	
	}

	
	return $output;
}


function rbtLoadAddSliderFormHtml($data = ''){

	$output = array();	
	$heading_checked = '';
	$heading_text = '<div class="rbt_tiny_mce_editor rbt_tiny_mce_editor_style"></div>';
	$heading_text_display = 'none';
	$description_checked = '';
	$description_text = '<div class="rbt_tiny_mce_editor rbt_tiny_mce_editor_style"></div>';
	$description_text_display = 'none';
	$img_id = '';
	$selected_img_html = '';

	if(isset($data['slider_item_img_id'])){
		$img_id = $data['slider_item_img_id'];
	}

	if(isset($data['slider_item_heading_checked'])){
		$heading_checked = $data['slider_item_heading_checked'];
		if($heading_checked == 'Y'){
			$heading_text_display = 'block';
			$heading_checked = 'checked';
		}
	}

	if(isset($data['slider_item_heading_text_html'])){
		$heading_text = $data['slider_item_heading_text_html'];
		
		$heading_text = str_replace('\&quot;','', $heading_text);
		$heading_text = stripslashes($heading_text);
			
	}

  if(isset($data['slider_item_description_checked'])){
		$description_checked = $data['slider_item_description_checked'];
		if($description_checked == 'Y'){
			$description_text_display = 'block';
			$description_checked = 'checked';
		}
	}

 if(isset($data['slider_item_description_text_html'])){
		$description_text = $data['slider_item_description_text_html'];
		$description_text = str_replace('\&quot;','', $description_text);
		$description_text = stripslashes($description_text);
    
 }

 if(isset($data['slider_item_img_src'])){
		$slider_item_img_src = $data['slider_item_img_src'];
		$selected_img_html = '<img src="'.$slider_item_img_src.'">';
 }




	$html = '<div class="modal_content_form " >

  <div class=" ">
    <div class="form-group">
      <label >Heading</label>
      <input type="checkbox" class="form-control rbt_field rbt_field_onchage_hide_show_section" name="slider_heading_y" '.$heading_checked.' data-show-hide-class= "slider_heading_html" >
      <div class="slider_heading_html" style="display:'.$heading_text_display.'"> '.$heading_text.'   </div>
    </div>

    <div class="form-group">
      <label >Description</label>
      <input type="checkbox" class="form-control  rbt_field rbt_field_onchage_hide_show_section" name="slider_description_y"  '.$description_checked.'   data-show-hide-class= "slider_description_html">
      <div class="slider_description_html" style="display:'.$description_text_display.'"> '.$description_text.'</div>
    </div>

     <div class="form-group">
      <label >Image</label>
      <span class="rbt_anchor_btn" onclick= "rbtMediaUploaderImage(this,\'add_slider_img_preview_html\',\'slider_img_id\')">select image</span>
      <div class="add_slider_img_preview_html">'.$selected_img_html.'</div> 
      <input type="hidden" class="form-control rbt_field rbt_field_required" name="slider_img_id" data-error-msg="Please select image" value="'.$img_id.'" >
    </div>
  </div>
  <button type="button" class="btn btn-primary" onclick="rbtAddSliderSection(this)">Add Slider</button>
	';
	$output['html'] = $html;
	$output['success'] = 'Save Successfully';	
	return $output;

}




}// is admin condotion is closed