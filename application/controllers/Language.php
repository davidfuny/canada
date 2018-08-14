<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 1989726
 * Date: 6/27/2018
 * Time: 1:05 PM
 */

class Language extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        header('Cache-Control:no-cache,must-revalidate,max-age=0');
        header('Cache-Control:post-check=0,pre-check=0',false);
        header('Pragma:no-cache');
        $this->load->library('session');
        if(!(isset($_SESSION["language"]))){
            $_SESSION["language"]='english';
        }
    }
    public function index($lang)

    {
        $_SESSION["language"]=$lang;
        redirect($_SERVER["HTTP_REFERER"]);
//        $url=$this->uri->uri_string();
//        redirect($url,'refresh');
    }

}