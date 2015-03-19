<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(true);
    }
    public function index()
    {
        $data["contents"] = "about";
        $this->load->view('templates/template', $data);
    }
}
