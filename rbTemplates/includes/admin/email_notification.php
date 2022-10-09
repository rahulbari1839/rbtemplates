<div class="rbt_main_container">
	<?php include_once('common.php');

     $show_tab_1 = 'active';
     $show_tab_2 = '';
     $show_tab_1_content = 'show active';

    $tempalte_name = '';
	$from_name = '';
	$from_email = '';
	$subject = '';
	$body = '';
	$edit_id = 0;
	$type = '';
	$send_copy = 0;
	$is_edit_mode = null;
     if(isset($_GET['mode']) && ($_GET['mode'] == 'add')){
     	 $show_tab_1 = '';
     	 $show_tab_1_content = '';
     	 $show_tab_2 = 'active';
     	 $show_tab_2_content = 'show active';
 
		if(isset($_GET['id'])){
     	  $hasData = RBT_EmailNotificationTemplates::loadById($_GET['id']);
     	  if(isset($hasData )){
     	  		$is_edit_mode = true;
				$edit_id = $hasData->getId();
				$from_name = $hasData->getFromName();
				$from_email = $hasData->getFromEmail();
				$type = $hasData->getType();
				$send_copy = $hasData->getSendCopy();
				$subject = $hasData->getSubject();
				$body = $hasData->getBody();
				$tempalte_name = $hasData->getTemplateName();
				

     	  }
     	}
     }
	 ?>
	<ul class="nav nav-tabs" id="rbt_tabs" role="tablist">
	  <li class="nav-item" role="presentation">
		<a class="nav-link <?php echo $show_tab_1;?> " id="rbt_tab_1_tab"  href="<?php echo admin_url('admin.php?page=rbt_email_notification'); ?>"  onclick="rbt_show_loader();">Manage Fields</a>
	  </li>
	  <li class="nav-item" role="presentation">
		<a class="nav-link   <?php echo $show_tab_2;?>" id="rbt_tab_2_tab" href="<?php echo admin_url('admin.php?page=rbt_email_notification&mode=add'); ?>" onclick="rbt_show_loader();">Create New Fields</a>
	  </li>
	</ul>
	<div class="tab-content" id="rbTabContent">
	  	<div class="tab-pane fade  show <?php echo $show_tab_1_content;?> " id="rbt_tab_1" role="tabpanel" aria-labelledby="rbt_tab_1_tab">
	  		<div class="rbt_table_contant m-2 bg-light">
				<div class="rbt_header p-4">
					<div class="row">
						<div class="col-sm-6">
							<div class="rbt_heading">
								<h3><i class="fa fa-sort"></i> Manage Email Notification Templates</h3>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="<?php echo admin_url('admin.php?page=rbt_email_notification&mode=add'); ?>" class="rbt_create-btn btn float-right">
								Add New Email Notification
							</a>
						</div>
					</div>
				</div>
				<div class="rbt_manage_shortcode_form_table_id_wrapper rbt_manage_table_class p-4">
					<?php echo rbtGetManageEmailTemplatesHtml();?>
				</div>
			</div>
	  	
	 	 </div> 
		  <div class="tab-pane fade  <?php echo $show_tab_2_content;?>" id="rbt_tab_2" role="tabpanel" aria-labelledby="rbt_tab_2_tab">

		  	<div class="row   rbt_add_fields_outer_div" id="rbt_add_email_template_outer_div">
				<div class="col-sm-6">
				  	<input type="hidden" class="form-control  rbt_field " id="rbt_email_template_edit_id" name="rbt_email_template_edit_id"  value="<?php echo $edit_id;?>">
				  	<div class="form-group form-group col-sm-4 ml-0 pl-0">
						<label for="email_name">Contact Form Name</label>
						<input type="text" class="form-control  rbt_field rbt_field_required" data-error-msg="Please enter name." id="email_tmp_name" placeholder="Enter Name" value="<?php echo $tempalte_name;?>" name="email_tmp_name" >
					</div>
					<div class="form-group">
						<label for="rbt_field_type">Select type</label>
						<select class="form-control rbt_field rbt_field_required  " id="email_tmp_type" data-error-msg="Please select Email Type" name="email_tmp_type" <?php if(isset($is_edit_mode)){ echo 'readonly disabled';} ?> >
						  <option value="">select</option>
						  <option value="contact" <?php if($type == 'contact'){ echo 'selected';}?>>Contact-us</option>
						  <option value="registration" <?php if($type == 'registration'){ echo 'selected';}?>>User Registration</option>
						   <option value="subscribe" <?php if($type == 'subscribe'){ echo 'selected';}?>>User Subscribe</option>
						</select>
					</div>
					<div class="form-group">
						<label for="email_send_copy">Send Copy to admin</label>
						<select class="form-control rbt_field rbt_field_required  " id="email_send_copy" data-error-msg="Please select Email Type" name="email_send_copy">
						  <option value="0" <?php  if($send_copy == '0'){ echo 'selected';}?>>No</option>
						  <option value="1"  <?php if($send_copy == '1'){ echo 'selected';}?>>Yes</option>
						  
						</select>
					</div>
					<div class="form-group form-group col-sm-4 ml-0 pl-0">
						<label for="email_tmp_from_email">From Email</label>
						<input type="email" class="form-control  rbt_field rbt_field_required" data-error-msg="Please from emal." id="email_tmp_from_email" placeholder="Enter from email" value="<?php echo $from_email;?>" name="email_tmp_from_email" >
					</div>
					<div class="form-group form-group col-sm-4 ml-0 pl-0">
						<label for="email_tmp_from_name">From Name</label>
						<input type="text" class="form-control  rbt_field rbt_field_required" data-error-msg="Please enter name." id="email_tmp_from_name" placeholder="Enter from name" value="<?php echo $from_name;?>" name="email_tmp_from_name">
					</div>
					<div class="form-group form-group col-sm-4 ml-0 pl-0">
						<label for="email_tmp_subject">Subject</label>
						<input type="text" class="form-control  rbt_field rbt_field_required" data-error-msg="Please enter subject." id="email_tmp_subject" placeholder="Enter subject" value="<?php echo $subject;?>" name="email_tmp_subject" >
					</div>
					<div class="form-group form-group col-sm-12 ml-0 pl-0">
						<label for="email_tmp_from_name">Body</label>
						
						
						<textarea id="email_tmp_body" name="email_tmp_body" class="rbt_tinymce_textarea_editor form-control rbt_field rbt_field_required" data-error-msg="Please enter body." placeholder="Enter email body" style="height: 200px;"><?php echo $body;?></textarea> 
					</div>

					<div class="rbt_btn_actions">
						<a href="<?php echo admin_url('admin.php?page=rbt_email_notification'); ?>"  onclick="rbt_show_loader();" class="btn btn-secondary">Return to Manage Mail</a>
						<span class="btn btn-primary" onclick="rbt_add_emal_templates(this)">Save</span>
					</div>

				</div>
			</div>
		  </div>	
	  </div>	
</div>


