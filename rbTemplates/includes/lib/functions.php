<?php 

function RBTlogToFile($msg = '',$error_type = ''){
	$error_type_db = 'all';
	$log_create_status = true;
	
	if($error_type_db == 'ALL'){
		$log_create_status = true;
	}else if($error_type == 'All'){
		$log_create_status = true;
	}
	
	if($log_create_status){
		$obj = new RBT_Logs();
		$obj->setLog($msg);
		$obj->create();	
	}
}

function RBTCommonVariableHtml(){
	
	$html = '<input type="hidden" value="'.site_url().'" name="rbt_global_website_url">';
	$html .= '<input type="hidden" value="'.plugin_dir_url('').RBT_PLUGIN_NAME.'" name="rbt_global_plugin_url">';
	$html .= '<input type="hidden" value="'.plugin_dir_url('').RBT_PLUGIN_NAME.'/includes/assets/images" name="rbt_global_plugin_img_url">';
	return $html;
	
}

function RBTLoaderHtml(){
	$html  = '';
	$html  .= '<div class="rbt_laoder_wrapper">';
	$html .= '<div id="rbt_loading_overlay"></div>';
	$html .= '<div id="rbt_loader_icon">';
	$html .= '<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="rbt_lds-dual-ring"><div></div></div></div>';
	$html .= '</div>';
	$html .= '</div>';
	return $html ;
}

function RBTRandNumber($str = ''){
	return $str.rand(10,1000);
}


function RBTRandNumberCSSJS(){
	return date('ymdhis').rand(10,1000);
}


function RBTRemoveUnsedHtmlContent(){
	$html  = "<div class='rbt_remove_unused_html_content' style='display:none'></div>";
	return $html;

}
function RBTGetShortcodeNameByIdAndType($id = 0, $type = ''){
	
	$html  = '';
	if($type == 'contact'){

		$html = '[RBTContactForm id='.$id.'][/RBTContactForm]';

	}else if($type == 'login'){

		$html = '[RBTLoginForm id='.$id.'][/RBTLoginForm]';

	}else if($type == 'gallery'){

		$html = '[RBTGallery id='.$id.'][/RBTGallery]';

	}else if($type == 'registration'){

		$html = '[RBTUserRegistrationForm id='.$id.'][/RBTUserRegistrationForm]';
	}else if($type == 'subscribe'){

		$html = '[RBTSubscribeForm id='.$id.'][/RBTSubscribeForm]';
	}else if($type == 'slider'){

		$html = '[RBTSlider id='.$id.'][/RBTSlider]';
	}

	return $html;
}

function RBTGetContactFormShortcodeNameById($id){
	return RBTGetShortcodeNameByIdAndType($id,'contact');
}



function rbtSetMailHtmlContentType(){
    return 'text/html';
}


function rbtReplateMergeTag($content = '', $data_replace_arr = ''){

	if(is_array($data_replace_arr)){
		foreach ($data_replace_arr as $name => $value){
			$content = str_replace('%%'.$name.'%%', $value, $content);
		}
	}
	return $content;

}

function rbtSendMail($data = '',$email_template_id = 0){

    if(is_array($data)){
 		if(!isset($data['email'])){
 			return false;
 		}
 		$send_to_mail_id = $data['email'];

    	$email_obj =  RBT_EmailNotificationTemplates::loadById($email_template_id);
    	if(!isset($email_obj )){
    		return false;
    	}

        $send_copy = $email_obj->getSendCopy();
        $from_name = $email_obj->getFromName();
        $from_email = $email_obj->getFromEmail();
        $subject = $email_obj->getSubject();
        $body = $email_obj->getBody();
        if($from_name == '' || $from_email == '' || $subject == '' || $body == '' || $send_to_mail_id == ''){
            return false;
        }

        $body = rbtReplateMergeTag($body,$data);
       
        add_filter( 'wp_mail_content_type', 'rbtThemeSetMailHtmlContentType' );
        $headers = array('From: '.$from_name.' <'.$from_email.'>');
        $status = wp_mail( $send_to_mail_id, $subject, $body, $headers);
        if($send_copy == 1){
        	$send_to_mail_id = $from_email;
        	$subject =  $subject.' - copy mail'; 

        	wp_mail( $send_to_mail_id, $subject, $body, $headers);
        }

        return $status;
    }
}

function rbtGetAllTemplatesFromTypesArr(){
	$list = array('contact','login','registration','subscribe');
	return $list;
}

function rbtListShortcodeWithoutTemplatesAndDragDropFeaturesArr(){
	$list = array('slider');
	return $list;
}

function rbtGetAllTemplatesTypesArr(){
	$list = array_merge(rbtGetAllTemplatesFromTypesArr(), array('gallery'),rbtListShortcodeWithoutTemplatesAndDragDropFeaturesArr());
	return $list;
}
