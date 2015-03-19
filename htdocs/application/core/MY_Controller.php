<?php defined('BASEPATH') OR exit( 'No direct script access allowed' );
/**
 * Created by PhpStorm.
 * User: aemebiku
 * Date: 24/02/15
 * Time: 17:38
 */


class Base_Controller extends CI_Controller
{
    public $logged_user;

    public function __construct()
    {
        parent::__construct();
        if (!$this->aauth->is_loggedin()) {

            redirect('Users/login');

        }
        else{
            redirect('admin');
        }
    }
}