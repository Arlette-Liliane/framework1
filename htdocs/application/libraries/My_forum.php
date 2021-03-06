<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_forum {

    /**
     * The CodeIgniter object variable
     * @var object
     */
    public $CI;


    /**
     * Constructor
     */
    public function __construct() {
        // get main CI object
        $this->CI = & get_instance();
        // Dependancies
        $this->CI->load->library('session');
        $this->CI->load->library('email');
        $this->CI->load->database();
        $this->CI->load->helper('url');
        $this->CI->load->helper('string');
        $this->CI->load->helper('email');
        $this->CI->load->helper('language');
        $this->CI->lang->load('aauth');
    }

    /**
     * view de la page
     * @param $name
     */

    public function template_view($name, $table = NULL)
    {
        $data["info"] = $table;
        $data["contents"] = $name;
        $this->CI->load->view('templates/template', $data);
    }

    ########################
    # Forum Functions
    ########################

    public function create_category($name, $description) {

        $valid = true;

        if (!$valid) {
            return false; }

        $data = array(
            'cat_name' => $name,
            'cat_description' => $description, // Password cannot be blank but user_id required for salt, setting bad password for no
        );

        if ( $this->CI->db->insert("categories", $data ))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * list category
     * @param bool $limit
     * @param bool $offset
     * @return mixed
     */
    public function list_category($id = 0, $where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("categories");
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('cat_id', $id);

        $query = $this->CI->db->get();

        return $query->result_array();
    }

    public function get_category($where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('cat_id')
            ->from("categories");
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('cat_name', $where);

        $query = $this->CI->db->get();

        return $query->result_array();
    }

    //tested
    /**
     * create topic
     * @param $t_subj
     * @param $t_date
     * @param $t_cat
     * @param $t_by
     * @return bool
     */
    public function create_topic($t_subj, $t_cat, $t_by) {

        $valid = true;

        if (!$valid) {
            return false; }
        $data = array(
            'topic_subject' => $t_subj,
            'topic_date' => date("Y-m-d H:i:s"),
            'topic_cat' => $t_cat,
            'topic_by' => $t_by
        );

        if ( $this->CI->db->insert("topics", $data ))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * create Post
     * @param $p_content
     * @param $p_topic
     * @param $p_by
     * @return bool
     */
    public function create_post($p_content, $p_topic, $p_by ) {

        $valid = true;

        if (!$valid) {
            return false; }

        $data = array(
            'post_content' => $p_content,
            'post_date' => date("Y-m-d H:i:s"),
            'post_topic' => $p_topic,
            'post_by' => $p_by
        );

        if ( $this->CI->db->insert("posts", $data ))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * list Topic
     * @param int $cat_id
     * @param bool $where
     * @param bool $limit
     * @param bool $offset
     * @return mixed
     */

    public function list_topic($cat_id = 0, $where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("topics");
        if ($where)
            $this->CI->db->where('topic_cat', $cat_id);
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('topic_cat', $cat_id);

        $query = $this->CI->db->get();

        return $query->result_array();

    }



    public function get_topic_post($id = FALSE) {



        $query = $this->CI->db->where('topic_id', $id);
        $query = $this->CI->db->get('topics');

        if ($query->num_rows() <= 0){
            $this->error($this->CI->lang->line('no_user'));
            return FALSE;
        }
        return $query->row();
    }

    public function get_topic($where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('topic_id')
            ->from("topics");
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('topic_subject', $where);

        $query = $this->CI->db->get();

        return $query->result_array();
    }

    public function get_topic_all($where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("topics");
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('topic_id', $where);

        $query = $this->CI->db->get();

        return $query->result_array();
    }

    public function get_post($where = FALSE, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("posts");
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }
        if ($where)
            $this->CI->db->where('post_id', $where);

        $query = $this->CI->db->get();

        return $query->result_array();
    }


    /**
     * view topics created
     * @param $id_topic
     * @param bool $limit
     * @param bool $offset
     * @return mixed
     */

    public function view_topic($id_topic, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("topics")
            ->where('topic_id', $id_topic);
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }



        $query = $this->CI->db->get();

        return $query->result_array();

    }

    public function view_post($id_topic, $limit = FALSE, $offset = FALSE) {

        // if group_par is given

        $this->CI->db->select('*')
            ->from("posts")
            ->join('aauth_users', 'posts.post_by = aauth_users.id')
            ->where('post_topic', $id_topic);
        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->CI->db->limit($limit);
            else
                $this->CI->db->limit($limit, $offset);
        }



        $query = $this->CI->db->get();

        return $query->result_array();

    }

    public function update_topic($id_topic, $subj, $topic_cat, $by) {

        // if group_par is given

        $data['topic_date'] = date("Y-m-d H:i:s");
        $data['topic_subject'] = $subj;
        $data["topic_cat"] = $topic_cat;
        $data["topic_by"] = $by;

        $query = $this->CI->db->where('topic_id',$id_topic);
        return $this->CI->db->update('topics', $data);

    }

    public function update_post($id_post, $subj, $topic_cat, $by) {

        // if group_par is given

        $data['post_date'] = date("Y-m-d H:i:s");
        $data['post_content'] = $subj;
        $data["post_topic"] = $topic_cat;
        $data["post_by"] = $by;
        //modifit ou les valeurs ou le id du post est egale
        $query = $this->CI->db->where('post_id',$id_post);
        return $this->CI->db->update('posts', $data);

    }


    public function delete_topic($id)
    {
        $this->CI->db->where('topic_id', $id);
        return $this->CI->db->delete('topics');
    }



    public function update_cat($id_cat, $subj, $description) {

        // if group_par is given


        $data['cat_description'] = $description;
        $data["cat_name"] = $subj;

        //modifit ou les valeurs ou le id du post est egale
        $query = $this->CI->db->where('cat_id',$id_cat);
        return $this->CI->db->update('categories', $data);

    }

    public function delete_cat($id)
    {
        $this->CI->db->where('cat_id', $id);
        return $this->CI->db->delete('categories');
    }

    public function update_post2($id_post, $subj) {

        // if group_par is given

        $data['post_date'] = date("Y-m-d H:i:s");
        $data['post_content'] = $subj;

        //modifit ou les valeurs ou le id du post est egale
        $query = $this->CI->db->where('post_id',$id_post);
        return $this->CI->db->update('posts', $data);

    }

    public function delete_post($id)
    {
        $this->CI->db->where('post_id', $id);
        return $this->CI->db->delete('posts');
    }
}


