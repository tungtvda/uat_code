<?php if ($_SESSION['superid']=='1') { ?>
<div id="member_login_wrapper">
	<div class="row">
		<div class="small-12 medium-12 large-12 columns">
			<?php if ($data['page']['member_register']['ok']==1) { ?>
			<div class="alert-box success radius"><?php echo Helper::translate("Registration is complete! You may now login below.", "member-login-activation-message"); ?></div>
			<?php } ?>
			<?php if ($_SESSION['disabled']=='1') { ?>
		    <div class="alert-box alert radius"><?php echo Helper::translate("You account have been disabled", "member-login-disabled-message"); ?></div>
            <?php } unset($_SESSION['disabled']); ?>
			<?php if ($data['page']['member_password']['ok']==1) { ?>
			<div class="alert-box success radius"><?php echo Helper::translate("Your new password has been saved. Please login again to continue.", "member-login-passwordsaved-message"); ?></div>
			<?php } ?>
			<?php if ($data['page']['member_logout']['ok']==1) { ?>
			<div class="alert-box success radius"><?php echo Helper::translate("You have logged out successfully.", "member-login-loggedout-message"); ?></div>
			<?php } ?>
			<?php if ($data['page']['member_forgotpassword']['ok']==1) { ?>
			<div class="alert-box success radius"><?php echo Helper::translate("A new password has been generated and sent to your registered email.", "member-login-email-generated"); ?></div>
			<?php } ?>
			<?php if ($data['page']['member_login']['error']['count']>0) { ?>
				<?php if ($data['page']['member_login']['error']['Login']==1) { ?>
			    <div class="alert-box alert radius"><?php echo Helper::translate("The username and/or password entered is invalid. Please try again.", "member-login-username-invalid"); ?></div>
			    <?php } ?>
			<?php } ?>
	    </div>
		<div class="small-12 medium-12 large-12 end columns">
		    <form id="login_form" name="login_form" class="common_block common_form" method="post" action="<?php echo $data['config']['SITE_DIR']; ?>/member/member/loginprocess">
			    <div class="row">
			    	<div class="small-12 medium-12 large-2 columns">
			    		<label for="Username" class="inline"><?php echo Helper::translate("Username:", "member-login-username"); ?></label>
			    	</div>
			    	<div class="small-12 medium-8 large-6 end columns">
			    		<input type="text" class="validate[required]" name="Username" id="Username" placeholder="" value="<?php echo $data['form_param']['Username']; ?>" />
			    	</div>
		    	</div>
		    	<div class="row">
			    	<div class="small-12 medium-12 large-2 columns">
			    		<label for="Company" class="inline"><?php echo Helper::translate("Password:", "member-login-password"); ?></label>
			    	</div>
			    	<div class="small-12 medium-8 large-6 end columns">
			    		<input type="password" class="validate[required]" name="Password" id="Password" placeholder="" />
			    	</div>
		    	</div>
		    	<div class="row">
			    	<div class="small-12 medium-12 large-10 large-offset-2 columns">
                        <input type="hidden" id="LoginTrigger" name="LoginTrigger" value="1" />
			            <input class="button" type="submit" name="submit" id="submit" value="<?php echo Helper::translate("Login", "member-login-login"); ?>" />
			    	</div>
		    	</div>
		    	<div class="row">
			    	<div class="small-12 medium-12 large-2 columns">
			    		&nbsp;
			    	</div>
			    	<div class="small-12 medium-8 large-6 end columns forgot_password">
			            <a href="<?php echo $data['config']['SITE_DIR']; ?>/member/member/forgotpassword?rid=<?php echo urlencode(base64_encode($_SESSION['reseller_code'])); ?>"><?php echo Helper::translate("Forgot your password?", "member-login-forgotpassword"); ?></a>
			    	</div>
		    	</div>
			</form>
	    </div>
	</div>
</div>
<?php echo $data['agentblock'][0]['Content']; ?>
<?php } else { ?>
<div id="member_login_wrapper">
  <?php if ($data['page']['member_register']['ok']==1) { ?>
    <div class="notify"><?php echo Helper::translate("Registration is complete! You may now login below.", "member-login-activation-message"); ?></div>
  <?php } ?>
  <?php if ($_SESSION['disabled']=='1') { ?>
   <div class="notify"><?php echo Helper::translate("You account have been disabled", "member-login-disabled-message"); ?></div>
 <?php } 
 unset($_SESSION['disabled']);
 ?>  
  <?php if ($data['page']['member_password']['ok']==1) { ?>
  <div class="notify"><?php echo Helper::translate("Your new password has been saved. Please login again to continue.", "member-login-passwordsaved-message"); ?></div>
  <?php } ?>
  <?php if ($data['page']['member_logout']['ok']==1) { ?>
  <div class="notify"><?php echo Helper::translate("You have logged out successfully.", "member-login-loggedout-message"); ?></div>
  <?php } ?>
  <?php if ($data['page']['member_forgotpassword']['ok']==1) { ?>
  <div class="notify"><?php echo Helper::translate("A new password has been generated and sent to your registered email.", "member-login-email-generated"); ?></div>
  <?php } ?>
  <?php if ($data['page']['member_login']['error']['count']>0) { ?>
    <?php if ($data['page']['member_login']['error']['Login']==1) { ?>
    <div class="error"><?php echo Helper::translate("The username and/or password entered is invalid. Please try again.", "member-login-username-invalid"); ?></div>
    <?php } ?>
  <?php } ?>
  <form name="login_form" id="login_form" method="post" action="<?php echo $data['config']['SITE_DIR']; ?>/member/member/loginprocess">
    <table border="0" cellspacing="0" cellpadding="0">        
      <tr>
          <th scope="row"><label><?php echo Helper::translate("Username:", "member-login-username"); ?></label></th>
        <td><input type="text" class="validate[required]" name="Username" id="Username" value="<?php echo $data['form_param']['Username']; ?>" /></td>
      </tr>
      <tr>
        <th scope="row"><label><?php echo Helper::translate("Password:", "member-login-password"); ?></label></th>
        <td><input type="password" class="validate[required]" name="Password" id="Password" value="" /></td>
      </tr>
      <!-- <tr>
        <th scope="row">&nbsp;</th>
        <td class='subtext'><label><input type="checkbox" name="AutoLogin" value="1" <?php if (($data['page']['member_auth']==1)&&($_GET['autologin']==1)) { ?>checked="checked"<?php } ?> /> Keep me logged in</label></td>
      </tr> -->
      <tr>
        <th scope="row">&nbsp;</th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <input type="hidden" id="LoginTrigger" name="LoginTrigger" value="1" />
        <td><input class="button" type="submit" name="submit" value="<?php echo Helper::translate("Login", "member-login-login"); ?>" /></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td class='subtext'><div class="forgot_password"><a href="<?php //echo $data['config']['SITE_DIR']; ?>/member/member/forgotpassword"><?php echo Helper::translate("Forgot your password?", "member-login-forgotpassword"); ?></a></div></td>
      </tr>
    </table>
  </form>
</div>
<?php echo $data['agentblock'][0]['Content']; ?>
<?php } ?>

