<div id="member_view_wrapper">
  <?php if ($data['content_param']['count']>0) { ?>
  <div class="member_view_box">
    <div class="member_desc"><?php echo $data['content'][0]['GenderID']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['FirstName']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['LastName']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Company']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['DOB']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['NRIC']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Passport']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Nationality']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Username']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Password']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['PhoneNo']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['FaxNo']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['MobileNo']; ?></div>
    <div class="member_desc"><?php echo $data['content'][0]['Email']; ?></div>
    <div class="member_social">
      <!-- AddThis Button BEGIN -->
      <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_preferred_1"></a> <a class="addthis_button_preferred_2"></a> <a class="addthis_button_preferred_3"></a> <a class="addthis_button_preferred_4"></a> <a class="addthis_button_compact"></a> <a class="addthis_counter addthis_bubble_style"></a>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-5050e2b007d1353b"></script>
        <!-- AddThis Button END -->
      </div>
    </div>
    <div><a href="<?php echo $data['config']['SITE_DIR']; ?>/main/member">&laquo; Back</a></div>
  </div>
  <?php } else { ?>
  <p>Member not found.</p>
  <?php } ?>
</div>
