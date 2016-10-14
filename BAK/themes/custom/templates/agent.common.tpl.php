<?php if($_SERVER['REMOTE_ADDR']!='60.53.220.203'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>    
<?php include($data['config']['THEME_DIR_INC'].'inc/meta_common.inc.php'); ?>
<title>
<?php include($data['config']['THEME_DIR_INC'].'inc/title.inc.php'); ?>
</title>
<?php include($data['config']['THEME_DIR_INC'].'inc/agent.scripts_common.inc.php'); ?>
<?php if($_GET['section']!='main' && $_GET['controller']!='staticpage' && $_GET['action']!='javascriptdisabled'){ ?>
<noscript>
  <meta http-equiv="refresh" content="0;url=<?php echo $data['config']['SITE_DIR']; ?>/main/staticpage/javascriptdisabled">
</noscript>
<?php } ?>       
</head>
<body onLoad="goforit()">
<div id="wrapper">
  
  <?php include($data['config']['THEME_DIR_INC'].'inc/agent.header.inc.php'); ?>
  <?php #include($data['config']['THEME_DIR_INC'].'inc/nav_main.inc.php'); ?>
  <div id="main">
    <div class="main_left">
      <?php echo $data['breadcrumb']; ?>
      <div id="common_content_wrapper">
        <h1><?php echo $data['page']['title']; ?></h1>
        <?php require($this->view_location); ?>
      </div>
    </div>
    <?php /* ?>
    <div class="main_right">
      <?php (($data['block']['side_nav']!="") ? include($data['block']['side_nav']) : ""); ?>
      <?php (($data['block']['common']!="false") ? include($data['config']['THEME_DIR_INC'].'inc/side_nav.common.inc.php') : ""); ?>
    </div><?php */ ?>
    <div class="clear"></div>
  </div>
  <?php //include($data['config']['THEME_DIR_INC'].'inc/footer.inc.php'); ?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50081244-1', 'casino9club.com');
  ga('send', 'pageview');

</script>
</body>
</html>
<?php } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($data['config']['THEME_DIR_INC'].'inc/meta_common.inc.php'); ?>
<title>
<?php include($data['config']['THEME_DIR_INC'].'inc/title.inc.php'); ?>
</title>
<?php include($data['config']['THEME_DIR_INC'].'inc/agent.scripts_common.inc.php'); ?>
<?php if($_GET['section']!='main' && $_GET['controller']!='staticpage' && $_GET['action']!='javascriptdisabled'){ ?>
<noscript>
  <meta http-equiv="refresh" content="0;url=<?php echo $data['config']['SITE_DIR']; ?>/main/staticpage/javascriptdisabled">
</noscript>
<?php } ?>       
</head>
<body onLoad="goforit()">
<div id="wrapper">
  
  <?php include($data['config']['THEME_DIR_INC'].'inc/agent.header.inc.php'); ?>
  <?php #include($data['config']['THEME_DIR_INC'].'inc/nav_main.inc.php'); ?>
  <div id="main">
    <div class="main_left">
      <?php echo $data['breadcrumb']; ?>
      <div id="common_content_wrapper">
        <h1><?php echo $data['page']['title']; ?></h1>
        <?php require($this->view_location); ?>
      </div>
    </div>
    <?php /* ?>
    <div class="main_right">
      <?php (($data['block']['side_nav']!="") ? include($data['block']['side_nav']) : ""); ?>
      <?php (($data['block']['common']!="false") ? include($data['config']['THEME_DIR_INC'].'inc/side_nav.common.inc.php') : ""); ?>
    </div><?php */ ?>
    <div class="clear"></div>
  </div>
  <?php //include($data['config']['THEME_DIR_INC'].'inc/footer.inc.php'); ?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50081244-1', 'casino9club.com');
  ga('send', 'pageview');

</script>
</body>
</html>    
<?php } ?>

