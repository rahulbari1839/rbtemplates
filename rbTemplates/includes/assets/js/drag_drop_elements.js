
var rbt_drag_drop_element_customizer_all_options = jQuery('.rbt_drag_drop_element_customizer_all_options').html();
jQuery(document).ready(function(){
	rbt_drag_drop_events();
	rbt_drag_drop_element_open_customizer();
	rbt_template_innner_section_show_hide();
	//rbt_img_resizeable();
	rbt_video_resizeable();
	rbt_dragdrop_remove_elemnt_style_list();
});

function rbt_template_innner_section_show_hide(){
	
	jQuery(document).on('click','.template_style_inner_section_btn',function(){
		var show_class = jQuery(this).attr('data-id');
		console.log("show_class"+show_class);
		jQuery(this).closest('.customizer_innner_sections').find('.template_style_inner_section_div.'+show_class).toggle('slow');
		
	});
}

function rbt_drag_drop_events(){
		rbt_drag_drop_element_customizer_all_options = jQuery('.rbt_drag_drop_element_customizer_all_options').html();
		jQuery('.rbt_drag_drop_element_customizer_all_options').html('');
		jQuery(document).on('click','.rbt_item_close_element_cutomizer',function() {
			rbt_remove_element_customizer();
		});
		
		jQuery(document).on('click','.rbt_tiny_mce_editor',function() {
			jQuery(this).focus(); 
			
			if(jQuery(this).closest('.rbt_template_drag_drop_item_section_level_2').length !=0){
				jQuery(this).addClass('rbt_disable_drag_drop_item_level_2'); 
			}

			if(jQuery(this).closest('.rbt_template_enable_drag_drop_outer').length !=0){	
				jQuery(this).addClass('rbt_template_disable_drag_drop_item_section'); 
			}
		
		});
		jQuery(document).on('blur','.rbt_tiny_mce_editor',function() {

			if(jQuery(this).closest('.rbt_template_drag_drop_item_section_level_2').length !=0){
				jQuery(this).removeClass('rbt_disable_drag_drop_item_level_2'); 
			}

			if(jQuery(this).closest('.rbt_template_enable_drag_drop_outer').length !=0){
				jQuery(this).removeClass('rbt_template_disable_drag_drop_item_section'); 
			}

			 
			
		});
		
		jQuery(document).on('click','.rbt_item_close_element_cutomizer',function(e) {
			jQuery(this).closest('.Template-Customize-Setting').remove();
			jQuery('.rbt_template_drag_drop_item_section').removeClass('rbt_element_customizer_active'); 
				rbt_remove_element_customizer();
		});
}

function rbt_drag_drop_element_open_customizer(){
	// on click on element show customize 
	jQuery(document).on('click','.rbt_template_drag_drop_item_section',function(event){
		if(jQuery(this).hasClass('rbt_element_customizer_active')){
			
		}else{
			var obj = this;
			event.stopPropagation();
			var data_action = jQuery(obj).attr('data-type');
			rbt_template_edit_element(obj,data_action)
		}
	});
}

// for contact form
function rbt_template_drag_drop_element_customizer_level_2_init(){
	
	var rbt_template_enable_drag_drop = "rbt_template_enable_drag_drop_outer_level_2";
	var rbt_template_drag_drop_item = "rbt_template_drag_drop_item_section_level_2";
	jQuery( "."+rbt_template_enable_drag_drop).sortable({
				connectWith: "."+rbt_template_enable_drag_drop,
				//opacity: 0.5,
				cursor: "move",
				disabled: false,
				cancel: ".rbt_disable_drag_drop_item_level_2 ",
				classes: {"ui-state-default": rbt_template_drag_drop_item },
				placeholder: "element_drop_here",
                start: function (event, ui) {
					jQuery('.element_drop_here').text('Drop Element Here');
                     
                },stop: function(event, ui){
						
				},
				update: function () {
					
				}
						
	});
	rbt_enable_draggable_item_level_2(rbt_template_enable_drag_drop);
	
}


