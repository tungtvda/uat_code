<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.css" media="screen" />
<script type="text/javascript" src="<?php echo $data['config']['THEME_DIR']; ?>js/jquery/jquery.maskedinput.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#TransferFrom").change(function(){
	if($('#TransferFrom option:selected').text()=="Main Wallet"){
		$('.mainwallet').hide();
		$('.nonmainwallet').show();
		$('.mainwallet').prop('disabled', 'disabled');
		$('.nonmainwallet').prop('disabled', '');
	}
	if($('#TransferFrom option:selected').text()!="Main Wallet"){
		$('.mainwallet').show();
		$('.nonmainwallet').hide();
		$('.nonmainwallet').prop('disabled', 'disabled');
		$('.mainwallet').prop('disabled', '');
	}
	 });
	
  

		
	
	$(".chosen").chosen();
	$(".chosen_full").chosen({ width: '100%' });
    $(".chosen_simple").chosen({
       disable_search:true 
    });
	$(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
	$("#add_form").validationEngine();
    
    $(".mask_date").mask("?99-99-9999",{placeholder:" "});
    
});
</script>
<style>
th{
		color: #EFEFEF;	
}
td{
		color: #EFEFEF;	
}
label{
		color: #EFEFEF;
}
.table_pet {
	border-left:1px dashed #404040;
	border-top:1px dashed #404040;
}
.table_pet th, .table_pet td {
	border-bottom:1px dashed #404040;
	border-right:1px dashed #404040;
	padding:5px 12px;
}
.float-right{
	float: right;
}
</style>