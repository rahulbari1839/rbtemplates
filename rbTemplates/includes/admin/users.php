<div class="rbt_main_container">
	<?php include_once('common.php'); 
	echo RBTModalHtmlAdmin('rbt_modal_outer_user_info rbt_modal_side_popup');
	?>
	<div class="rbt_table_contant m-2 bg-light">
		<div class="rbt_header p-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="rbt_heading">
						<h3><i class="fa fa-sort"></i> Manage Users</h3>
					</div>
				</div>
				
			</div>
		</div>
		<div class="rbt_manage_shortcode_form_table_id_wrapper rbt_manage_table_class p-4">
			<?php echo RBTGetManageUserTableHtml();	?>
		</div>
	</div>
</div>
