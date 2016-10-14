<div id="merchant_wrapper">
  <?php if ($data['content_param']['count']>0) { ?>
  <?php for ($i=0; $i<$data['content_param']['count']; $i++) { ?>
  <div class="merchant_list_box">
    <h2><a href="/main/merchant/view/<?php echo $data['content'][$i]['ID']; ?>"><?php echo $data['content'][$i]['Name']; ?></a></h2>
    <div class="merchant_desc"><?php echo $data['content'][$i]['GenderID']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['FirstName']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['LastName']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Company']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['DOB']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['NRIC']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Passport']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Nationality']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Username']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Password']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['PhoneNo']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['FaxNo']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['MobileNo']; ?></div>
    <div class="merchant_desc"><?php echo $data['content'][$i]['Email']; ?></div>
    <div class="merchant_more"><a href="<?php echo $data['config']['SITE_URL']; ?>/main/merchant/view/<?php echo $data['content'][$i]['ID']; ?>">Read more &raquo;</a></div>
  </div>
  <?php } ?>
  <?php echo $data['content_param']['paginate']; ?>
  <?php } else { ?>
  <p>No Merchants yet.</p>
  <?php } ?>
</div>
