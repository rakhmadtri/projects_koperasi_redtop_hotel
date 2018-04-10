<?php 

	class error extends CI_Controller{
		public function __construct() 
	    {
	        parent::__construct(); 
	    } 

	    public function _remap(){
			$this->indexfixer->remap();
		}

		public function index($error){
			$this->output->set_status_header($error);
			$this->load->view("error",array("error" => $error));
		}
	}
?>