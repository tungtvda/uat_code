<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){
	$("#edit_form").validationEngine();
        
        $(".chosen").chosen();
	$(".chosen_full").chosen({ width: '100%' });
    $(".chosen_simple").chosen({
       disable_search:true 
    });
        
        var error = 0;     
    $("input").click(function() {

             error++;

    });

    $("input").keydown(function() {

             error++;

    });

    $("input").keyup(function() {

             error++;

    });
    
    $('#NewPassword').change(function() 
    {        
        if ($('#NewPassword').is(':checked'))
        {
            $('#NewPasswordBox').show('medium');
        }
        else 
        {
            $('#NewPasswordBox').hide('medium');
        }
    });

        
});
</script>