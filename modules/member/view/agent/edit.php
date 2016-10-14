<?php
function familyTree($array, $parentID)
	{
            //global $data;
            //echo $parentID;

                if(is_array($array)===TRUE)
                {


                      for ($index = 0; $index < $array['count']; $index++) {


                             if ($array[$index]['ID']==$parentID) {
                                $selected= 'selected="selected"';
                                //echo 'hi';

                             }

                            $data= '<option style="padding-left:'.$array[$index]['Padding'].'px;" value="'. $array[$index]['ID'].'" '.$selected.'>'.$array[$index]['Name'].' - '. $array[$index]['ID'].' | '. $array[$index]['Company'].'</option>';

                            echo $data;
                            //exit;

                            unset($selected);


                           familyTree($array[$index]['Child'], $parentID);
                      }


                }

        }

?>
<?php if ($data['page']['member_add']['ok']==1) { ?>
<div class="notify">Member created successfully.</div>
<?php } ?>
<?php if ($data['page']['member_edit']['error']['count']>0) { ?>
    <div class="error">
        <ul>
            <?php if ($data['page']['member_edit']['error']['Username']==1) { ?><li>The username "<?php echo $data['form_param']['Username']; ?>" is taken. Please try again with another username.</li><?php } ?>
            <?php if ($data['page']['member_edit']['error']['NRIC']==1) { ?><li>The NRIC number <?php echo $data['form_param']['NRIC']; ?> exists in the database. Each member can only register once. Please try again with another NRIC number.</li><?php } ?>
            <?php if ($data['page']['member_edit']['error']['Passport']==1) { ?><li>The Passport number <?php echo $data['form_param']['Passport']; ?> exists in the database. Each member can only register once. Please try again with another Passport number.</li><?php } ?>
            <?php if ($data['page']['member_edit']['error']['Bank']==1) { ?><li>The Bank <?php echo $data['form_param']['Bank']; ?> exists in the database. Please try again with another bank.</li><?php } ?>
        </ul>
    </div>
<?php } else { ?>
    <?php if ($data['page']['member_edit']['ok']==1) { ?>
    <div class="notify">Member edited successfully.</div>
    <?php } ?>
<?php } ?>
<form name="edit_form" class="admin_table_noMobile"  id="edit_form" action="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/editprocess/<?php echo $data['content'][0]['ID']; ?>" method="post">
  <table border="0" Mobilespacing="0" Mobilepadding="0">
    <tr>
      <th scope="row"><label>Agent<span class="label_required">*</span></label></th>
      <td><select name="Agent" class="validate[] chosen">
                        <option value="<?php echo $data['agent'][0]['ID']; ?>"<?php if($data['content'][0]['Agent']==$data['agent'][0]['ID']){ ?> selected="selected"<?php } ?>><?php echo $data['agent'][0]['Name']; ?> - <?php echo $data['agent'][0]['ID']; ?> | <?php echo $data['content'][0]['Company']; ?></option><?php familyTree($data['agent'][0]['Child'], $data['content'][0]['Agent']); ?>
          </select>
          </td>
    </tr>
    <tr>
      <th scope="row"><label>Full Name<span class="label_required">*</span></label></th>
      <td><input name="Name" type="text" class="validate[required]" value="<?php echo (($data['form_param']['Name']!="") ? $data['form_param']['Name'] : $data['content'][0]['Name']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Facebook ID</label></th>
      <td><input name="FacebookID" type="text" class="validate[]" value="<?php echo (($data['form_param']['FacebookID']!="") ? $data['form_param']['FacebookID'] : $data['content'][0]['FacebookID']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Gender<span class="label_required">*</span></label></th>
      <td><select name="GenderID" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['gender_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['gender_list'][$i]['ID']; ?>"
              <?php if ($data['form_param']['GenderID']!="") { ?>
              <?php if ($data['content_param']['gender_list'][$i]['ID']==$data['form_param']['GenderID']) { ?>selected="selected"<?php } ?>
              <?php } else { ?>
              <?php if ($data['content_param']['gender_list'][$i]['ID']==$data['content'][0]['GenderID']) { ?>selected="selected"<?php } ?>
              <?php } ?>><?php echo $data['content_param']['gender_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row"><label>Date of Birth</label></th>
      <td><input name="DOB" type="text" class="validate[custom[dmyDate]] datepicker mask_date" value="<?php if ($data['content'][0]['DOB']!="00-00-0000") { echo (($data['form_param']['DOB']!="") ? $data['form_param']['DOB'] : $data['content'][0]['DOB']); } ?>" size="10" maxlength="10" /><span class="label_hint">(dd-mm-yyyy)</span></td>
    </tr>
    <tr>
      <th scope="row"><label>Nationality<span class="label_required">*</span></label></th>
      <td><select name="Nationality" id="Nationality" class="chosen">
          <?php for ($i=0; $i<$data['content_param']['country_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['country_list'][$i]['ID']; ?>"
              <?php if ($data['form_param']['Nationality']!="") { ?>
              <?php if ($data['content_param']['country_list'][$i]['ID']==$data['form_param']['Nationality']) { ?>selected="selected"<?php } ?>
              <?php } else { ?>
              <?php if ($data['content_param']['country_list'][$i]['ID']==$data['content'][0]['Nationality']) { ?> selected="selected"<?php } ?>
              <?php } ?>><?php echo $data['content_param']['country_list'][$i]['Name']; ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tbody id="nric_box"
        <?php if ($data['form_param']['Nationality']!="") { ?>
        <?php if ($data['form_param']['Nationality']!=151) { ?>class="invisible"<?php } ?>
        <?php } else { ?>
        <?php if ($data['content'][0]['Nationality']!=151) { ?>class="invisible"<?php } ?>
        <?php } ?>>
        <tr>
          <th scope="row"><label>NRIC</label></th>
          <td><input name="NRIC" type="text" class="validate[custom[NRIC]] mask_nric" value="<?php echo (($data['form_param']['NRIC']!="") ? $data['form_param']['NRIC'] : $data['content'][0]['NRIC']); ?>" size="20" /><span class="label_hint">(e.g. 880101-14-5566)</span></td>
        </tr>
    </tbody>
    <tbody id="passport_box"
        <?php if ($data['form_param']['Nationality']!="") { ?>
        <?php if ($data['form_param']['Nationality']==151) { ?>class="invisible"<?php } ?>
        <?php } else { ?>
        <?php if ($data['content'][0]['Nationality']==151) { ?>class="invisible"<?php } ?>
        <?php } ?>>
        <tr>
          <th scope="row"><label>Passport</label></th>
          <td><input name="Passport" type="text" class="validate[]" value="<?php echo (($data['form_param']['Passport']!="") ? $data['form_param']['Passport'] : $data['content'][0]['Passport']); ?>" size="20" /></td>
        </tr>
    </tbody>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><label>Company</label></th>
      <td><input name="Company" type="text" class="validate[]" value="<?php echo (($data['form_param']['Company']!="") ? $data['form_param']['Company'] : $data['content'][0]['Company']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Bank</label></th>
      <td>
          <select name="Bank" class="validate[] chosen">
                        <?php if (!($_SESSION['agent']['operator']['ProfileID']>'0')) { ?>
                        <option value="">--Please select one--</option>
                        <?php } ?>

                        <?php for ($i=0; $i<$data['content_param']['bank_list']['count']; $i++) { ?>

                        <?php if ($_SESSION['agent']['operator']['ProfileID']>'0') { ?>

                            <?php if ($data['content'][0]['Bank']==$data['content_param']['bank_list'][$i]['Label']) { ?>
                            <option value="<?php echo $data['content_param']['bank_list'][$i]['Label']; ?>" <?php if($data['content'][0]['Bank']==$data['content_param']['bank_list'][$i]['Label']){ ?> selected="selected" <?php } ?>><?php echo $data['content_param']['bank_list'][$i]['Label']; ?></option>
                            <?php } ?>


                        <?php } else { ?>

                        <option value="<?php echo $data['content_param']['bank_list'][$i]['Label']; ?>" <?php if($data['content'][0]['Bank']==$data['content_param']['bank_list'][$i]['Label']){ ?> selected="selected" <?php } ?>><?php echo $data['content_param']['bank_list'][$i]['Label']; ?></option>
                        <?php } ?>

                        <?php } ?>
                  </select>
          </td>
    </tr>
    <tr>
      <th scope="row"><label>Bank Account No</label></th>
      <td><input name="BankAccountNo" type="text" <?php if ($_SESSION['agent']['operator']['ProfileID']>'0') { ?>readonly='readonly'<?php } ?> class="validate[required, custom[integer], minsize[2]]" value="<?php echo (($data['form_param']['BankAccountNo']!="") ? $data['form_param']['BankAccountNo'] : $data['content'][0]['BankAccountNo']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Secondary Bank</label></th>
      <td><input name="SecondaryBank" type="text" <?php if ($_SESSION['agent']['operator']['ProfileID']>'0') { ?>readonly='readonly'<?php } ?> class="validate[]" value="<?php echo (($data['form_param']['SecondaryBank']!="") ? $data['form_param']['SecondaryBank'] : $data['content'][0]['SecondaryBank']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Secondary Bank Account No</label></th>
      <td><input name="SecondaryBankAccountNo" type="text" <?php if ($_SESSION['agent']['operator']['ProfileID']>'0') { ?>readonly='readonly'<?php } ?> class="validate[custom[integer], minsize[2]]" value="<?php echo (($data['form_param']['SecondaryBankAccountNo']!="") ? $data['form_param']['SecondaryBankAccountNo'] : $data['content'][0]['SecondaryBankAccountNo']); ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><label>Username<span class="label_required">*</span></label></th>
      <td><input name="Username" type="text" class="validate[required]" value="<?php echo (($data['form_param']['Username']!="") ? $data['form_param']['Username'] : $data['content'][0]['Username']); ?>" size="20" /></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><label><input name="NewPassword" id="NewPassword" type="checkbox" value="1" /> Create a new password</label></td>
    </tr>
    <tbody id="NewPasswordBox" class="invisible">
    <tr>
      <th scope="row"><label>New Password<span class="label_required">*</span></label></th>
      <td><input name="Password" id="Password" type="password" class="validate[required,minSize[8]]" value="" size="20" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Confirm Password<span class="label_required">*</span></label></th>
      <td><input name="PasswordConfirm" id="PasswordConfirm" class="validate[required,equals[Password]]" type="password" value="" size="20" /></td>
    </tr>
    </tbody>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <tr>
      <th scope="row"><label>Mobile No</label></th>
      <td><input name="MobileNo" type="text" class="validate[custom[mobileNo],minSize[9]]" value="<?php echo (($data['form_param']['MobileNo']!="") ? $data['form_param']['MobileNo'] : $data['content'][0]['MobileNo']); ?>" size="20" maxlength="15" /><span class="label_hint">(e.g. 0192255667)</span></td>
    </tr>
    <?php } ?>
    <?php if($_SESSION['agent']['operator']['OperatorType']=='1'){ ?>
    <tr>
      <th scope="row"><label>Mobile No</label></th>
      <td><input name="MobileNo" type="text" class="validate[custom[mobileNo],minSize[9]]" value="<?php echo (($data['form_param']['MobileNo']!="") ? $data['form_param']['MobileNo'] : $data['content'][0]['MobileNo']); ?>" size="20" maxlength="15" /><span class="label_hint">(e.g. 0192255667)</span></td>
    </tr>
    <?php } ?>
    <tr>
      <th scope="row"><label>Phone No</label></th>
      <td><input name="PhoneNo" type="text" class="validate[custom[phoneNo],minSize[9]]" value="<?php echo (($data['form_param']['PhoneNo']!="") ? $data['form_param']['PhoneNo'] : $data['content'][0]['PhoneNo']); ?>" size="20" maxlength="15" /><span class="label_hint">(e.g. 0320540000)</span></td>
    </tr>
    <tr>
      <th scope="row"><label>Fax No</label></th>
      <td><input name="FaxNo" type="text" class="validate[custom[faxNo],minSize[9]]" value="<?php echo (($data['form_param']['FaxNo']!="") ? $data['form_param']['FaxNo'] : $data['content'][0]['FaxNo']); ?>" size="20" maxlength="15" /><span class="label_hint">(e.g. 0320540000)</span></td>
    </tr>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <tr>
      <th scope="row"><label>Email<span class="label_required">*</span></label></th>
      <td><input name="Email" type="text" class="validate[required,custom[email]]" value="<?php echo (($data['form_param']['Email']!="") ? $data['form_param']['Email'] : $data['content'][0]['Email']); ?>" size="30" /><span class="label_hint">(e.g. harry.porter@gmail.com)</span></td>
    </tr>
    <?php } ?>
    <?php if($_SESSION['agent']['operator']['OperatorType']=='1'){ ?>
    <tr>
      <th scope="row"><label>Email<span class="label_required">*</span></label></th>
      <td><input name="Email" type="text" class="validate[required,custom[email]]" value="<?php echo (($data['form_param']['Email']!="") ? $data['form_param']['Email'] : $data['content'][0]['Email']); ?>" size="30" /><span class="label_hint">(e.g. harry.porter@gmail.com)</span></td>
    </tr>
    <?php } ?>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><label>Prompt</label></th>
      <td><select name="Prompt" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>"
              <?php if ($data['form_param']['Prompt']!="") { ?>
              <?php if ($data['content_param']['enabled_list'][$i]['ID']==$data['form_param']['Prompt']) { ?>selected="selected"<?php } ?>
              <?php } else { ?>
              <?php if ($data['content_param']['enabled_list'][$i]['ID']==$data['content'][0]['Prompt']) { ?>selected="selected"<?php } ?>
              <?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <input type="hidden" name="apc" value="<?php echo $data['apc']; ?>">
    <tr>
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>"
              <?php if ($data['form_param']['Enabled']!="") { ?>
              <?php if ($data['content_param']['enabled_list'][$i]['ID']==$data['form_param']['Enabled']) { ?>selected="selected"<?php } ?>
              <?php } else { ?>
              <?php if ($data['content_param']['enabled_list'][$i]['ID']==$data['content'][0]['Enabled']) { ?>selected="selected"<?php } ?>
              <?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" value="Update" class="button" />
        <?php if($data['apc']=='apcg'){ ?>
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/group">
        <input type="button" value="Cancel" class="button" />
        </a>
       <?php }elseif($data['apc']=='apci'){ ?>
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/index">
        <input type="button" value="Cancel" class="button" />
        </a>
       <?php }else{ ?>
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/index">
        <input type="button" value="Cancel" class="button" />
        </a>
       <?php } ?>
      </td>
    </tr>
  </table>
</form>
