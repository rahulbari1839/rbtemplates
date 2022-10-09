<?php 
$rbt_temp_aligment = 'center';
$rbt_temp_wid = 573;
$rbt_temp_border_width = 0;
$rbt_temp_border_radius = 0;
$rbt_temp_border_color = '#fff';
$rbt_temp_background_color = '#fff';
$rbt_temp_border_style = 'none';
$rbt_temp_img_show = 'yes';
//$rbt_contact_image_height = 258;
$rbt_temp_captcha = 'no';




$rbt_temp_error_width = 352;
$rbt_temp_error_border_width = 0; 
$rbt_temp_error_border_radius = 0;
$rbt_temp_error_background_color = '#f05b41';

$rbt_temp_error_border_color = '#fff';
$rbt_temp_error_style = 'none';



$rbt_temp_submit_btn_width = 352;
$rbt_temp_submit_btn_height = 48;
$rbt_temp_submit_btn_border_width = 0;
$rbt_temp_submit_btn_radius = 3;

$rbt_temp_submit_btn_background_color = '#4787fd';
$rbt_temp_submit_btn_border_color = '#fff';
$rbt_temp_submit_btn_border_style = 'none';


$rbt_temp_shadow_horizontal_length = 0;
$rbt_temp_shadow_vertical_length = 0;
$rbt_temp_shadow_blur_radius = 18;
$rbt_temp_shadow_spread_radius = 4;
$rbt_temp_shadow_color =  '#999';




// ===================



$default_numaric_values = array(	
   
  
	'rbt_temp_wid' => $rbt_temp_wid,
	'rbt_temp_border_width' => $rbt_temp_border_width,
	'rbt_temp_border_radius' => $rbt_temp_border_radius,
	'rbt_temp_error_width' => $rbt_temp_error_width,
	'rbt_temp_error_border_width' => $rbt_temp_error_border_width,
	'rbt_temp_error_border_radius' => $rbt_temp_error_border_radius,
	'rbt_temp_submit_btn_width' => $rbt_temp_submit_btn_width,
	'rbt_temp_submit_btn_height' => $rbt_temp_submit_btn_height,
	'rbt_temp_submit_btn_border_width' => $rbt_temp_submit_btn_border_width,
	'rbt_temp_submit_btn_radius' => $rbt_temp_submit_btn_radius,
	//'rbt_contact_image_height' => $rbt_contact_image_height,
	'rbt_temp_shadow_horizontal_length' => $rbt_temp_shadow_horizontal_length,
	'rbt_temp_shadow_vertical_length' => $rbt_temp_shadow_vertical_length,
	'rbt_temp_shadow_blur_radius' => $rbt_temp_shadow_blur_radius,
	'rbt_temp_shadow_spread_radius' => $rbt_temp_shadow_spread_radius,
);


$default_style_values = array(	
	
	
	'rbt_temp_border_style' => $rbt_temp_border_style,
	'rbt_temp_img_show' => $rbt_temp_img_show,
	
	'rbt_temp_error_style' => $rbt_temp_error_style,
	'rbt_temp_submit_btn_border_style' => $rbt_temp_submit_btn_border_style,
	'rbt_temp_captcha' => $rbt_temp_captcha,
	'rbt_temp_aligment' => $rbt_temp_aligment
);

$default_colorpicker_values = array(
	
	 'rbt_temp_border_color' => $rbt_temp_border_color,
	
	
	 'rbt_temp_background_color' => $rbt_temp_background_color,
	 'rbt_temp_error_background_color' => $rbt_temp_error_background_color,
     'rbt_temp_error_border_color' => $rbt_temp_error_border_color,
     'rbt_temp_submit_btn_background_color' => $rbt_temp_submit_btn_background_color,
     'rbt_temp_submit_btn_border_color' => $rbt_temp_submit_btn_border_color,
     'rbt_temp_shadow_color' => $rbt_temp_shadow_color,
);


// default set variables
$template_type = 'gallery';
$template_type_class = 'gallery';
$template_heading_text = '';
$heading_error_text = 'After submit form show error/Success messages';

 $html  =  '<div id="rbt_form_template_wrapper" class=" rbt_form_wrapper_template rbt_'.$template_type_class.'_template_wrapper rbt_'.$template_type_class.'_template_1">';
 $html .=  '<div class="rbt_template_wrapper_customizer_init rbt_'.$template_type_class.'_outer rbt_template_enable_drag_drop_outer">';
 //image 1
 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';

 // image 2
 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default1.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';

 // image 3
 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default2.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';

 //image 4

 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default3.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';

 //image 5
 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default4.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';

 //image 6
 $html .=  '<div class="rbt_template_drag_drop_item_section ui_helper_my_custom_element rbt_default_'.$template_type_class.'_img">';
  $html .=  '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
 $html .=  '<div class=" rbt_change_img_outer rbt_img_resizeable_outer  ">';
 $html .= '<img class="rbt_change_img " src="'.plugin_dir_url(__FILE__).'images/default5.jpg" >';
 $html .= '<span class="rbt_change_img_icon rbt_frontend_hide" data-class="start_img"><i class="fa fa-camera" aria-hidden="true"></i></span>';
 $html .= '</div>';
 $html .= '</div>';
 

 $html .= '</div>';
 $html .= '</div>';
 
 


 
 
 
 



$css_file_path = plugin_dir_url(__FILE__)."style.css?".rand(1,1000);


echo json_encode(array('html'=>$html,'css_file_path'=>$css_file_path,'default_numaric_values'=>$default_numaric_values,'default_style_values'=>$default_style_values,'default_colorpicker_values'=>$default_colorpicker_values));
die;





;
