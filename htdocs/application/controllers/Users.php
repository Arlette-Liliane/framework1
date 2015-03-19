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
                redirect("Users/login");

            }

        }

        $this->load->view('templates/template', $data);
    }

    public function list_users()
    {
       $data['list_user'] = $this->aauth->list_users();
        $data['contents'] = 'list_users';
        $this->load->view("templates/template", $data);

    }

    public function profile()
    {
        $data['pro'] = $this->aauth->get_user();
        $data['contents'] = 'profile';
        $this->load->view("templates/template", $data);

    }

    public function update_users()
    {

        //le bouton openfile renvoit un modal bootstrap qui est recuperer par ajax et affiché dans une div
        if (isset($_POST["update"]) && !empty($_POST["update"]))
        {
            $id = $_POST["update"];

            $data['up'] = $this->aauth->get_user($id);
            $data['gr'] = $this->aauth->get_user_groups($id);
            $this->load->view("update_user", $data);

        }
        else{
            $id = $_POST['id'];
            $email = $this->input->post('email');
            $name = htmlentities($this->input->post('name'));
            $surname = htmlentities($this->input->post("surname"));


            // $this->tables_model->set('aauth_users');
            //echo $_POST["pass"];
            if (isset($_POST["pass"])){
                echo "no";

                $this->aauth->update_user($id, $email, $_POST["pass"], $name, $surname);
                if (isset($_POST['groups']))
                    $this->aauth->add_member($id, $this->input->post('groups'));

            }

            else{
                echo "yes";

                $this->aauth->update_user($id, $email, $name, $surname);
                if (isset($_POST['groups']))
                    $this->aauth->add_member($id, $this->input->post('groups'));
            }


        }


    }

    public function delete_users()
    {
        $this->aauth->delete_user($_POST["empId"]);
    }



}
