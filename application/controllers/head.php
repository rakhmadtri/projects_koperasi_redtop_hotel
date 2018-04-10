<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class head extends CI_Controller {

    public function index()
    {
        $this->load->view('header_blank');        
    }

}
