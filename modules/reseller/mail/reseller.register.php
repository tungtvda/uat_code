<html>
<head></head>
<body style="background-color: #f5f5f5">
<div style="width: 550px; border:1px solid #ddd; padding:15px 20px 20px; margin:10px; border-radius:6px; background-color: #fff; font-family:Arial,sans-serif; font-size:12px; color:#333;">
  <table>
    <tbody>
      <tr>
        <td align="left"><img src="<?php echo $param['config']['SITE_URL'].$param['config']['THEME_DIR']; ?>img/cgame-logo.png" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left">Hi <strong style="color:#c00;"><?php echo $param['content']['Name']; ?></strong>,<br /><br />Congratulations on your new account! You're all set to get the best of what <?php echo $param['config']['SITE_NAME']; ?> can offer.<br /><br />
        <b>Username:</b> <?php echo $param['content']['Username']; ?><br /><br />
        To access your account, please visit our website at <a style="color:#c00;" href="<?php echo $param['config']['SITE_URL']; ?><?php echo $param['config']['SITE_DIR']; ?>"><?php echo $param['config']['SITE_URL']; ?><?php echo $param['config']['SITE_DIR']; ?></a>.</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Best Regards,<br />
            <strong><?php echo $param['config']['COMPANY_NAME']; ?></strong></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>