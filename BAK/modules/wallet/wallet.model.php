<?php
Core::requireModel('member');
Core::requireModel('product');
Core::requireModel('producttype');
Core::requireModel('moduletranslation');
Core::requireModel('agent');

class WalletModel extends BaseModel
{
	private $output = array();

        private $module_name = "Wallet";
	private $module_dir = "modules/wallet/";
    private $module_default_url = "/main/wallet/index";
    private $module_default_admin_url = "/admin/wallet/index";

	private $member_module_name = "Member";
    private $member_module_dir = "modules/member/";

	private $reseller_module_name = "Reseller";
    private $reseller_module_dir = "modules/reseller/";
	private $module_default_reseller_url = "/reseller/reseller/index";
        
        private $agent_module_name = "Agent";
    private $agent_module_dir = "modules/agent/";
	private $module_default_agent_url = "/agent/wallet/index";


	public function __construct()
	{
		parent::__construct();
	}

	public function Index($param)
	{
		//exit;
		$crud = new CRUD();

		// Prepare Pagination
		$query_count = "SELECT COUNT(*) AS num FROM wallet WHERE Enabled = 1";
		$total_pages = $this->dbconnect->query($query_count)->fetchColumn();

		$targetpage = $data['config']['SITE_DIR'].'/main/wallet/index';
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

		$sql = "SELECT * FROM wallet WHERE Enabled = 1 ORDER BY ID ASC LIMIT $start, $limit";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Wallets", 'template' => 'common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/main/index.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,""),
		'content' => $result,
		'content_param' => array('count' => $i, 'total_results' => $total_pages, 'paginate' => $paginate),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function View($param)
	{
		$sql = "SELECT * FROM wallet WHERE ID = '".$param."' AND Enabled = 1";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => $result[0]['Title'], 'template' => 'common.tpl.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,$result[0]['Title']),
		'content' => $result,
		'content_param' => array('count' => $i),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function ResellerView($param)
	{
		$sql = "SELECT * FROM wallet WHERE MemberID = '".$param."' AND Enabled = 1";
			/*echo $sql;*/
			$wallet = array();

			$i = 0;

			foreach ($this->dbconnect->query($sql) as $row)
			{

				$wallet[$i] = array(
					'ID' => $row['ID'],
					'MemberID' => MemberModel::getMemberName($row['MemberID']),
					'ProductID' => ProductModel::getProductName($row['ProductID']),
					'Username' => $row['Username'],
					'Password' => $row['Password'],
					'Total' => $row['Total'],
					'MemberCount' => MemberModel::getMemberCount(),
					'Enabled' => CRUD::isActive($row['Enabled']));

				$i += 1;


			}

			/*Debug::displayArray($wallet);
			exit;*/
			//$wallet['count'] = $i;

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => 'Member Wallet ('.$wallet[0]['MemberID'].')', 'template' => 'reseller.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/reseller/view.inc.php'),
		'block' => array('side_nav' => $this->reseller_module_dir.'inc/reseller/side_nav.reseller.inc.php', 'common' => "false"),
		//'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,$result[0]['Title']),
		'breadcrumb' => HTML::getBreadcrumb($this->reseller_module_name,$this->module_default_reseller_url,"",$this->config,'Member Wallet'),
		'content' => $wallet,
		'content_param' => array('count' => $i),
		'meta' => array('active' => "on"));

		return $this->output;
	}
        