function rbt_enable_draggable_item_level_2(enable_draggable_class = ''){
	jQuery(".customized-optional  .rbt_addcustomfield_draggable_element_outer").draggable({
				disabled:false,
				connectToSortable: '.'+enable_draggable_class,
				helper: 'clone',
				revert: 'invalid',
	}); 
	rbt_enable_drag_drop_for_item(enable_draggable_class);
}

function rbt_template_drag_drop_element_customizer_init(){
	
	var rbt_template_enable_drag_drop = "rbt_template_enable_drag_drop_outer";
	var rbt_template_drag_drop_item = "rbt_template_drag_drop_item_section";
	jQuery( "."+rbt_template_enable_drag_drop).sortable({
				connectWith: "."+rbt_template_enable_drag_drop,
				//opacity: 0.5,
				cursor: "move",
				disabled: false,
				cancel: ".rbt_template_disable_drag_drop_item_section ",
				classes: {"ui-state-default": rbt_template_drag_drop_item },
				placeholder: "element_drop_here",
                start: function (event, ui) {
					jQuery('.element_drop_here').text('Drop Element Here');
                     
                },stop: function(event, ui){
						
				},
				update: function () {
					
				}
						
	});
	rbt_enable_draggable_item(rbt_template_enable_drag_drop);
	
}


