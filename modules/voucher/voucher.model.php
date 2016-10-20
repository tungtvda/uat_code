<?php

// Require required models

Core::requireModel('state');

Core::requireModel('country');

Core::requireModel('bankinfo');

Core::requireModel('product');

Core::requireModel('transaction');

Core::requireModel('agenttype');

Core::requireModel('profile');

Core::requireModel('agentblock');

Core::requireModel('agentpromotion');


class VoucherModel extends BaseModel

{

    private $output = array();

    private $module_name = "Voucher";

    private $module_dir = "modules/voucher/";

    private $module_default_url = "/agent/voucher/index";

    private $module_default_admin_url = "/admin/agent/index";

    private $module_default_agent_url = "/agent/voucher/index";

    private $module_default_agentlist_url = "/agent/agent/agentlist";

    private $module_default_adminlist_url = "/admin/agent/agentlist";

    private $module_default_downline_url = "/agent/agent/downline";

    private $module_default_editindex_url = "/agent/agent/editindex";

    public function __construct()
    {
        parent::__construct();
    }

    public function AgentAccess()
    {
        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "Checking Access..."),
            'secure' => TRUE,
            'meta' => array('active' => "off"));
        return $this->output;
    }


// function show interface list voucher
    public function agentIndex($param)
    {
        // Initialise query conditions
        $query_condition = "";

        $crud = new CRUD();
        // Reset query conditions

        if ($_GET['page'] == "all") {
            $_GET['page'] = "";
            unset($_SESSION['agent_' . __FUNCTION__]);
        }

        // Determine Title

        if (isset($_SESSION['agent_' . __FUNCTION__])) {
            $query_title = "Search Results";
            $search = "on";
        } else {
            $query_title = "All Results";
            $search = "off";
        }
        $demkt = 1;
        if ($_SESSION['agent']['TypeID'] == '2') {
            $dk = "Normal_agent_id = '" . $_SESSION['agent']['ID'] . "'";
        } else {
            $dk = "AgentID = '" . $_SESSION['agent']['ID'] . "'";
        }
        if (isset($_GET['Name']) && $_GET['Name'] != "") {
            $dk .= ' and Name LIKE "%' . mb_strtolower(addslashes(strip_tags($_GET['Name']))) . '%"';
        }
        if (isset($_GET['Code']) && $_GET['Code'] != '') {
            $dk .= ' and  Code LIKE "%' . mb_strtolower(addslashes(strip_tags($_GET['Code']))) . '%"';
        }
        if (isset($_GET['Amount']) && $_GET['Amount'] !== '') {
            $dk .= ' and Amount LIKE "%' . mb_strtolower(addslashes(strip_tags($_GET['Amount']))) . '%"';
        }
        // Prepare Pagination
        $query_count = "SELECT COUNT(*) AS num FROM agent_voucher WHERE " . $dk;
        $total_pages = $this->dbconnect->query($query_count)->fetchColumn();
        $targetpage = $param['config']['SITE_DIR'] . '/agent/voucher/index';
        $limit = 10;
        $stages = 3;
        if (isset($_GET['page'])) {
            $page = addslashes(strip_tags($_GET['page']));
            if ($page > 0) {
            } else {
                $page = 0;
            }
        } else {
            $page = 0;
        }
        if ($page) {
            $start = ($page - 1) * $limit;
        } else {
            $start = 0;
        }
        // Initialize Pagination
        $paginate = $crud->paginate($targetpage, $total_pages, $limit, $stages, $page);
        $sql = "SELECT * FROM agent_voucher WHERE " . $dk . " ORDER BY Id desc";

        $result = array();
        $i = 0;
        foreach ($this->dbconnect->query($sql) as $row) {
            $arr = array(
                'Name_normal_agent' => "",
                'Company' => ""
            );
            $sql_sub = "SELECT * FROM agent WHERE ID = '" . $row['Normal_agent_id'] . "'";
            foreach ($this->dbconnect->query($sql_sub) as $row_sub) {
                $arr = array(
                    'Name_normal_agent' => $row_sub['Name'],
                    'Company' => $row_sub['Company'],
                );
            }
            $sql_pass = "SELECT * FROM agent_voucher_password WHERE Agent_voucher_id = '" . $row['Id'] . "'";
            $i2 = 0;
            foreach ($this->dbconnect->query($sql_pass) as $row_pass) {
                $item = array(
                    'Id_pass'=>$row_pass['ID'],
                    'Password' => $row_pass['Password'],
                    'Status' => $row_pass['Status'],
                    'ID_user'=>$this->returnMember($row_pass['UserId'])['ID'],
                    'Name_user'=>$this->returnMember($row_pass['UserId'])['Name'],
                );
                array_push($result, $row + $arr + $item);
                $i2++;
            }
            $i += 1;
            if ($i2 > 0) {
                $i2 = $i2 - 1;
            }
            $i = $i + $i2;
        }
        $result['count'] = $i;
        $_SESSION['agent']['redirect'] = __FUNCTION__;
        // return list
        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "My Vouchers", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/downline.inc.php'),
            'block' => array('side_nav' => $this->module_dir . 'inc/agent/side_nav.agent.inc.php', 'common' => "false"),
            'breadcrumb' => HTML::getBreadcrumb($this->module_name, $this->module_default_agent_url, "", $this->config, "Voucher"),
            'content' => $result,
            'content_param' => array('count' => $i, 'total_results' => $i, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList()),
            'secure' => TRUE,
            'meta' => array('active' => "on"));
        return $this->output;

    }
