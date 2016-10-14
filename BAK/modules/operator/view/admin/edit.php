<?php if ($data['page']['operator_add']['error']['count']>0) { ?>
<?php } else { ?>
    <?php if ($data['page']['operator_add']['ok']==1) { ?>
    <div class="notify">Operator or analyst created successfully.</div>
    <?php } ?>
<?php } ?>
<?php if ($data['page']['operator_edit']['error']['count']>0) { ?>
    <div class="error">Operator or analyst failed to edit. Username is taken, please select other username.</div>
<?php } else { ?>
    <?php if ($data['page']['operator_edit']['ok']==1) { ?>
    <div class="notify">Operator or analyst edited successfully.</div>
    <?php } ?>
<?php } ?>
<form name="edit_form" class="admin_table_nocell"  id="edit_form" action="<?php echo $data['config']['SITE_URL']; ?>/admin/operator/editprocess/<?php echo $data['content'][0]['ID']; ?>" method="post">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th scope="row"><label>Agent</label></th>
      <td><select name="AgentID" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['agent_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['agent_list'][$i]['ID']; ?>" <?php if ($data['content_param']['agent_list'][$i]['ID']==$data['content'][0]['AgentID']) { ?> selected="selected"<?php } ?>><?php echo $data['content_param']['agent_list'][$i]['Name']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row"><label>Profile</label></th>
      <td><select name="ProfileID">
          <?php for ($i=0; $i<$data['content_param']['profile_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['profile_list'][$i]['ID']; ?>" <?php if ($data['content'][0]['ProfileID']==$data['content_param']['profile_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['profile_list'][$i]['Profile']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <th scope="row"><label>Username<span class="label_required">*</span></label></th>
      <td><input name="Username" class="validate[required]" type="text" value="<?php echo $data['content'][0]['Username']; ?>" size="40" /></td>
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
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($data['content'][0]['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
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
        <a href="<?php echo $data['config']['SITE_URL']; ?>/admin/operator/index">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