function rbt_enable_draggable_item(enable_draggable_class = ''){
	jQuery(".rbt_draggable_elements_wrapper .rbt_draggable_element_outer").draggable({
				disabled:false,
				connectToSortable: '.'+enable_draggable_class,
				helper: 'clone',
				revert: 'invalid',
	}); 
	rbt_enable_drag_drop_for_item(enable_draggable_class);
}

	
function rbt_enable_drag_drop_for_item(enable_dragdrop_class = ''){
	
		jQuery("."+enable_dragdrop_class).droppable({
						out: function( event, ui ) {
							},
						over: function( event, ui ) {
							var data_type = jQuery(ui.helper).attr('data-type');
							if( data_type != 'undefined'){
								if(jQuery(ui.helper).hasClass('rbt_ui_helper_my_custom_droppable_start_element')){
									jQuery(ui.helper).addClass("rbt_ui_helper_my_custom_droppable_start_element");
								}
								console.log("class added rbt_ui_helper_my_custom_droppable_start_element");
							}
							//jQuery('').find('.element_drop_here_default').remove();
							
						},
						accept: function(dropElem) {
							return true;
							//dropElem was the dropped element, return true or false to accept/refuse it
						},
						drop: function( event, ui ) {
							
							
							jQuery(ui.helper).addClass("ui_helper_my_custom_element");
							jQuery(ui.helper).addClass("rbt_template_drag_drop_item_section"); 
							jQuery(ui.helper).removeClass("rbt_ui_helper_my_custom_droppable_start_element");
							console.log("class remove rbt_ui_helper_my_custom_droppable_start_element");
							console.log(jQuery(ui.helper).html());
							var data_type = jQuery(ui.helper).attr('data-type');
							console.log("data_type "+data_type);
							if( data_type != 'undefined' ){
								
								
								var rbt_template_dt = new Date();
								var rbt_template_dt_var = rbt_template_dt.getDate()+'_'+rbt_template_dt.getMonth()+'_'+rbt_template_dt.getDay()+'_'+rbt_template_dt.getHours()+'_'+rbt_template_dt.getMinutes()+'_'+rbt_template_dt.getSeconds()+'_'+rbt_template_dt.getYear();
									
							    
								var action_html  = '<div class="hover_close_btn"><i class="fa fa-edit element_edit" aria-hidden="true"></i><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';

								var action_only_delete  = '<div class="hover_close_btn"><i class="fa fa-close element_delete" aria-hidden="true"></i></div>';
								action_html = action_only_delete;

								var html = '';
							   if(data_type == 'product_info'){
									
								   
								   
							   }else if(data_type == 'heading'){
								  html = action_html+'<div data-action="heading" class="dragdrop_inner_section dragdrop_heading_elements"  style="font-size:17px;font-weight:700;color:#333; color: #0f2e47;font-size: 21px;font-weight: 600;font-family: DM Sans,sans-serif"><div class="rbt_tiny_mce_editor"><div style="text-align: left;">  Enter Heading... </div></div></div>';
								  
								  
							   }else if(data_type == 'subheading'){
								  html = action_html+'<div data-action="subheading" class="dragdrop_inner_section dragdrop_subheading_elements"  style="font-size:17px;font-weight:500;color:#333;"><div class="rbt_tiny_mce_editor"><div style="text-align: left;">  Enter Subheading Here...</div></div></div>';
								 
							   }else if(data_type == 'text'){
								  html = action_html+'<div data-action="text" class="dragdrop_inner_section dragdrop_text_elements "  style="font-size:14px;font-weight:300;color:#333;" > <div class="rbt_tiny_mce_editor"><div style="text-align: left;">Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document</div> </div></div>'; 
								  
							   }else if(data_type == 'add_shortcode'){
								  html = action_html+'<div data-action="text" class="dragdrop_inner_section dragdrop_text_elements "  style="font-size:14px;font-weight:300;color:#333;" > <div class="rbt_tiny_mce_editor"><div style="text-align: left;font-size: 15pt;">Enter Shortcode Here</div> </div></div>'; 
								  
							   }else if(data_type == 'image'){
									
									jQuery(ui.draggable).css('text-align','center');
									html = action_html+'<div class="dragdrop_inner_section dragdrop_image_elements dct_img_section rbt_change_img_outer rbt_img_resizeable_outer" data-action="image" ><img class="rbt_tiny_mce_editor_img rbt_change_img "  src="'+rbt_global_plugin_img_url+'/default_drag.jpg" width="100%"><span class="rbt_change_img_icon rbt_backend_show"><i class="fa fa-camera" aria-hidden="true"></i></span></div>';
									
								}else if(data_type == 'video'){
									jQuery(ui.draggable).css('text-align','center');
									
									html = action_html+'<div class="rbt_video_resizeable dragdrop_video_elements dragdrop_inner_section" data-action="video"><iframe width="727" height="409" src="http://rbtemplates.com/shortcode/contact-us-templates.mp4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
										
									
									 
								}else if(data_type == 'testimonial'){
									
									jQuery(ui.draggable).css('text-align','left');
									html = action_html+'<div data-action="testimonial" class="dragdrop_inner_section dragdrop_testimonial_elements dct_img_section rbt_change_img_outer"><div class="testimonial_outer_section"><div class="client_image rbt_img_resizeable_outer"> <img class="rbt_tiny_mce_editor_img rbt_change_img" src="'+rbt_global_plugin_img_url+'/default_user.png"><span class="rbt_change_img_icon rbt_backend_show"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="client_feed_bk"><div class="rbt_tiny_mce_editor"><h6 style="text-align: left;">Testimonial</h6></div><div class="rbt_tiny_mce_editor"><div style="text-align: left;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tristique faucibus libero. Duis id ex luctus, convallis libero non, ultrices tellus. Mauris consectetur condimentum neque, at maximus lectus sollicitudin eget.</div></div></div></div></div>';
									  
								}else  if(data_type == 'divider'){
									html = action_html+'<div data-action="divider"  class="dragdrop_divider_elements dragdrop_inner_section" style=" border: 0; border-top-width: 2px; border-style: dashed; border-color: #333;"></div>';
									
								}else if(data_type == 'bullet_points'){
									html = action_html+'<div data-action="bullet_points"  class="dragdrop_bullet_points dragdrop_inner_section" style="font-size:14px;font-weight:300;color:#333;"><ul class="rbt_tiny_mce_editor" ><li >Lorem ipsum is a placeholder text commonly used to demonstrate</li><li>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document</li><li>Lorem ipsum is a placeholder text commonly used to demonstrate</li><li>Lorem ipsum is a placeholder text commonly used</li></ul></div>';
									
								}else if(data_type == 'add_more_tick_text'){
									html = action_html+'<div class="dragdrop_add_more_tick_text dragdrop_inner_section" data-action="add_more_tick_text"> <div class="rbt_tiny_mce_editor" ><h3 style="text-align: left;">What You Get: </h3> </div><ul class="list-check-style"> <li ><div class="rbt_tiny_mce_editor"><div style="text-align: left;">Contrary to popular belief, Lorem Ipsum is not simply random</div></div><div class="rbt_remove_li_text rbt_backend_show"><i class="fa fa-close" aria-hidden="true"></i></div></li><li><div class="rbt_tiny_mce_editor"><div style="text-align: left;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum.</div></div><div class="rbt_remove_li_text rbt_backend_show"><i class="fa fa-close" aria-hidden="true"></i></div></li><li><div class="rbt_tiny_mce_editor"><div style="text-align: left;">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</div></div><div class="rbt_remove_li_text rbt_backend_show"><i class="fa fa-close" aria-hidden="true"></i></div></li><li><div class="rbt_tiny_mce_editor"><div style="text-align: left;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to</div></div><div class="rbt_remove_li_text rbt_backend_show"><i class="fa fa-close" aria-hidden="true"></i></div></li></ul> <div class="showin_backend rbt_backend_show"><div class="rbt_add_more_li_text"> <span onclick="rbt_add_more_elemnt_style_list(this)"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add more text</span></div></div></div>';
								}else if(data_type == 'add_button'){
									jQuery(ui.helper).addClass('drag_drop_add_button_element_outer');
									html = action_html+'<div class="dragdrop_add_button dragdrop_inner_section" data-action="add_button" ><a class="rbt_tiny_mce_editor dragdrop_add_button_anchor" href=""><div >Click to Redirect</div></a></div>';
								}else if(data_type == 'add_custom_field'){

									if(jQuery(ui.helper).closest('.rbt_template_enable_drag_drop_outer_level_2').length == 0){
										return false;
									}
									jQuery(ui.helper).addClass('drag_drop_add_custom_field_element_outer form-group rbt_template_drag_drop_item_section_level_2');
									var data_field_name = jQuery(ui.helper).attr('data-field-name');
                                  console.log(data_field_name);
                                   console.log(222222222222);
									if(jQuery('.rbt_template_drag_drop_item_section_level_2.rbt_custom_field_'+data_field_name).length != 0){
										 console.log(11111111111);
										var field_html = jQuery('.rbt_template_drag_drop_item_section_level_2.rbt_custom_field_'+data_field_name).html();
										field_html = field_html.replace("rbt_tiny_mce_editor_disabled ", "rbt_tiny_mce_editor");
										html = action_html+field_html;
										console.log(field_html);
									}
								}    
							  
							   if(html != ''){
								// open element customize option    
								jQuery(ui.draggable).css('background-color','inherit').html(html);
								if(data_type != 'add_custom_field'){
									rbt_template_edit_element(ui.draggable,data_type,'drag_drop');  
								}
							
								
								
									if(data_type == 'video'){ 

							   			rbt_video_resizeable(); 

							  	 	}else if(data_type == 'image'){

							    		rbt_img_resizeable(); 
							    	}

							   }

							  

								  rbt_tiny_mce_editor();
							   }
							}
				
					});
			
				
}

