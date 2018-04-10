<?php
	// application/core/MY_Exceptions.php
	class MY_Exceptions extends CI_Exceptions {

	    public function show_404($error="404")
	    {
	        $CI =& get_instance();
	        $CI->load->view('error',array("error" => $error.""));
	        echo $CI->output->get_output();
	        exit;
	    }
	}
?>