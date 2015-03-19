<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends  CI_Controller{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data["contents"] = "about";
        $this->load->view('templates/template', $data);

    }

    function add_user()
    {

        $a = $this->aauth->create_user($this->input->post("email"),
            $this->input->post('password'),
            $this->input->post('name'),
            $this->input->post("surname"));

        if ($a){
            $reponse = "OK";
            if (isset($_POST['group']))
             $this->aauth->add_member($this->aauth->get_user_id($this->input->post("email")), $this->input->post('group'));
        }

        else
            $reponse= "KO : ". $this->input->post('name'). ' '.$this->input->post("surname"). ' already exist';

        echo json_encode(['reponse' => $reponse]);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */