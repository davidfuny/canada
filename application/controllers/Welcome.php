<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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
        header('Cache-Control:post-check=0,pre-check=0', false);
        header('Pragma:no-cache');

        $this->load->library('session');
        if (!(isset($_SESSION["language"]))) {
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if ($lang == 'zh') {
                $_SESSION["language"] = 'chinese';
            } else {
                $_SESSION["language"] = 'english';
            }

        }
    }

    public function index($dat = '')

    {
        if ($dat == '') {
            $lang = $_SESSION["language"];
            $this->session->unset_userdata('language');
            if (isset($_SESSION["user_name"])) {
                $this->session->unset_userdata('user_name');
            }

            $_SESSION["language"] = $lang;
            $this->load->view('index.php');
        }
//        if login false
        if ($dat == 'false') {
            $data['message'] = $dat;
            $this->load->view('index.php', $data);
        }
//        if register success
        if ($dat == 'success') {
            $data['register'] = $_SESSION["account_name"];
            $data['email'] = $_SESSION["user_email"];
//            session_destroy();
            $this->load->view('index.php', $data);
        }
        if ($dat == 'email_faild') {
            $data['email_faild'] = $_SESSION["account_name"];
            $data['email'] = $_SESSION["user_email"];
//            session_destroy();
            $this->load->view('index.php', $data);
        }


    }

    public function login()
    {

        if (isset($_SESSION["user_name"])) {
            $this->load->view('user.php');
        } else {
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
                    $this->load->model('user');
                    $results = $this->user->get_user($username);
                    if (!empty($results[0]->language)) {
                        if ($results[0]->language == 'en') {
                            $_SESSION["language"] = 'english';
                            $_SESSION["apt"] = $results[0]->apt;
                            $_SESSION["city"] = $results[0]->city;
                            $_SESSION["load_address"] = $results[0]->load_address;
                            $_SESSION["zip_code"] = $results[0]->zip_code;
                            $_SESSION["country"] = $results[0]->country;
                            $_SESSION["province"] = $results[0]->province;

                        } else {
                            $_SESSION["language"] = 'chinese';
                            $_SESSION["apt"] = $results[0]->apt;
                            $_SESSION["city"] = $results[0]->city;
                            $_SESSION["load_address"] = $results[0]->load_address;
                            $_SESSION["zip_code"] = $results[0]->zip_code;
                            $_SESSION["country"] = $results[0]->country;
                            $_SESSION["province"] = $results[0]->province;

                        }

                    }

                    $this->load->view('user.php');
                } else {
                    $dat = 'false';
                    redirect('/welcome/index/' . $dat);
                    //                header( 'Location: index.php?message=false') ;

                }
            } else {
                redirect('/welcome/index', 'refresh');
            }

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
            if ($var2 == "") {
                $this->load->view('image.php');
            } else {
                $data['someObjects'] = json_decode($var2);
                $this->load->view('image.php', $data);
            }


        } else {
            redirect('/welcome/index', 'refresh');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('/welcome/index/');
    }

    public function change_address()
    {
        if (isset($_SESSION["user_name"])) {
            $this->load->view('profile/change_address.php');
        } else {
            redirect('/welcome/index', 'refresh');
        }

    }

    public function change_password()
    {
        if (isset($_SESSION["user_name"])) {
            $this->load->view('profile/change_password.php');
        } else {
            redirect('/welcome/index', 'refresh');
        }

    }

    public function update_address()
    {
        if (isset($_SESSION["user_name"])) {
            if (isset($_POST["zip_code"])) {
                $this->load->model('user');
                $data['apt'] = $_POST["apt"];
                $data['zip_code'] = $_POST["zip_code"];
                $data['load_address'] = $_POST["load_address"];
                $data['province'] = $_POST["province"];
                $data['country'] = $_POST["country"];
                $data['city'] = $_POST["city"];
                $result = $this->user->update_user($data);
                if ($result) {
                    $_SESSION["apt"] = $data['apt'];
                    $_SESSION["city"] = $data['city'];
                    $_SESSION["load_address"] = $data['load_address'];
                    $_SESSION["zip_code"] = $data['zip_code'];
                    $_SESSION["country"] = $data['country'];
                    $_SESSION["province"] = $data['province'];
                    $status['status'] = 'success';
                    $this->load->view('profile/change_address.php', $status);

                } else {
                    $status['status'] = 'false';
                    $this->load->view('profile/change_address.php', $status);
                }
            } else {
                $this->load->view('profile/change_address.php');
            }


        } else {
            redirect('/welcome/index', 'refresh');
        }

    }

    public function update_password()
    {
        if (isset($_SESSION["user_name"])) {
            if (isset($_POST['new_pass'])) {
                $data_string = $_POST['new_pass'];
                $access_token = $_SESSION["access_token"];
                $refresh_token = $_SESSION["refresh_token"];
                $ch = curl_init('http://mefon.scopeactive.com:8080/uaa/api/account/change-password');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_COOKIE, 'access_token=' . $access_token . ';refresh_token=' . $refresh_token);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization : Basic bWVmb25fYXBwOlA5MDgyMGJiMTc0M2UxMGNlYQ=='));
                //    die($ch);
                $result = curl_exec($ch);
                if ($result == "") {

                    $update['status'] = 'ok';
                    $this->load->view('profile/change_password.php', $update);

                } else {
                    $update['status'] = 'false';
                    $this->load->view('profile/change_password.php', $update);
                }

            }
            else {
                $this->load->view('profile/change_password.php');
            }

         }
        else
        {
        redirect('/welcome/index', 'refresh');
        }

    }
}
