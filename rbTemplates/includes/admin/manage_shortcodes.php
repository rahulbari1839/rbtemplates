<div class="rbt_main_container">
	<?php include_once('common.php'); ?>
	<div class="rbt_table_contant m-2 bg-light">
		<div class="rbt_header p-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="rbt_heading">
						<h3><i class="fa fa-sort"></i> Manage Shortcode</h3>
					</div>
				</div>
				<div class="col-sm-6">
					<a href="<?php echo admin_url('admin.php?page=rbt_select_form_page'); ?>" class="rbt_create-btn btn float-right">
						Add new Shortcode
					</a>
				</div>
			</div>
		</div>
		<div class="rbt_manage_shortcode_form_table_id_wrapper rbt_manage_table_class p-4">
			<?php echo RBTGetManageFormTableHtml();?>
		</div>
	</div>
</div>
