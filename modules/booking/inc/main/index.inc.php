<style type="text/css">
#memberaddress_wrapper {
    margin-top:15px;
}
#memberaddress_wrapper .memberaddress_list_box h2 {
	margin-bottom:0px;
}
#memberaddress_wrapper .memberaddress_list_box {
	margin-bottom:15px;
	border-bottom:1px dotted #e0e0e0;
	padding-bottom:15px;
}
#memberaddress_wrapper .memberaddress_date {
	color:#909090;
	margin-bottom:10px;
}
#memberaddress_wrapper .memberaddress_desc {
	margin-bottom:10px;
}
#memberaddress_wrapper .memberaddress_more {
	text-align:right;
}
</style>
<script type="text/javascript" src="<?php echo $data['config']['SITE_URL']; ?>/lib/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['config']['SITE_URL']; ?>/lib/chosen/chosen.css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){
	$(".chosen").chosen({ width: 'auto' });
	$(".chosen_full").chosen({ width: '100%' });
    $(".chosen_simple").chosen({
       width: 'auto',
       disable_search:true 
    });
	$(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
	
	$("#search_trigger").click(function() {
        if ($('#search_content').is(":visible")) {
            $("#search_content").hide('fast');
            $("#search_box").addClass('search_initial')            
        }
        else
        {
            $("#search_content").show('fast');
            $("#search_box").removeClass('search_initial')
        }
    });
});
</script>