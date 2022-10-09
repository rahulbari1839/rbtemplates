<div class="rbt_main_container">
	<?php include_once('common.php'); ?>
	<div class="rbt_header p-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="rbt_heading">
						<h3><i class="fa fa-sort"></i> Select form</h3>
					</div>
				</div>
				
			</div>
		</div>
	<div class="rbt_select_form_outer">
		<div class="row">
			<?php 
			$shortcode_list = array();
			$shortcode_list[] = array('title'=>'Contact Form', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_contact_shortcode');
			$shortcode_list[] = array('title'=>'Login Form', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_login_shortcode');
			$shortcode_list[] = array('title'=>'Gallery Page', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_gallery_shortcode');
			$shortcode_list[] = array('title'=>'User Registration Page', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_registration_shortcode');
			$shortcode_list[] = array('title'=>'Subscribe Form', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_subscribe_shortcode');

			$shortcode_list[] = array('title'=>'Slider', 'image_link' => 'assets/images/select-form.png', 'page_slug' => 'rbt_create_slider_shortcode');

			$html  = '';
			foreach ($shortcode_list as $key => $shortcode_info) {
				$img = plugin_dir_url(__FILE__)."../".$shortcode_info['image_link'];
				$title = $shortcode_info['title'];
				$link = admin_url('admin.php?page='.$shortcode_info['page_slug']);
				$html  .= '<div class="col-sm-3">
							<div class="card" >
						 	 	<img class="card-img-top" src="'.$img.'">
								<div class="card-body">
								    <h5 class="card-title">'.$title.'</h5>
								    <p class="card-text d-none"></p>
								    <a href="'.$link.'"  onclick="rbt_show_loader();"  class="btn btn-primary">Select</a>
							    </div>
							</div>
						</div>
						';
			}
			echo $html;
			?>
		
		
		
	</div>	
</div>	