function rbt_template_edit_element(obj,data_action ,action_event = ''){
		  

		jQuery('.rbt_template_drag_drop_item_section').removeClass('rbt_element_customizer_active');
		if(data_action == 'add_custom_field'){
			data_action = '';
		} 

		if(1 || typeof data_action !== 'undefined'){
			/*if(jQuery(obj).hasClass('course_template_tabs')){
				jQuery('.rbt_drag_drop_element_customizer_wrapper_list').hide('show');
				return false;
			}*/
			
			if(jQuery(obj).closest('.rbt_template_drag_drop_item_section').length !=0){
				
				jQuery(obj).closest('.rbt_template_drag_drop_item_section').addClass('rbt_element_customizer_active');
				
			}else{
				
				jQuery(obj).addClass('rbt_element_customizer_active');
				
			}
		
			rbt_remove_element_customizer();
			jQuery('.rbt_element_customizer_active').after(rbt_drag_drop_element_customizer_all_options);
			rbt_template_element_customizer_init(); 
			jQuery('.rbt_element_customizer_wrapper_list .element_wrapper').hide();
			jQuery('.rbt_element_customizer_wrapper_list .element_'+data_action+'_wrapper').show();
				
			jQuery('.rbt_element_customizer_wrapper_list').show('show');
			rbt_prepopulate_drag_drop_elments_values(data_action);
			if(action_event == 'drag_drop'){
				setTimeout(function(){
					jQuery('.rbt_element_customizer_active').removeClass('rbt_element_customizer_active').trigger('click');
				}, 1000);
			}
		}else{
			jQuery('.rbt_element_customizer_wrapper_list').hide('show');
		}
}

