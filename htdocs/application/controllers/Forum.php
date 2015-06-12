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
        $this->output->enable_profiler(true);
        //$this->output->enable_profiler(true);
    }
    public function index()
    {
        redirect("Forum/list_cat");
    }

    public function create_cat()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            if (!$this->my_forum->get_category($this->input->post("name"))){

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

        else {
                print "<script type=\"text/javascript\">alert('Error : This categorie exist Please try again');</script>";

            }

        }
        $this->my_forum->template_view("categorie");
    }

    public function create_topic()
    {

        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('mycategorie', 'Mycategorie', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            if (!$this->my_forum->get_topic($this->input->post("subject"))) {
                $cat_id = $this->my_forum->get_category($this->input->post('mycatgorie'));


                //echo "id = ".$this->session->userdata('id')." ";echo  $this->input->post('mycatgorie');
                $a = $this->my_forum->create_topic($this->input->post("subject"),
                    $cat_id[0]['cat_id'],
                    $this->session->userdata('id'));

//apres avoir enregistrer le topic on enregistre le message dans post
                $topic_id = $this->my_forum->get_topic($this->input->post('subject'));
                $b = $this->my_forum->create_post($this->input->post("message"),
                    $topic_id[0]['topic_id'],
                    $this->session->userdata('id'));
                //echo "test3";

                if ($a) {
                    print "<script type=\"text/javascript\">alert('this category has been created');</script>";
                    redirect("Forum/list_topic/".$cat_id[0]['cat_id']);

                } else {
                    print "<script type=\"text/javascript\">alert('Error: this topics exist Please try again');</script>";
                }


            }

            else {
                print "<script type=\"text/javascript\">alert('Error this topic exit Please try again');</script>";

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

        $data['topic'] = $this->my_forum->list_topic($cat, TRUE);

        $data['cat'] = $this->my_forum->list_category($cat, TRUE);

        $this->my_forum->template_view("list_topic", $data);



    }

    public function  post_topic($id_topic)
    {
        $data["tab"] = $this->my_forum->view_post($id_topic);
        $data["topic"] = $this->my_forum->get_topic_post($id_topic);
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $a = $this->my_forum-> create_post($this->input->post("message"),
                $id_topic,
                $this->session->userdata('id'));
            if ($a) {
                print "<script type=\"text/javascript\">alert('this category has been created');</script>";
                redirect("Forum/post_topic/".$id_topic);

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $this->my_forum->template_view("view_topic", $data);

    }


    public function modify_topic($id_topic)
    {
        echo $this->input->post("message");
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('mycategorie', 'Mycategorie', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        $data["messages"] = $this->my_forum->view_post($id_topic);
        if ($this->form_validation->run()) {
echo $this->input->post("subject");//die;
            $cat_id = $this->my_forum->get_category($this->input->post('mycatgorie'));
            //echo "id = ".$this->session->userdata('id')." ";echo  $this->input->post('mycatgorie');
            $a = $this->my_forum->update_topic($id_topic, $this->input->post("subject"),
                $cat_id[0]['cat_id'],
                $this->session->userdata('id'));

            $b = $this->my_forum->update_post($data['messages'][0]['post_id'], $this->input->post("message"),
                $id_topic, $this->session->userdata('id'));
            //echo "test3";

            if ($a && $b) {

                //redirect("Forum/list_topic/".$cat_id[0]['cat_id']);
                print "<script type=\"text/javascript\">alert('this category has been modify');</script>";

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $data["cat"] = $this->my_forum->list_category();

        $data["topic"] = $this->my_forum->get_topic_all($id_topic);


        $this->my_forum->template_view("modify_topic", $data);
    }

    public function delete_topic($id_topic)
    {
        $data = $this->my_forum->get_topic_all($id_topic);
        $a = $this->my_forum->delete_topic($id_topic);
        if ($a)
            redirect("Forum/list_topic/".$data[0]['topic_cat']);
        else {
            print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
        }
    }

    public function modify_cat($id_cat)
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $a = $this->my_forum->update_cat($id_cat, $this->input->post("name"),
                $this->input->post("description"));


            if ($a) {

                redirect("Forum/list_cat");
                print "<script type=\"text/javascript\">alert('this category has been modify');</script>";

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $data = $this->my_forum->list_category($id_cat, TRUE);

        $this->my_forum->template_view("update_cat", $data);
    }

    public function delete_cat($id_cat)
    {

        $a = $this->my_forum->delete_cat($id_cat);
        if ($a)
            redirect("Forum/list_cat");
        else {
            print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
        }
    }

    public function modify_post($id_post)
    {


        $data["post"]= $this->my_forum->get_post($id_post);

        $data["tab"] = $this->my_forum->view_post($data["post"][0]["post_topic"]);
        $data["topic"] = $this->my_forum->get_topic_post($data["post"][0]["post_topic"]);
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {

            $a = $this->my_forum->update_post2($id_post, $this->input->post("message"));


            if ($a) {
                echo "test";
                redirect("Forum/post_topic/".$data["post"][0]["post_topic"]);
                print "<script type=\"text/javascript\">alert('this category has been modify');</script>";
                echo "oui";

            }

            else {
                print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
            }

        }
        $data["cat"] = $this->my_forum->list_category();

        $this->my_forum->template_view("update_post", $data);
    }

    public function delete_post($id_post)
    {

        $data["post"]= $this->my_forum->get_post($id_post);

        $data["tab"] = $this->my_forum->view_post($data["post"][0]["post_topic"]);

        $a = $this->my_forum->delete_post($id_post);
        if ($a)
            redirect("Forum/post_topic/".$data["post"][0]["post_topic"]);
        else {
            print "<script type=\"text/javascript\">alert('Error Please try again');</script>";
        }
    }


}