var rbt_global_website_url = '';
var rbt_global_plugin_url = '';
var rbt_global_plugin_img_url = '';
jQuery(document).ready(function(){
	
	if(jQuery('.rbt_laoder_wrapper').length != 0){
		rbt_hide_loader();
	}
	jQuery(document).on('click','.rbt_modal_hide',function(){
      rbt_hide_modal();
     
	});
	jQuery(document).on('click','.rbt_field_onchage_hide_show_section',function(){
      	var hide_class = jQuery(this).attr('data-show-hide-class');
	    if(typeof hide_class !== undefined && hide_class != '' && jQuery('.'+hide_class).length != 0){
	     	jQuery('.'+hide_class).toggle();
		}
     
	});

	

	if(typeof jQuery('input[name="rbt_global_website_url"]').val() !== 'undefined' && typeof jQuery('input[name="rbt_website_url"]').val() !== undefined){
		rbt_global_website_url = jQuery('input[name="rbt_global_website_url"]').val();
		rbt_global_plugin_url = jQuery('input[name="rbt_global_plugin_url"]').val();
		rbt_global_plugin_img_url = jQuery('input[name="rbt_global_plugin_img_url"]').val();
	}

	// minimize customizer ul
	jQuery(document).on('click','.customizer_heading',function(){
		console.log('customizer_heading call')
		if(jQuery(this).find('.coptional-open-close-btn').length != 0){
			rbt_minimize_customizer(jQuery(this).find('.coptional-open-close-btn'));
		}
	});
	

	
});
 
 function rbt_minimize_customizer(obj){
 	var selector = jQuery(obj);
	if(selector.hasClass('fa-angle-down')){
		selector.removeClass('fa-angle-down').addClass('fa-angle-up');
		selector.closest('.customized-optional').find('.customized-optional-ul').hide('slow');
	}else if(selector.hasClass('fa-angle-up')){
		selector.removeClass('fa-angle-up').addClass('fa-angle-down');
		selector.closest('.customized-optional').find('.customized-optional-ul').show('slow');
	}
 }

function rbt_show_loader(){
	jQuery('.rbt_laoder_wrapper').show();
}

function rbt_hide_loader(){
	jQuery('.rbt_laoder_wrapper').hide();  
}


function rbt_datatable_call_by_table_id(table_id = '', order_by_row = 0){
	console.log("rbt_datatable_call_by_table_id call table_id: "+table_id)
	if(jQuery('#'+table_id).length != 0){
		jQuery('#'+table_id).DataTable({
			pageLength : 10,
			language: {
				search: "",
				searchPlaceholder: "Search..."
			},
			"fnInitComplete": function() {
				jQuery('#'+table_id).show();
			},
			 "order": [[order_by_row, "desc"]]
		});
	}
}