//
//    // show interface add voucher (by QSOFT)
    public function agentAdd()
    {
        $sql2 = "SELECT ID, Name FROM agent WHERE Enabled = 1 AND TypeID=2 AND ParentID = '" . $_SESSION['agent']['ID'] . "'";
//        $sql2 = "SELECT * FROM agent WHERE Enabled = 1 AND TypeID=2";
        $result2 = array();
        $arr_parent = array();
        $z = 0;
        foreach ($this->dbconnect->query($sql2) as $row2) {
            $arr_parent[$z] = array('ID' => $row2['ID'], 'Name' => $row2['Name']);
            $z += 1;
        }
        $arr_parent['count'] = $z;

        if ($_GET['apc'] == 'apcg') {
            $breadcrumb = $this->module_default_agentgroup_url;
        } elseif ($_GET['apc'] == 'apci') {
            $breadcrumb = $this->module_default_agentmember_url;
        } else {
            $breadcrumb = $this->module_default_agentmember_url;
        }
        $key_gen = $this->generateRandomCode(10);


        $this->output = array(

            'config' => $this->config,

            'page' => array('title' => "Create Voucher", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/add.inc.php'),

            'block' => array('side_nav' => $this->agent_module_dir . 'inc/agent/side_nav.agent.inc.php', 'common' => "false"),

            'breadcrumb' => HTML::getBreadcrumb($this->module_name, $this->module_default_agent_url,"", $this->config, "Create Voucher"),


            'back' => $_SESSION['agent']['redirect'],

            'content' => $result2,

            'apc' => $_GET['apc'],

            'content_param' => array('agent_list' => $arr_parent, 'code_gen' => $key_gen),

            'form_param' => '',

            'secure' => TRUE,

            'meta' => array('active' => "on"));

        return $this->output;

    }

    public function agentaddvoucherprocess()
    {
        $AgentID = $_SESSION['agent']['ID'];
        $status = 0;
        $Normal_agent_id = $this->checkPostParamSecurity('Normal_agent_id');
        $Name = $this->checkPostParamSecurity('Name');
        $Code = $this->checkPostParamSecurity('Code');
        $Amount = $this->checkPostParamSecurity('Amount');
        $How_many = $this->checkPostParamSecurity('How_many');
        $Description = $this->checkPostParamSecurity('Description');
        $Start_date = $this->checkPostParamSecurity('Start_date');
        if ($Start_date != '') {
            $Start_date = date('Y-m-d', strtotime($Start_date));
        } else {
            $Start_date = date('Y-m-d');
        }
        $End_date = $this->checkPostParamSecurity('End_date');
        if ($End_date != '') {
            $End_date = date('Y-m-d', strtotime($End_date));
        } else {
            $End_date = date('Y-m-d');
        }
        $key = "(AgentID, Normal_agent_id, Name, Code, Amount, How_many, Description, Start_date, End_date, Status_voucher)";

        $value = "('" . $AgentID . "', '" . $Normal_agent_id . "', '" . $Name . "', '" . $Code . "', '" . $Amount . "', '" . $How_many . "', '" . $Description . "', '" . $Start_date . "','" . $End_date . "','" . $status . "')";
        $sql = "INSERT INTO agent_voucher " . $key . " VALUES " . $value;
        $count = $this->dbconnect->exec($sql);
        $newID = $this->dbconnect->lastInsertId();

        if ($How_many > 0) {
            for ($i = 1; $i <= $How_many; $i++) {
                $string_gen = $this->actionGenNumber($newID, $Start_date, $End_date);
                $key = "(Agent_voucher_id, Password)";

                $value = "('" . $newID . "', '" . $string_gen . "')";
                $sql = "INSERT INTO agent_voucher_password " . $key . " VALUES " . $value;
                $this->dbconnect->exec($sql);
            }
        }
        $ok = ($count == 1) ? 1 : "";
        $error = '';
        $dnsStatusMessage = 'Create voucher successfully';
        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "Creating Agent...", 'template' => 'admin.common.tpl.php'),
            'content' => $_POST,
            'content_param' => array('count' => $count, 'newID' => $newID),
            'status' => array('ok' => $ok, 'error' => $error, 'dnsMessage' => $dnsStatusMessage),
            'meta' => array('active' => "on"));
        return $this->output;
    }

    public function agentView($param)
    {
        $id = addslashes(strip_tags($param));

        $sql = "SELECT * FROM agent_voucher WHERE Id = '" . $id . "'";
        $result = array();
        $i = 0;
        foreach ($this->dbconnect->query($sql) as $row) {
            $sql_sub = "SELECT * FROM agent WHERE ID = '" . $row['Normal_agent_id'] . "'";
            $name_nomal = '';
            foreach ($this->dbconnect->query($sql_sub) as $row_sub) {
                $name_nomal = $row_sub['Name'];
            }
            $result[$i] = array(
                'ID' => $row['Id'],
                'AgentID' => $row['AgentID'],
                'Normal_agent_id' => $row['Normal_agent_id'],
                'Name_normal_agent' => $name_nomal,
                'Name' => $row['Name'],
                'Code' => $row['Code'],
                'Amount' => $row['Amount'],
                'How_many' => $row['How_many'],
                'Description' => $row['Description'],
                'Start_date' => $row['Start_date'],
                'End_date' => $row['End_date'],
                'Status' => $row['Status_voucher'],
            );
            $i += 1;
        }
        $result_pass = array();
        $j = 1;
        $sql_pass = "SELECT * FROM agent_voucher_password WHERE Agent_voucher_id = '" . $id . "'";
        foreach ($this->dbconnect->query($sql_pass) as $row_pass) {
            $item = array(
                'stt' => $j,
                'Password' => $row_pass['Password'],
                'User' => $row_pass['UserId'],
                'Status' => $row_pass['Status'],
            );
            array_push($result_pass, $item);
            $j++;
        }

        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => $result[0]['Name'], 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/view.inc.php'),
//            'page' => array('title' => $result[0]['Name'], 'template' => 'common.tpl.php','custom_inc_loc' => $this->module_dir.'inc/agent/add.inc.php'),
            'breadcrumb' => HTML::getBreadcrumb($this->module_name, $this->module_default_url, "", $this->config, $result[0]['Name']),
            'content' => $result,
            'content_param' => array('count' => $i, 'item_pass' => $result_pass),
            'meta' => array('active' => "on"));
        return $this->output;
    }

    public function agentDelete($param)
    {
        $id = addslashes(strip_tags($param));
        $sql = "DELETE FROM agent_voucher WHERE id ='" . $id . "'";
        $count = $this->dbconnect->exec($sql);
        // Set Status
        if (count($count == 1)) {
            $sql = "DELETE FROM agent_voucher_password WHERE Agent_voucher_id ='" . $id . "'";
            $this->dbconnect->exec($sql);
            $ok = 1;
        } else {
            $ok = 0;
        }
        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "Deleting Voucher...", 'template' => 'agent.common.tpl.php'),
            'content_param' => array('count' => $count),
            'status' => array('ok' => $ok, 'error' => ''),
            'meta' => array('active' => "on"));
        return $this->output;

    }

    public function agentAccountSummary($param)
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        if (isset($_GET['Start_date']) && isset($_GET['End_date']) && $_GET['End_date'] != '' && $_GET['Start_date'] != '') {
            $start_date = addslashes(strip_tags($_GET['Start_date']));
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = addslashes(strip_tags($_GET['End_date']));
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            if (isset($_GET['Start_date']) && $_GET['Start_date'] != '') {
                $start_date = addslashes(strip_tags($_GET['Start_date']));
                $end_date = $start_date = date('Y-m-d', strtotime($start_date));
            }
            if (isset($_GET['End_date']) && $_GET['End_date'] != '') {
                $start_date = addslashes(strip_tags($_GET['End_date']));
                $end_date = $start_date = date('Y-m-d', strtotime($start_date));
            }
        }

        if ($_SESSION['agent']['TypeID'] == '2') {
            $dk_nomal = "ID = '" . $_SESSION['agent']['ID'] . "'";
        } else {
            $dk_nomal = "ParentID = '" . $_SESSION['agent']['ID'] . "'";
        }
        $sql_normal = "SELECT ID, Name, Company, Pay FROM agent WHERE " . $dk_nomal . " ORDER BY Id asc ";
        $arr_nomal = array();
        $arr_nomal_id=array();
        array_push($arr_nomal, array('ID'=>0,'Name'=>'All normal agent'));
        foreach ($this->dbconnect->query($sql_normal) as $row_nomal) {
            $item = array(
                'ID' => $row_nomal['ID'],
                'Name' => $row_nomal['Name'] . ' - ' . $row_nomal['ID'] . ' | ' . $row_nomal['Company']
            );
            array_push($arr_nomal, $item);
            array_push($arr_nomal_id,array('Id'=> $row_nomal['ID'], 'Pay'=> $row_nomal['Pay']));
        }

        $id = '';
        if (isset($_GET['Normal_agent_id']) && $_GET['Normal_agent_id'] !=0&& $_GET['Normal_agent_id'] !='') {
            $id  = addslashes(strip_tags($_GET['Normal_agent_id']));
            $arr_nomal_id=array($id);

        }


        $arr_check = array();
        //Total
        $total_card_end = 0;
        $total_active_end = 0;
        $total_used_end = 0;
        $total_suspend_end = 0;
        $total_amount_end = 0;
        $pay_end = 0;
        $balance_end = 0;

        $arr_push = array();
        // Initialise query conditions
        $query_condition = "";
        $crud = new CRUD();
        // Reset query conditions

        if ($_GET['page'] == "all") {
            $_GET['page'] = "";
            unset($_SESSION['agent_' . __FUNCTION__]);
        }
        // Determine Title

        if (isset($_SESSION['agent_' . __FUNCTION__])) {
            $query_title = "Search Results";
            $search = "on";
        } else {
            $query_title = "All Results";
            $search = "off";
        }
