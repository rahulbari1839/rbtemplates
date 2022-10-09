<?php 

$form_name = '';
$form_html = '';
$customizer_values = '';
$template_no = '';
$form_edit_id = '';
$shortcode_details = '';
$form_edit_mode = false;
$template_type = 'slider';

$email_templates_list = RBT_EmailNotificationTemplates::loadByType($template_type);
$email_templates_list = null;
$selected_email_temp = 0;
$slider_items_details_html = '';
$image_per_screen = 1;
if(isset($_GET['id'])){
	$RBT_DataHas = RBT_Form::loadById($_GET['id']);
	if(isset($RBT_DataHas)){
		$form_edit_mode = true;
		$form_edit_id = $_GET['id'];
		$form_name = $RBT_DataHas->getName();
		
		$template_no = $RBT_DataHas->getTemplateNo();
		$shortcode_details  = RBTGetShortcodeNameByIdAndType($form_edit_id,$template_type);
		$shortcode_details  = '<div class="rbt_shortcode_details"><span class="shortcode_details">Here is your Shortcode:</span><p><span class="shortcode_display" id="dynamic_copyable_text_rbt_'.$form_edit_id.'">'.$shortcode_details.'</span><span data-id="dynamic_copyable_text_rbt_'.$form_edit_id.'" class="copy-btn " onclick="rbt_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p></div>';
		$form_html = $RBT_DataHas->getHtml();
		$form_html = stripslashes($form_html);
		
		$customizer_values = $RBT_DataHas->getCustomizerValues();
		
		$customizer_values_array = explode('||||',$customizer_values);

		if(isset($customizer_values_array[0])){
			$image_per_screen = $customizer_values_array[0]; 
		}


		
		if($form_html != ''){
			$slider_items_array = explode('||||||',$form_html);
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
					$slider_img_details = wp_get_attachment_image_src($slider_img_id);
					$slider_img_url = '';
					if($slider_img_details && is_array($slider_img_details) && isset($slider_img_details[0])){
						$slider_img_url = $slider_img_details[0];
					}

					$slider_item_details = array();
					$slider_item_details['slider_img_url'] = $slider_img_url;
					$slider_item_details['slider_img_id'] = $slider_img_id;
					$slider_item_details['heading_checked'] = $heading_checked;
					$slider_item_details['heading_text_html'] = $heading_text_html;
					$slider_item_details['description_checked'] = $description_checked;
					$slider_item_details['description_text_html'] = $description_text_html;

					$slider_item_details_html_arr =  rbtLoadSliderItemHtml($slider_item_details);
					
					if(is_array($slider_item_details_html_arr) && isset($slider_item_details_html_arr['html'])){
						$slider_items_details_html .= $slider_item_details_html_arr['html'];
					}
				}

			}
		}



		
	}
}
?>


