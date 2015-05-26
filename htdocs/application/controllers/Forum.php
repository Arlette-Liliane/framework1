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
        $this->load->library('session');
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
                redirect("Forum/list_cat");

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $this->my_forum->template_view("categorie");
    }

    public function create_topic()
    {
        echo "test1";
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('mycategorie', 'Mycategorie', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $cat_id = $this->my_forum->get_category($this->input->post('mycatgorie'));
            //echo "id = ".$this->session->userdata('id')." ";echo  $this->input->post('mycatgorie');
            $a = $this->my_forum->create_topic($this->input->post("subject"),
                $cat_id[0]['cat_id'],
                $this->session->userdata('id'));
            //echo "test3";

            if ($a) {
                print "<script type=\"text/javascript\">alert('this category has been created');</script>";
                redirect("Forum");

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $data = $this->my_forum->list_category();
        $this->my_forum->template_view("topic", $data);
    }

    public function list_cat()
    {
        $data = $this->my_forum->list_category();
        $this->my_forum->template_view("list_cat", $data);



    }

    public function list_topic($cat)
    {

        $data = $this->my_forum->list_topic($cat, TRUE);
        $this->my_forum->template_view("list_topic", $data);



    }

    public function  post_topic($id_topic)
    {
        $data = $this->my_forum->view_post($id_topic);
        $data["name"] = $this->my_forum->get_topic_post($id_topic);
        $this->my_forum->template_view("view_topic", $data);

    }


}