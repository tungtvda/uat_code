
<?php if ($data['page']['bankinslip_add']['error']['count']>0) { ?>
<?php } else { ?>
    <?php if ($data['page']['bankinslip_add']['ok']==1) { ?>
    <div class="notify">Bankin Slip created successfully.</div>
    <?php } ?>
<?php } ?>
<?php if ($data['page']['bankinslip_edit']['error']['count']>0) { ?>
<?php } else { ?>
    <?php if ($data['page']['bankinslip_edit']['ok']==1) { ?>
    <div class="notify">Bankin Slip edited successfully.</div>
    <?php } ?>
<?php } ?>

<form name="edit_form" class="admin_table_nocell"  id="edit_form" action="<?php echo $data['config']['SITE_DIR']; ?>/admin/bankinslip/editprocess/<?php echo $data['content'][0]['ID']; ?>" method="post">
  <table border="0" cellspacing="0" cellpadding="0">
      <tr>
          <th scope="row"></th>
          <td>
              <select id="admin-language" name="">
                    <option value="en" <?php if($_SESSION['admin']['DEFAULT_LANGUAGE']=='en'){ ?>selected="selected" <?php } ?>>English</option>
                  <option value="ms" <?php if($_SESSION['admin']['DEFAULT_LANGUAGE']=='ms'){ ?>selected="selected" <?php } ?>>Malay</option>
                  <option value="zhCN" <?php if($_SESSION['admin']['DEFAULT_LANGUAGE']=='zhCN'){ ?>selected="selected" <?php } ?>>Mandarin</option>
                </select>
          </td>
          
      </tr>
      <input type="hidden" id="hiddenLang" name="Lang" value="">
    <tr>
      <th scope="row"><label>Label<span class="label_required">*</span></label></th>
      <td><input name="Label" type="text" class="validate[required]" value="<?php echo $data['content'][0]['Label']; ?>" size="40" /><span id="info" class="label_hint">Please update the current changes first before you continue.</span></td>
    </tr>
    <?php /*?><tr>
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($data['content'][0]['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr><?php */?>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" value="Update" class="button" />
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/admin/bankinslip/index">
        <input type="button" value="Cancel" class="button" />
        </a></td>
    </tr>
  </table>
</form>
