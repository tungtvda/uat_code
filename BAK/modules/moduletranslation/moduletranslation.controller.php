<?php
// Require required controllers
Core::requireController('staff');
Core::requireController('permission');

class ModuleTranslation extends BaseController 
{
	protected $controller_name = "moduletranslation";

	protected function Start()
	{
		// Determines Prefix for Loading Section Model Method
		if ($this->section!='main') {
			$this->prefix = $this->section;
		}

		$model = new ModuleTranslationModel();
		return $model;
	}

	protected function Index() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);

			// Check Access Permission
			Permission::Access($this->controller_name,1);
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
            $this->ReturnView($param, true);
        }
        else if ($this->section=='api')
        {
        }
	}

	protected function View() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
        else if ($this->section=='admin')
        {
        	Helper::redirect404();
        }
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }
		
		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
        $param = $start->$loadModel($this->id);

        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
        }
        else if ($this->section=='api')
        {
        }
	}

	protected function Add() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
	
			// Check Access Permission
			Permission::Access($this->controller_name,2);
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
            $this->ReturnView($param, true);
        }
        else if ($this->section=='api')
        {
        }
	}

	protected function AddProcess()
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
	
			// Validate Genuine Form Submission
            CRUD::validateFormSubmit('1', 'AddFormPost');
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);
				
        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
			$_SESSION['admin']['moduletranslation_add'] = $param['status'];
	        
	        if ($param['status']['ok']=="1") 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/edit/".$param['content_param']['newID']);
			} 
			else 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/add/");
			}
		}
        else if ($this->section=='api')
        {
        }
	}
        
        protected function AjaxTranslateAction()
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
	
			// Validate Genuine Form Submission
            //CRUD::validateFormSubmit('1', 'AddFormPost');
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$this->ReturnView($start->$loadModel($this->id), false);
                
                
                
                //echo $param;
                //exit;
				
	}

	protected function Edit() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
	
			// Check Access Permission
			Permission::Access($this->controller_name,3);
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);
        
        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
	        if ($param['content_param']['count']=="1") 
	        {
	            $this->ReturnView($param, true);
	        }
	        else
	        {
	            Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/index");
	        }
		}
        else if ($this->section=='api')
        {
        }
	}

	protected function EditProcess() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
			
			// Validate Genuine Form Submission
            CRUD::validateFormSubmit('1', 'EditFormPost');
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }
		
		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);
		
        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
			$_SESSION['admin']['moduletranslation_edit'] = $param['status'];
	        
	        if ($param['status']['ok']=="1") 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/edit/".$this->id);
			} 
			else 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/edit/".$this->id);
			}
		}
        else if ($this->section=='api')
        {
        }
	}
        
        protected function AjaxEditProcess() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
			
			// Validate Genuine Form Submission
            CRUD::validateFormSubmit('1', 'EditFormPost');
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }
		
		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);
		
        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
			$_SESSION['admin']['moduletranslation_edit'] = $param['status'];
	        
	        if ($param['status']['ok']=="1") 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/edit/".$this->id);
			} 
			else 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/edit/".$this->id);
			}
		}
        else if ($this->section=='api')
        {
        }
	}
        
         

	protected function Delete() 
	{
        if ($this->section=='main')
        {
        	Helper::redirect404();
        }
		else if ($this->section=='admin')
		{
			// Control Access
			Staff::Access(1);
	
			// Check Access Permission
			Permission::Access($this->controller_name,4);
		}
        else if ($this->section=='api')
        {
        	Helper::redirect404();
        }
        else
        {
            Helper::redirect404();
        }

		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);

        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
			$_SESSION['admin']['moduletranslation_delete'] = $param['status'];
	        
	        if ($param['status']['ok']=="1") 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/index");
			} 
			else 
			{
				Helper::redirect($param['config']['SITE_DIR']."/admin/moduletranslation/index");
			}
        }
        else if ($this->section=='api')
        {
        }
	}
		
	protected function Export() 
	{
        if ($this->section=='main')
        {
            Helper::redirect404();
		}
        else if ($this->section=='admin')
        {
            // Control Access
            Staff::Access(1);

            // Check Access Permission
            Permission::Access($this->controller_name,1);
        }
        else if ($this->section=='api')
        {
            Helper::redirect404();
        }
        else
		{
            Helper::redirect404();
        }
		
		// Load Model
		$start = $this->Start();				
		$loadModel = $this->prefix.__FUNCTION__;
		$param = $start->$loadModel($this->id);
		
        if ($this->section=='main')
        {
        }
        else if ($this->section=='admin')
        {
			Helper::exportCSV($param['content']['header'], $param['content']['content'], $param['content']['filename']);
        }
        else if ($this->section=='api')
        {
        }
	}	
}
?>