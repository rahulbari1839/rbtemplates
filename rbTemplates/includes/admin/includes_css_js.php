<?php

add_action( "admin_enqueue_scripts", "RBTIncudesCssJs" );

function RBTIncudesCssJs(){	
	
	$current_version_plugin = rand(10,1000);	
	$include_js_css_on_page = array(
										"rbt_manage_form",
										"rbt_create_contact_shortcode",
										"rbt_create_login_shortcode",
										"rbt_add_fields",
										"rbt_logs",
										"rbt_users",
										"rbt_email_notification",
										"rbt_select_form_page",
										"rbt_create_gallery_shortcode",
										"rbt_create_registration_shortcode",
										"rbt_page_visit",
										"rbt_create_subscribe_shortcode",
										"rbt_create_slider_shortcode",
									);
	
	if(isset($_GET["page"]) && in_array($_GET["page"], $include_js_css_on_page)){
		
		//include fonts
		wp_enqueue_style( 'fonts.googleapis-family-Open-sans-css','//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800', false );
		wp_enqueue_style( 'font-awesome-latest-css','//use.fontawesome.com/releases/v5.3.1/css/all.css', false );
		wp_enqueue_style( 'font-awesome-css','//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false );

		//include css
		wp_enqueue_style( "rbt_bootstrap.min","//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css", false, "4.1.0" );
		
		wp_enqueue_style("rbt_admin_common",plugin_dir_url(__FILE__)."../assets/css/common.css", false, $current_version_plugin );
		
		//includes js
		wp_enqueue_script("rbt_jquery","//code.jquery.com/jquery-3.3.1.min.js", false, "3.3.1" );		
		wp_enqueue_script("rbt_popper","//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js", false, '1.16.0' );		
		//wp_enqueue_script("rbt_ui_jquery","//code.jquery.com/ui/1.12.1/jquery-ui.js", false, '1.16.0' );		
		wp_enqueue_script("rbt_bootstrap.min.js","//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js", false, "4.1.0" );	
		wp_enqueue_script("rbt_sweetalert2-min-js", "//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.16.0/sweetalert2.all.js", false, "7.16.0",true); 
		
		wp_enqueue_script("rbt_bootstrap_slider_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js", false, "10.0.2" );		
		wp_enqueue_style("rbt_bootstrap_slider_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css", false,'10.0.2' );
			
		wp_enqueue_script("rbt_bootstrap_colorpicker_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/js/bootstrap-colorpicker.min.js", false, "2.5.2" );	
		wp_enqueue_style("rbt_bootstrap_colorpicker_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/css/bootstrap-colorpicker.min.css", false,'2.5.2' );
		wp_enqueue_style("rbt_base_ui" , "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",  false, "1.12.1");


		$include_tinymce_js_on_page = array('rbt_create_contact_shortcode','rbt_email_notification','rbt_create_login_shortcode','rbt_create_gallery_shortcode','rbt_create_registration_shortcode','rbt_create_subscribe_shortcode','rbt_create_slider_shortcode');
		
		
		if(in_array($_GET['page'], $include_tinymce_js_on_page)){
			wp_enqueue_script("rbt_tinymce_min_js", plugin_dir_url(__FILE__)."../../../../../wp-includes/js/tinymce/tinymce.min.js", array("jquery"));
			wp_enqueue_script("rbt_tinymce_plugin_min_js",plugin_dir_url(__FILE__)."../assets/js/tinymce_plugin.min.js", array("jquery"));
			
	   }


		wp_enqueue_style("rbt_common_backend_frontend",plugin_dir_url(__FILE__)."../assets/css/common_backend_frontend.css", false, $current_version_plugin );
		wp_enqueue_style("common_backend_frontend_templates",plugin_dir_url(__FILE__)."../assets/css/common_backend_frontend_templates.css", false, $current_version_plugin );
		     
		
		
	   
	  

		 $include_drag_drop_css_js = array('rbt_create_contact_shortcode','rbt_create_login_shortcode','rbt_create_gallery_shortcode','rbt_create_registration_shortcode','rbt_create_subscribe_shortcode');
		if(in_array($_GET['page'], $include_drag_drop_css_js)){
				wp_enqueue_style("rbt_drag_drop",plugin_dir_url(__FILE__)."../assets/css/drag_drop.css", false, $current_version_plugin );
				 wp_enqueue_script("rbt_drag_drop_elements",plugin_dir_url(__FILE__)."../assets/js/drag_drop_elements.js", false, $current_version_plugin );
			}	
	   
        wp_enqueue_script("sqb_common",plugin_dir_url(__FILE__)."../assets/js/common.js", false, $current_version_plugin );
        
        $include_manage_table = array('rbt_manage_form','rbt_users','rbt_add_fields','rbt_email_notification','rbt_page_visit');
		if(in_array($_GET['page'], $include_manage_table)){
			 wp_enqueue_style("rbt_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false, "1.10.19");
			 wp_enqueue_script("rbt_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",  false, "1.10.19");
			 wp_enqueue_style("rbt_manage_form",plugin_dir_url(__FILE__)."../assets/css/table.css", false, $current_version_plugin );
			 wp_enqueue_script("rbt_manage_form",plugin_dir_url(__FILE__)."../assets/js/manage_tables.js", false, $current_version_plugin );
		}

		$include_form_create_js_common = array('rbt_email_notification');
		if(in_array($_GET['page'],$include_form_create_js_common)){
		wp_enqueue_script("rbt_add_common_js",plugin_dir_url(__FILE__)."../assets/js/form_create_common.js", array("jquery"));
		}
		  
        if($_GET['page'] == 'rbt_manage_form'){
			 
			 wp_enqueue_style("rbt_manage_form",plugin_dir_url(__FILE__)."../assets/css/table.css", false, $current_version_plugin );
			 wp_enqueue_script("rbt_manage_form",plugin_dir_url(__FILE__)."../assets/js/manage_tables.js", false, $current_version_plugin );
			 
		}else  if(in_array($_GET['page'],array('rbt_create_login_shortcode','rbt_create_contact_shortcode','rbt_create_gallery_shortcode','rbt_create_registration_shortcode','rbt_create_subscribe_shortcode'))){
			 
			 wp_enqueue_style("rbt_create_form_template",plugin_dir_url(__FILE__)."../assets/css/create_form_template.css", false, $current_version_plugin );
			 wp_enqueue_script("rbt_create_form_template",plugin_dir_url(__FILE__)."../assets/js/create_form_template.js", false, $current_version_plugin );
			
		
		}else  if($_GET['page'] == 'rbt_create_slider_shortcode'){
			
			 wp_enqueue_script("rbt_add_slider",plugin_dir_url(__FILE__)."../assets/js/add_slider.js", false, $current_version_plugin );
		}else  if($_GET['page'] == 'rbt_logs'){
			 wp_enqueue_script("rbt_logs",plugin_dir_url(__FILE__)."../assets/js/logs.js", false, $current_version_plugin );
		}else  if($_GET['page'] == 'rbt_add_fields'){
		
			 //wp_enqueue_style("rbt_add_student",plugin_dir_url(__FILE__)."../assets/css/add_contact_form.css", false, $current_version_plugin );
			 wp_enqueue_script("rbt_add_fields",plugin_dir_url(__FILE__)."../assets/js/add_fields.js", false, $current_version_plugin );
		
		}

	}
	
}
	
