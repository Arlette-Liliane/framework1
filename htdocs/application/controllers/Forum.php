<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: aemebiku
 * Date: 08/05/15
 * Time: 16:36
 */

class Forum extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('My_forum');
        //$this->output->enable_profiler(true);
    }
    public function index()
    {
        $data["contents"] = "Forum";
        $this->load->view('templates/template', $data);
    }

    public function create_cat()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run()) { echo "test";
            $a = $this->my_forum->create_category($this->input->post("name"),
                $this->input->post('description'));
            echo "test2";

            if ($a) {
                print "<script type=\"text/javascript\">alert('this category has been created');</script>";
                redirect("Forum");

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $this->my_forum->template_view("categorie");
    }

    public function create_topic()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run()) { echo "test";
            $a = $this->my_forum->create_category($this->input->post("name"),
                $this->input->post('description'));
            echo "test2";

            if ($a) {
                print "<script type=\"text/javascript\">alert('this category has been created');</script>";
                redirect("Forum");

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $this->my_forum->template_view("categorie");
    }


}