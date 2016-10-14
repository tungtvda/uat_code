<?php //Debug::displayArray($data); exit; ?>
<?php if ($_GET['param']==="successd") { ?>
<div class="notify">Thank you. Your transaction has been requested successfully and is under processing. Your funds are currently being verified and will be credited to your account within 5 - 10 minutes.</div>
<?php } elseif ($_GET['param']==="successw") { ?>
<div class="notify">Thank you. Your transaction has been requested successfully and is under processing. The amount will be banked in to your designated bank account within 10 minutes.</div>
<?php } elseif ($_GET['param']==="successt") { ?>
<div class="notify">Thank you. Your transaction has been requested successfully and is under processing. Your funds are currently being verified and will be transferred within 5 - 10 minutes.</div>
<?php } elseif ($_GET['param']==="failure") { ?>
<div class="error">Transaction error occurred.</div>
<?php } ?>
<div id="search_box"<?php if ($data['content_param']['search']=="off") { ?>class="search_initial"<?php } ?>>
  <h2>Search</h2><span id="search_trigger_box">(<a id="search_trigger" href="javascript:void(0);">click to show/hide</a>)</span>
  <div id="search_content" <?php if ($data['content_param']['search']=="off") { ?>class="invisible"<?php } ?>>
	  <p>Submitting this search form without any data entry will show all results. Clicking on the Reset button will also remove all filters and show all results.</p>
          <form name="search_form" class="admin_table_nocell"  id="search_form" action="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/index" method="post">
	    <input name="Trigger" type="hidden" value="search_form" />
	    <table border="0" Mobilespacing="0" Mobilepadding="0">

               <?php if($_SESSION['agent']['TypeID']=='1' || $_SESSION['agent']['operator']['OperatorType']=='1'){ ?>
	      <tr>


	        <!--<td><input name="Reseller" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Reseller']; ?>" size="" /></td>-->
                <th scope="row"><label>Mobile No</label></th>
	        <td><input name="MobileNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['MobileNo']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th scope="row"><label>Email</label></th>
	        <td><input name="Email" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Email']; ?>" size="" /></td>
	      </tr>
              <?php } ?>
	      <tr>
	        <th scope="row"><label>Facebook ID</label></th>
	        <td><input name="FacebookID" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['FacebookID']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th scope="row"><label>Username</label></th>
	        <td><input name="Username" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Username']; ?>" size="" /></td>
	      </tr>
          <tr>
            <th scope="row"><label>Date Registered (From)</label></th>
            <td><input name="DateRegisteredFrom" class="datepicker" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['DateRegisteredFrom']; ?>" size="" />(dd-mm-yyyy hh:mm:ss)</td>
            <td>&nbsp;</td>
            <th scope="row"><label>Date Registered (To)</label></th>
            <td><input name="DateRegisteredTo" class="defaultdatepicker" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['DateRegisteredTo']; ?>" size="" />(dd-mm-yyyy hh:mm:ss)</td>
          </tr>
	      <tr>
	        <th scope="row"><label>Bank</label></th>
            <td>
                <select name="Bank" class="validate[] chosen">
                    <option value="">--Please select one--</option>
                        <?php for ($i=0; $i<$data['content_param']['bank_list']['count']; $i++) { ?>
                        <option value="<?php echo $data['content_param']['bank_list'][$i]['Label']; ?>" <?php if ($data['content_param']['bank_list'][$i]['Label']==$_SESSION['member_AgentIndex']['param']['Bank']) { ?> selected="selected"<?php } ?>><?php echo $data['content_param']['bank_list'][$i]['Label']; ?></option>
                        <?php } ?>
                  </select>
                </td>
	        <td>&nbsp;</td>

	        <th scope="row"><label>Full Name</label></th>
	        <td><input name="Name" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Name']; ?>" size="" /></td>
	      </tr>
              <!--<tr>
	      	<th scope="row"><label>Secondary Bank</label></th>
            <td><input name="SecondaryBank" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['SecondaryBank']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	      </tr>-->
	      <!--<tr>
	        <th scope="row"><label>Bank Account No</label></th>
            <td><input name="BankAccountNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['BankAccountNo']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th scope="row"><label>Phone No</label></th>
	        <td><input name="PhoneNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['PhoneNo']; ?>" size="" /></td>
	      </tr>
              <tr>
	      	<th scope="row"><label>Secondary Bank Account No</label></th>
            <td><input name="SecondaryBankAccountNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['SecondaryBankAccountNo']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	      </tr>-->
	      <tr>
            <th scope="row"><label>Bank Account No</label></th>
            <td><input name="BankAccountNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['BankAccountNo']; ?>" size="" /></td>
            <td>&nbsp;</td>
              <th scope="row"><label>Gender</label></th>
	        <td><select name="GenderID" class="chosen_simple">
	            <option value="" selected="selected">All Gender</option>
	            <?php for ($i=0; $i<$data['content_param']['gender_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['gender_list'][$i]['ID']; ?>" <?php if ($_SESSION['member_AgentIndex']['param']['GenderID']==$data['content_param']['gender_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['gender_list'][$i]['Value']; ?></option>
	            <?php } ?>
	        </select></td>
	        <!--<td>&nbsp;</td>
	        <th scope="row"><label>Fax No</label></th>
	        <td><input name="FaxNo" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['FaxNo']; ?>" size="" /></td>-->
	      </tr>
	      <?php /* ?>
	      <tr>
              <!--<th scope="row"><label>Date of Birth (From)</label></th>
	        <td><input name="DOBFrom" class="datepicker" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['DOBFrom']; ?>" size="10" />
	          (dd-mm-yyyy)</td>-->
                <th scope="row"><label>Passport</label></th>
	        <td><input name="Passport" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Passport']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th scope="row"><label>Nationality</label></th>
	        <td><select name="Nationality" class="chosen_full">
	            <option value="" selected="selected">All Nationality</option>
	            <?php for ($i=0; $i<$data['content_param']['country_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['country_list'][$i]['ID']; ?>" <?php if ($data['content_param']['country_list'][$i]['ID']==$_SESSION['member_AgentIndex']['param']['Nationality']) { ?> selected="selected"<?php } ?>><?php echo $data['content_param']['country_list'][$i]['NameShort']; ?></option>
	            <?php } ?>
	          </select></td>
	      </tr><?php */ ?>
          <!--<tr>
              <th scope="row"><label>Date of Birth (To)</label></th>
	        <td><input name="DOBTo" class="datepicker" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['DOBTo']; ?>" size="10" />
	          (dd-mm-yyyy)</td>
	        <td>&nbsp;</td>

	      </tr>-->
	      <tr>
	        <th scope="row"><label>NRIC</label></th>
	        <td><input name="NRIC" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['NRIC']; ?>" size="" /></td>
            <td>&nbsp;</td>
            <th>Enabled</th>
	        <td><select name="Enabled" class="chosen_simple">
	            <option value="" selected="selected">All Status</option>
	            <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($_SESSION['member_AgentIndex']['param']['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
	            <?php } ?>
	        </select></td>
	      </tr>
	      <tr>
	      	<th scope="row"><label>Company</label></th>
	        <td><input name="Company" type="text" value="<?php echo $_SESSION['member_AgentIndex']['param']['Company']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
                <td>&nbsp;</td>
	      </tr>
	      <tr>
	        <th scope="row"><label></label></th>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	      </tr>
	      <tr>
	        <th scope="row"><label></label></th>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td class="text_right"><input type="submit" name="submit" value="Search" class="button" />
	          <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/member/index?page=all">
	          <input type="button" value="Reset" class="button" />
	          </a></td>
	      </tr>


	    </table>
	  </form>

  </div>
</div>
<div class="admin_results">
  <div class="results_left">
    <h2><?php echo $data['content_param']['query_title']; ?></h2>
    <?php if ($data['content_param']['count']>0) { ?>
    <div>Total Results: <?php echo $data['content_param']['total_results']; ?></div>
    <?php } ?>
  </div>
  <div class="results_right">
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
      <a href='/agent/member/add?apc=apci'>
        <input type="button" class="button" value="Create Member">
      </a>
    <?php } ?>
    <?php if($_SESSION['agent']['operator']['ProfileID']=='2' || $_SESSION['agent']['operator']['ProfileID']=='3'){ ?>
      <a href='/agent/member/add?apc=apci'>
        <input type="button" class="button" value="Create Member">
      </a>
    <?php } ?>
<!--<a href='<?php echo $data['config']['SITE_DIR']; ?>/admin/transaction/export/AdminIndex'>
    <input type="button" class="button" value="Export to CSV">
    </a>--><?php echo $data['content_param']['paginate']; ?></div>
  <div class="clear"></div>
</div>
<?php if ($data['content_param']['count']>0) { ?>
<table class="admin_table" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th>Name</th>
    <th>Username</th>
    <th>Gender</th>
    <!-- <th>Company</th> -->
    <th>Bank</th>
    <th>Bank Account No</th>
<!--<th>Secondary Bank</th>
    <th>Secondary Bank Account No</th>
    <th>Date Of Birth</th>
    <th>NRIC</th>
    <?php if ($data['content'][$i]['NationalityID']=='151') { ?>
    <th>Nationality</th>
    <?php } else { ?>
    <th>Passport</th>
    <?php } ?>
    <th>Phone No</th>
    <th>Fax No</th>-->
    <?php if($_SESSION['agent']['TypeID']=='1' || $_SESSION['agent']['operator']['OperatorType']=='1'){ ?>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <th>Mobile No</th>
    <?php } ?>
    <th>Email</th>
    <?php } ?>
    <th>Facebook ID</th>
    <th class="center">Enabled</th>
    <th>Date Registered</th>
    <th>Wallet</th>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <th class="center">Edit</th>
    <?php } ?>
    <?php if($_SESSION['agent']['operator']['ProfileID']=='2' || $_SESSION['agent']['operator']['ProfileID']=='3'){ ?>
    <th class="center">Edit</th>
    <?php } ?>
  </tr>
  <?php for ($i=0; $i<$data['content_param']['count']; $i++) { ?>
  <tr>
    <td><?php echo $data['content'][$i]['Name']; ?></td>
    <td><?php echo $data['content'][$i]['Username']; ?></td>
    <td><?php echo $data['content'][$i]['GenderID']; ?></td>
    <!-- <td><?php echo $data['content'][$i]['Company']; ?></td> -->
    <td><?php echo $data['content'][$i]['Bank']; ?></td>
    <td><?php echo $data['content'][$i]['BankAccountNo']; ?></td>
<!--<td><?php echo $data['content'][$i]['SecondaryBank']; ?></td>
    <td><?php echo $data['content'][$i]['SecondaryBankAccountNo']; ?></td>
    <td><?php echo $data['content'][$i]['DOB']; ?></td>
    <td><?php echo $data['content'][$i]['Nationality']; ?></td>
    <?php if ($data['content'][$i]['NationalityID']=='151') { ?>
        <td><?php echo $data['content'][$i]['NRIC']; ?></td>
    <?php } else { ?>
        <td><?php echo $data['content'][$i]['Passport']; ?></td>
    <?php } ?>
    <td><?php echo $data['content'][$i]['PhoneNo']; ?></td>
    <td><?php echo $data['content'][$i]['FaxNo']; ?></td>-->
    <?php if($_SESSION['agent']['TypeID']=='1' || $_SESSION['agent']['operator']['OperatorType']=='1'){ ?>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <td><?php echo $data['content'][$i]['MobileNo']; ?></td>
    <?php } ?>
    <td><?php echo $data['content'][$i]['Email']; ?></td>
<?php } ?>
    <td><?php echo $data['content'][$i]['FacebookID']; ?></td>
    <td><?php echo $data['content'][$i]['Enabled']; ?></td>
    <td><?php echo $data['content'][$i]['DateRegistered']; ?></td>
    <td><div align="center">
    <a href="<?php echo $data['config']['SITE_DIR']; ?>/agent/wallet/view/<?php echo $data['content'][$i]['ID']; ?>">View
    </a></div>
    </td>
    <?php if($_SESSION['agent']['TypeID']=='1'){ ?>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_DIR']; ?>/agent/member/edit/<?php echo $data['content'][$i]['ID']; ?>?apc=apci'>Edit</a></div></td>


    <?php } ?>

    <?php /*if($_SESSION['agent']['operator']['ProfileID']=='2' || $_SESSION['agent']['operator']['ProfileID']=='3'){ ?>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_DIR']; ?>/agent/member/edit/<?php echo $data['content'][$i]['ID']; ?>?apc=apci'>Edit</a></div></td>

    <?php }*/ ?>

  </tr>
  <?php } ?>
</table>
<?php } else { ?>
<p>No records.</p>
<?php } ?>




