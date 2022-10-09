function RBTShowLoader(){
	jQuery('.rbt_laoder_wrapper:first').show();
}

function RBTHideLoader(){
	jQuery('.rbt_laoder_wrapper:first').hide();
}

var rbt_ajax_error = "something Wrong !";
var rtb_image_base64_url = '';
jQuery('document').ready(function(){
	RBTHideLoader();
	jQuery('.rbt_frontend_outer_div').show();
	rbt_ajax_error = jQuery('input[name="rbt_ajax_error"').val();

	//call slider
	if(jQuery('.rbt_slider_items_owl_carousel').length != 0){
			jQuery('.rbt_slider_items_owl_carousel').each(function(){
				rbtOwlCarousel(jQuery(this).attr('id'));
			});
	}

});



function RBTEmailValidation(email) {
  //var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return emailReg.test( email );
}


function rbt_swal_message(type = '', msg = '', title= ''){
	if(msg != ''){
			alert(msg);
	}

}

function rbt_call_ajax_data(obj = '',send_data = ''){
		if(send_data == ''){
			return false;
		}
		var output = false;
		var  rbt_ajax_url = jQuery('input[name="rbt_ajax_url"]').val();
		var  rbt_ajax_token = jQuery('input[name="rbt_ajax_token"]:last').val();
		RBTShowLoader();
		jQuery.ajax({
		url: rbt_ajax_url,
		type: "POST",
		async: false,
		cache: false,
    timeout: 30000,
		data: {
			'action': 'rbt_call_ajax_data_fe',
			'token': rbt_ajax_token,
			'fields': send_data,
		},
		success: function (response) {
			RBTHideLoader();
		
			response = JSON.parse(response);
			if(response.error){
				//rbt_swal_message('error',response.error,'');
				//return false;
			}

			output =  response;  
			//console.log("+++++++");
		//	console.log(output);
			
		},
		error:function(response){
			rbt_swal_message('error',rbt_ajax_error);
			}
		
		});
	  return output;
}




function rbt_form_validation(form_id = '', validation_show_type = ''){
	
	var validation_status = false;
	if(jQuery('#'+form_id).length == 1){
		jQuery('#'+form_id).find('.rbt_field_error_msg_html').html('').hide();
		jQuery('#'+form_id).find('.rbt_field_required').each(function(){
			var type = jQuery(this).attr('type');
			var value = '';
			if(type == 'text' || type == 'number' || type == 'password' ){
				 value = jQuery(this).val();
			}else if(type == 'email'){
					 value = jQuery(this).val();
					 if(!RBTEmailValidation(value)){
					 	value = '';
					 }
			}else if(type == 'checkbox' || type == 'radio'){
				var is_checked = jQuery(this).prop('checked');
				if(is_checked){
					value = 'Y';
				}
			}else if($(this).is("textarea")){
				 value = jQuery(this).val();
				
			}else if(type == 'file'){
				 value = jQuery(this).val();
			}

			
			//console.log("type: "+type);
			//console.log("value: "+value);
			
			if(value == ''){
			//	console.log('hello');
				var field_error_msg = jQuery(this).attr('data-error-msg');
				validation_status = true;
				var msg_html = "<div class='rbt_field_error_msg'>"+field_error_msg+"</div>";
				jQuery(this).closest('.rbt_field_wrapper').find('.rbt_field_error_msg_html').html(msg_html).show();
			}
		});
	}
	return validation_status;


}


function RBTUploadfileShow(obj = '',show_image_class = ''){
	var image_selector = jQuery(obj);
	if(image_selector.length == 1){
		//console.log("stfUploadfileShow 1111111");
			jQuery(obj).closest('.rbt_field_wrapper').find('.rbt_field_file_html').html('').hide();
			var validation_status = false;
			var 	image  = image_selector.get(0).files;
			if (image && image[0]) {
					var image_url_base64 = window.URL.createObjectURL(image[0]);
					//console.log(image_url_base64);
					var extension = image_selector.val().replace(/^.*\./, '');
					//console.log(extension);
					if(!(/\.(png|jpg|jpeg)$/i).test(image_selector.val())) {              
    					rbt_swal_message('error','PNG and JPEG files allowed');     
    					image_selector.val('');  
    			    validation_status = true;
					}else{
						var file = obj.files[0];  
				    var reader = new FileReader(); 
				      reader.readAsDataURL(obj.files[0]);
				 
				    reader.onload = function() {  
				        rtb_image_base64_url = reader.result;  
				        //console.log("imagebase64");
				    }  
						//console.log("image_url_base64");
						//console.log(image_url_base64);
						
						var html = '<img src='+image_url_base64+'>';
							jQuery(obj).closest('.rbt_field_wrapper').find('.rbt_field_file_html').html(html).show();
					}
			}

		return validation_status;

	}

}


function rbtOwlCarousel(owl_carousel_id = ''){
		if(jQuery('#'+owl_carousel_id).length != 0){
			 var items_in_sreen = jQuery('#'+owl_carousel_id).attr('items_in_sreen');
				jQuery('#'+owl_carousel_id).owlCarousel({
			    loop:true,
			    margin:10,
			    responsiveClass:true,
			    responsive:{
			        0:{
			            items:1,
			            nav:true
			        },
			        600:{
			            items:items_in_sreen,
			            nav:false
			        },
			        1000:{
			            items:items_in_sreen,
			            nav:true,
			            loop:false
			        }
			    }
				});


		}
}