function rbt_template_element_customizer_init(){
	var rb_element_customizer_active_class = '.rbt_element_customizer_active:visible';
	
	//Paadding customize start 
		jQuery('#rbt_item_element_padding_top').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('padding-top', +this.value + 'px');
		});
		jQuery('#rbt_item_element_padding_bottom').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('padding-bottom', +this.value + 'px');
		});
		jQuery('#rbt_item_element_padding_left').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('padding-left', +this.value + 'px');
		});
		jQuery('#rbt_item_element_padding_right').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('padding-right', +this.value + 'px');
		});
	 //Paadding customize end
	 
	 //Margin customize start 
		jQuery('#rbt_item_element_margin_top').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('margin-top', +this.value + 'px');
		});
		jQuery('#rbt_item_element_margin_bottom').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('margin-bottom', +this.value + 'px');
		});
		jQuery('#rbt_item_element_margin_left').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('margin-left', +this.value + 'px');
		});
		jQuery('#rbt_item_element_margin_right').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).css('margin-right', +this.value + 'px');
		});
	 //Margin customize end
	 
	 // Element alignments customize start
		jQuery('#rbt_item_element_alignment').on('change',function() {
			jQuery(rb_element_customizer_active_class).css('text-align', this.value);
		});
	// Element alignments customize end
	// Element background color customize start
		jQuery('#rbt_item_element_backgroud_color,#rbt_item_element_backgroud_color_div').colorpicker().on('changeColor', function() {
			jQuery(rb_element_customizer_active_class).css('background-color', jQuery(this).colorpicker('getValue'));
		});
	
	// Element background color customize end
	
	// divider customize start 	
		jQuery('#rbt_item_element_divider_br_style').change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_divider_elements').css('border-style', this.value);
		});
			
		jQuery('#rbt_item_element_divider_br_clr_div,#element_divider_br_clr').colorpicker().on('changeColor', function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_divider_elements').css('background-color', jQuery(this).colorpicker('getValue'));
		});
		
		jQuery('#rbt_item_element_divider_br_wid').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_divider_elements').css('border-top-width', +this.value + 'px');
		});
	// divider customize end
	
	//image customze start 
		//drag and drop upload image function call
		//	spc_drag_drop_mediauploader();
		
		/*jQuery('#rbt_item_element_image_width').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_image_elements img').css('width', +this.value + 'px');
		});*/
		
		/*jQuery('#rbt_item_element_image_height').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_image_elements img').css('height', +this.value + 'px');
		});*/
	
		/*jQuery('#element_image_width').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_image_elements img').css('width', +this.value + 'px');
		});*/
	
	//image customze end
	
	//Video customze start 
		/*jQuery('#rbt_item_element_video_height').bootstrapSlider().change(function() {
			var video_source = jQuery('#rbt_item_element_video_source').val();
			var video_type = '';
			if(video_source == "external_video"){
				video_type = 'video';
			}else{
				video_type = 'iframe';
			}
			
			jQuery(rb_element_customizer_active_class).find('.dragdrop_video_elements '+video_type).css('height', +this.value + 'px');
		});*/
		
	/*	jQuery('#rbt_item_element_video_width').bootstrapSlider().change(function() {
			var video_source = jQuery('#rbt_item_element_video_source').val();
			var video_type = '';
			if(video_source == "external_video"){
				video_type = 'video';
			}else{
				video_type = 'iframe';
			}
			jQuery(rb_element_customizer_active_class).find('.dragdrop_video_elements '+video_type).css('width', +this.value + 'px');
		});*/
		jQuery('#rbt_item_element_video_url').on('keyup',function(){
			
			var embed_code = jQuery(this).val();
			if(jQuery.trim(embed_code) != ''){
				var video_source = jQuery('#rbt_item_element_video_source').val();
				if(video_source  == "external_video"){
					embed_code  = "<video width='"+jQuery('#rbt_item_element_video_width').val()+"' height='"+jQuery('#rbt_item_element_video_height').val()+"' controls><source src="+embed_code+" type='video/mp4'></video>";
				}
				
				
				jQuery(rb_element_customizer_active_class).find('.dragdrop_video_elements').html(embed_code);
			}
		});
		
		jQuery('#rbt_item_element_video_source').on('change',function(){
			var parent_selector = jQuery('.element_video_wrapper.element_wrapper')
			if(jQuery(this).val() == "external_video"){
				parent_selector.find('.rbt_c_cutomzier_video_youtube').hide();
				parent_selector.find('.rbt_c_cutomzier_video_external').show();
			}else{
				parent_selector.find('.rbt_c_cutomzier_video_external').hide();
				parent_selector.find('.rbt_c_cutomzier_video_youtube').show();
			}
			
			
		});
		
		
	//Video customze end
	//add button customze end
	
		jQuery('#rbt_item_add_button_element_target').on('change',function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').attr('target',jQuery(this).val());
		});
	
		jQuery('#rbt_item_add_button_backgroud_color,#rbt_item_add_button_backgroud_color_div').colorpicker().on('changeColor', function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').css('background-color', jQuery(this).colorpicker('getValue'));
		});
		jQuery('#rbt_item_element_add_button_url').on('keyup',function(){
			
			var button_url = jQuery(this).val();
			
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').attr('href',button_url);
		});
		
		jQuery('#rbt_item_element_add_button_height').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').css('padding-top', +this.value + 'px');
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').css('padding-bottom', +this.value + 'px');
		});
		jQuery('#rbt_item_element_add_button_padding_lr').bootstrapSlider().change(function() {
			jQuery(rb_element_customizer_active_class).find('.dragdrop_add_button_anchor').css('width', +this.value + 'px');
			
		});
		
		
		
	//add button customze end
	
	
}