//        $query_count = "SELECT COUNT(*) AS num FROM agent_voucher WHERE " . $dk;
        $total_pages = 0;
        $targetpage = $param['config']['SITE_DIR'] . '/agent/voucher/accountSummary';
        $limit = 10;
        $stages = 3;
        if (isset($_GET['page'])) {
            $page = addslashes(strip_tags($_GET['page']));
            if ($page > 0) {
            } else {
                $page = 0;
            }
        } else {
            $page = 0;
        }
        if ($page) {
            $start = ($page - 1) * $limit;
        } else {
            $start = 0;
        }
        // Initialize Pagination
        $paginate = $crud->paginate($targetpage, $total_pages, $limit, $stages, $page);
        foreach($arr_nomal_id as $row_normal)
        {
            $total_amount=0;
            $total_card = 0;
            $total_active = 0;
            $total_used = 0;
            $total_suspend = 0;
            $pay = $row_normal['Pay'];
            $pay_end += $pay;
            $balance = 0;
            $dk = ' Start_date >= "' . $start_date . '" and End_date <="' . $end_date . '" and Normal_agent_id=' . $row_normal['Id'];
            $sql = "SELECT * FROM agent_voucher WHERE " . $dk . " ORDER BY Normal_agent_id asc ";
            $count_check=0;
            foreach ($this->dbconnect->query($sql) as $row) {
                $sql_pass = "SELECT * FROM agent_voucher_password WHERE Agent_voucher_id = '" . $row['Id'] . "'";
                foreach ($this->dbconnect->query($sql_pass) as $row_pass) {
                    $total_card++;
                    if ($row_pass['Status'] == 0) {
                        $total_active++;
                        $total_active_end++;
                    }
                    if ($row_pass['Status'] == 1) {
                        $total_used++;
                        $total_used_end++;
                    }
                    if ($row_pass['Status'] == 2) {
                        $total_suspend++;
                        $total_suspend_end++;
                    }
                }
                $total_amount += $total_card * $row['Amount'];
                $total_card_end += $total_card;


                $sql_sub = "SELECT * FROM agent WHERE ID = '" . $row['Normal_agent_id'] . "'";
                $name = '';
                $company = '';
                foreach ($this->dbconnect->query($sql_sub) as $row_sub) {
                    $name = $row_sub['Name'];
                    $company = $row_sub['Company'];
                    $_SESSION['agent']['Company']=$row_sub['Company'];
                }

                if($start_date==$end_date){
                    $date=$start_date;
                }
                else{
                    $date=$start_date.' - '.$end_date;
                }

                $count_check++;
            }
            $total_amount_end += $total_amount;
            $balance = $total_amount - $pay;
            $balance_end += $balance;
            if($count_check>0)
            {
                $item = array(
                    'Id'=>$row_normal['Id'],
                    'total_card' => $total_card,
                    'total_active' => $total_active,
                    'total_used' => $total_used,
                    'total_suspend' => $total_suspend,
                    'Amount' => $total_amount,
                    'Name' => $row['Name'],
                    'Normal_agent' => $name,
                    'Company' => $company,
                    'Pay' => $pay,
                    'Balance' => $balance
                );
                array_push($arr_push, $item);
            }

        }

        $item_total_end = array(
            'total_card_end' => $total_card_end,
            'total_active_end' => $total_active_end,
            'total_used_end' => $total_used_end,
            'total_suspend_end' => $total_suspend_end,
            'total_amount_end' => $total_amount_end,
            'pay_end' => $pay_end,
            'balance_end' => $balance_end,
        );
        $item_dk=array(
            'Start_date'=>$this->checkGetParamSecurity('Start_date'),
            'End_date'=>$this->checkGetParamSecurity('End_date'),
            'Normal_agent_id'=>$id
        );
