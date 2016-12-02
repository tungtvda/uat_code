

  <?php if ($data['content_param']['count']>0) { ?>


  <table class="admin_table" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <!--<th>Member</th>-->
    <th class="td_left">Field</th>
    <th>Value</th>

    <!--<th class="center">Enabled</th>-->

  <tr>
    <td class="td_left">Normal Agent</td>
    <td><?php echo $data['content'][0]['Name_normal_agent']; ?></td>

  </tr>
    <tr>
      <td class="td_left">Name</td>
      <td><?php echo $data['content'][0]['Name']; ?></td>

    </tr>
    <tr>
      <td class="td_left">Code</td>
      <td><?php echo $data['content'][0]['Code']; ?></td>

    </tr>
    <tr>
      <td class="td_left">Amount</td>
      <td><?php echo $data['content'][0]['Amount']; ?></td>

    </tr>
    <tr>
      <td class="td_left">How many coupon/card</td>
      <td><?php echo $data['content'][0]['How_many']; ?></td>

    </tr>
    <tr>
      <td class="td_left">Start date</td>
      <td><?php echo $data['content'][0]['Start_date']; ?></td>

    </tr>
    <tr>
      <td class="td_left">End date</td>
      <td><?php echo $data['content'][0]['End_date']; ?></td>

    </tr>
    <tr>
      <td class="td_left">Password</td>
      <td id="#password">
        <?php if(count($data['content_param']['item_pass'])>0){?>
          <script type="text/javascript">
            //<![CDATA[
            $(function() {
              jQuery("#show_list_pass").click(function(){
                $('#show_pass').slideToggle();
                val=$('#show_list_pass').text();
              if(val=="Hidden list password"){
                $('#show_list_pass').text('Show list password');
              }else{
                $('#show_list_pass').text('Hidden list password');
              }

              });
            });

            //]]>
          </script>
        <a href="javascript:void(0)" style="padding-bottom: 20px" id="show_list_pass">Show list password</a>
          <?php
          if(isset($_GET['password'])){
           $show= "block";
          }
          else{
           $show= "none";
          }

          ?>
        <div  style="display: <?php echo $show ?>"  id="show_pass">
          <table class="sub_table">

            <tr >
              <th>#</th>
              <th >Password</th>
              <th >Status</th>
              <th >User by</th>
            </tr>
            <?php foreach($data['content_param']['item_pass'] as $row_pass){?>
            <tr>
              <td>
                <?php echo $row_pass['stt']?>
              </td>
              <td>
               <span class="password_right"><?php echo $row_pass['Password']?></span>
              </td>
              <td>
                <select disabled>
                  <option value="0" <?php if($row_pass['Status']==0) echo "selected='selected'"?>>Active</option>
                  <option value="1" <?php if($row_pass['Status']==1) echo "selected='selected'"?>>Used</option>
                  <option value="2" <?php if($row_pass['Status']==2) echo "selected='selected'"?>>Suspend</option>
                </select>
              </td>
              <td>
                <span class="password_right"><?php echo $row_pass['Name_user']?></span>
              </td>
            </tr>
            <?php }?>
          </table>
        </div>
        <?php }?>
      </td>

    </tr>
    <tr>
      <td class="td_left">Description</td>
      <td><?php echo $data['content'][0]['Description']; ?></td>

    </tr>



</table>
<style>
  .td_left{
    width:200px;
  }
  .password_right{
    color:#f60;
  }

</style>



  <?php } else { ?>
  <p>Voucher not found.</p>
  <?php } ?>

