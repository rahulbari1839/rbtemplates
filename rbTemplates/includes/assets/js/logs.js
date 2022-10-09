function rbt_delete_all_logs(){
	
	rbt_show_loader();
	jQuery.post(ajaxurl, {
		action: 'rbt_delete_all_logs_ajax',
		}, function(response) {
			rbt_hide_loader();
			response = JSON.parse(response);
			if(response.success){
				rbt_swal_message('',response.success,'');
				 location.reload();
				return false;
			}
		});
}


