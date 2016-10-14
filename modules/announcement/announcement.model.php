<?php
class AnnouncementModel extends BaseModel
{
	private $output = array();
    private $module_name = "Announcement";
	private $module_dir = "modules/announcement/";
    private $module_default_url = "/main/announcement/index";
    private $module_default_admin_url = "/admin/announcement/index";
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function Index($param) 
	{
		$crud = new CRUD();

		// Prepare Pagination
		$query_count = "SELECT COUNT(*) AS num FROM announcement WHERE Enabled = 1";
		$total_pages = $this->dbconnect->query($query_count)->fetchColumn(); 
		
		$targetpage = $data['config']['SITE_DIR'].'/main/announcement/index';
		$limit = 5;
		$stages = 3;
		$page = mysql_escape_string($_GET['page']);
		if ($page) {
			$start = ($page - 1) * $limit; 
		} else {
			$start = 0;	
		}	
		
		// Initialize Pagination
		$paginate = $crud->paginate($targetpage,$total_pages,$limit,$stages,$page);
		
		$sql = "SELECT * FROM announcement WHERE Enabled = 1 ORDER BY Date DESC, ID DESC LIMIT $start, $limit";
		
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToLongDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => CRUD::isActive($row['Enabled']));
			
			$i += 1;
		}

		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Announcements", 'template' => 'common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/main/index.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,""),
		'content' => $result,
		'content_param' => array('count' => $i, 'total_results' => $total_pages, 'paginate' => $paginate),
		'meta' => array('active' => "on"));
					
		return $this->output;
	}

	public function View($param) 
	{
		$sql = "SELECT * FROM announcement WHERE ID = '".$param."' AND Enabled = 1";
		
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToLongDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => CRUD::isActive($row['Enabled']));
			
			$i += 1;
		}

		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => $result[0]['Title'], 'template' => 'common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/main/view.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,$result[0]['Title']),
		'content' => $result,
		'content_param' => array('count' => $i),
		'meta' => array('active' => "on"));
					
		return $this->output;
	}

	public function AdminIndex($param) 
	{		
		// Initialise query conditions
		$query_condition = "";
		
		$crud = new CRUD();
		
		if ($_POST['Trigger']=='search_form')
		{
			// Reset Query Variable
			$_SESSION['announcement_'.__FUNCTION__] = "";
			
			$query_condition .= $crud->queryCondition("Title",$_POST['Title'],"LIKE");
			$query_condition .= $crud->queryCondition("Date",Helper::dateDisplaySQL($_POST['DateFrom']),">=");
			$query_condition .= $crud->queryCondition("Date",Helper::dateDisplaySQL($_POST['DateTo']),"<=");
			$query_condition .= $crud->queryCondition("Description",$_POST['Description'],"LIKE");
			$query_condition .= $crud->queryCondition("Content",$_POST['Content'],"LIKE");
			$query_condition .= $crud->queryCondition("Enabled",$_POST['Enabled'],"=");
			
			$_SESSION['announcement_'.__FUNCTION__]['param']['Title'] = $_POST['Title'];
			$_SESSION['announcement_'.__FUNCTION__]['param']['DateFrom'] = $_POST['DateFrom'];
			$_SESSION['announcement_'.__FUNCTION__]['param']['DateTo'] = $_POST['DateTo'];
			$_SESSION['announcement_'.__FUNCTION__]['param']['Description'] = $_POST['Description'];
			$_SESSION['announcement_'.__FUNCTION__]['param']['Content'] = $_POST['Content'];
			$_SESSION['announcement_'.__FUNCTION__]['param']['Enabled'] = $_POST['Enabled'];
			
			// Set Query Variable
			$_SESSION['announcement_'.__FUNCTION__]['query_condition'] = $query_condition;
			$_SESSION['announcement_'.__FUNCTION__]['query_title'] = "Search Results";
		}

		// Reset query conditions
		if ($_GET['page']=="all")
		{
			$_GET['page'] = "";
			unset($_SESSION['announcement_'.__FUNCTION__]);			
		}

		// Determine Title
		if (isset($_SESSION['announcement_'.__FUNCTION__]))
		{
			$query_title = "Search Results";
            $search = "on";
		}
		else
		{
			$query_title = "All Results";
            $search = "off";
		}

		// Prepare Pagination
		$query_count = "SELECT COUNT(*) AS num FROM announcement ".$_SESSION['announcement_'.__FUNCTION__]['query_condition'];
		$total_pages = $this->dbconnect->query($query_count)->fetchColumn(); 
		
		$targetpage = $data['config']['SITE_DIR'].'/admin/announcement/index';
		$limit = 10;
		$stages = 3;
		$page = mysql_escape_string($_GET['page']);
		if ($page) {
			$start = ($page - 1) * $limit; 
		} else {
			$start = 0;	
		}	
		
		// Initialize Pagination
		$paginate = $crud->paginate($targetpage,$total_pages,$limit,$stages,$page);
		
		$sql = "SELECT * FROM announcement ".$_SESSION['announcement_'.__FUNCTION__]['query_condition']." ORDER BY Date DESC, ID DESC LIMIT $start, $limit";
		
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToLongDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => CRUD::isActive($row['Enabled']));
			
			$i += 1;
		}
		
		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Announcements", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/index.inc.php', 'announcement_delete' => $_SESSION['admin']['announcement_delete']),
		'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.announcement_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,""),
		'content' => $result,
		'content_param' => array('count' => $i, 'total_results' => $total_pages, 'paginate' => $paginate, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['admin']['announcement_delete']);
					
		return $this->output;
	}

	public function AdminAdd() 
	{
		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Create Announcement", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/add.inc.php', 'announcement_add' => $_SESSION['admin']['announcement_add']),
		'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.announcement_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,"Create Announcement"),
		'content_param' => array('enabled_list' => CRUD::getActiveList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));
				
		unset($_SESSION['admin']['announcement_add']);
					
		return $this->output;
	}

	public function AdminAddProcess()
	{
		$key = "(Title, Date, Description, Content, Enabled)";
		$value = "('".$_POST['Title']."', '".Helper::dateDisplaySQL($_POST['Date'])."', '".$_POST['Description']."', '".$_POST['Content']."', '".$_POST['Enabled']."')";

		$sql = "INSERT INTO announcement ".$key." VALUES ". $value;

		$count = $this->dbconnect->exec($sql);
		$newID = $this->dbconnect->lastInsertId();
		
		// Set Status
        $ok = ($count==1) ? 1 : "";
		
		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Creating Announcement...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count, 'newID' => $newID),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));
					
		return $this->output;
	}

	public function AdminEdit($param) 
	{
		$sql = "SELECT * FROM announcement WHERE ID = '".$param."'";
	
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => $row['Enabled']);
			
			$i += 1;
		}

		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Edit Announcement", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/edit.inc.php', 'announcement_add' => $_SESSION['admin']['announcement_add'], 'announcement_edit' => $_SESSION['admin']['announcement_edit']),
        'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.announcement_common.inc.php'),
        'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,"Edit Announcement"),
		'content' => $result,
		'content_param' => array('count' => $i, 'enabled_list' => CRUD::getActiveList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['admin']['announcement_add']);
		unset($_SESSION['admin']['announcement_edit']);
					
		return $this->output;
	}

	public function AdminEditProcess($param) 
	{
		$sql = "UPDATE announcement SET Title='".$_POST['Title']."', Date='".Helper::dateDisplaySQL($_POST['Date'])."', Description='".$_POST['Description']."', Content='".$_POST['Content']."', Enabled='".$_POST['Enabled']."' WHERE ID='".$param."'";

		$count = $this->dbconnect->exec($sql);
		
		// Set Status
        $ok = ($count<=1) ? 1 : "";
		
		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Editing Announcement...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));
					
		return $this->output;
	}
	
	public function AdminDelete($param) 
	{
		$sql = "DELETE FROM announcement WHERE ID ='".$param."'";
		$count = $this->dbconnect->exec($sql);
		
		// Set Status
        $ok = ($count==1) ? 1 : "";

		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Deleting Announcement...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));
					
		return $this->output;
	}
	
	public function getAnnouncement($param) 
	{
		$crud = new CRUD();

		$sql = "SELECT * FROM announcement WHERE ID = '".$param."'";
		
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToLongDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => CRUD::isActive($row['Enabled']));
			
			$i += 1;
		}
		
		$result = $result[0]['Title'];
		
		return $result;
	}

	public function getAnnouncementList() 
	{
		$crud = new CRUD();

		$sql = "SELECT * FROM announcement ORDER BY Date DESC, ID DESC";
		
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'Title' => $row['Title'],
			'Date' => Helper::dateSQLToLongDisplay($row['Date']),
			'Description' => $row['Description'],
			'Content' => $row['Content'],
			'Enabled' => CRUD::isActive($row['Enabled']));
			
			$i += 1;
		}
		
		$result['count'] = $i;

		return $result;
	}
	
	public function AdminExport($param) 
	{		
		$sql = "SELECT * FROM announcement ".$_SESSION['announcement_'.$param]['query_condition']." ORDER BY Date DESC, ID DESC";
		
		$result = array();
		
		$result['filename'] = $this->config['SITE_NAME']."_Announcement";
		$result['header'] = $this->config['SITE_NAME']." | Announcement (" . date('Y-m-d H:i:s') . ")\n\nID, Title, Date, Description, Content, Enabled";
		$result['content'] = '';
		
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result['content'] .= "\"".$row['ID']."\",";
			$result['content'] .= "\"".$row['Title']."\",";
			$result['content'] .= "\"".Helper::dateSQLToDisplay($row['Date'])."\",";
			$result['content'] .= "\"".Helper::stripNLTags($row['Description'])."\",";
			$result['content'] .= "\"".Helper::stripNLTags($row['Content'])."\",";
			$result['content'] .= "\"".CRUD::isActive($row['Enabled'])."\"\n";

			$i += 1;
		}
		
		$this->output = array( 
		'config' => $this->config,
		'page' => array('title' => "Exporting..."),
		'content' => $result,
		'secure' => TRUE,
		'meta' => array('active' => "on"));
					
		return $this->output;
	}
}
?>