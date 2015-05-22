<?php defined('BASEPATH') OR exit( 'No direct script access allowed' );
/**
 * Created by PhpStorm.
 * User: aemebiku
 * Date: 24/02/15
 * Time: 15:00
 */

class MY_Model extends CI_Model {
    //creation of protected variables
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;

    public function __construct()
    {

        parent::__construct();
        //$this->load->database();
    }

    /**
     * inserts the data contained in the database
     * @param array $option_echap
     * @param $option_non_echap
     * @return bool
     */
    public function create($option_echap = array(), $option_non_echap)
    {
        //audits to insert data
        if (empty($option_echap) AND empty($option_non_echap))
            return false;
        return (bool) $this->db->set($option_echap)
            ->set($option_non_echap, null, false)
            ->insert($this->_table_name);
    }

    /**
     * reads the data contained in the database
     * @param string $select
     * @param array $where
     * @param null $nb
     * @param null $debut
     * @return mixed
     */

    public function read_where($select = array(), $where = array(), $cle = 'id', $tri = 'asc')
    {

        return $this->db->select($select)
            ->from($this->_table_name)
            ->where($where)
            ->order_by($cle, $tri)
            ->get()
            ->result_array();
    }
    public function select($select = array(), $cle = 'id', $tri = 'asc')
    {

        return $this->db->select($select)
            ->from($this->_table_name)

            ->order_by($cle, $tri)
            ->get()
            ->result_array();
    }

    public function read_where_distinct($select = array(), $where = array(), $cle = 'id', $tri = 'asc')
    {

        return $this->db->distinct($select)
            ->from($this->_table_name)
            ->where($where)
            ->order_by($cle, $tri)
            ->get()
            ->result_array();
    }

    public function read_dec($select = '*')
    {

        return $this->db->select($select)
            ->from($this->_table_name)
            ->get()
            ->result_array();
    }

    public function read($select = '*', $cle = 'id', $tri = "asc")
    {

        return $this->db->select($select)
            ->from($this->_table_name)
            ->order_by($cle, $tri)
            ->get()
            ->result_array();
    }

    public function read_where_dist($select = '*', $where)
    {
        $where = "'$where'";
        $query = $this->db->query("SELECT DISTINCT $select
        FROM $this->_table_name
        WHERE mode_diffusion = $where");

        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return NULL;
    }

    public function read_distinct($select = '*', $cle = 'id', $tri = "asc")
    {

        $query = $this->db->query("SELECT DISTINCT $select
        FROM $this->_table_name
        ORDER BY $cle $tri");

        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return NULL;
    }


    /**
     * modifies the data contained in the database
     * @param $where
     * @param array $option_echapp
     * @param array $option_non_echap
     * @return bool
     */

    public function update($where, $option_echapp = array(), $option_non_echap = array())
    {
        //audits to insert data
        if (empty($option_echapp) AND empty($option_non_echapp))
            return false;




        return (bool) $this->db->set($option_echapp)
            ->set($option_non_echap, null, false)
            ->where($where)
            ->update($this->_table_name);
    }

    /**
     * deletes the data contained in the database
     * @param $where
     * @return bool
     */
    public function delete($where)
    {
        //audits to insert data

        $where = array('id' => $where);

        return (bool)$this->db->where($where)
            ->delete($this->_table_name);
    }

    public function delete_status($where = array())
    {
        //audits to insert data



        return (bool)$this->db->where($where)
            ->delete($this->_table_name);
    }
    /**
     * Retrieves the list of all post values.
     * It prevents from using $this->input->post($field) several times.
     *
     * @param $fields
     *
     * @return array|bool
     */
    public function array_from_post( $fields ) {
        if ( !$fields ) {
            return FALSE;
        }

        $data = array();

        foreach ( $fields as $field ) {
            $data[$field] = $this->input->post($field);
        }

        return $data;
    }
}