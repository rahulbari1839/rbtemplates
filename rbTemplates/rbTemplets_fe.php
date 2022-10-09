<?php

add_shortcode('RBTSubscribeForm', 'RBTSubscribeFormShortcodeFe');
add_shortcode('RBTPageVisit', 'RBTPageVisitShortcodeFe');
add_shortcode('RBTUserRegistrationForm', 'RBTUserRegistrationFormShortcodeFe');
add_shortcode('RBTSlider', 'RBTSliderhortcodeFe');
add_shortcode('RBTGallery', 'RBTGalleryShortcodeFe');
add_shortcode('RBTLoginForm', 'RBTLoginFormShortcodeFe');
add_shortcode('RBTContactForm', 'RBTContactFormShortcodeFe');

function RBTPageVisitShortcodeFe($atts, $content = null){

	$page_id = get_the_ID(); 
	$user_ip = rbtGetIPAddress(); 
	$temp_type = 'page_visit';

	if(is_numeric($page_id) && $page_id != 0){
		
		$obj = new RBT_UsersInfo();
		$obj->setName($page_id);
		$obj->setEmail($user_ip);
		$obj->setType($temp_type);
		$obj->create();
	}

}

function RBTSliderhortcodeFe($atts, $content = null){
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;

}

function RBTSubscribeFormShortcodeFe($atts, $content = null){
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;

}
function RBTUserRegistrationFormShortcodeFe($atts, $content = null){
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;
	//include_once (plugin_dir_path(__FILE__)."includes/frontend/contact_shortcode.php");
	//return RBTDisplayContactFormById($id);
	
}
 

function RBTGalleryShortcodeFe($atts, $content = null){
	$html  = '';
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;	
}

function RBTLoginFormShortcodeFe($atts, $content = null){
	$html  = '';
	if ( is_user_logged_in() ) {
	return $html;		
	} 
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;	
}



function RBTContactFormShortcodeFe($atts, $content = null){
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	$html = RBTShortcodeDisplayFormByIdFe($id);
	return $html;
	//include_once (plugin_dir_path(__FILE__)."includes/frontend/contact_shortcode.php");
	//return RBTDisplayContactFormById($id);
	
}



//get style And script
function RBTGetScriptJQuery(){
	
	$jquerymain =""; 
	if(!wp_script_is('jquery')) {
		$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";					
	} 
	return $jquerymain;	
}






