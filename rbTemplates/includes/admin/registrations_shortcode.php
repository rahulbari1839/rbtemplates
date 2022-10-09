<?php 
wp_enqueue_script("rbt_sortable_jquery_ui", "//code.jquery.com/ui/1.12.1/jquery-ui.js", array('jquery')); 

$rbt_temp_aligment = 'center';
$rbt_temp_wid = 573;
$rbt_temp_background_color = '#fff';
$rbt_temp_border_width = 0;
$rbt_temp_border_style = 'none';
$rbt_temp_border_color = '#fff';
$rbt_temp_border_radius = 0;


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

$rbt_temp_error_width = 352;
$rbt_temp_error_background_color = '#f05b41';
$rbt_temp_error_border_width = 0; 
$rbt_temp_error_style = 'none';
$rbt_temp_error_border_color = '#fff';
$rbt_temp_error_border_radius = 0;

$form_name = '';
$form_html = '';
$customizer_values = '';
$template_no = '';
$form_edit_id = '';
$shortcode_details = '';
$form_edit_mode = false;

$template_type = 'registration';

$email_templates_list = RBT_EmailNotificationTemplates::loadByType($template_type);
$selected_email_temp = 0;
if(isset($_GET['id'])){
	$RBT_DataHas = RBT_Form::loadById($_GET['id']);
	if(isset($RBT_DataHas)){
		$form_edit_mode = true;
		$form_edit_id = $_GET['id'];
		$form_name = $RBT_DataHas->getName();
		$selected_email_temp = $RBT_DataHas->getEmailTemplateId();
		$template_no = $RBT_DataHas->getTemplateNo();
		$shortcode_details  = RBTGetShortcodeNameByIdAndType($form_edit_id,$template_type);
		$shortcode_details  = '<div class="rbt_shortcode_details"><span class="shortcode_details">Here is your Shortcode:</span><p><span class="shortcode_display" id="dynamic_copyable_text_rbt_'.$form_edit_id.'">'.$shortcode_details.'</span><span data-id="dynamic_copyable_text_rbt_'.$form_edit_id.'" class="copy-btn " onclick="rbt_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p></div>';
		$form_html = $RBT_DataHas->getHtml();
		$form_html = stripslashes($form_html);
		$form_html = '<link rel="stylesheet"  href="'.plugin_dir_url(__FILE__)."../templates/".$template_type."/".$template_no."/style.css?".rand(1,1000).'"><div class="template_html_wrapper ">'.$form_html.'</div>';
		$customizer_values = $RBT_DataHas->getCustomizerValues();
		
		$customizer_values_array = explode('||||',$customizer_values);
		if(isset($customizer_values_array[0])){
			
			$customizer_values_array1 = explode('||',$customizer_values_array[0]);
			if(isset($customizer_values_array1[0])){
				$rbt_temp_aligment = $customizer_values_array1[0];
			}
			if(isset($customizer_values_array1[1])){
				$rbt_temp_wid = $customizer_values_array1[1];
			}
			if(isset($customizer_values_array1[2])){
				$rbt_temp_background_color = $customizer_values_array1[2];
			}
			
		}
		
		if(0 && isset($customizer_values_array[1])){
			
			$customizer_values_array2 = explode('||',$customizer_values_array[1]);
			if(isset($customizer_values_array2[0])){
				$rbt_temp_border_width = $customizer_values_array2[0];
			}
			if(isset($customizer_values_array2[1])){
				$rbt_temp_border_style = $customizer_values_array2[1];
			}
			if(isset($customizer_values_array2[2])){
				$rbt_temp_border_color = $customizer_values_array2[2];
			}
			if(isset($customizer_values_array2[3])){
				$rbt_temp_border_radius = $customizer_values_array2[3];
			}
			
		}
		
		if(isset($customizer_values_array[2])){
			
			$customizer_values_array3 = explode('||',$customizer_values_array[2]);
			if(isset($customizer_values_array3[0])){
				$rbt_temp_shadow_color = $customizer_values_array3[0];
			}
			if(isset($customizer_values_array3[1])){
				$rbt_temp_shadow_spread_radius = $customizer_values_array3[1];
			}
			if(isset($customizer_values_array3[2])){
				$rbt_temp_shadow_blur_radius = $customizer_values_array3[2];
			}
			if(isset($customizer_values_array3[3])){
				$rbt_temp_shadow_horizontal_length = $customizer_values_array3[3];
			}
			if(isset($customizer_values_array3[4])){
				$rbt_temp_shadow_vertical_length = $customizer_values_array3[4];
			}
		}
		
		if(isset($customizer_values_array[3])){
			
			$customizer_values_array4 = explode('||',$customizer_values_array[3]);
			if(isset($customizer_values_array4[0])){
				$rbt_temp_submit_btn_width = $customizer_values_array4[0];
			}
			if(isset($customizer_values_array4[1])){
				$rbt_temp_submit_btn_height = $customizer_values_array4[1];
			}
			if(isset($customizer_values_array4[2])){
				$rbt_temp_submit_btn_background_color = $customizer_values_array4[2];
			}
			if(isset($customizer_values_array4[3])){
				$rbt_temp_submit_btn_border_width = $customizer_values_array4[3];
			}
			if(isset($customizer_values_array4[4])){
				$rbt_temp_submit_btn_border_style = $customizer_values_array4[4];
			}
			if(isset($customizer_values_array4[5])){
				$rbt_temp_submit_btn_border_color = $customizer_values_array4[5];
			}
			if(isset($customizer_values_array4[6])){
				$rbt_temp_submit_btn_radius = $customizer_values_array4[6];
			}
		}
		
	}
}
?>