<div class="rbt_main_container rbt-slider-body-admin">
	<?php include_once('common.php');
	echo RBTModalHtmlAdmin('rbt_modal_outer_img_preview rbt_modal_right_side');
	
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
	<div class="tab-content p-4  " id="rbTabContent">
	  <div class="tab-pane fade  <?php if(!$form_edit_mode){ echo ' show active ';} ?>" id="rbt_tab_1" role="tabpanel" aria-labelledby="rbt_tab_1_tab">
		<input type="hidden" class="form-control" id="rbt_form_edit_id" value="<?php echo $form_edit_id;?>">
		 <input type="hidden" class="form-control" id="template_type" value="<?php echo $template_type;?>">
		 <div class="form-group form-group col-sm-4 ml-0 pl-0">
			<label for="rbt_form_name"><?php echo ucfirst($template_type); ?>  Name</label>
			<input type="text" class="form-control rbt_field_required" data-error-msg="Please enter name." id="rbt_form_name" placeholder="Enter Name" value="<?php echo $form_name;?>">
		  </div>

		   <div class="form-group form-group col-sm-4 ml-0 pl-0">
			<label for="rbt_form_name">Select Image per screen</label>
			<select name="rbt_image_per_screen" id="rbt_image_per_screen" class="form-control">
				<?php 
				$rbt_image_per_screen_html = '';
				for($rbt_i = 1; $rbt_i <= 10; $rbt_i++ ){
					$slected_option = '';
					if($image_per_screen == $rbt_i){
						$slected_option = 'selected';	
					}
					$rbt_image_per_screen_html .= '<option '.$slected_option.' value="'.$rbt_i.'">'.$rbt_i.'</option>';
				}
				echo $rbt_image_per_screen_html;
				?>
				
				
			</select>
			
		  </div>
		  
		  
		  <div class="form-group">
			<label ><h5>Select Template</h5></label>
			  
			  <ul class="rbt_templates_list  rbt_field_required" data-error-type="lenght" data-error-class="rbt_selcted_temp" data-error-class data-error-msg="Please select a template" >
				  <li  data-temp="template1" class="rbt_select_temp <?php if($template_no == 'template1'){ echo 'rbt_selcted_temp'; }?>">
					<h6 class="text-center">Template 1</h6>
				<div>
					<label class="rbt_select_img rbt_overlay_outer">
					<img class="img_prev" src="<?php echo plugin_dir_url(__FILE__)."../templates/".$template_type."/template1/preview.jpg?".rand(10,100);?>">
					<div class="rbt_overlay_inner"></div>
					<div class="rbt_select_btn">
					<span class="btn btn-primary" onclick="rbt_template_privew('<?php echo plugin_dir_url(__FILE__)."../templates/".$template_type."/template1/preview.jpg?".rand(10,100);?>')">Preview</span>
					<span class="btn btn-success" onclick="rbt_select_template_type_options(this,'<?php echo $template_type;?>','template1')">Select
					</span>

					</div>
					</label>
				</div>
				</li>

				

			</ul>
			
			
		  </div>
	  
		<div class="">
			<a  href="<?php echo admin_url('admin.php?page=rbt_manage_form'); ?>"  onclick="rbt_show_loader();" class="btn btn-secondary">Return to Manage Shortcodes</a>
			
			<span class="btn btn-primary" onclick="rbtSaveSliderSortcode(this,'rbt_tab_1')">Save</span>
			<span class="btn btn-info" onclick="rbtSaveSliderSortcode(this,'rbt_tab_1','rbt_tab_2')">Save & Next</span>
		</div>
	  
	  </div>
	  <div class="tab-pane fade <?php if($form_edit_mode){ echo ' show active ';} ?>" id="rbt_tab_2" role="tabpanel" aria-labelledby="rbt_tab_2_tab">
	  
	 	 	<div class="row">
				<div class="col-sm-12">
					<div class="template_html_outer template_html_wrapper_backend">
						<?php echo $slider_items_details_html; ?>
					</div>
						
							<?php 
							
							$no_slider_div_html = '<div class="empty-item-section-outer rbt_center_div"><div class="empty-item-section">
													<img src="'.plugin_dir_url(__FILE__).'../../includes/assets/images/add-item.png" alt="icon">
													<!--h3>You currently don\'t have any slider.</h3-->
													<p></p>
													<!--p> Please click on the button to create an slider.</p-->
													<a href="javascript:void(0)" onclick="rbtAddSliderButtonTrigger(this)" ><i class="fa fa-plus-circle" aria-hidden="true"></i>Add A New Slider</a>
												</div></div>';
							echo $no_slider_div_html;					


							?>

					
				</div>
			</div>
		
			<div class="row mt-4">
				
				<div class="col-sm-4">
					<span class="btn btn-primary" onclick="rbt_next_tab_show('rbt_tab_1')">Previous</span>
				</div>
				<div class="col-sm-4 text-center">
					<span class="btn btn-success " onclick="rbtSaveSliderSortcode(this,'rbt_tab_2')">Save</span>
				</div>
				<div class="col-sm-4 text-right">
					<span class="btn btn-info" onclick="rbtSaveSliderSortcode(this,'rbt_tab_2','rbt_tab_3')">Save & Next</span>
				</div>
				
			</div>
		
		
	  </div>
	  <div class="tab-pane fade" id="rbt_tab_3" role="tabpanel" aria-labelledby="rbt_tab_3_tab">
	  
	  <div class="shortcode_details_div"><?php echo $shortcode_details ; ?></div>
	  <div class="">
			
			<span class="btn btn-primary" onclick="rbt_next_tab_show('rbt_tab_2')">Previous</span>
			<span class="btn btn-primary" onclick="rbtSaveSliderSortcode(this,'')">Save</span>
			
		</div>
		
	  </div>
	</div>

</div>

<?php echo RBTCommonVariableHtmlAdmin(); ?>
