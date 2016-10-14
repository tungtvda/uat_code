<?php if ($data['page']['agentblock_delete']['ok']==1) { ?>
<div class="notify">Agent Block deleted successfully.</div>
<?php } ?>
<div id="search_box"<?php if ($data['content_param']['search']=="off") { ?>class="search_initial"<?php } ?>>
  <h2>Search</h2><span id="search_trigger_box">(<a id="search_trigger" href="javascript:void(0);">click to show/hide</a>)</span>
  <div id="search_content" <?php if ($data['content_param']['search']=="off") { ?>class="invisible"<?php } ?>>
	  <p>Submitting this search form without any data entry will show all results. Clicking on the Reset button will also remove all filters and show all results.</p>
	  <form name="search_form" class="admin_table_nocell"  id="search_form" action="<?php echo $data['config']['SITE_DIR']; ?>/admin/agentblock/index" method="post">
	    <input name="Trigger" type="hidden" value="search_form" />
	    <table border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <th scope="row"><label>Agent</label></th>
<!--	        <td><select name="AgentID" class="chosen_full">
	            <option value="">All Agents</option>
	            <?php for ($i=0; $i<$data['content_param']['agent_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['agent_list'][$i]['ID']; ?>" <?php if ($data['content_param']['agent_list'][$i]['ID']==$_SESSION['agentblock_AdminIndex']['param']['AgentID']) { ?> selected="selected"<?php } ?>><?php echo $data['content_param']['agent_list'][$i]['Name']; ?> - <?php echo $data['content_param']['agent_list'][$i]['ID']; ?> | <?php echo $data['content_param']['agent_list'][$i]['Company']; ?></option>
	            <?php } ?>
	          </select></td>-->
                <?php //Debug::displayArray($data['content_param']['test1']); ?>
                  <td>
                    <select name="AgentID" class="chosen_full">
                    <option value="">--Select All--</option>
                    <?php for ($g=0; $g<$data['content_param']['test1']['count']; $g++) { ?>
                    <option value="<?php echo $data['content_param']['test1'][$g]['ID']; ?>" <?php if($data['content_param']['test1'][$g]['ID']==$_SESSION['agentblock_AdminIndex']['param']['AgentID']){ ?>selected="selected"<?php } ?>><?php echo $data['content_param']['test1'][$g]['Name']; ?> - <?php echo $data['content_param']['test1'][$g]['ID']; ?> | <?php echo $data['content_param']['test1'][$g]['Company']; ?></option>
	            <?php Helper::agentOptionList($data['content_param']['test1'][$g]['Child'], $_SESSION['agentblock_AdminIndex']['param']['AgentID']); ?>
                    <?php } ?>
                    <?php for ($i=0; $i<$data['content_param']['test2']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['test2'][$i]['ID']; ?>" <?php if ($data['content_param']['test2'][$i]['ID']==$_SESSION['agentblock_AdminIndex']['param']['AgentID']) { ?> selected="selected"<?php } ?>><?php echo $data['content_param']['test2'][$i]['Name']; ?> - <?php echo $data['content_param']['test2'][$i]['ID']; ?> | <?php echo $data['content_param']['test2'][$i]['Company']; ?></option>
	            <?php } ?>
                    </select>
                </td>
	        <td>&nbsp;</td>
            <th>Name</th>
            <td><input name="Name" type="text" value="<?php echo $_SESSION['agentblock_AdminIndex']['param']['Name']; ?>" /></td>
	      </tr>
	      <tr>
	        <th scope="row"><label>Content</label></th>
            <td><input name="Content" type="text" value="<?php echo $_SESSION['agentblock_AdminIndex']['param']['Content']; ?>" /></td>
	        <td>&nbsp;</td>
	        <th><label>Position</label></th>
	        <td><input name="Position" type="text" value="<?php echo $_SESSION['agentblock_AdminIndex']['param']['Position']; ?>" /></td>
	      </tr>
	      <tr>
	        <th><label>Enabled</label></th>
	        <td><select name="Enabled">
	            <option value="" selected="selected">All Status</option>
	            <?php for ($i=0; $i<$data['content_param']['enabled_list']['count']; $i++) { ?>
	            <option value="<?php echo $data['content_param']['enabled_list'][$i]['ID']; ?>" <?php if ($_SESSION['agentblock_AdminIndex']['param']['Enabled']==$data['content_param']['enabled_list'][$i]['ID']) { ?>selected="selected"<?php } ?>><?php echo $data['content_param']['enabled_list'][$i]['Value']; ?></option>
	            <?php } ?>
	          </select></td>
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
	          <a href="<?php echo $data['config']['SITE_DIR']; ?>/admin/agentblock/index?page=all">
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
  <div class="results_right"><a href='/admin/agentblock/add/'><input type="button" class="button" value="Create Agent Block"></a><a href='/admin/agentblock/manage?page=all'><input type="button" class="button" value="Bulk Update"></a><a href='<?php echo $data['config']['SITE_DIR']; ?>/admin/agentblock/export/AdminIndex'>
    <input type="button" class="button" value="Export to CSV">
    </a><?php echo $data['content_param']['paginate']; ?></div>
  <div class="clear"></div>
</div>
<?php if ($data['content_param']['count']>0) { ?>
<table class="admin_table" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>Agent</th>
    <th>Name</th>
    <th>Content</th>
    <th>Position</th>
    <th class="center">Enabled</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php for ($i=0; $i<$data['content_param']['count']; $i++) { ?>
  <tr>
    <td><?php echo $data['content'][$i]['AgentID']; ?></td>
    <td><?php echo $data['content'][$i]['Name']; ?></td>
    <td><?php echo $data['content'][$i]['Content']; ?></td>
    <td><?php echo $data['content'][$i]['Position']; ?></td>
    <td class="center"><?php echo $data['content'][$i]['Enabled']; ?></td>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_DIR']; ?>/admin/agentblock/edit/<?php echo $data['content'][$i]['ID']; ?>'>Edit</a></div></td>
    <td><div align="center"><a href='<?php echo $data['config']['SITE_DIR']; ?>/admin/agentblock/delete/<?php echo $data['content'][$i]['ID']; ?>' onclick='return call_confirm()'>Delete</a></div></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
<p>No records.</p>
<?php } ?>