<div class="rbt_main_container">
	<?php include_once('common.php');
	echo RBTModalHtmlAdmin('rbt_modal_outer_img_preview');
	 ?>
	<ul class="nav nav-tabs rbt_tabs" id="rbt_tabs" role="tablist">
	  <li class="nav-item" role="presentation">
		<a class="nav-link <?php if(!$form_edit_mode){ echo ' active ';} ?>" id="rbt_tab_1_tab" data-toggle="tab" href="#rbt_tab_1" role="tab" aria-controls="rbt_tab_1" aria-selected="true">Basic Info</a>
	  </li>
	  <li class="nav-item" role="presentation">
		<a class="nav-link <?php if($form_edit_mode){ echo ' active ';} ?>" id="rbt_tab_2_tab" data-toggle="tab" href="#rbt_tab_2" role="tab" aria-controls="rbt_tab_2" aria-selected="false">Template Customizer</a>
	  </li>
	  <li class="nav-item" role="presentation">
		<a class="nav-link" id="rbt_tab_3_tab" data-toggle="tab" href="#rbt_tab_3" role="tab" aria-controls="rbt_tab_3" aria-selected="false">Details</a>
	  </li>
	</ul>
	<div class="tab-content p-4" id="rbTabContent">
	  <div class="tab-pane fade  <?php if(!$form_edit_mode){ echo ' show active ';} ?>" id="rbt_tab_1" role="tabpanel" aria-labelledby="rbt_tab_1_tab">
		<input type="hidden" class="form-control" id="rbt_form_edit_id" value="<?php echo $form_edit_id;?>">
		<input type="hidden" class="form-control" id="template_type" value="<?php echo $template_type;?>">
		 <div class="form-group form-group col-sm-4 ml-0 pl-0">
			<label for="rbt_form_name"><?php echo ucfirst($template_type); ?> Form Name</label>
			<input type="text" class="form-control rbt_field_required" data-error-msg="Please enter name." id="rbt_form_name" placeholder="Enter Name" value="<?php echo $form_name;?>">
		  </div>
		  
		  
		  <div class="form-group">
			<label ><h5>Select Template</h5></label>
			  
			  <ul class="rbt_templates_list  rbt_field_required" data-error-type="lenght" data-error-class="rbt_selcted_temp" data-error-class data-error-msg="Please select a template" >
				  <li  data-temp="template1" class="rbt_select_temp <?php if($template_no == 'template1'){ echo 'rbt_selcted_temp'; }?>">
					<h6 class="text-center">Template 1</h6>
				<div>
					<label class="rbt_select_img rbt_overlay_outer">
					<img class="img_prev" src="<?php echo plugin_dir_url(__FILE__)."../templates/".$template_type."/template1/preview.jpg";?>">
					<div class="rbt_overlay_inner"></div>
					<div class="rbt_select_btn">
					<span class="btn btn-primary" onclick="rbt_template_privew('<?php echo plugin_dir_url(__FILE__)."../templates/".$template_type."/template1/preview.jpg";?>')">Preview</span>
					<span class="btn btn-success" onclick="rbt_select_template(this,'<?php echo $template_type;?>','template1')">Select
					</span>

					</div>
					</label>
				</div>
				</li>

				

			</ul>
			
			
		  </div>
	  
		<div class="">
			<a  href="<?php echo admin_url('admin.php?page=rbt_manage_form'); ?>"  onclick="rbt_show_loader();" class="btn btn-secondary">Return to Manage Shortcodes</a>
			
			<span class="btn btn-primary" onclick="rbt_save_form_template(this,'rbt_tab_1')">Save</span>
			<span class="btn btn-info" onclick="rbt_save_form_template(this,'rbt_tab_1','rbt_tab_2')">Save & Next</span>
		</div>
	  
	  </div>
	  <div class="tab-pane fade <?php if($form_edit_mode){ echo ' show active ';} ?>" id="rbt_tab_2" role="tabpanel" aria-labelledby="rbt_tab_2_tab">
	  
	  <div class="row">
		<div class="col-sm-3">
		<div class="customized-optional">
			<div class="customizer_heading">Template Style <i class="fa fa-angle-down coptional-open-close-btn" aria-hidden="true"></i></div>
			<ul class="templates-styles customized-optional-ul">
				<li>
					<label>Template Alignment</label>
					<div class="input-group ">
						<select class="input-group form-control" id="rbt_temp_aligment" name="rbt_temp_aligment">
						<?php 
						$rbt_temp_aligment_array = array('center'=>'Center','left'=>'Left','right'=>'Right');

						foreach($rbt_temp_aligment_array as $key=>$value){
							$slected = '';
							if($key == $rbt_temp_aligment ){

							$slected = 'selected=selected';
							}
							echo "<option value='".$key."' $slected >$value</option>";
						}
						?>
							
							
						</select>
					</div>
			   </li>
			   <li>
				<label>Width</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
						<input id="rbt_temp_wid" name="rbt_temp_wid" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_wid;?>" /> 
					</div>
				</div>
				</li>
				<li>
				<label>Background Color </label>
				<div class="input-group ">
				  <div id="rbt_temp_background_color_div" class="input-group colorpicker-component colorpicker-element">
				  <input type="text" id="rbt_temp_background_color" value="<?php echo $rbt_temp_background_color ?>"  name="rbt_temp_background_color" class="form-control"> 
				  <span class="input-group-addon">
					  <i style="background-color:<?php echo $rbt_temp_background_color;?>"></i>
				   </span>
				  </div>
				</div>
			</li>
			
			<li>
				<label>Border Width</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
						<input id="rbt_temp_border_width" name="rbt_temp_border_width" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_border_width;?>" /> 
						
					</div>
				</div>
			</li>
			
			<li>
				<label>Border Style </label>
				<div class="input-group ">
					<select class="input-group form-control" id="rbt_temp_border_style" name="rbt_temp_border_style">
					<?php 
					$rbt_temp_border_style_array = array('none'=>'None','solid'=>'Solid','dashed'=>'Dashed','dotted'=>'Dotted');

					foreach($rbt_temp_border_style_array as $key=>$value){
						$slected = '';
						if($key == $rbt_temp_border_style ){

						$slected = 'selected=selected';
						}
						echo "<option value='".$key."' $slected >$value</option>";
					}
					?>
						
						
					</select>
				</div>
		</li>
		<li>
			<label>Border Color </label>
			<div class="input-group ">
			  <div id="rbt_temp_border_color_div" class="input-group colorpicker-component">
			  <input type="text"  name="rbt_temp_border_color" value="<?php echo $rbt_temp_border_color;?>" id="rbt_temp_border_color" class="form-control" /> 
			  <span class="input-group-addon">
				  <i style="background-color:<?php echo $rbt_temp_border_color;?>"></i>
			   </span>
			  </div>
			</div>
			</li>
			<li>
				<label>Border Radius</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
					<input id="rbt_temp_border_radius" name="rbt_temp_border_radius" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_border_radius; ?>" /> 
				</div>
			</div>
			</li>

		   </ul>
		</div>
		
		<div class="customized-optional">
			<div class="customizer_heading">Submit button style 
			<i class="fa fa-angle-up coptional-open-close-btn" aria-hidden="true"></i></div>
			<ul class="templates-styles customized-optional-ul" style="display: none">
			
				<li>
				<label>Width</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
						<input id="rbt_temp_submit_btn_width" name="rbt_temp_submit_btn_width" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="300" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_submit_btn_width;?>" /> 
					</div>
				</div>
				</li>
				
				<li>
					<label>Height</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
							<input id="rbt_temp_submit_btn_height" name="rbt_temp_submit_btn_height" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="5" data-slider-max="100" data-slider-step="1"
							 data-slider-value="<?php echo $rbt_temp_submit_btn_height;?>" /> 
						</div>
					</div>
				</li>
				<li >
					<label>Background Color </label>
					<div class="input-group ">
					  <div id="rbt_temp_submit_btn_background_color_div" class="input-group colorpicker-component colorpicker-element">
					  <input type="text" value="<?php echo $rbt_temp_submit_btn_background_color; ?>" id="rbt_temp_submit_btn_background_color" name="" class="form-control"> 
					  <span class="input-group-addon">
						  <i></i>
					   </span>
					  </div>
					</div>
				</li>
				<li >
					<label>Border Width</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
							<input id="rbt_temp_submit_btn_border_width" name="rbt_temp_submit_btn_border_width" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_submit_btn_border_width;?>" /> 
							
						</div>
					</div>
				</li>
				
				<li >
					<label>Button Border Style </label>
					<div class="input-group ">
						<select class="input-group form-control" id="rbt_temp_submit_btn_border_style" name="atc_border_style">
						<?php 
						$rbt_temp_submit_btn_border_style_array = array('none'=>'None','solid'=>'Solid','dashed'=>'Dashed','dotted'=>'Dotted');

						foreach($rbt_temp_submit_btn_border_style_array as $key=>$value){
						$slected = '';
						if($key == $rbt_temp_submit_btn_border_style ){

						$slected = 'selected=selected';
						}
						echo "<option value='".$key."' $slected >$value</option>";
						}
						?>
							
							
						</select>
					</div>
			</li>
			<li >
				<label>Border Color </label>
				<div class="input-group ">
				  <div id="rbt_temp_submit_btn_border_color_div" class="input-group colorpicker-component">
				  <input type="text"  name="rbt_temp_submit_btn_border_color" value="<?php echo $rbt_temp_submit_btn_border_color;?>" id="dm_login_temp_signin_border_color" class="form-control" /> 
				  <span class="input-group-addon">
					  <i style="background-color:<?php echo $rbt_temp_submit_btn_border_color;?>"></i>
				   </span>
				  </div>
				</div>
				</li>
				<li >
					<label>Border Radius</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
						<input id="rbt_temp_submit_btn_radius" name="rbt_temp_submit_btn_radius" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_submit_btn_radius; ?>" /> 
					</div>
				</div>
				</li>
			</ul>
		</div>
		
		<div class="customized-optional">
			<div class="customizer_heading">External Shadow Customizer<i class="fa fa-angle-up coptional-open-close-btn" aria-hidden="true"></i></div>
			<ul class="templates-styles customized-optional-ul" style="display: none">
				<li>
					<label>Shadow Color </label>
					<div class="input-group ">
					  <div id="rbt_temp_shadow_color_div" class="input-group colorpicker-component colorpicker-element">
					  <input type="text" value="<?php echo $rbt_temp_shadow_color;?>" id="rbt_temp_shadow_color" name="dm_login_temp_shadow_color" class="form-control"> 
					  <span class="input-group-addon">
						  <i></i>
					   </span>
					  </div>
					</div>
				</li>
				<li>
				<label>Spread Radius</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
						<input id="rbt_temp_shadow_spread_radius" name="rbt_temp_shadow_spread_radius" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_shadow_spread_radius;?>" /> 
					</div>
				</div>
				</li>
				
				
				<li>
					<label>Blur Radius</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
							<input id="rbt_temp_shadow_blur_radius" name="rbt_temp_shadow_blur_radius" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_shadow_blur_radius;?>" /> 
							
						</div>
					</div>
				</li>
				
				
			
				<li>
					<label>Horizontal Length</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
						<input id="rbt_temp_shadow_horizontal_length" name="rbt_temp_shadow_horizontal_length" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_shadow_horizontal_length; ?>" /> 
					</div>
				</div>
				</li>
				<li>
					<label>Vertical Length</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
						<input id="rbt_temp_shadow_vertical_length" name="rbt_temp_shadow_vertical_length" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_shadow_vertical_length; ?>" /> 
					</div>
				</div>
				</li>
				
				
				
			</ul>	
		</div>
		
		
		<div class="customized-optional">
			<div class="customizer_heading">Response Section style<i class="fa fa-angle-up coptional-open-close-btn" aria-hidden="true"></i></div>
			<ul class="templates-styles customized-optional-ul" style="display: none">
				<li>
					<label>Background Color </label>
					<div class="input-group ">
					  <div id="rbt_temp_error_background_color_div" class="input-group colorpicker-component colorpicker-element">
					  <input type="text" value="<?php echo $rbt_temp_error_background_color;?>" id="rbt_temp_error_background_color" name="rbt_temp_error_background_color" class="form-control"> 
					  <span class="input-group-addon">
						  <i></i>
					   </span>
					  </div>
					</div>
				</li>
				<li>
				<label>Width</label>
				<div class="input-group ">
					<div class="input-group colorpicker-component">
						<input id="rbt_temp_error_width" name="rbt_temp_error_width" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="300" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_error_width;?>" /> 
					</div>
				</div>
				</li>
				
				
				<li>
					<label>Border Width</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
							<input id="rbt_temp_error_border_width" name="rbt_temp_error_border_width" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_error_border_width;?>" /> 
							
						</div>
					</div>
				</li>
				
				<li>
					<label>Border Style </label>
					<div class="input-group ">
						<select class="input-group form-control" id="rbt_temp_error_style" name="rbt_temp_error_style">
						<?php 
						$rbt_temp_error_style_array = array('none'=>'None','solid'=>'Solid','dashed'=>'Dashed','dotted'=>'Dotted');

						foreach($rbt_temp_error_style_array as $key=>$value){
						$slected = '';
						if($key == $rbt_temp_error_style ){

						$slected = 'selected=selected';
						}
						echo "<option value='".$key."' $slected >$value</option>";
						}
						?>
							
							
						</select>
					</div>
			</li>
			<li>
				<label>Border Color </label>
				<div class="input-group ">
				  <div id="rbt_temp_error_border_color_div" class="input-group colorpicker-component">
				  <input type="text"  name="rbt_temp_error_border_color" value="<?php echo $rbt_temp_error_border_color;?>" id="rbt_temp_error_border_color" class="form-control" /> 
				  <span class="input-group-addon">
					  <i style="background-color:<?php echo $rbt_temp_error_border_radius;?>"></i>
				   </span>
				  </div>
				</div>
				</li>
				<li>
					<label>Border Radius</label>
					<div class="input-group ">
						<div class="input-group colorpicker-component">
						<input id="rbt_temp_error_border_radius" name="rbt_temp_error_border_radius" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $rbt_temp_error_border_radius; ?>" /> 
					</div>
				</div>
				</li>
			</ul>	
		</div>
									
						
			
		</div>	
		<div class="col-sm-6">
		<div class="template_html_outer template_html_wrapper_backend">
				<?php echo $form_html; ?>
		</div>
		</div>
		<div class="col-sm-3 drag_drop_elements_wrapper">
			<?php include_once('drag_drop_elements.php'); ?>
			<div class="rbt_template_customizers_outer customized-optional">
			   <div class="rbt_template_customizers_inner">
				   <div class="Template-Customize-Setting" >
			         <div class="showHideLeftSidebaroptions">
			            <div class="customizer_heading" >
			               Add Fields 
			               
			                  <i class="fa fa-angle-up coptional-open-close-btn" aria-hidden="true" ></i>
			               
			            </div>
			         </div>
			        <div class="rbt_addcustomfield_draggable_elements_wrapper rbt_customizers_innner_sections customized-optional-ul" style="display: none">
					  <?php 
						$data_fields_list = RBT_Fields::load();
						$fields_dragdrop_html = '';
						$fields_dragdrop_heading_html = '';
						if(isset($data_fields_list)){
							$fields_allow_array = array('textarea','text','email','number','radio','checkbox','file');
							foreach($data_fields_list as $data_field_info){
								
								$id = $data_field_info->getId();
								$date = $data_field_info->getDate();
								$field_name = $data_field_info->getName();
								$field_type = $data_field_info->getType();
								$field_value = $data_field_info->getValue();
								$field_label = $data_field_info->getLabel();
								if(!in_array($field_type, $fields_allow_array)){
									continue;
								}

								$field_placeholder = $data_field_info->getPlaceholder();
								$fields_dragdrop_heading_html .= '<div class="rbt_inner_section_side_bar rbt_addcustomfield_draggable_element_outer rbt_field_wrapper field_type_'.$field_type.'" data-type="add_custom_field" data-field-name="'.$field_name.'">
						  <span  class="draggableElement btn template_style element_btn ">'.$field_name.'</span>		
					   </div>';
					    $field_input_html  = '';
                        $field_is_required_class = ' ||||'.$field_name.'_class|||| ';
                        $field_is_required_msg = ' ||||error_'.$field_name.'_msg|||| ';

                        $edit_placeholder_class = ' rbt_field_change_placehoder ';
                        if($field_value != ''){
                        	 $edit_placeholder_class = '';

                        }

                       $extra_class = " rb_field_input_".$field_type."_class ";
					   if($field_type == 'textarea'){
					   	 $field_input_html  = '<textarea class="form-control  '.$extra_class.$edit_placeholder_class.' rbt_field '.$field_is_required_class.' " data-error-msg="'.$field_is_required_msg.'" name="'.$field_name.'" placeholder="'.$field_placeholder.'" >'.$field_value.'</textarea>';
					   }else if($field_type == 'text' || $field_type == 'email' || $field_type == 'file'){
					  	 $field_input_html  = '<input type="'.$field_type.'" class="form-control  '.$extra_class.$edit_placeholder_class.'  rbt_field '.$field_is_required_class.' " data-error-msg="'.$field_is_required_msg.'"  name="'.$field_name.'" placeholder="'.$field_placeholder.'" value="'.$field_value.'" >';
						}else if($field_type == 'radio' || $field_type == 'checkbox' ){
							 $field_input_html  = '<input value="'.$field_value.'" type="'.$field_type.'" class="form-control_rename   rbt_field '.$field_is_required_class.' " data-error-msg="'.$field_is_required_msg.'"  name="'.$field_name.'" placeholder="'.$field_placeholder.'" >';
						}else{
							continue;
						}


					 

					   if($field_type == 'file'){
					   	 $field_input_html  .= '<div class="rbt_field_file_html "></div>';
					   }
 					   $field_input_html  .= '<div class="rbt_field_error_msg_html "></div>';


					   $fields_dragdrop_html .= '<div data-action="add_custom_field" class="rbt_template_drag_drop_item_section_level_2  dragdrop_text_elements  rbt_custom_field_'.$field_name.' "  style="font-size:14px;font-weight:300;color:#333;" ><label class="rbt_tiny_mce_editor_disabled "">'.$field_label.'</label> '.$field_input_html.'</div>'; 
							}
						}else{

						}
						echo $fields_dragdrop_heading_html;
			 ?>
					   
					</div>
					<div style="display: none">
					<?php echo $fields_dragdrop_html ;?>
					</div>
				</div>
			</div>
		
			
		</div>





	</div>
	</div>
		<div class="row mt-4">
			
			<div class="col-sm-4">
				<span class="btn btn-primary" onclick="rbt_next_tab_show('rbt_tab_1')">Previous</span>
			</div>
			<div class="col-sm-4 text-center">
				<span class="btn btn-success " onclick="rbt_save_form_template(this,'rbt_tab_2')">Save</span>
			</div>
			<div class="col-sm-4 text-right">
				<span class="btn btn-info" onclick="rbt_save_form_template(this,'rbt_tab_2','rbt_tab_3')">Save & Next</span>
			</div>
			
		</div>
		
		
	  </div>
	  <div class="tab-pane fade" id="rbt_tab_3" role="tabpanel" aria-labelledby="rbt_tab_3_tab">
	  <div class="form-group form-group col-sm-4 ml-0 pl-0">
			<label for="contact_form_name">Select Email Template</label>
			
			<select name="email_template_id" class="form-control" id="email_template_id">
				<option value="0" >Select Template</option>
			<?php 
				if(isset($email_templates_list)){
					foreach($email_templates_list as $email_template_info){
						$email_selected = '';
						if($selected_email_temp == $email_template_info->getId()){
							$email_selected = 'selected';
						}
						echo "<option ".$email_selected." value='".$email_template_info->getId()."'>".$email_template_info->getTemplateName()."</option>";		
					}
				
				}

			?>
			</select>

	  </div>
	  <div class="shortcode_details_div"><?php echo $shortcode_details ; ?></div>
	  <div class="">
			
			<span class="btn btn-primary" onclick="rbt_next_tab_show('rbt_tab_2')">Previous</span>
			<span class="btn btn-primary" onclick="rbt_save_form_template(this,'')">Save</span>
			
		</div>
		
	  </div>
	</div>

</div>

<?php echo RBTCommonVariableHtmlAdmin(); ?>