//        $arr_push['count'] = count($arr_push);
        $_SESSION['agent']['redirect'] = __FUNCTION__;
        // return list
        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "Account Summary", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/downline.inc.php'),
            'block' => array('side_nav' => $this->module_dir . 'inc/agent/side_nav.agent.inc.php', 'common' => "false"),
//            'page' => array('title' => "Account Summary", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/add.inc.php'), //'transaction_delete' => $_SESSION['admin']['transaction_delete']),
//            'block' => array('side_nav' => $this->module_dir . 'inc/agent/side_nav.agent.inc.php', 'common' => "false"),
            'breadcrumb' => HTML::getBreadcrumb($this->module_name, $this->module_default_agent_url, "", $this->config, " Account Summary"),
            'content' => $arr_push,
            'content_param' => array('dr_find'=>$item_dk,'total_end' => $item_total_end, 'count' => count($arr_push), 'total_results' => count($arr_push), 'paginate' => $paginate, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList(), 'agent_list' => $arr_nomal),
            'secure' => TRUE,
            'meta' => array('active' => "on"));
        return $this->output;

    }

    function agentDownline($param)
    {
        if (isset($_SESSION['agent_' . __FUNCTION__])) {
            $query_title = "Search Results";
            $search = "on";
        } else {
            $query_title = "All Results";
            $search = "off";
        }
        $crud = new CRUD();
        $dk = "Normal_agent_id!=0 AND 	AgentID = '" . $_SESSION['agent']['ID'] . "'";
        $query_count = "SELECT COUNT(*) AS num FROM agent_voucher WHERE " . $dk;
        $total_pages = $this->dbconnect->query($query_count)->fetchColumn();
        $targetpage = $param['config']['SITE_DIR'] . '/agent/voucher/accountSummary';
        $limit = 30;
        $stages = 3;
        if (isset($_GET['page'])) {
            $page = addslashes(strip_tags($_GET['page']));
            if ($page > 0) {
            } else {
                $page = 0;
            }
        } else {
            $page = 0;
        }
        if ($page) {
            $start = ($page - 1) * $limit;
        } else {
            $start = 0;
        }
        $arr_push = array();
        // Initialize Pagination
        $paginate = $crud->paginate($targetpage, $total_pages, $limit, $stages, $page);
        $sql = "SELECT * FROM agent_voucher WHERE " . $dk . " ORDER BY Id asc LIMIT $start, $limit";

        foreach ($this->dbconnect->query($sql) as $row) {
            $sql_sub = "SELECT * FROM agent WHERE ID = '" . $row['Normal_agent_id'] . "'";
            $company = '';
            $name_normal = '';
            foreach ($this->dbconnect->query($sql_sub) as $row_sub) {
                $company = $row_sub['Company'];
                $name_normal = $row_sub['Name'];
            }
            $item = array(
                'Id' => $row['Id'],
                'Name' => $row['Name'],
                'Code' => $row['Code'],
                'Amount' => $row['Amount'],
                'Status' => $row['Status'],
                'name_normal' => $name_normal,
                'company' => $company,
            );
            array_push($arr_push, $item);
        }

        $this->output = array(
            'config' => $this->config,
            'page' => array('title' => "Downline Agents", 'template' => 'agent.common.tpl.php', 'custom_inc' => 'on', 'custom_inc_loc' => $this->module_dir . 'inc/agent/downline.inc.php'),
            'block' => array('side_nav' => $this->module_dir . 'inc/agent/side_nav.agent.inc.php', 'common' => "false"),
            'breadcrumb' => HTML::getBreadcrumb($this->module_name, $this->module_default_agent_url, "", $this->config, "Downline Agents"),
            'content' => $arr_push,
            'content_param' => array('count' => count($arr_push), 'total_results' => $total_pages, 'paginate' => $paginate, 'query_title' => $query_title, 'search' => $search, 'enabled_list' => CRUD::getActiveList()),
            'secure' => TRUE,
            'meta' => array('active' => "on"));
        return $this->output;
    }
    public function agentStatus(){
        $id=$this->checkGetParamSecurity('id');
        $value=$this->checkGetParamSecurity('value');
        if($id==''||$value=='')
        {
            return 0;
        }
        $sqltoken = "UPDATE agent_voucher_password SET Status =$value WHERE ID = ".$id;
        $count = $this->dbconnect->exec($sqltoken);
        if($count>0){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function agentPay(){
        $id=$this->checkGetParamSecurity('id');
        $value=$this->checkGetParamSecurity('value');
        $value_old=$this->checkGetParamSecurity('value_old');
        $value_amount=$this->checkGetParamSecurity('value_amount');
        $total_amount=$this->checkGetParamSecurity('total_amount');
        $total_pay=$this->checkGetParamSecurity('total_pay');
        $pay=$total_pay+($value-$value_old);
        if($id==''||$value=='')
        {
            return 0;
        }
        $sqltoken = "UPDATE agent SET Pay =$value WHERE ID = ".$id;
        $count = $this->dbconnect->exec($sqltoken);
        if($count>0){
            $item=array(
                'value'=>number_format($value, 2, '.',','),
                'value_amount'=>number_format($value_amount, 2, '.',','),
                'balance'=>number_format($value_amount-$value, 2, '.',','),
                'total_pay_format'=>number_format($pay, 2, '.',','),
                'total_pay'=>$pay,
                'total_balance_format'=>number_format($total_amount-$pay, 2, '.',','),

            );
            return json_encode($item);

        }
        else{
            return '';
        }
    }


    public function actionGenNumber($id, $start_date, $end_date)
    {
        $num = $id . str_pad(mt_rand(1, 99999999), 16, '0', STR_PAD_LEFT) . $id . str_pad(mt_rand(1, 99999999), 16, '0', STR_PAD_LEFT) . $start_date . $id . $end_date;
        $str = md5($num);
        $str_gen = preg_replace('/[^0-9]/', '', $str);
        $str_gen = substr($str_gen, 0, 16);

        $query_count = "SELECT COUNT(*) AS num FROM agent_voucher_password WHERE Agent_voucher_id = " . $id . " AND 	Password='" . $str_gen . "'";
        $total_pages = $this->dbconnect->query($query_count)->fetchColumn();
        if ($total_pages == 0) {
            return $str_gen;
        } else {
            return $this->actionGenNumber();
        }
    }

    function generateRandomCode($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength -1)];
        }
        $query_count = "SELECT COUNT(*) AS num FROM agent_voucher WHERE 	Code='" . $randomString . "'";
        $total_pages = $this->dbconnect->query($query_count)->fetchColumn();
        if ($total_pages == 0) {
            return $randomString;
        } else {
            return $this->generateRandomCode(10);
        }
    }

// function check param
    function checkPostParamSecurity($param)
    {
        if (isset($_POST[$param])) {
            return addslashes(strip_tags($_POST[$param]));
        } else {
            return false;
        }

    }
    function checkGetParamSecurity($param)
    {
        if (isset($_GET[$param])) {
            return addslashes(strip_tags($_GET[$param]));
        } else {
            return '';
        }

    }
    function returnMember($id){
        $sql_pass = "SELECT * FROM member WHERE ID = '" . $id . "'";
        $arr_member=array(
            'ID'=>'',
            'Name'=>''
        );
        foreach ($this->dbconnect->query($sql_pass) as $row_pass) {
            $arr_member=array(
                'ID'=>$row_pass['ID'],
                'Name'=>$row_pass['Name']
            );
        }
        return  $arr_member;
    }


}

?>