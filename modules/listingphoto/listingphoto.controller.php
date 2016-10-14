<?php
// Require required controllers
Core::requireController('staff');
Core::requireController('permission');

class ListingPhoto extends BaseController
{
	protected $controller_name = "listingphoto";

	protected function Start()
	{
		// Determines Prefix for Loading Section Model Method
		if ($this->section!='main') {
			$this->prefix = $this->section;
		}

		$model = new ListingPhotoModel();
		return $model;
	}

	protected function Index()
	{
		if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);

			// Check Access Permission
			Permission::Access($this->controller_name,1);
		}

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$this->ReturnView($start->$loadModel($this->id), true);
	}

	protected function View()
	{
		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($param['content_param']['count']=="1")
        {
            $this->ReturnView($param, true);
        }
        else
        {
            Helper::redirect404();
        }
	}

	protected function Add()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		Permission::Access($this->controller_name,2);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$this->ReturnView($start->$loadModel(), true);
	}

	protected function AddProcess()
	{
		// Control Access
		Staff::Access(1);

		// Validate Genuine Form Submission
		CRUD::validateFormSubmit('Add');

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_add'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/edit/".$param['content_param']['newID']);
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/add/");
		}
	}

	protected function Edit()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		Permission::Access($this->controller_name,3);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($param['content_param']['count']=="1")
        {
            $this->ReturnView($param, true);
        }
        else
        {
            Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/index");
        }
	}

	protected function EditProcess()
	{
		// Control Access
		Staff::Access(1);

		// Validate Genuine Form Submission
		CRUD::validateFormSubmit('Update');

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_edit'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/edit/".$this->id);
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/edit/".$this->id);
		}
	}

	protected function Delete()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		#Permission::Access($this->controller_name,4);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_delete'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/index");
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/index");
		}

	}

	protected function ListingIndex()
	{
		if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);

			// Check Access Permission
			Permission::Access($this->controller_name,1);
		}

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$this->ReturnView($start->$loadModel($this->id), true);
	}

	protected function ListingAdd()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		Permission::Access($this->controller_name,2);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$this->ReturnView($start->$loadModel(), true);
	}

	protected function ListingAddProcess()
	{
		// Control Access
		Staff::Access(1);

		// Validate Genuine Form Submission
		CRUD::validateFormSubmit('Add');

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_listingadd'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingedit/".$param['parent']['id'].",".$param['content_param']['newID']);
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingadd/");
		}
	}

	protected function ListingEdit()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		Permission::Access($this->controller_name,3);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($param['content_param']['count']=="1")
        {
            $this->ReturnView($param, true);
        }
        else
        {
            Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingindex/".$param['parent']['id']);
        }
	}

	protected function ListingEditProcess()
	{
		// Control Access
		Staff::Access(1);

		// Validate Genuine Form Submission
		CRUD::validateFormSubmit('Update');

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_listingedit'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingedit/".$param['parent']['id'].",".$param['current']['id']);
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingedit/".$param['parent']['id'].",".$param['current']['id']);
		}
	}

	protected function ListingDelete()
	{
		// Control Access
		Staff::Access(1);

		// Check Access Permission
		#Permission::Access($this->controller_name,4);

		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		$_SESSION['admin']['listingphoto_listingdelete'] = $param['status'];

        if ($param['status']['ok']=="1")
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingindex/".$param['parent']['id']);
		}
		else
		{
			Helper::redirect($param['config']['SITE_URL']."/admin/listingphoto/listingindex/".$param['parent']['id']);
		}

	}

	protected function Sort()
    {
        // Control Access
        Staff::Access(1);

        // Load Model
        $start = $this->Start();
        $loadModel = $this->prefix.__FUNCTION__;
        $param = $start->$loadModel($this->id);
    }

	protected function Position()
    {
        // Control Access
        Staff::Access(1);

        // Load Model
        $start = $this->Start();
        $loadModel = $this->prefix.__FUNCTION__;
        $param = $start->$loadModel($this->id);

        echo $param;
    }

	protected function Export()
	{
		// Load Model
		$start = $this->Start();
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

		Helper::exportCSV($param['content']['header'], $param['content']['content'], $param['content']['filename']);
	}
}
?>