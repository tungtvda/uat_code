<?php
function familyTree($array)
	{


                if(is_array($array)===TRUE)
                {


                      for ($index = 0; $index < $array['count']; $index++) {



                            $data= '<option style="padding-left:'.$array[$index]['Padding'].'px;" value="'. $array[$index]['ID'].'" '.$selected.'>'.$array[$index]['Name'].' - '. $array[$index]['ID'].' | '. $array[$index]['Company'].'</option>';

                            echo $data;


                           familyTree($array[$index]['Child']);
                      }


                }

        }

?>
<?php if ($data['page']['member_add']['error']['count']>0) { ?>
    <div class="error">
        <ul>
            <?php if ($data['page']['member_add']['error']['Username']==1) { ?><li>The username "<?php echo $data['form_param']['Username']; ?>" is taken. Please try again with another username.</li><?php } ?>
            <?php if ($data['page']['member_add']['error']['NRIC']==1) { ?><li>The NRIC number <?php echo $data['form_param']['NRIC']; ?> exists in the database. Each member can only register once. Please try again with another NRIC number.</li><?php } ?>
            <?php if ($data['page']['member_add']['error']['Passport']==1) { ?><li>The Passport number <?php echo $data['form_param']['Passport']; ?> exists in the database. Each member can only register once. Please try again with another Passport number.</li><?php } ?>
            <?php if ($data['page']['member_add']['error']['Bank']==1) { ?><li>The Bank <?php echo $data['form_param']['Bank']; ?> exists in the database. Please try again with another username.</li><?php } ?>
        </ul>
    </div>
<?php } ?>
<form name="add_form" class="admin_table_noMobile" id="add_form" action="<?php echo $data['config']['SITE_DIR']; ?>/agent/voucher/addvoucherprocess" method="post">
  <table border="0" Mobilespacing="0" Mobilepadding="0">

    <tr>
      <th scope="row"><label>Voucher name<span class="label_required">*</span></label></th>
      <td><input name="Name" type="text" class="validate[required]" value="" size="40" /></td>
    </tr>
    <tr>
        <th scope="row"><label>Voucher code<span class="label_required">*</span></label></th>
      <td>
          <input readonly style="background-color: rgba(219, 223, 204, 1)" name="Code" type="text" class="validate[]" value="<?php echo $data['content_param']['code_gen']; ?>" size="40" />
      </td>
    </tr>
      <tr>
          <th scope="row"><label>Voucher for which normal agent <span class="label_required">*</span></label></th>
          <td><select style="width: 276px" name="Normal_agent_id" r  class="chosen validate[required]">
                  <option value="">Select normal agent</option>
                  <?php for ($i=0; $i<$data['content_param']['agent_list']['count']; $i++) { ?>
                      <option value="<?php echo $data['content_param']['agent_list'][$i]['ID']; ?>">
                          <?php echo $data['content_param']['agent_list'][$i]['Name']; ?></option>
                  <?php } ?>
              </select></td>
      </tr>
      <tr>
          <th scope="row"><label>Amount of voucher per price<span class="label_required">*</span></label></th>
          <td><input id="number_amount" name="Amount" type="number" min="1" class="validate[required]" value="<?php echo $data['form_param']['FacebookID']; ?>" size="40" /> <span class="label_hint">RM</span></td>
      </tr>
      <tr>
          <th scope="row"><label>How many coupon/card <span class="label_required">*</span></label></th>
          <td><input id="number_how_many" name="How_many" type="number" min="1" class="validate[required]" value="<?php echo $data['form_param']['FacebookID']; ?>" size="40" /></td>
      </tr>
      <tr>
          <th scope="row"><label>Description</label></th>
          <td>
              <textarea class="validate[]" name="Description" rows="5" style="width: 400px"></textarea>
<!--              <input name="Description" type="text" class="validate[]" value="--><?php //echo $data['form_param']['FacebookID']; ?><!--" size="40" />-->
          </td>
      </tr>
    <tr>
      <th scope="row"><label>Start Date <span class="label_required">*</span></label></th>
      <td>
          <input required name="Start_date" id="txtFrom" class=" validate[required] " type="text"  size="10" maxlength="10" />

          <span class="label_hint">(mm-dd-yyyy)</span> <span style="
      color: red" id="error_1"> </span></td>
    </tr>
      <tr>
          <th scope="row"><label>End Date <span class="label_required">*</span></label></th>
          <td><input required name="End_date" id="txtTo" class="validate[required]" type="text"  size="10" maxlength="10" /><span class="label_hint">(mm-dd-yyyy)</span> <span style="
      color: red" id="error_2"> </span></td>

      </tr>


    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;<input hidden id="date_now" value="<?php echo date('d-m-Y')?>"></th>
      <td><input id="submit_check" type="submit" name="submit" value="Add" class="button" />
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/voucher/index?page=all">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
        type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
      rel="Stylesheet"type="text/css"/>
<script type="text/javascript">
    $(function () {
        $("#txtFrom").datepicker({
            numberOfMonths: 2,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#txtTo").datepicker("option", "minDate", dt);
            }
        });
        $("#txtTo").datepicker({
            numberOfMonths: 2,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#txtFrom").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>

<script type="text/javascript">
    //<![CDATA[
    $(function() {
        jQuery("#number_amount").change(function(){
            value=jQuery('#number_amount').val();
            if(value<0){
                jQuery('#number_amount').val(1);
            }
        });
        jQuery("#number_how_many").change(function(){
            value=jQuery('#number_how_many').val();
            if(value<0){
                jQuery('#number_how_many').val(1);
            }
        });
        jQuery("#start_date").change(function(){
            start_date=jQuery('#start_date').val();
            end_date=jQuery('#end_date').val();
            var date=new  Date().getTime(start_date);
            var d1 = new Date(start_date).getTime();
            var d2 =new Date(end_date).getTime();
            alert(d1);

            if(d2<d1&&end_date!=''){
                $('#submit_check').hide();
                $('#error_1').text('Start date cannot be later than end date');
            }else{
                var date_now=jQuery('#date_now').val();
                var d3 = new Date(date_now).getTime()
                if(d2<d3&&end_date!='')
                {
                    $('#submit_check').hide();
                    $('#error_2').text('End date can not be less than current date');
                }
                else{
                        $('#submit_check').show();
                        $('#error_1').text('');
                        $('#error_2').text('');
                }
            }
        });
        function compareDate(date, check) {
            if (!.isDate(new Date(date)) || !.isDate(new Date(check))) {
                return false;
            } else {
                return new Date(date).getTime() === new Date(check).getTime();
            }

        }
        jQuery("#end_date").change(function(){
            start_date=jQuery('#start_date').val();
            end_date=jQuery('#end_date').val();
            var d1 = Date.parse(start_date);
            var d2 = Date.parse(end_date);
            if(d1<d2&&start_date!=''){
                $('#submit_check').hide();
                $('#error_2').text('End date cannot be before start date');
            }else{
                var date_now=jQuery('#date_now').val();
                var d3 = Date.parse(date_now);
                if(d2<d3)
                {
                    $('#submit_check').hide();
                    $('#error_2').text('End date can not be less than current date');
                }else{
                    $('#submit_check').show();
                    $('#error_2').text('');
                    $('#error_1').text('');
                }

            }
        });



    });

    //]]>
</script>