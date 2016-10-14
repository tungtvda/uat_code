<?php if ($data['page']['orderitem_orderdelete']['ok']==1) { ?>
<div class="notify">Order Item deleted successfully.</div>
<?php } ?>
<div id="search_box"<?php if ($data['content_param']['search']=="off") { ?>class="search_initial"<?php } ?>>
  <h2>Search</h2><span id="search_trigger_box">(<a id="search_trigger" href="javascript:void(0);">click to show/hide</a>)</span>
  <div id="search_content" <?php if ($data['content_param']['search']=="off") { ?>class="invisible"<?php } ?>>
	  <p>Submitting this search form without any data entry will show all results. Clicking on the Reset button will also remove all filters and show all results.</p>
	  <form name="search_form" class="admin_table_nocell"  id="search_form" action="<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/orderindex/<?php echo $data['parent']['id']; ?>" method="post">
	    <input name="Trigger" type="hidden" value="search_form" />
	    <table border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <th scope="row"><label>Name</label></th>
	        <td><input name="Name" type="text" value="<?php echo $_SESSION['orderitem_AdminOrderIndex']['param']['Name']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th>Price</th>
            <td><input name="Price" type="text" value="<?php echo $_SESSION['orderitem_AdminOrderIndex']['param']['Price']; ?>" /></td>
	      </tr>
	      <tr>
	        <th scope="row"><label>Description</label></th>
	        <td><input name="Description" type="text" value="<?php echo $_SESSION['orderitem_AdminOrderIndex']['param']['Description']; ?>" size="" /></td>
	        <td>&nbsp;</td>
	        <th>Quantity</th>
            <td><input name="Quantity" type="text" value="<?php echo $_SESSION['orderitem_AdminOrderIndex']['param']['Quantity']; ?>" /></td>
	      </tr>
	      <?php /* ?><tr>
	        <th scope="row"><label>Enabled</label></th>
	        <td><select name="Enabled"  class="chosen_simple">
	            <option value="" selected="selected">All Status</option>
	            <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($_SESSION['orderitem_AdminOrderIndex']['param']['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
	            <?php } ?>
	        </select></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	      </tr><?php */ ?>
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
	          <a href="<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/orderindex?page=all">
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
  <div class="results_right"><a href='<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/orderadd/<?php echo $data['parent']['id']; ?>'><input type="button" class="button" value="Create Order Item"></a><a href='<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/export/AdminOrderIndex'>
    <input type="button" class="button" value="Export to CSV">
    </a><?php echo $data['content_param']['paginate']; ?></div>
  <div class="clear"></div>
</div>
<?php if ($data['content_param']['count']>0) { ?>
<table class="admin_table" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>Order</th>
    <th>Product</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th class="center">Quantity</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php for ($i=0; $i<$data['content_param']['count']; $i++) { ?>
  <tr>
    <td><?php echo $data['content'][$i]['OrderID']; ?></td>
    <td><?php echo $data['content'][$i]['ProductID']; ?></td>
    <td><?php echo $data['content'][$i]['Name']; ?></td>
    <td><?php echo $data['content'][$i]['Description']; ?></td>
    <td><?php echo $data['content'][$i]['Price']; ?></td>
    <td class="center"><?php echo $data['content'][$i]['Quantity']; ?></td>
    <?php /* ?><td class="center"><?php echo $data['content'][$i]['Enabled']; ?></td><?php */ ?>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/orderedit/<?php echo $data['parent']['id']; ?>,<?php echo $data['content'][$i]['ID']; ?>'>Edit</a></div></td>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_URL']; ?>/admin/orderitem/orderdelete/<?php echo $data['parent']['id']; ?>,<?php echo $data['content'][$i]['ID']; ?>' onclick='return call_confirm()'>Delete</a></div></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
<p>No records.</p>
<?php } ?>
