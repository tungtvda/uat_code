<?php if ($data['page']['transactionstatus_add']['error']['count']>0) { ?>
<?php } else { ?>
    <?php if ($data['page']['transactionstatus_add']['ok']==1) { ?>
    <div class="notify">Transaction Status created successfully.</div>
    <?php } ?>
<?php } ?>
<?php if ($data['page']['transactionstatus_edit']['error']['count']>0) { ?>
<?php } else { ?>
    <?php if ($data['page']['transactionstatus_edit']['ok']==1) { ?>
    <div class="notify">Transaction Status edited successfully.</div>
    <?php } ?>
<?php } ?>
<form name="edit_form" class="admin_table_nocell"  id="edit_form" action="<?php echo $data['config']['SITE_DIR']; ?>/admin/transactionstatus/editprocess/<?php echo $data['content'][0]['ID']; ?>" method="post">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th scope="row"><label>Label<span class="label_required">*</span></label></th>
      <td><input name="Label" type="text" class="validate[required]" value="<?php echo $data['content'][0]['Label']; ?>" size="40" /></td>
    </tr>
    <!-- <tr>
      <th scope="row"><label>Background Color<span class="label_required">*</span></label></th>
      <td><input name="BGColor" type="text" class="validate[required] cpicker" value="<?php echo $data['content'][0]['BGColor']; ?>" size="10" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Color<span class="label_required">*</span></label></th>
      <td><input name="Color" type="text" class="validate[required] cpicker" value="<?php echo $data['content'][0]['Color']; ?>" size="10" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($data['content'][0]['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr> -->
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" value="Update" class="button" />
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/admin/transactionstatus/index">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
