<?php 
$logs_html = RBT_Logs::loadHtml();

?>

<div class='log_outer_div'>
<textarea><?php echo $logs_html; ?></textarea>
<span class="btn btn-success" onclick="rbt_delete_all_logs()">Click to clear logs</span>
</div>
 
<style>
.log_outer_div {    padding-top: 31px;
    width: 700px;}
.log_outer_div textarea{
    width: 100%;
    
        min-height: 200px;
}
</style>


