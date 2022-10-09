
	<div class="rbt_main_container rbt_table_contant">
	<ul class="nav nav-tabs" id="rbt_tabs" role="tablist">
	  <li class="nav-item" role="presentation">
		<a class="nav-link active " id="rbt_tab_1_tab" data-toggle="tab" href="#rbt_tab_1" role="tab" aria-controls="rbt_tab_1" aria-selected="true">Manage Fields</a>
	  </li>
	  <li class="nav-item" role="presentation">
		<a class="nav-link   " id="rbt_tab_2_tab" data-toggle="tab" href="#rbt_tab_2" role="tab" aria-controls="rbt_tab_2" aria-selected="false" onclick="rbt_form_reset('rbt_add_fields_outer_div')">Create New Fields</a>
	  </li>
	</ul>
	<div class="tab-content" id="rbTabContent">
	  <div class="tab-pane fade  show active " id="rbt_tab_1" role="tabpanel" aria-labelledby="rbt_tab_1_tab">
	  	<div class="rbt_header p-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="rbt_heading">
						<h3><i class="fa fa-sort"></i> Manage Fields</h3>
					</div>
				</div>
				
			</div>
		</div>
		  <div class="rbt_manage_fields_table_id_wrapper">
			<?php echo RBTGetManageFieldTableHtml();?>
		  </div>
	  </div> 
	  <div class="tab-pane fade  " id="rbt_tab_2" role="tabpanel" aria-labelledby="rbt_tab_2_tab">
		  <div class="row   rbt_add_fields_outer_div" id="rbt_add_fields_outer_div">
			<div class="col-sm-6">
		
		  
		  <div class="form-group">
			<label for="rbt_field_name">Name</label>
			<input type="hidden" class="form-control rbt_field" id="rbt_field_edit_id" vaule=""  >
			<input type="text" class="form-control rbt_field_required rbt_field rbt_field_edit_mode_readyonly"  data-error-msg="Please enter field name"  id="rbt_field_name"  placeholder="Enter name">
		  </div>
		  
		  <div class="form-group">
			<label for="rbt_field_name">Default Value</label>
			<input type="text" class="form-control rbt_field" id="rbt_field_default_value"  placeholder="Enter value">
		  </div>
		  
		  <div class="form-group">
			<label for="rbt_field_type">Select type</label>
			<select class="form-control rbt_field rbt_field_required rbt_field_edit_mode_readyonly " id="rbt_field_type" data-error-msg="Please select field type" >
			  <option value=''>select</option>
			  <option value='email'>Email</option>
			  <option value='text'>Text</option>
			  <option value='textarea'>Textarea</option>
			  <option value='radio'>Radio</option>
			  <option value='checkbox'>Checkbox</option>
			  <option value='number'>Number</option>
			   <option value='file'>Image</option>
			   <option value='password'>Password</option>
			</select>

		  </div>
		  <div class="form-group">
			<label for="rbt_field_label">Label Name</label>
			<input type="text" class="form-control rbt_field" id="rbt_field_label" placeholder="Enter label">
		  </div>
		   <div class="form-group">
			<label for="rbt_field_placeholder">Placeholder</label>
			<input type="text" class="form-control rbt_field" id="rbt_field_placeholder" placeholder="Enter placeholder">
		  </div>
		  <div class="form-group">
			<label for="rbt_field_is_required">Is Required?</label>
			<input type="checkbox" class="form-control rbt_field" onclick="rbtFieldRequiredClick(this)" id="rbt_field_is_required" >
		  </div>
		   <div class="form-group rbt_field_required_msg_wrapper" style="display:none" >
			<label for="rbt_field_required_msg">Required Message</label>
			<input type="text" class="form-control rbt_field rbt_field_required" id="rbt_field_required_msg" data-error-msg="Please enter msg" >
		  </div>
		  <div class="btn btn-primary" onclick="rbt_add_field(this)">Click to create</div>
		
	      </div>
	      </div>
	  </div>
		 
	</div>	  

