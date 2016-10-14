<?php if ($data['page']['operator_add']['error']['count']>0) { ?>
    <?php if ($data['page']['operator_add']['error']['Username']>'0') { ?>
        <div class="error">Operator or analyst failed to create. Username is taken, please select other username.</div>
    <?php } ?>
<?php } ?>   
<form name="add_form" class="admin_table_nocell"  id="add_form" action="<?php echo $data['config']['SITE_URL']; ?>/admin/operator/addprocess" method="post">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th scope="row"><label>Agent</label></th>
      <td><select name="AgentID" class="chosen_simple">
            <?php for ($i=0; $i<$data['content_param']['agent_list']['count']; $i++) { ?>
            <option value="<?php echo $data['content_param']['agent_list'][$i]['ID']; ?>"><?php echo $data['content_param']['agent_list'][$i]['Name']; ?> - <?php echo $data['content_param']['agent_list'][$i]['ID']; ?> | <?php echo $data['content_param']['agent_list'][$i]['Company']; ?></option>
            <?php } ?>
          </select></td>
    </tr>
    <tr>
      <th scope="row"><label>Profile</label></th>
      <td><select name="ProfileID" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['profile_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['profile_list'][$i]['ID']; ?>" <?php if ($data['form_param']['ProfileID']==$data['content_param']['profile_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['profile_list'][$i]['Profile']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row"><label>Username<span class="label_required">*</span></label></th>
      <td><input name="Username" class="validate[required]" type="text" value="<?php echo $data['form_param']['Username']; ?>" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><label>New Password<span class="label_required">*</span></label></th>
      <td><input name="Password" id="Password" class="validate[required,minSize[8]]" type="password" value="" size="20" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Confirm Password<span class="label_required">*</span></label></th>
      <td><input name="PasswordConfirm" id="PasswordConfirm" class="validate[required,equals[Password]]" type="password" value="" size="20" /></td>
    </tr>    
    <tr>
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($data['form_param']['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" value="Add" class="button" />
        <a href="<?php echo $data['config']['SITE_URL']; ?>/admin/operator/index">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