function RBTGetFrontendCssAndJsFe($formObj = null){

		static $call_one_time = false;
		if($call_one_time){
			//return false;
		}

	    if (!$call_one_time) {
	        $call_one_time = true;
	        // etc.
	    }
	    if(!isset($formObj)){
			return false;
	    }

	    $action_type = $formObj->getType(); 
	    $template_no = $formObj->getTemplateNo(); 
	    if($action_type ==''){
			return false;
		}
		$includes_jQuery  = RBTGetScriptJQuery();
		
		//check if enqueue is working on the site
		if(wp_style_is('wp_enqueue_test_css')) {  
			$includeCSSByEnqueue = true;
		}else{
			$includeCSSByEnqueue = false;
		}

		if(wp_script_is('wp_enqueue_test_js')) {
			$includeJSByEnqueue = true;
		}else{
			$includeJSByEnqueue = false;
		}
		
		
		$includes_css_js = "";
		$css_js_rand_no = RBTRandNumberCSSJS(); 

		$common_external_before_css_arr = array('rbt-font-awesome'=>'//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css','rbt-font-googleapis'=>'//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap');

		$common_css_after_arr = array('rbt_common_backend_frontend' => 'common_backend_frontend.css','rbt_common_backend_frontend_templates' => 'common_backend_frontend_templates.css','rbt_common_fe'=>'common_fe.css');


		$common_css_drag_drop_temp_arr = array('rbt_drag_drop' => 'drag_drop.css');

		$common_css_temp_arr = array('rbt_template_'.$action_type.'_'.$template_no =>"includes/templates/".$action_type."/".$template_no."/style.css");


		
		//$common_js_drag_drop_temp_arr = array('rbt_drag_drop' => 'drag_drop.js');

		$css_on_action_type_arr = array(
					 'gallery' => array('rbt_gallery_viewer'=>'viewer.css'),
					 'slider' => array('rbt_slider_owl_carousel_default'=>'owl.theme.default.min.css','rbt_slider_owl_carousel'=>'owl.carousel.min.css'),
					);

		$js_on_action_type_arr = array(
					 'gallery' => array('rbt_gallery_viewer'=>'viewer.min.js'),
					 'slider' => array('rbt_slider_owl_carousel'=>'owl.carousel.min.js'),
					);
		
		

		$common_js_for_submit_form_arr = array('rbt_form_fe' => 'form_fe.js');
		$common_js_after_arr = array('rbt_common_fe' => 'common_fe.js');


	

		$includes_css_js_without_enqueue  = '';
		if(wp_script_is('jquery')) {
				if($includeCSSByEnqueue){

					foreach ($common_external_before_css_arr as $key => $value) {
						wp_enqueue_style($key, $value);
					}

					if(!in_array($action_type, rbtListShortcodeWithoutTemplatesAndDragDropFeaturesArr())){
						foreach ($common_css_drag_drop_temp_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
							wp_enqueue_style($key, $value);
							
						}
						foreach ($common_css_temp_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).$value.'?'.$css_js_rand_no;
							wp_enqueue_style($key, $value);
							
						}
					}

					

					if(isset($css_on_action_type_arr[$action_type])){
						foreach ($css_on_action_type_arr[$action_type] as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
							wp_enqueue_style($key, $value);
							
						}
					}

					foreach ($common_css_after_arr as $key => $value) {
						$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
						wp_enqueue_style($key, $value);
						
					}
				} 

				 if($includeJSByEnqueue){

				 	if(in_array($action_type, rbtGetAllTemplatesFromTypesArr())){
				 		foreach ($common_js_for_submit_form_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
							wp_enqueue_script($key, $value, array('jquery'), $css_js_rand_no);
							
						}
				 	}

				 	

					if(isset($js_on_action_type_arr[$action_type])){

						foreach ($js_on_action_type_arr[$action_type] as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
							wp_enqueue_style($key, $value);
						
						}
					}

				 	foreach ($common_js_after_arr as $key => $value) {
						$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
						wp_enqueue_script($key, $value, array('jquery'), $css_js_rand_no);
						
					}

				 }
			}else{

					foreach ($common_external_before_css_arr as $key => $value) {
						$includes_css_js_without_enqueue .= '<link href="'.$value.'" rel="stylesheet">';
					}

					if(!in_array($action_type, rbtListShortcodeWithoutTemplatesAndDragDropFeaturesArr())){
						foreach ($common_css_drag_drop_temp_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
							$includes_css_js_without_enqueue .= '<link href="'.$value.'" rel="stylesheet">';
						}
						foreach ($common_css_temp_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).$value.'?'.$css_js_rand_no;
							$includes_css_js_without_enqueue .= '<link href="'.$value.'" rel="stylesheet">';
							
						}
					}

					if(isset($css_on_action_type_arr[$action_type])){
						foreach ($css_on_action_type_arr[$action_type] as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
							$includes_css_js_without_enqueue .= '<link href="'.$value.'" rel="stylesheet">';
						}
					}

					foreach ($common_css_after_arr as $key => $value) {
						$value = plugin_dir_url(__FILE__).'includes/assets/css/'.$value.'?'.$css_js_rand_no;
						$includes_css_js_without_enqueue .= '<link href="'.$value.'" rel="stylesheet">';
					}
					

					// js include 

				 	if(in_array($action_type, rbtGetAllTemplatesFromTypesArr())){
				 		
				 		foreach ($common_js_for_submit_form_arr as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
						
							$includes_css_js_without_enqueue .= '<script src="'.$value.'" defer></script>';
						}
				 	}


					if(isset($js_on_action_type_arr[$action_type])){

						foreach ($js_on_action_type_arr[$action_type] as $key => $value) {
							$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
							
							$includes_css_js_without_enqueue .= '<script src="'.$value.'" defer></script>';
						}
					}

				 	foreach ($common_js_after_arr as $key => $value) {
						$value = plugin_dir_url(__FILE__).'includes/assets/js/'.$value.'?'.$css_js_rand_no;
						
						$includes_css_js_without_enqueue .= '<script src="'.$value.'" defer></script>';
					}

				//$includes_css_js  .= '<script  src="//code.jquery.com/ui/1.12.1/jquery-ui.js?'.$css_js_rand_no.'" defer></script>';
				$includes_css_js .=$includes_css_js_without_enqueue; 

			}

			
		
	return $includes_jQuery.$includes_css_js;
}
