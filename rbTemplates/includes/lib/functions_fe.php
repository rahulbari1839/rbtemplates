<?php 

function rbtGetIPAddress() {  


    //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  

      $ip = $_SERVER['HTTP_CLIENT_IP'];  

   }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //whether ip is from the proxy 

      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  

   }else{  //whether ip is from the remote address  

      $ip = $_SERVER['REMOTE_ADDR'];  
   }  
     return $ip;  
}  

function RBTShortcodeDisplayFormByIdFe($id = 0, $preview = ''){

    $formObj =  RBT_Form::loadById($id);  

    $html = ''; 

	if(isset($formObj)){
		$type = $formObj->getType(); 
        
		if(in_array($type, rbtGetAllTemplatesTypesArr())){

			$html = RBTShortcodeFormFe($formObj,$preview,$type); 
		}else{
			return $html;
		}

		if(in_array($type, rbtGetAllTemplatesFromTypesArr())){
			$html = rbtFieldsReplaceStaticDataToDynamic($html, $type, $id);
		}

		$html = rbtWrapHtmlWithCommonSection($html, $type, $id,$formObj);

	}
	return $html;
}

function rbtWrapHtmlWithCommonSection($html = '', $type = '', $id = 0,$formObj = ''){
	$outer_rand_no =  $id.'_'.RBTRandNumber();

	$loader_html = RBTLoaderHtml();

	$common_hidden_fields = RBTShortcodeCommonHiddenFieldsFe($id);

	$html = $common_hidden_fields.$html;

	$extra_clases = '';
	$display_type = $formObj->getDisplayType(); 
	if($display_type == 'button_click'){
		$extra_clases = ' tmplate_display_type_'.$display_type;
	}else if($display_type == 'popup'){
		$extra_clases = ' tmplate_display_type_'.$display_type;
	}

	$html = $loader_html."<div  class='".$extra_clases." rbt_frontend_outer_div rbt_form_outer_".$type."' id='rbt_frontend_outer_div_".$outer_rand_no."' style='display:none'>".$html."</div>";

	$html = stripslashes($html);

	$html  = str_replace('contenteditable="true"','contenteditable="false"',$html); 

	return $html;
}



function rbtFieldsReplaceStaticDataToDynamic($html = '', $type = '' , $id = ''){

	$all_fields = RBT_Fields::load();
	// for default fields
	$html  = str_replace('||||name_class||||',' rbt_field_required ',$html); 
	$html  = str_replace('||||error_name_msg||||',"Field is required ",$html); 
	$html  = str_replace('||||email_class||||',' rbt_field_required ',$html); 
	$html  = str_replace('||||error_email_msg||||',"Field is required ",$html); 
	if(isset($all_fields)){
		foreach ($all_fields as  $field_obj) {

			$requred_class = '';

			$requred_error_msg = '';

			$field_name = trim($field_obj->name);

			if($field_obj->is_required == 1){
				$requred_class = ' rbt_field_required ';
				$requred_error_msg = $field_obj->required_msg;
			}

			$html  = str_replace('||||'.$field_name.'_class||||',$requred_class,$html); 
			$html  = str_replace('||||error_'.$field_name.'_msg||||',$requred_error_msg,$html); 

		}
	}
	return $html;

}





function rbtGetMd5Data($data = ''){

	$data = (int)$data;

	$number = mt_rand().date('y-m-d-H-m-s').$data;

	return md5(uniqid($number, true));



}

function rbtDecodeData($key = 0){

	return rbtGetSessionValueByKey($key);

}





function rbtSetSessionKeyAndValue($key = '',$value = ''){

	if(isset($_SESSION['rb_templates']) && isset($_SESSION['rb_templates'][$key])){

	}else{
		$_SESSION['rb_templates'][$key] = $value;
	}
	
	return $_SESSION['rb_templates'][$key];

}



function rbtGetSessionValueByKey($key){

	$value = '';

	if(isset($_SESSION['rb_templates']) && isset($_SESSION['rb_templates'][$key])){

			$value = $_SESSION['rb_templates'][$key];

	}

	return $value;

}



function rbtEncodeData($data = 0){

	$key = rbtGetMd5Data($data);

	rbtSetSessionKeyAndValue($key,$data);

	return $key;

}







function RBTVerificationToken($token_check = ''){

	$status = null;

	$curent_token = '';

	if(isset($_SESSION['rb_templates'])){

		$curent_token = rbtGetSessionValueByKey('token');

		if($token_check == $curent_token){

				$status = true;

		}

	}

	return $status;

}





function RBTGetToken(){

	$rbt_token = '';

	if(isset($_SESSION['rb_templates']['token'])){

			$rbt_token = $_SESSION['rb_templates']['token'];

	}

	return $rbt_token;

}



function RBTSetToken(){

	$rbt_token = rbtGetMd5Data();

	$rbt_token = rbtSetSessionKeyAndValue('token',$rbt_token);

	return $rbt_token;

}



function RBTInputValidate($data) {

  $data = trim($data);

  $data = stripslashes($data);

  $data = htmlspecialchars($data);

  return $data;

}



