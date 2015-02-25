<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: aemebiku
 * Date: 24/02/15
 * Time: 17:33
 */

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(true);
    }
    public function login(){

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run()){
            if ($this->aauth->login($this->input->post("email"), $this->input->post("password"))) {
                // $this->session->set_flashdata('success', 'You are now logged in.');
                redirect('Home');
            } else {
                redirect('Users/login');
                // $this->load->view('templates/template', $data);

            }
        }
$this->load->view('login');
    }

    public function logout()
    {

        $this->aauth->logout();
        $this->session->set_flashdata('success', 'You are now logged out.');
        redirect("Home");
    }

    function create_user()
    {
        $data['contents'] = 'newuser';
//var_dump($data);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('surname', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('login', 'login', 'required|min_length[5]|max_length[12]|is_unique[aauth_users.name]');//is_unique[aauth_users.name] verifit si le login ou lemail est unique dans la base de donnees
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[aauth_users.email]');

        if ($this->form_validation->run()) {
            $a = $this->aauth->create_user($this->input->post("email"),
                $this->input->post('password'),
                $this->input->post('login'),
                $this->input->post("surname"));

            if ($a) {
                redirect("Home");

            }

        }

        $this->load->view('templates/template', $data);
    }

    public function list_users()
    {
        $this->template->viewdata("list_users", $this->aauth->list_users());
        $this->template->view("Users/list_users");

    }

    public function update_users()
    {
        //update venent du bouton openfile
        if (isset($_POST["update"]) && !empty($_POST["update"])) {
            $id = $_POST["update"];
            $this->tables_model->set('aauth_users');
            $users = $this->tables_model->read_where('*', array('id' => intval($id)));
            $up["up"] = $users[0];
            $this->load->view("Users/update_users");

        }
        //le bouton openfile renvoit un modal bootstrap qui est recuperer par ajax et affiché dans une div

        if (isset($_POST["id_update"]) && !empty($_POST["id_update"])) {
            $id = intval($_POST["id_update"]);
            $email = $this->input->post('email');
            $name = strtolower($this->input->post('name'));
            $surname = strtolower($this->input->post("surname"));

            // var_dump($arr1[1]);
            $pass = substr($name, 0, 3) . "" . substr($surname, 0, 2);
            $name = $this->input->post('name');
            $surname = $this->input->post("surname");

            // $this->tables_model->set('aauth_users');
            $this->aauth->update_user($id, $email, $pass, $name, $surname);
        }

    }

    public function delete_users()
    {
        $this->aauth->delete_user($_POST["empId"]);
    }

}
