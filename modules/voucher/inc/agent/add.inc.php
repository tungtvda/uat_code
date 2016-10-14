<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['config']['SITE_DIR']; ?>/lib/chosen/chosen.css" media="screen" />
<script type="text/javascript" src="<?php echo $data['config']['THEME_DIR']; ?>js/jquery/jquery.maskedinput.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="<?php $data['config']['SITE_DIR']; ?>/lib/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php $data['config']['SITE_DIR']; ?>/lib/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".chosen").chosen();
	$(".chosen_full").chosen({ width: '100%' });
    $(".chosen_simple").chosen({
       disable_search:true 
    });
	$(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#add_form").validationEngine({
        'custom_error_messages': {
            '#PasswordConfirm' : {
                'equals': {
                    'message': "* Passwords do not match"
                }
            }
        }   
    });
    
    $(".cpicker").ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val('#'+hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            var hexcode = this.value.replace("#","");
            
            if (hexcode.length==3) {
                var hexcode = hexcode.split("");
                hexcode = hexcode[0]+hexcode[0]+hexcode[1]+hexcode[1]+hexcode[2]+hexcode[2];
            }
            
            $(this).ColorPickerSetColor(hexcode);
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
    
    $(".mask_date").mask("?99-99-9999",{placeholder:" "});
    $(".mask_nric").mask("?999999-99-9999",{placeholder:" "});
    
    $('#Nationality').change(function() 
    {   
        var value = $(this).val();
        
        if (value=='151')
        {
            $('#nric_box').show('medium');
            $('#passport_box').hide();
        }
        else 
        {
            $('#nric_box').hide();
            $('#passport_box').show('medium');
        }
    });
});
</script>

<script type="text/javascript">
    //<![CDATA[
    $(function() {

        $('table.admin_table').each(function() {
            var currentPage = 0;
            var numPerPage = 20;
            var $table = $(this);
            $table.bind('repaginate', function() {
                $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
            });
            $table.trigger('repaginate');
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            var $pager = $('<div class="paginate"></div>');
            for (var page = 0; page < numPages; page++) {
                $('<a href="javascript:void(0)" class="page-number"></a>').text(page + 1).bind('click', {
                    newPage: page
                }, function(event) {
                    currentPage = event.data['newPage'];
                    $table.trigger('repaginate');
                    $(this).addClass('active').siblings().removeClass('active');
                }).appendTo($pager).addClass('clickable');
            }
            $pager.insertBefore($table).find('span.page-number:first').addClass('active');
        });


        jQuery("#search_trigger").click(function(){
            $('#search_content').slideToggle();
        });
        $("#search").on("keyup", function() {
            var value = $(this).val();
            value=value.toLowerCase();
            $("#myTable tr").each(function(index) {
                if (index !== 0) {

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                }
            });
            var rowCount = $('#myTable >tbody >tr:visible').length-1;
            $('#total_res').text(rowCount);
        });
        $("#search").change(function() {
            var value = $(this).val();
            value=value.toLowerCase();
            $("#myTable tr").each(function(index) {
                if (index !== 0) {

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                }
            });
            var rowCount = $('#myTable >tbody >tr:visible').length-1;
            $('#total_res').text(rowCount);
        });

    });

    //]]>
</script>
<style>
    .paginate a.active{
        border: 1px solid #ddd;
        font-weight: bold;
        background-color: #ddd;
    }
    .paginate a{

    }
</style>