function rbt_prepopulate_drag_drop_elments_values(data_type){
		
	
	//for course template 
		var rbt_item_active_div = jQuery('.rbt_element_customizer_active:visible');
		
		//Paadding customize start 
			jQuery('#rbt_item_element_padding_top').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('padding-top')));
				
			jQuery('#rbt_item_element_padding_bottom').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('padding-bottom')));
			
			jQuery('#rbt_item_element_padding_left').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('padding-left')));
			jQuery('#rbt_item_element_padding_right').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('padding-right')));
		 //Paadding customize end
		 
		 //Margin customize start 
			jQuery('#rbt_item_element_margin_top').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('margin-top')));
			jQuery('#rbt_item_element_margin_bottom').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('margin-bottom')));
			jQuery('#rbt_item_element_margin_left').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('margin-left')));
			jQuery('#rbt_item_element_margin_right').bootstrapSlider('setValue',parseInt(rbt_item_active_div.css('margin-right')));
		 //Margin customize end
		
		// Element alignments customize start
			jQuery('#rbt_item_element_alignment').val(rbt_item_active_div.css('text-align'));
		// Element alignments customize end
		// Element background color customize start
			jQuery('#rbt_item_element_backgroud_color,#rbt_item_element_backgroud_color_div').colorpicker('setValue',rbt_item_active_div.css('background-color'));
		
		// Element background color customize end
		
		if(data_type == 'divider'){
		// divider customize start 	
			jQuery('#rbt_item_element_divider_br_style').val(rbt_item_active_div.find('.dragdrop_divider_elements').css('border-style'));
				
			jQuery('#rbt_item_element_divider_br_clr_div,#rbt_item_element_divider_br_clr').colorpicker('setValue',rbt_item_active_div.find('.dragdrop_divider_elements').css('background-color'));
			
			jQuery('#rbt_item_element_divider_br_wid').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_divider_elements').css('border-top-width')));

		// divider customize end
		}
		if(data_type == 'image'){
		//image customze start 
			//jQuery('#rbt_item_element_image_height').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_image_elements img').css('height')));
		
			//jQuery('#rbt_item_element_image_width').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_image_elements img').css('width')));
		
		//image customze end
		}
		if(data_type == 'video'){
		//Video customze start 
			
			//jQuery('#rbt_item_element_video_url').val(rbt_item_active_div.find('.dragdrop_video_elements iframe').attr('src'));
			
			var has_yourtube = rbt_item_active_div.find('.dragdrop_video_elements iframe').length; 
			var video_type = 'video';
			
			if(has_yourtube != 0){
				jQuery('#rbt_item_element_video_source').val('youtube');
			}else{
				jQuery('#rbt_item_element_video_source').val('external_video');
			}
			
		
			var parent_selector = jQuery('.element_video_wrapper.element_wrapper')
			var video_source = jQuery('#rbt_item_element_video_source').val();
			
			if(video_source == "external_video"){
				parent_selector.find('.rbt_c_cutomzier_video_youtube').hide();
				parent_selector.find('.rbt_c_cutomzier_video_external').show();
				 video_type = 'video';
			}else{
				parent_selector.find('.rbt_c_cutomzier_video_external').hide();
				parent_selector.find('.rbt_c_cutomzier_video_youtube').show();
				 video_type = 'iframe';
			}
            
            
            jQuery('#rbt_item_element_video_height').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_video_elements '+video_type).css('height')));
			
			jQuery('#rbt_item_element_video_width').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_video_elements '+video_type).css('width')));			
			
		//Video customze end
		}
		if(data_type == 'add_button'){
		//add button customze start 
		
			jQuery('#rbt_item_add_button_backgroud_color,#rbt_item_add_button_backgroud_color_div').colorpicker('setValue',rbt_item_active_div.find('.dragdrop_add_button_anchor').css('background-color'));
			
			jQuery('#rbt_item_element_add_button_padding_lr').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_add_button_anchor').css('width')));
			
			jQuery('#rbt_item_element_add_button_height').bootstrapSlider('setValue',parseInt(rbt_item_active_div.find('.dragdrop_add_button_anchor').css('padding-top')));
			
			
			var add_button_target_edit_mode = rbt_item_active_div.find('.dragdrop_add_button_anchor').attr('target');
			if(add_button_target_edit_mode != '_blank'){
				add_button_target_edit_mode = "_self";
			}
			jQuery('#rbt_item_add_button_element_target').val(add_button_target_edit_mode);
			jQuery('#rbt_item_element_add_button_url').val(rbt_item_active_div.find('.dragdrop_add_button_anchor').attr('href'));
			
		//Video button end
		}
		
	
	
}

