<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.css" media="screen" />
<script type="text/javascript" src="<?php echo $data['config']['THEME_DIR']; ?>js/jquery/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo $data['config']['THEME_DIR']; ?>js/jquery/jquery-ui-timepicker-addon.js"></script>
<link href="<?php echo $data['config']['THEME_DIR']; ?>css/timepicker-addon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
    
    $("#TransferFrom").change(function(){
	if($('#TransferFrom option:selected').val()=="30"){
		$('.mainwallet').hide();
		$('.nonmainwallet').show();
		$('.mainwallet').prop('disabled', 'disabled');
		$('.nonmainwallet').prop('disabled', '');
	}
	else { //if($('#TransferFrom option:selected').text()!="Main Wallet"){
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
    $("#add_form").validationEngine();

	 $(".datepicker").datetimepicker({
		dateFormat: 'dd-mm-yy',
		timeFormat: 'HH:mm:ss',
		controlType: 'select',
		showSecond: true
	});



    $(".mask_date").mask("?99-99-9999 99:99:99",{placeholder:" "});

});
</script>