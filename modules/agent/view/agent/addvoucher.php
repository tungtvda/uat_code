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
<form name="add_form" class="admin_table_noMobile" id="add_form" action="<?php echo $data['config']['SITE_DIR']; ?>/agent/agent/addvoucherprocess" method="post">
  <table border="0" Mobilespacing="0" Mobilepadding="0">

    <tr>
      <th scope="row"><label>Voucher name<span class="label_required">*</span></label></th>
      <td><input name="Name" type="text" class="validate[required]" value="<?php echo $data['form_param']['Name']; ?>" size="40" /></td>
    </tr>
    <tr>
        <th scope="row"><label>Voucher code<span class="label_required">*</span></label></th>
      <td>
          <input readonly style="background-color: rgba(219, 223, 204, 1)" name="Code" type="text" class="validate[required]" value="<?php echo $data['content_param']['code_gen']; ?>" size="40" />
      </td>
    </tr>
      <tr>
          <th scope="row"><label>Voucher for which normal agent <span class="label_required">*</span></label></th>
          <td><select name="Normal_agent_id" id="Nationality" class="chosen">
                  <?php for ($i=0; $i<$data['content_param']['agent_list']['count']; $i++) { ?>
                      <option value="<?php echo $data['content_param']['agent_list'][$i]['ID']; ?>">
                          <?php echo $data['content_param']['agent_list'][$i]['Name']; ?></option>
                  <?php } ?>
              </select></td>
      </tr>
      <tr>
          <th scope="row"><label>Amount of voucher per price<span class="label_required">*</span></label></th>
          <td><input name="Amount" type="text" class="validate[required]" value="<?php echo $data['form_param']['FacebookID']; ?>" size="40" /></td>
      </tr>
      <tr>
          <th scope="row"><label>How many coupon/card <span class="label_required">*</span></label></th>
          <td><input name="How_many" type="text" class="validate[required]" value="<?php echo $data['form_param']['FacebookID']; ?>" size="40" /></td>
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
      <td><input required name="Start_date" class="validate[custom[dmyDate]] validate[required] datepicker mask_date" type="text" value="<?php echo $data['form_param']['DOB']; ?>" size="10" maxlength="10" /><span class="label_hint">(dd-mm-yyyy)</span></td>
    </tr>
      <tr>
          <th scope="row"><label>End Date <span class="label_required">*</span></label></th>
          <td><input required name="End_date" class="validate[custom[dmyDate]] validate[required] datepicker mask_date" type="text" value="<?php echo $data['form_param']['DOB']; ?>" size="10" maxlength="10" /><span class="label_hint">(dd-mm-yyyy)</span></td>
      </tr>


    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" value="Add" class="button" />
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/agent/voucher">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