function rbt_remove_element_customizer(){
	jQuery(document).find('.rbt_element_customizer_wrapper_list').remove();   
}

function rbt_drag_drop_element_delete(){
	jQuery(document).on('click','.element_delete',function(){
		var current_obj = this;
		console.log('test11222');
		swal({
		title: "Are you sure you want to delete ?",
		text: "You cannot recover the settings.",
		//type: "warning",
		showCancelButton: true,
		showCloseButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, Delete!",
		customClass: 'rbt_sweet_alert',
		
		}).then((isConfirm) => {
			console.log("isConfirm");
			console.log(isConfirm);
				if (isConfirm.value) {
				
				jQuery(current_obj).closest('.rbt_template_drag_drop_item_section').remove();
				jQuery('.rbt_template_drag_drop_item_section').removeClass('rbt_dragdrop_element_customizer_active');
				jQuery('.rbt_dragdrop_element_customizer_wrapper_list').hide('show');
			}
		});
		
	});	
}


function rbt_dragdrop_remove_elemnt_style_list(){

	jQuery(document).on('click','.rbt_remove_li_text',function(){
		var current_obj = this;
		swal({
			title: "Are you sure you want to delete ?",
			text: "You cannot recover the settings.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: 'rbt_sweet_alert',

		}).then((isConfirm) => {
			
				if (isConfirm.value) {
					 jQuery(current_obj).parent('li').remove();
				}
			});
	});

}

function rbt_add_more_elemnt_style_list(obj = ''){
	console.log("rbt_add_more_elemnt_style_list call");
	jQuery(obj).closest('.dragdrop_add_more_tick_text').find('ul.list-check-style').append('<li><div class="rbt_tiny_mce_editor "></div><div class="rbt_remove_li_text"><i class="fa fa-close" aria-hidden="true"></i></div></li>');
	rbt_tiny_mce_editor();	 
}



