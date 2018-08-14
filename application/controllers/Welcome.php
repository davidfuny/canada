<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
	public function index($dat='')

	{
	    if ($dat==''){
            session_destroy();
            $this->load->view('index.php');
        }
//        if login false
        if ($dat=='false'){
	        $data['message']=$dat;
            $this->load->view('index.php',$data);
        }
//        if register success
        if ($dat=='success'){
            $data['register']=$_SESSION["account_name"];
            session_destroy();
            $this->load->view('index.php',$data);
        }


	}
    public function login()
    {

//        if(isset($_SESSION["user_name"])){
//            $this->load->view('user.php');
//        }

            if (isset($_POST['uname'])) {
                $username = $_POST['uname'];
                $pass = $_POST['psw'];
                $data = array("username" => $username, "password" => $pass);
                $data_string = json_encode($data);

                $ch = curl_init('http://mefon.scopeactive.com:8080/auth/login');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization : Basic bWVmb25fYXBwOlA5MDgyMGJiMTc0M2UxMGNlYQ=='));
    //    die($ch);
                $result = curl_exec($ch);
                $sss = json_decode($result);
    //    echo ($result);
                if (isset($sss->{'access_token'})) {
                    $access_token = $sss->{'access_token'};
                    $refresh_token = $sss->{'refresh_token'};
                    $_SESSION["access_token"] = $access_token;
                    $_SESSION["refresh_token"] = $refresh_token;
                    $_SESSION["user_name"] = $username;
                    $this->load->view('user.php');
                } else {
                    $dat='false';
                    redirect('/welcome/index/'.$dat);
    //                header( 'Location: index.php?message=false') ;

                }
            }
        else{
            redirect('/welcome/index', 'refresh');
        }

    }
    public function show_image()
    {
        if (isset($_SESSION["access_token"])) {
            $access_token = $_SESSION["access_token"];
            $refresh_token = $_SESSION["refresh_token"];
            $user_name = $_SESSION["user_name"];

            $ch = curl_init('http://mefon.scopeactive.com:8080/media/api/_search/media?query=ownerName:' . $user_name);
//    $ch = curl_init('http://mefon.scopeactive.com:8080/media/api/_search/media?query=ownerName:hubert');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_COOKIE, 'access_token=' . $access_token . ';refresh_token=' . $refresh_token);
            $results = curl_exec($ch);
            $var2 = (string)$results;
            $data['someObjects'] = json_decode($var2);
            $this->load->view('image.php',$data);
        }
        else{
            redirect('/welcome/index', 'refresh');
        }
    }
    public function logout()
    {
        session_destroy();
        redirect('/welcome/index/');
    }
}
