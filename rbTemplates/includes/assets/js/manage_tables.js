jQuery(document).ready(function(){
	rbt_datatable_call_by_table_id('rbt_manage_table_id',2);
});

function rbt_delete_table_row(row_id = 0,action = ''){
		swal({
			title: "Are you sure you want to delete ?",
			text: "You cannot recover the settings.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: 'rbt_swal_custom_class',
			
		}).then((result) => {
			if (result.value) {
				var send_data = {'delete_id':row_id, 'type':'delete','action':action};
				var response = rbt_call_ajax_data('', send_data);
				if(response.table_html){
					jQuery('.rbt_manage_table_class').html(response.table_html);
					rbt_datatable_call_by_table_id('rbt_manage_table_id',2);
				}
				
				
		
			}
		});
			
}


function rbt_view_user_info_by_id(id = 0){
	var send_data = {'id':id, 'type':'view','action':'contact_user_view'};
	var response = rbt_call_ajax_data('', send_data);
	if(response.success){
		jQuery('.rbt_modal_outer_user_info').addClass('rbt_modal_outer_active');
		var body_html = response.html;
		var header_html = response.heading;
		rbt_show_modal(header_html, body_html);
	}
}