function RBTShortcodeCommonHiddenFieldsFe($id = 0){

		$rbt_ajax_token = RBTSetToken();

		$ajaxurl =  admin_url('admin-ajax.php');

		$rbt_ajax_error = "Something Wrong";

		$html = '';

		$html .= '<input type="hidden"  name="rbt_ajax_url" value="'.$ajaxurl.'" />';

		$html .= '<input type="hidden"  name="rbt_ajax_token" value="'.$rbt_ajax_token.'" />';

		$html .= '<input type="hidden"  name="rbt_ajax_error" value="'.$rbt_ajax_error.'" />';

		$html .= '<input type="hidden"  name="rbt_form_id" value="'.rbtEncodeData($id).'" />';

		return $html;

}



function RBTShortcodeFormFe($formObj = null, $preview = '', $type = ''){

	$output = '';

	if(isset($formObj)){

		$includes_css_js = RBTGetFrontendCssAndJsFe($formObj);

		$css_js_rand_no = RBTRandNumberCSSJS();
		
		$html = $formObj->getHtml();
		$display_type = $formObj->getDisplayType();  
		if($display_type == 'button_click'){
			$html .= $formObj->getHtml2(); 
		}else if($display_type == 'popup'){
			$html = '<div class="rbt_close_template_popup rbt_temp_cursor"><i class="fa fa-window-close" aria-hidden="true"></i></div>'.$html;
		}

		if($type == 'slider'){
			
			$html = rbtSliderItemsHtmlFe($formObj);
		}

		$output = $includes_css_js.$html;
	}

	return $output;
}


function rbtSliderItemsHtmlFe($shortcode_obj = ''){
	$html = $shortcode_obj->getHtml(); 
	$customizer_values = $shortcode_obj->getCustomizerValues();
	$customizer_values_array = explode('||||',$customizer_values);
	$image_per_screen = 1;
	if(isset($customizer_values_array[0]) && is_numeric($customizer_values_array[0])){
		$image_per_screen = $customizer_values_array[0]; 
	}

	if($html != ''){
		$slider_items_html = '';
		$slider_items_array = explode('||||||',$html);
		if(count($slider_items_array)){
			foreach ($slider_items_array as $slider_item_array) {
				$slider_item_array = explode('||||',$slider_item_array);
				$slider_img_id = 0;
				$heading_checked = '';
				$heading_text_html = '';
				$description_checked = '';
				$description_text_html = '';
				
				

				if(isset($slider_item_array[0])){
					$slider_img_id = $slider_item_array[0];
				}
				if(isset($slider_item_array[1])){
					$heading_checked = $slider_item_array[1];
				}
				if(isset($slider_item_array[2])){
					$heading_text_html = $slider_item_array[2];
				}
				if(isset($slider_item_array[3])){
					$description_checked = $slider_item_array[3];
				}
				if(isset($slider_item_array[4])){
					$description_text_html = $slider_item_array[4];
				}

				$slider_img_details = wp_get_attachment_image_src($slider_img_id,'full');
				$slider_img_url = '';
				if($slider_img_details && is_array($slider_img_details) && isset($slider_img_details[0])){
					$slider_img_url = $slider_img_details[0];
				}

				$slider_items_html .= '<div class="rbt_slider_item item">';
				if($slider_img_url != ''){
					$slider_items_html .= '<div class="rbt_slider_item_img">';

					$slider_items_html .= '<div class="rbt_slider_item_info">';
					
					//$slider_items_html .= '<div class="rbt_slider_item_heading">hhhhhhhhh</div>';
					//$slider_items_html .= '<div class="rbt_slider_item_link"><a href="#">View</a></div>';

					 $slider_items_html .= '</div>';
					if($heading_checked == 'Y'){
						// $slider_items_html .= '<div class="rbt_slider_item_heading">'.$heading_text_html.'</div>';
					}
					if($description_checked == 'Y'){
						// $slider_items_html .= '<div class="rbt_slider_item_description">'.$description_text_html.'</div>';
					}
					$slider_items_html .= '<img src="'.$slider_img_url.'">';
					$slider_items_html .= '</div>';
				}
				$slider_items_html .= '</div>';
			}
			$rand_id = 'rbt_slider_items_owl_carousel_'.date('dmy-mis').rand(10,100);
			
			$slider_items_html = '<div class="owl-theme owl-carousel rbt_slider_items_owl_carousel" id="'.$rand_id.'"  items_in_sreen="'.$image_per_screen.'">'.$slider_items_html.'</div>';
		}


		$html = $slider_items_html;
	}
	return $html;
}


function RBTShortcodeLoginForm($formObj = null, $preview = ''){

	$output = '';

	if(isset($formObj)){

		$includes_css_js = RBTGetFrontendCssAndJsFe($formObj);

		$css_js_rand_no = RBTRandNumberCSSJS();

		$html = $formObj->getHtml(); 

		$output = $includes_css_js.$html;

		

	}

	return $output;

	

}