        public function AgentView($param)
	{
		$sql = "SELECT * FROM wallet WHERE MemberID = '".$param."' AND Enabled = 1";
			/*echo $sql;*/
			$wallet = array();

			$i = 0;

			foreach ($this->dbconnect->query($sql) as $row)
			{

				$wallet[$i] = array(
					'ID' => $row['ID'],
					'MemberID' => MemberModel::getMemberName($row['MemberID']),
					'ProductID' => ProductModel::getProductName($row['ProductID']),
					'Username' => $row['Username'],
					'Password' => $row['Password'],
					'Total' => $row['Total'],
					'MemberCount' => MemberModel::getMemberCount(),
					'Enabled' => CRUD::isActive($row['Enabled']));

				$i += 1;


			}

			/*Debug::displayArray($wallet);
			exit;*/
			//$wallet['count'] = $i;

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => 'Member Wallet ('.$wallet[0]['MemberID'].')', 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/reseller/view.inc.php'),
		'block' => array('side_nav' => $this->agent_module_dir.'inc/agent/side_nav.agent.inc.php', 'common' => "false"),
		//'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_url,"",$this->config,$result[0]['Title']),
		'breadcrumb' => HTML::getBreadcrumb($this->agent_module_name,$this->module_default_agent_url,"",$this->config,'Member Wallet'),
		'content' => $wallet,
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
			$_SESSION['wallet_'.__FUNCTION__] = "";

			$query_condition .= $crud->queryCondition("MemberID",$_POST['MemberID'],"=");
                        $query_condition .= $crud->queryCondition("AgentID",$_POST['AgentID'],"=");
			$query_condition .= $crud->queryCondition("ProductID",$_POST['ProductID'],"=");
			$query_condition .= $crud->queryCondition("Total",$_POST['Total'],"LIKE");
			$query_condition .= $crud->queryCondition("Enabled",$_POST['Enabled'],"=");

			$_SESSION['wallet_'.__FUNCTION__]['param']['MemberID'] = $_POST['MemberID'];
                        $_SESSION['wallet_'.__FUNCTION__]['param']['AgentID'] = $_POST['AgentID'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['ProductID'] = $_POST['ProductID'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['Total'] = $_POST['Total'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['Enabled'] = $_POST['Enabled'];

			// Set Query Variable
			$_SESSION['wallet_'.__FUNCTION__]['query_condition'] = $query_condition;
			$_SESSION['wallet_'.__FUNCTION__]['query_title'] = "Search Results";
		}

		// Reset query conditions
		if ($_GET['page']=="all")
		{
			$_GET['page'] = "";
			unset($_SESSION['wallet_'.__FUNCTION__]);
		}

		// Determine Title
		if (isset($_SESSION['wallet_'.__FUNCTION__]))
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
		$query_count = "SELECT COUNT(*) AS num FROM wallet ".$_SESSION['wallet_'.__FUNCTION__]['query_condition'];
		$total_pages = $this->dbconnect->query($query_count)->fetchColumn();

		$targetpage = $data['config']['SITE_DIR'].'/admin/wallet/index';
		$limit = 12;
		$stages = 3;
		$page = mysql_escape_string($_GET['page']);
		if ($page) {
			$start = ($page - 1) * $limit;
		} else {
			$start = 0;
		}

		// Initialize Pagination
		$paginate = $crud->paginate($targetpage,$total_pages,$limit,$stages,$page);

		$sql = "SELECT * FROM wallet ".$_SESSION['wallet_'.__FUNCTION__]['query_condition']." ORDER BY CASE WHEN ProductID = '30' THEN 1 END DESC, MemberID ASC LIMIT $start, $limit";
                //echo $sql;
                //exit;
		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => MemberModel::getMemberName($row['MemberID']),
            'MemberUsername' => MemberModel::getMemberUsername($row['MemberID']),
                        'AgentID' => AgentModel::getAgent($row['AgentID'], "Name"),   
			'ProductID' => ProductModel::getProductName($row['ProductID']),
			'PIN' => $row['PIN'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'MemberCount' => MemberModel::getMemberCount(),
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}
                
                $result2 = AgentModel::getAdminAgentAllParentChild();

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Wallets", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/index.inc.php', 'wallet_delete' => $_SESSION['admin']['wallet_delete']),
		'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,""),
		'content' => $result,
		'content_param' => array('count' => $i, 'total_results' => $total_pages, 'paginate' => $paginate, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberList(), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentList(), 'agent_list1' => $result2['result2'], 'agent_list2' => $result2['result3']),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['admin']['wallet_delete']);

		return $this->output;
	}
        
        public function AgentIndex($param)
	{
		// Initialise query conditions
		$query_condition = "";

		$crud = new CRUD();

		if ($_POST['Trigger']=='search_form')
		{
			// Reset Query Variable
			$_SESSION['wallet_'.__FUNCTION__] = "";
                //}        
                        
                       
                            

                        $query_condition .= $crud->queryCondition("AgentID",$_POST['AgentID'],"=", 1);
                        $query_condition .= $crud->queryCondition("MemberID",$_POST['MemberID'],"=");
			$query_condition .= $crud->queryCondition("ProductID",$_POST['ProductID'],"=");
                        $query_condition .= $crud->queryCondition("Username",$_POST['Username'],"LIKE");
                        $query_condition .= $crud->queryCondition("PIN",$_POST['PIN'],"=");
			$query_condition .= $crud->queryCondition("Total",$_POST['Total'],"=");
			$query_condition .= $crud->queryCondition("Enabled",$_POST['Enabled'],"=");

			$_SESSION['wallet_'.__FUNCTION__]['param']['MemberID'] = $_POST['MemberID'];
                        $_SESSION['wallet_'.__FUNCTION__]['param']['AgentID'] = $_POST['AgentID'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['ProductID'] = $_POST['ProductID'];
                        $_SESSION['wallet_'.__FUNCTION__]['param']['Username'] = $_POST['Username'];
                        $_SESSION['wallet_'.__FUNCTION__]['param']['PIN'] = $_POST['PIN'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['Total'] = $_POST['Total'];
			$_SESSION['wallet_'.__FUNCTION__]['param']['Enabled'] = $_POST['Enabled'];

			// Set Query Variable
			$_SESSION['wallet_'.__FUNCTION__]['query_condition'] = $query_condition;
			$_SESSION['wallet_'.__FUNCTION__]['query_title'] = "Search Results";
		}

		// Reset query conditions
		if ($_GET['page']=="all")
		{
			$_GET['page'] = "";
			unset($_SESSION['wallet_'.__FUNCTION__]);
		}

		// Determine Title
		if (isset($_SESSION['wallet_'.__FUNCTION__]))
		{
			$query_title = "Search Results";
            $search = "on";
		}
		else
		{
			$query_title = "All Results";
            $search = "off";
		}
                
                $_SESSION['agentchild'] = array();
                array_push($_SESSION['agentchild'], $_SESSION['agent']['ID']);
                //Debug::displayArray($_SESSION['agentchild']);
                //exit;
                $count = AgentModel::getAgentChildExist($_SESSION['agent']['ID']);
                
                if($count>'0')
                {
                    AgentModel::getAgentAllChild($_SESSION['agent']['ID']);
                }
                
                
                $child = implode(',', $_SESSION['agentchild']);
                
                unset($_SESSION['agentchild']);
                
                
                if(isset($_SESSION['wallet_'.__FUNCTION__]['param']['AgentID'])===true && empty($_SESSION['wallet_'.__FUNCTION__]['param']['AgentID'])===false)
                {
                    $query_part = "";
                }
                else
                {
                    $query_part = "AND AgentID IN (".$child.")";
                }
       

                    // Prepare Pagination
                    $query_count = "SELECT COUNT(*) AS num FROM wallet WHERE TRUE = TRUE ".$query_part." ".$_SESSION['wallet_'.__FUNCTION__]['query_condition'];
                    //echo $query_count;
                    //exit;
                    $total_pages = $this->dbconnect->query($query_count)->fetchColumn();

                    $targetpage = $data['config']['SITE_DIR'].'/agent/wallet/index';
                    $limit = 12;
                    $stages = 3;
                    $page = mysql_escape_string($_GET['page']);
                    if ($page) {
                            $start = ($page - 1) * $limit;
                    } else {
                            $start = 0;
                    }

                    // Initialize Pagination
                    $paginate = $crud->paginate($targetpage,$total_pages,$limit,$stages,$page);

                    $sql = "SELECT * FROM wallet WHERE TRUE = TRUE ".$query_part." ".$_SESSION['wallet_'.__FUNCTION__]['query_condition']." Order By ID DESC LIMIT $start, $limit";
                

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => MemberModel::getMemberName($row['MemberID']),
                        'MemberUsername' => MemberModel::getMemberUsername($row['MemberID']),
                        'AgentID' => AgentModel::getAgent($row['AgentID'], "Name"),   
			'ProductID' => ProductModel::getProductName($row['ProductID']),
			'PIN' => $row['PIN'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'MemberCount' => MemberModel::getMemberCount(),
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}
                
                $result['count'] = $i;
                
                $sql2 = "SELECT * FROM agent WHERE Enabled = 1 AND ID = '".$_SESSION['agent']['ID']."'";

                        $result2 = array();
                        $z = 0;
                        $tier = 1;
                        foreach ($this->dbconnect->query($sql2) as $row2)
                        {
                                $result2[$z] = array(
                                        'ID' => $row2['ID'],
                                        'Child'=> AgentModel::getAgentChild($row2['ID'], $tier),
                                        'Name' => $row2['Name'],
                                        'Company' => $row2['Company']);

                                $z += 1;
                        }

                        $result2['count'] = $z;
                        
		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Wallets", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/agent/index.inc.php', 'wallet_delete' => $_SESSION['agent']['wallet_delete']),
		'block' => array('side_nav' => $this->module_dir.'inc/agent/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_agent_url,"",$this->config,"index"),
		'content' => $result,
                'agent' => $result2,    
		'content_param' => array('count' => $i, 'total_results' => $total_pages, 'paginate' => $paginate, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList(), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentListByParent($_SESSION['agent']['ID']), 'enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberListByAgentAgent($_SESSION['agent']['ID'])),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['agent']['wallet_delete']);

		return $this->output;
	}
        
        
        public function APIIndex($param)
    {
        // Initiate REST API class
        $restapi = new RestAPI();

        // Get method
        $method = $restapi->getMethod();

        if ($method=="GET")
        {
            // Get all request data
            $request_data = $restapi->getRequestData();
            
            
            
            if(isset($request_data['LanguageCode'])===TRUE && empty($request_data['LanguageCode'])===FALSE) {
                $_SESSION['language'] = $request_data['LanguageCode'];
            } else {
                $request_data['LanguageCode'] = 'en';
                $_SESSION['language'] = 'en';
            }
            
           

            $sql1 = "SELECT * FROM product_type";

			$type = array();
			$z = 0;

			foreach ($this->dbconnect->query($sql1) as $row1) {

			$sql2 = "SELECT p.TypeID AS p_TypeID, w.ID AS w_ID, w.ProductID AS w_ProductID, w.MemberID AS w_MemberID, w.PIN AS w_PIN, w.Username AS w_Username, w.Total AS w_Total, w.Password AS w_Password FROM wallet AS w, product AS p WHERE w.ProductID = p.ID AND w.MemberID = '".$request_data['memberID']."' AND p.TypeID = '".$row1['ID']."' AND w.AgentID = '".$request_data['Agent']."'";
		//echo $sql2;
			//exit;
			$result = array();
			$i = 0;

				foreach ($this->dbconnect->query($sql2) as $row2)
			    {

						$result['items'][$i] = array(
						'ID' => $row2['w_ID'],
						/*'MemberID' => MemberModel::getMemberName($row['MemberID']),*/
						'ProductID' => ProductModel::getProductName($row2['w_ProductID']),
						'PlayNow' => ProductModel::getAPIPlayNowLink($row2['w_ProductID']),
						'PIN' => (empty($row2['w_PIN'])===TRUE)? '-' : $row2['w_PIN'],
						'Username' => (empty($row2['w_Username'])===TRUE)? '-' : $row2['w_Username'],
						'Password' => (empty($row2['w_Password'])===TRUE)? '-' : $row2['w_Password'],
						'Total' => $row2['w_Total'],
                                                 
						//'MemberCount' => MemberModel::getMemberCount(),
						'Enabled' => CRUD::isActive($row2['w_Enabled']));


						$i += 1;
			    }
			    $result['count'] = $i;
                            
                            if($request_data['LanguageCode']=='en'){
                                $result['Type'] = $row1['Label'];
                            }
                            else 
                            {
                                $result['Type'] = ModuleTranslationModel::getTranslated($row1['ID']);
                            }
			$type[$z] = $result;
                        
			$z += 1;
		}
		

            $output['Count'] = $z;
            $output['Content'] = $type;
            
            
                                                                
             unset($_SESSION['language']);
            // Set output
            if ($output['Count']>0)
            {
                $result = json_encode($output);
                $restapi->setResponse('200', 'OK', $result);
            }
            else
            {
                $restapi->setResponse('404', 'Resource Not Found');
            }
        }
        else
        {
            $restapi->setResponse('405', 'HTTP Method Not Accepted');
        }
    }

	public function MemberIndex($param)
	{

		$sql1 = "SELECT * FROM product_type";

			$type = array();
			$z = 0;

			foreach ($this->dbconnect->query($sql1) as $row1) {

			$sql2 = "SELECT p.TypeID AS p_TypeID, w.ID AS w_ID, w.ProductID AS w_ProductID, w.MemberID AS w_MemberID, w.PIN AS w_PIN, w.Username AS w_Username, w.Total AS w_Total, w.Password AS w_Password FROM wallet AS w, product AS p WHERE w.ProductID = p.ID AND w.MemberID = '".$_SESSION['member']['ID']."' AND p.TypeID = '".$row1['ID']."' AND w.AgentID = '".$_SESSION['reseller_code']."'";
		//echo $sql2;
			//exit;
			$result = array();
			$i = 0;

				foreach ($this->dbconnect->query($sql2) as $row2)
			    {

						$result[$i] = array(
						'ID' => $row2['w_ID'],
						/*'MemberID' => MemberModel::getMemberName($row['MemberID']),*/
						'ProductID' => ProductModel::getProductName($row2['w_ProductID']),
						'PlayNow' => ProductModel::getPlayNowLink($row2['w_ProductID']),
						'PIN' => $row2['w_PIN'],
						'Username' => $row2['w_Username'],
						'Password' => $row2['w_Password'],
						'Total' => $row2['w_Total'],
						//'MemberCount' => MemberModel::getMemberCount(),
						'Enabled' => CRUD::isActive($row2['w_Enabled']));


						$i += 1;
			    }
			    $result[0]['count'] = $i;
				//echo $result[0]['count'].'<br />';
			$type[$z] = $result;
                        
                        if($_SESSION['language']=='en')
                        {
                            $type[$z][0]['Type'] = $row1['Label'];
                        }
                        else 
                        {
                            $type[$z][0]['Type'] = ModuleTranslationModel::getTranslated($row1['ID']);
                        }
			
			//Debug::displayArray($type);
			$z += 1;
		}
		//exit;

		/*Debug::displayArray($type);
		exit;*/
		$type['count'] = $z;

		$product_list['main'] = ProductModel::getProductListByType('5');

                $product_list['main'][0]['Name'] = Helper::translate($product_list['main'][0]['Name'], "member-wallet-main");
                //echo '<pre>';
                //Debug::displayArray($type);
                //Debug::displayArray($product_list['main']);
                //echo '</pre>';
                //exit;

                if($_SESSION['language']=='en')
                {
                   $this->module_name = Helper::translate("Wallet", "member-breadcrumb-wallet");
                }
                elseif($_SESSION['language']=='ms')
                {
                    $this->module_name = Helper::translate("Wallet", "member-breadcrumb-wallet");
                }
                elseif($_SESSION['language']=='zh_CN')
                {
                    $this->module_name = Helper::translate("Wallet", "member-breadcrumb-wallet");
                }

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => Helper::translate("Wallets", "member-wallet-title"), 'template' => 'common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/member/index.inc.php', 'custom_bottom_inc' => 'on', 'custom_bottom_inc_loc' => $this->module_dir.'inc/member/index.bottom.inc.php', 'wallet_delete' => $_SESSION['admin']['wallet_delete']),
		//'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.wallet_common.inc.php'),
		'block' => array('side_nav' => $this->member_module_dir.'inc/member/side_nav.member.inc.php', 'common' => "false"),
		//'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,""),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_member_url,"",$this->config,""),
		'content' => $type,
		'main_wallet' => $product_list['main'],
		'content_param' => array('count' => $z),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		/*Debug::displayArray($this->output['content']);
		exit;*/

		return $this->output;
	}

	public function AdminAdd()
	{
		$WalletList = WalletModel::getWalletList();
		$result = ProductModel::getProductList();


		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Create Wallet", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/add.inc.php', 'wallet_add' => $_SESSION['admin']['wallet_add']),
		'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,"Create Wallet"),
		'content' => $result,
		'wallet' => $WalletList,
		'content_param' => array('enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberList(), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['admin']['wallet_add']);

		return $this->output;
	}

	public function AdminAddProcess()
	{
		$key = "(MemberID, ProductID, AgentID, PIN, Username, Password, Total, Enabled)";
		$value = "('".$_POST['MemberID']."', '".$_POST['ProductID']."', '".$_POST['AgentID']."', '".$_POST['PIN']."', '".$_POST['Username']."', '".$_POST['Password']."', '".$_POST['Total']."', '".$_POST['Enabled']."')";

		$sql = "INSERT INTO wallet ".$key." VALUES ". $value;

		$count = $this->dbconnect->exec($sql);
		$newID = $this->dbconnect->lastInsertId();

		// Set Status
        $ok = ($count==1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Creating Wallet...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count, 'newID' => $newID),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function AgentEdit($param)
	{
		$sql = "SELECT * FROM wallet WHERE ID = '".$param."'";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
                        'AgentID' => $row['AgentID'],
			'PIN' => $row['PIN'],
			'ProductList'=> AgentModel::getAgentProductDetails($_SESSION['agent']['ID']),
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => $row['Enabled']);

			$i += 1;
		}
                
                $sql2 = "SELECT * FROM agent WHERE Enabled = 1 AND ID = '".$_SESSION['agent']['ID']."'";

                $result2 = array();
                $z = 0;
                $tier = 1;
                foreach ($this->dbconnect->query($sql2) as $row2)
                {
                        $result2[$z] = array(
                                'ID' => $row2['ID'],
                                'Child'=> AgentModel::getAgentChild($row2['ID'], $tier),
                                'Name' => $row2['Name'],
                                'Company' => $row2['Company']);

                        $z += 1;
                }

                $result2['count'] = $z;

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Edit Wallet", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/agent/edit.inc.php', 'wallet_add' => $_SESSION['agent']['wallet_add'], 'wallet_edit' => $_SESSION['agent']['wallet_edit']),
		'block' => array('side_nav' => $this->module_dir.'inc/agent/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_agent_url,"",$this->config,"Edit Wallet"),
		'content' => $result,
                'agent' => $result2,   
		'content_param' => array('count' => $i, 'enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberListByAgentAgent($_SESSION['agent']['ID']), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['agent']['wallet_add']);
		unset($_SESSION['agent']['wallet_edit']);

		return $this->output;
	}

	public function AgentEditProcess($param)
	{

		$sql = "UPDATE wallet SET MemberID ='".$_POST['MemberID']."', ProductID='".$_POST['ProductID']."', PIN='".$_POST['PIN']."', Username='".$_POST['Username']."', AgentID='".$_POST['AgentID']."', Password='".$_POST['Password']."', Total ='".$_POST['Total']."', Enabled ='".$_POST['Enabled']."'  WHERE ID='".$param."'";

		$count = $this->dbconnect->exec($sql);

		// Set Status
        $ok = ($count<=1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Editing Wallet...", 'template' => 'agent.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}
        
        public function AgentAdd()
	{
		$WalletList = WalletModel::getWalletList();
		$result = AgentModel::getAgentProductDetails($_SESSION['agent']['ID']);
                                                    
                $sql2 = "SELECT * FROM agent WHERE Enabled = 1 AND ID = '".$_SESSION['agent']['ID']."'";

                $result2 = array();
                $z = 0;
                $tier = 1;
                foreach ($this->dbconnect->query($sql2) as $row2)
                {
                        $result2[$z] = array(
                                'ID' => $row2['ID'],
                                'Child'=> AgentModel::getAgentChild($row2['ID'], $tier),
                                'Name' => $row2['Name'],
                                'Company' => $row2['Company']);

                        $z += 1;
                }

                $result2['count'] = $z;


		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Create Wallet", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/agent/add.inc.php', 'wallet_add' => $_SESSION['agent']['wallet_add']),
		'block' => array('side_nav' => $this->module_dir.'inc/agent/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_agent_url,"",$this->config,"Create Wallet"),
		'content' => $result,
                'agent' => $result2,     
		'wallet' => $WalletList,
		'content_param' => array('enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberListByAgentAgent($_SESSION['agent']['ID']), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['agent']['wallet_add']);

		return $this->output;
	}

	public function AgentAddProcess()
	{
		$key = "(MemberID, ProductID, AgentID, PIN, Username, Password, Total, Enabled)";
		$value = "('".$_POST['MemberID']."', '".$_POST['ProductID']."', '".$_POST['AgentID']."', '".$_POST['PIN']."', '".$_POST['Username']."', '".$_POST['Password']."', '".$_POST['Total']."', '".$_POST['Enabled']."')";

		$sql = "INSERT INTO wallet ".$key." VALUES ". $value;

		$count = $this->dbconnect->exec($sql);
		$newID = $this->dbconnect->lastInsertId();

		// Set Status
        $ok = ($count==1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Creating Wallet...", 'template' => 'agent.common.tpl.php'),
		'content_param' => array('count' => $count, 'newID' => $newID),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}
        
        public function AgentDelete($param)
	{
		$sql = "DELETE FROM wallet WHERE ID ='".$param."'";
		$count = $this->dbconnect->exec($sql);

		// Set Status
        $ok = ($count==1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Deleting Wallet...", 'template' => 'agent.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function AdminEdit($param)
	{
		$sql = "SELECT * FROM wallet WHERE ID = '".$param."'";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
                        'AgentID' => $row['AgentID'],
			'PIN' => $row['PIN'],
			'ProductList'=> ProductModel::getProductList(),
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => $row['Enabled']);

			$i += 1;
		}

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Edit Wallet", 'template' => 'admin.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir.'inc/admin/edit.inc.php', 'wallet_add' => $_SESSION['admin']['wallet_add'], 'wallet_edit' => $_SESSION['admin']['wallet_edit']),
		'block' => array('side_nav' => $this->module_dir.'inc/admin/side_nav.wallet_common.inc.php'),
		'breadcrumb' => HTML::getBreadcrumb($this->module_name,$this->module_default_admin_url,"admin",$this->config,"Edit Wallet"),
		'content' => $result,
		'content_param' => array('count' => $i, 'enabled_list' => CRUD::getActiveList(), 'member_list' => MemberModel::getMemberList(), 'product_list' => ProductModel::getProductList(), 'agent_list' => AgentModel::getAgentList()),
		'secure' => TRUE,
		'meta' => array('active' => "on"));

		unset($_SESSION['admin']['wallet_add']);
		unset($_SESSION['admin']['wallet_edit']);

		return $this->output;
	}

	public function AdminEditProcess($param)
	{

		$sql = "UPDATE wallet SET MemberID ='".$_POST['MemberID']."', ProductID='".$_POST['ProductID']."', PIN='".$_POST['PIN']."', Username='".$_POST['Username']."', AgentID='".$_POST['AgentID']."', Password='".$_POST['Password']."', Total ='".$_POST['Total']."', Enabled ='".$_POST['Enabled']."'  WHERE ID='".$param."'";

		$count = $this->dbconnect->exec($sql);

		// Set Status
        $ok = ($count<=1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Editing Wallet...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function AdminDelete($param)
	{
		$sql = "DELETE FROM wallet WHERE ID ='".$param."'";
		$count = $this->dbconnect->exec($sql);

		// Set Status
        $ok = ($count==1) ? 1 : "";

		$this->output = array(
		'config' => $this->config,
		'page' => array('title' => "Deleting Wallet...", 'template' => 'admin.common.tpl.php'),
		'content_param' => array('count' => $count),
		'status' => array('ok' => $ok, 'error' => $error),
		'meta' => array('active' => "on"));

		return $this->output;
	}

	public function getMainWalletTotal()
	{
		$sql = "SELECT Total FROM wallet WHERE ProductID = '30' AND MemberID = '".$_SESSION['member']['ID']."' AND AgentID = '".$_SESSION['reseller_code']."' AND Enabled = '1'";

		$result = $this->dbconnect->query($sql);

		$result = $result->fetchColumn();

		return $result;

	}
        
        public function getAPIMainWalletTotal($request_data)
	{
		$sql = "SELECT Total FROM wallet WHERE ProductID = '30' AND MemberID = '".$request_data['memberID']."' AND AgentID = '".$request_data['Agent']."' AND Enabled = '1'";

		$result = $this->dbconnect->query($sql);

		$result = $result->fetchColumn();

		return $result;

	}

	public function getWallet($param)
	{
		$crud = new CRUD();

		$sql = "SELECT * FROM wallet WHERE ID = '".$param."'";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}

		$result = $result[0]['Total'];

		return $result;
	}
        
        public function getWalletUpdate($param, $MemberID)
	{
		$sql = "UPDATE wallet SET Total ='".$param."' WHERE MemberID = '".$MemberID."' AND Enabled ='1' AND ProductID = '30'";

		$count = $this->dbconnect->exec($sql);

		// Set Status
                $ok = ($count<=1) ? 1 : "";

		return $ok;
	}

	public function getWalletByProductID($param)
	{
		$crud = new CRUD();

		$sql = "SELECT * FROM wallet WHERE ProductID = '".$param."'";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}

		$result = $result[0]['Total'];

		return $result;
	}

    public function getWalletByMember($param)
    {
        $crud = new CRUD();

        $sql = "SELECT * FROM wallet WHERE ProductID = '".$param."' AND MemberID = '".$_SESSION['member']['ID']."'";

        $result = array();
        $i = 0;
        foreach ($this->dbconnect->query($sql) as $row)
        {
            $result[$i] = array(
            'ID' => $row['ID'],
            'Total' => $row['Total'],
            'Enabled' => CRUD::isActive($row['Enabled']));

            $i += 1;
        }

        $result = $result[0]['Total'];

        return $result;
    }

	public function getWalletList()
	{
		$crud = new CRUD();

		$sql = "SELECT * FROM wallet ORDER BY CASE WHEN ProductID = '30' THEN 1 END DESC";

		$result = array();
		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}

		$result['count'] = $i;

		return $result;
	}

    public function getWalletListByProduct($param)
    {
        $crud = new CRUD();

        $sql = "SELECT * FROM wallet WHERE MemberID = '".$_SESSION['member']['ID']."' AND ProductID = '".$param."' ORDER BY Name ASC";

        $result = array();
        $i = 0;
        foreach ($this->dbconnect->query($sql) as $row)
        {
            $result[$i] = array(
            'ID' => $row['ID'],
            'MemberID' => $row['MemberID'],
            'ProductID' => ProductModel::getProductName($row['ProductID']),
            'Total' => $row['Total'],
            'Enabled' => CRUD::isActive($row['Enabled']));

            $i += 1;
        }

        $result['count'] = $i;

        return $result;
    }

	public function getProductWallet($param)
	{

		$sql = "SELECT * FROM wallet WHERE ProductID = '".$param."' AND Enabled = 1 ORDER BY ID ASC";

		$result = array();
		$i = 1;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));

			$i += 1;
		}
		$result['count'] = $i;

		return $result;
	}

	public function getProductSingleWallet($param)
	{
		$sql = "SELECT * FROM wallet WHERE ProductID = '".$param."' AND MemberID = '".$_SESSION['member']['ID']."' AND Enabled = 1 ORDER BY ID ASC";

		$result = array();
		$i = 1;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result[$i] = array(
			'ID' => $row['ID'],
			'MemberID' => $row['MemberID'],
			'ProductID' => $row['ProductID'],
			'Username' => $row['Username'],
			'Password' => $row['Password'],
			'PIN' => $row['PIN'],
			'Total' => $row['Total'],
			'Enabled' => CRUD::isActive($row['Enabled']));


		}
		$result['count'] = $i;

		return $result;
	}

	public function getWalletTotal()
	{
		$crud = new CRUD();

		$sql = "SELECT Total FROM wallet WHERE ProductID = '21' AND Enabled = '1'";

		$result = $this->dbconnect->query($sql);
		$result = $result->fetchColumn();


		return $result;
	}
        
        public function getMemberWalletTotal($param)
	{
		$crud = new CRUD();

		$sql = "SELECT Total FROM wallet WHERE ProductID = '30' AND Enabled = '1' AND MemberID = '".$param."'";
                //echo $sql;    
		$result = $this->dbconnect->query($sql);
		$result = $result->fetchColumn();
                //Debug::displayArray($result);
                //echo '<pre>';
                //var_dump($result);
                //echo '</pre>';
		return $result;
	}
        
        public function getAdminWalletTotal($productID, $memberID)
	{
		$crud = new CRUD();

		$sql = "SELECT Total FROM wallet WHERE ProductID = '".$productID."' AND MemberID = '".$memberID."' AND Enabled = '1'";

		$result = $this->dbconnect->query($sql);
		$result = $result->fetchColumn();


		return $result;
	}
        
        public function getWalletUsername($MemberID, $ProductID)
	{
		$crud = new CRUD();

		$sql = "SELECT Username FROM wallet WHERE ProductID = '".$ProductID."' AND MemberID = '".$MemberID."' AND Enabled = '1'";

		$result = $this->dbconnect->query($sql);
		$result = $result->fetchColumn();


		return $result;
	}

    public function getWalletAmount($param)
    {
        $sql = "SELECT * FROM wallet WHERE ProductID = '".$param."' AND MemberID = '".$_SESSION['member']['ID']."'";

        $result = array();
        $i = 1;
        foreach ($this->dbconnect->query($sql) as $row)
        {
            $result[$i] = array(
            'ID' => $row['ID'],
            'Total' => $row['Total']);
        }

        return $row['Total'];
    }

	public function AdminExport($param)
	{
		$sql = "SELECT * FROM wallet ".$_SESSION['wallet_'.$param]['query_condition']." ORDER BY ID ASC";

		$result = array();

		$result['filename'] = $this->config['SITE_Total']."_Wallet";
		$result['header'] = $this->config['SITE_Total']." | Wallet (" . date('Y-m-d H:i:s') . ")\n\nID, Member, Member Username, Product, Username, Password, Total, Enabled";
		$result['content'] = '';

		$i = 0;
		foreach ($this->dbconnect->query($sql) as $row)
		{
			$result['content'] .= "\"".$row['ID']."\",";
			$result['content'] .= "\"".MemberModel::getMemberName($row['MemberID'])."\",";
            $result['content'] .= "\"".MemberModel::getMemberUsername($row['MemberID'])."\",";
			$result['content'] .= "\"".ProductModel::getProductName($row['ProductID'])."\",";
			$result['content'] .= "\"".$row['Username']."\",";
			$result['content'] .= "\"".$row['Password']."\",";
			$result['content'] .= "\"".$row['Total']."\",";
			$result['content'] .= "\"".$row['Enabled']."\"\n";

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