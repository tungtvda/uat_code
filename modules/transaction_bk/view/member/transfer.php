<?php if($_GET['param']==="invalid"){ ?>
<div class="error"><?php echo Helper::translate("The amount specified is less than the available balance in the selected wallet. Please try again.", "member-transfer-message"); ?></div>
<?php } ?>

<br />
<form name="add_form" class="admin_table_nocell"  id="add_form" action="<?php echo $data['config']['SITE_DIR']; ?>/member/transaction/transferprocess" method="post">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th scope="row"><label><?php echo Helper::translate("Transfer From", "member-transfer-from"); ?></label></th>
      <td><select id="TransferFrom" name="TransferFrom">
            <?php for ($i=0; $i<$data['Product']['count']; $i++) { ?>
            <option value="<?php echo $data['Product'][$i]['ID']; ?>"><?php echo $data['Product'][$i]['Name']; ?> ----- <?php echo Helper::translate("Balance:", "member-transfer-balance"); ?> RM<?php echo $data['Product'][$i]['Wallet']; ?></option>
            <?php } ?>
          </select></td>
    </tr>
    <tr>
      <th scope="row"><label><?php echo Helper::translate("Transfer To", "member-transfer-to"); ?></label></th>
      <td><select class="mainwallet invisible" id="TransferTo" name="TransferTo">
            <?php for ($i=0; $i<$data['mainwallet']['count']; $i++) { ?>
            <option value="<?php echo $data['mainwallet'][$i]['ID']; ?>"><?php echo $data['mainwallet'][$i]['Name']; ?></option>
            <?php } ?>
          </select>
          <select class="nonmainwallet" id="TransferTo" name="TransferTo">
            <?php for ($i=0; $i<$data['nonmainwallet']['count']; $i++) { ?>
            <option value="<?php echo $data['nonmainwallet'][$i]['ID']; ?>"><?php echo $data['nonmainwallet'][$i]['Name']; ?></option>
            <?php } ?>
          </select></td>
    </tr>
     <tr>
      <th scope="row"><label><?php echo Helper::translate("Amount (MYR)", "member-transfer-amount"); ?></label></th>
      <td><input name="Amount" id="Amount" class="validate[required, custom[number], min[10]]" value="" size="10" /> <?php echo Helper::translate("(Minimum MYR 10.00)", "member-transfer-minimum-amount"); ?></td>
    </tr>
    <!-- <tr>
      <th scope="row"><label>Description<span class="label_required">*</span></label></th>
      <td><input name="description" class="validate[required]" value="" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Date<span class="label_required">*</span></label></th>
      <td><input name="Date" class="validate[required,custom[dmyDate]] datepicker mask_date" type="text" value="" size="10" maxlength="10" /><span class="label_hint">(dd-mm-yyyy)</span></td>
    </tr>
    <tr>
      <th scope="row"><label>Debit<span class="label_required">*</span></label></th>
      <td><input name="Debit" class="validate[required]" type="text" value="" size="80" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Credit<span class="label_required">*</span></label></th>
      <td><input name="Credit" class="validate[required]" type="text" value="" size="80" /></td>
    </tr>
    <tr>
      <th scope="row"><label>Status</label></th>
      <td><select name="Status" class="chosen_simple">
            <?php for ($i=0; $i<$data['content_param']['transactionstatus_list']['count']; $i++) { ?>
            <option value="<?php echo $data['content_param']['transactionstatus_list'][$i]['ID']; ?>"><?php echo $data['content_param']['transactionstatus_list'][$i]['Label']; ?></option>
            <?php } ?>
          </select></td>
    </tr> -->
    <?php /*?><tr>
      <th scope="row"><label>Enabled</label></th>
      <td><select name="Enabled" class="chosen_simple">
          <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
          <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>"><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
          <?php } ?>
        </select></td>
    </tr><?php */?>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <input type="hidden" id="TransferTrigger" name="TransferTrigger" value="1" />
      <input type="hidden" id="form_token" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
      <td><input type="submit" id="Submit" name="submit" value="<?php echo Helper::translate("Save", "member-transfer-save"); ?>" class="button" />
        <a href="<?php echo $data['config']['SITE_DIR']; ?>/member/transaction/index">
        <input type="button" id="Cancel" value="<?php echo Helper::translate("Cancel", "member-transfer-cancel"); ?>" class="button" />
        </a></td>
    </tr>
  </table>
</form>
<br /><br />