function rbt_tiny_mce_editor() {
	 tinymce.init({
        selector: '.rbt_tiny_mce_editor',
        inline: true,
        height: 500,
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        resize: "both",
        object_resizing: "img",
        forced_root_block: 'div',
        convert_urls: false,
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 30pt 35pt 40pt",
        font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Montserrat=Montserrat,sans-serif;Poppins=Poppins,sans-serif;Lato=Lato,sans-serif;Nunito=Nunito,sans-serif;Raleway=Raleway,sans-serif;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
		content_style:"@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');",
        //plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
       // toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
       // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
       plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor"
           ],
 toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
   toolbar2: 'print preview media | forecolor backcolor emoticons ',      
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
}

function rbt_swal_message(type = '',msg = '',title = ''){
	
	swal(title,msg,type);
}
 
 
function rbt_select_template_type_options(obj,tempplate_name = '',template_number = '',next_tab = ''){
	var currenct_obj = obj;
	jQuery(currenct_obj).closest('ul li').removeClass('rbt_selcted_temp');
	jQuery(currenct_obj).closest('li').addClass('rbt_selcted_temp');
	rbt_next_tab_show('rbt_tab_2');
}

function rbt_select_template(obj,tempplate_name = '',template_number = '',next_tab = ''){
	var currenct_obj = obj; 
	rbt_show_loader();
	jQuery.post(ajaxurl, {
	action: 'rbt_select_template_ajax',
	tempplate_name: tempplate_name,   
	template_number: template_number,   
	}, function(response) {
		rbt_hide_loader();
		response = JSON.parse(response);
		if(response.error){
			rbt_swal_message('',response.error,'');
			return false;
		}
		jQuery(currenct_obj).closest('ul li').removeClass('rbt_selcted_temp');
		jQuery(currenct_obj).closest('li').addClass('rbt_selcted_temp');
		if(response.html){
			var template_html = '<link rel="stylesheet"  href="'+response.css_file_path+'"><div class="template_html_wrapper">'+response.html+'</div>';
			jQuery('.template_html_outer').html(template_html);
			rbt_next_tab_show('rbt_tab_2');
			rbt_tiny_mce_editor();
			//set default values of color picker
			if(response.default_colorpicker_values){
				var data = response.default_colorpicker_values;
				
				for (var key in data) {
					if(jQuery('#'+key).length != 0){
						jQuery('#'+key).colorpicker('setValue',data[key]);
					}
				}
			}	
			
			if(response.default_numaric_values){
				var data = response.default_numaric_values;
				for (var key in data) {
					if(jQuery('#'+key).length != 0){
						jQuery('#'+key).bootstrapSlider('setValue',data[key]);
					}
				}
			}
			
			if(response.default_style_values){
				var data = response.default_style_values;	
				for (var key in data) {
					if(jQuery('#'+key).length != 0){
						jQuery('#'+key).val(data[key]);
					}
				}
			}
			rbt_template_drag_drop_element_customizer_init();
			rbt_template_drag_drop_element_customizer_level_2_init();
			rbt_img_resizeable();	
		}
	});
		
	
}
	
function rbt_next_tab_show(tab_id = ''){
	jQuery('html, body').animate({
		scrollTop: 0
	}, 100);
	console.log("tab_id "+tab_id);
	jQuery('#rbt_tabs  a[href="#'+tab_id+'"]').tab('show'); 
	
}	
	
function rbt_template_privew(img_url =''){
	body_html = '<img src="'+img_url+'">';
	rbt_show_modal('', body_html);
} 

function rbt_show_modal(header_html = '', body_html = ''){
	if(jQuery('.rbt_modal_outer').length != 0){
		jQuery('.rbt_modal_outer').addClass('rbt_modal_outer_active');
		var parent = jQuery('.rbt_modal_outer.rbt_modal_outer_active');
		parent.show();
		parent.find('.rbt_modal_header').html(header_html);
		parent.find('.rbt_modal_body').html(body_html);
		 jQuery('body').addClass('rbt_modal_active_body');
	}
}
function rbt_hide_modal(){
	if(jQuery('.rbt_modal_outer.rbt_modal_outer_active').length != 0){
		var parent = jQuery('.rbt_modal_outer.rbt_modal_outer_active');
		parent.hide();
		parent.find('.rbt_modal_header').html('');
		parent.find('.rbt_modal_body').html('');
		parent.removeClass('rbt_modal_outer_active');
		 jQuery('body').removeClass('rbt_modal_active_body');
	}
	
}




function rbt_copy_to_clipboard(obj) {
	jQuery(obj).text('Copied');
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy"); 
	document.body.removeChild(aux);
}

function rbt_change_placehoder(class_name = ''){
	
	if(class_name != ''){
		jQuery(document).on('focus','.'+class_name,function() {
				console.log('rbt_field_change_placehoder call: focus');
				var text = jQuery(this).attr('placeholder');
				jQuery(this).val(text);
		});
		jQuery(document).on('focusout','.'+class_name,function() {
				console.log('rbt_field_change_placehoder call: focusout ');
				jQuery(this).attr('placeholder',jQuery(this).val());
				jQuery(this).val('');
		});		
	}
}


function  rbt_img_resizeable(){	
	console.log("rbt_img_resizeable call: rbt_img_resizeable");
	jQuery(".rbt_img_resizeable_outer").resizable({		
		  aspectRatio: true, 
		resize: function(e, ui) {
			console.log('image resizable function is trigger')			 
			var img_wid = jQuery(this).css("width");			
			jQuery(this).find("img").css("width", img_wid);
			var img_height = jQuery(this).css("height");
			jQuery(this).find("img").css("height", img_height);			
		}
	});
}
function  rbt_video_resizeable(){	
	console.log("rbt_video_resizeable call");
	jQuery(".rbt_video_resizeable").resizable({		
		handles: "n, e, s, w",
		  aspectRatio: true,
		resize: function(e, ui) {			 
			jQuery(this).find("iframe").css("width", jQuery(this).css("width"));			
			jQuery(this).find("iframe").css("height", jQuery(this).css("height"));			
		}
	});
}

function rbt_mediauploader_image(img_resizeable_call = 'N'){
	
	jQuery(document).on('click','.rbt_change_img_icon',function() {
	   var current_obj = jQuery(this);
	   var rbt_mediauploader;
	   window.rbt_img_class = jQuery(current_obj).attr('data-class');	 
		if (rbt_mediauploader) {
			rbt_mediauploader.open();
			return;
		}
		rbt_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		rbt_mediauploader.on('select', function() {
			attachment = rbt_mediauploader.state().get('selection').first().toJSON();
			jQuery(current_obj).closest('.rbt_change_img_outer').find('.rbt_change_img').attr('src', attachment.url);
			console.log('img_resizeable_call'+img_resizeable_call)
			if(img_resizeable_call == 'Y'){
				rbt_img_resizeable();
			}
		});
		rbt_mediauploader.open();
		
	});
}


function rbtMediaUploaderImage(obj, prview_class = '', input_name = ''){
	
	   var current_obj = obj;
	   var rbt_mediauploader;
	   window.rbt_img_class = jQuery(current_obj).attr('data-class');	 
		if (rbt_mediauploader) {
			rbt_mediauploader.open();
			return;
		}
		rbt_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		rbt_mediauploader.on('select', function() {
			attachment = rbt_mediauploader.state().get('selection').first().toJSON();
			console.log(attachment);
			if(jQuery('.'+prview_class).length == 1){
				jQuery('.'+prview_class).html("<img src='"+attachment.url+"' >");
			}

			if(jQuery('input[name="'+input_name+'"]').length == 1){
				jQuery('input[name="'+input_name+'"]').val(attachment.id);
			}
				
		});
		rbt_mediauploader.open();		
	
}


function rbt_remove_unused_html_content(html = ''){
    var selctor = jQuery('.rbt_remove_unused_html_content');
	if(selctor.length != 0){
			selctor.html(html);
			selctor.find('.ui-resizable-handle').remove();
			selctor.find('.rbt_element_customizer_wrapper_list').remove();
			selctor.find('.ui-resizable-handle.ui-resizable-e').remove();
			selctor.find('.ui-resizable-handle.ui-resizable-se').remove();
			selctor.find('.ui-resizable-handle.ui-resizable-s').remove();	 
			html = selctor.html();
	}
	return html;
}



function rbt_form_validation(form_id = '', validation_show_type = ''){
	var validation_status = false;
	if(jQuery('#'+form_id).length == 1){
		jQuery('#'+form_id).find('.rbt_field_error_msg_html').remove();
		jQuery('#'+form_id).find('.rbt_field_required').each(function(){
			var value = jQuery(this).val();
			var field_error_type = jQuery(this).attr('data-error-type');
			if(field_error_type == "lenght"){
				var selected_anyoption = jQuery(this).find('.rbt_selcted_temp').length;
				
				if(selected_anyoption == 0){
					value = '';
				}else{
					value = 'has-value';
				}

			}else if(jQuery(this).hasClass('rbt_tinymce_textarea_editor')){

				var value = tinymce.get(jQuery(this).attr('id')).getContent();	

			}
			
			
			if(value == ''){
				
				validation_status = true;
				var msg = jQuery(this).attr('data-error-msg');
				if(validation_show_type == 'alert'){
					rbt_swal_message('',msg,'');
					return validation_status;

				}else{
					var msg_html = "<div class='rbt_field_error_msg_html'>"+msg+"</div>";
					jQuery(this).after(msg_html);
				}
			}


		});
	}
	return validation_status;


}

function rbt_form_reset(form_id = ''){
	
	if(jQuery('#'+form_id).length == 1){
		jQuery('#'+form_id).find('.rbt_field_error_msg_html').remove();
		jQuery('#'+form_id).find('.rbt_field').each(function(){
			jQuery(this).val('');
			if(jQuery(this).hasClass('rbt_field_edit_mode_readyonly')){
				jQuery(this).removeAttr('readonly');

			}
		});
	}

}




function rbt_call_ajax_data(obj = '',send_data = ''){
		if(send_data == ''){
			return false;
		}
		var output = false;
		rbt_show_loader();
		jQuery.ajax({
		url: ajaxurl,
		type: "POST",
		async: false,
		cache: false,
    timeout: 30000,
		data: {
			'action': 'rbt_call_ajax_data_admin',
			'data': send_data,
		},
		success: function (response) {
			rbt_hide_loader();
		
			response = JSON.parse(response);
			if(response.error){
				rbt_swal_message('error',response.error,'');
				return false;
			}

			output =  response;  
			console.log("+++++++");
			console.log(output);
			
		},
		error:function(response){
			rbt_swal_message('error',rbt_ajax_error);
			}
		
		});
	  return output;
}




function rbtValidateTabs(tab_class = ''){
			console.log("rbtValidateTabs call");
  
	if(jQuery('.nav-tabs.'+tab_class).length == 1){
		
		var parent_selecotr = jQuery('.nav-tabs.'+tab_class);

		parent_selecotr.find('li.nav-item').on('click','a', function (e) {
			var not_has_error = true;
		
			if(e.target == e.currentTarget) {
				
				var current_tab_id = jQuery(e.target).attr("href"); // activated tab
			}else {
				var current_tab_id = jQuery(this).parents('li').find('a').attr("href"); // activated tab
				
			}	
			
			current_tab_id = current_tab_id.replace(/^#/, '');
			
			if(jQuery("#"+current_tab_id).closest('.tab-content').length == 1	){
				jQuery("#"+current_tab_id).closest('.tab-content').find('.tab-pane').each(function(){
					tab_id = jQuery(this).attr('id');
					if(current_tab_id == tab_id){
						rbt_next_tab_show(current_tab_id);
						return false;
					}
					var validation_status_tab = rbt_form_validation(form_id = tab_id, validation_show_type = '');
					if(validation_status_tab){
						not_has_error = false;
						return false;
					}

				});
			}	
			return not_has_error;
			
		});

		/*parent_selecotr.find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = jQuery(e.target).attr("href") // activated tab
		  rbt_form_validation(form_id = '', validation_show_type = '')
		});*/
	}

}


function rbtGetAllInputValues(form_id = ''){
	var input_values = {};
	if(jQuery('#'+form_id).length == 1){
			jQuery('#'+form_id).find('.rbt_field').each(function(){
				var value = jQuery(this).val();
				var name = jQuery(this).attr('name');
				var type = jQuery(this).attr('type');
				if(type == 'file'){
					value = '';
				}else if(jQuery(this).hasClass('rbt_tinymce_textarea_editor')){

					var value = tinymce.get(jQuery(this).attr('id')).getContent();	
				}
				var value_info = {type:type,value:value};
				input_values[name] =  value_info;	
		});
	}
	return input_values;
}


function rbt_tinymce_textarea_editor() {
	tinymce.init({
         mode : "specific_textareas",
            editor_selector : "rbt_tinymce_textarea_editor",
            fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 20pt 24pt 30pt 36pt',
            font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",     
		   plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor"
           ],
 		toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
   		toolbar2: 'print preview media | forecolor backcolor emoticons ',      
		   
			relative_urls: false,
            remove_script_host: false,
            convert_urls:false,
            templates: [
			   { title: 'Test template 1', content: 'Test 1' },
			   { title: 'Test template 2', content: 'Test 2' }
			   ],
           setup : function(ed) {
                ed.on('init', function() {
                    jQuery(ed.getDoc()).contents().find('body').blur(function(){
                       
                    });  
                });
            }

        });
}

function rbtTinymceRemoveIds(html = ''){
	
	var selctor = jQuery('.rbt_remove_unused_html_content');
	if(selctor.length != 0){
		selctor.html(html);
		jQuery(selctor).find( "[id^='mce_']" ).each(function(){
			jQuery(this).removeAttr('id');
		});
		html = selctor.html();
	}
	return html;

}

function rbtTempDisplayType(obj) {
	if(jQuery(obj).val() == 'button_click'){
		jQuery('.temp_click_button_option_show_hide').show();
	}else{
		jQuery('.temp_click_button_option_show_hide').hide();
	}
}



function rbtChangeInputCustomizer(obj= '', class_name = '',css_property = '', type = '',extra = ''){

	if(obj != '' && jQuery(obj).length !=0){
		var change_val = jQuery(obj).val();
		console.log("rbtChangeInputCustomizer: "+change_val);
		console.log("type: "+type);
		console.log("extra: "+extra);
		console.log("css_property: "+css_property);
		if(type == 'range'){
			change_val = change_val+'px';
			jQuery('.'+jQuery(obj).attr('name')+'_dynamic_val').html(change_val);
			
		}

		if(css_property == 'height' && extra == 'padding'){

			jQuery('.'+class_name).css('padding-top',change_val);
			jQuery('.'+class_name).css('padding-bottom',change_val);

		}else{

			jQuery('.'+class_name).css(css_property,change_val).addClass(css_property);
		}

	}

}

