<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 1989726
 * Date: 6/27/2018
 * Time: 11:10 AM
 */

class Register  extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        header('Cache-Control:no-cache,must-revalidate,max-age=0');
        header('Cache-Control:post-check=0,pre-check=0',false);
        header('Pragma:no-cache');
        $this->load->library('session');
        if(!(isset($_SESSION["language"]))){
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if ($lang=='zh'){
                $_SESSION["language"]='chinese';
            }
            else{
                $_SESSION["language"]='english';
            }

        }
    }

    public function index($dat='')
    {

        if ($dat==''){
            $this->load->view('register/index.php');
        }
        if ($dat=='image'){
            $data['image']=$dat;
            $this->load->view('register/index.php',$data);
        }
//
    }
    public function sms()
    {
        if (isset($_POST['mobile_number'])) {
            $mobile_number = $_POST['mobile_number'];

            $zip_code=str_replace(' ', '', $_POST['zip_code']);
            $load_address=$_POST['load_address'];
            $province = $_POST['province'];
            $country = $_POST['country'];
            $language = $_POST['language'];
            $city = $_POST['city'];
            $nationality = $_POST['nationality'];
            $country_birth = $_POST['country_birth'];
            $post_code = $_POST['post_code'];
            $post_code = preg_replace('/\s+/', '', $post_code);

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $user_email = $_POST['user_email'];
            $user_apt = $_POST['apt'];
            $user_password = $_POST['user_password'];
//            $confirm_user_password = $_POST['confirm_user_password'];
            $user_name=strtolower($nationality.'.'.$last_name.'.'.$first_name.'.'.$post_code.'.'.$country_birth);

//
//          upload profile image


            $image_path='assets/user_images/'.$user_name.'.jpg';
            $file_path = iconv("utf-8", "cp936", 'assets/user_images/'.$user_name.'.jpg');

            if(file_exists($file_path)){
                unlink($file_path);
            }
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$file_path)){
                $image_url=str_replace("index.php/","",site_url($image_path));
            }

            $generateUrl = "https://auth.miniorange.com/moas/api/auth/challenge";
            /* The customer Key provided to you */
            $customerKey = "120306";
            /* The customer API Key provided to you */
            $apiKey = "Cnq4LaoXHi5VuPVgPqWAqHsqIQMfMwfO";
            /* Current time in milliseconds since midnight, January 1, 1970 UTC. */
            $currentTimeInMillis = round(microtime(true) * 1000);
            /* Creating the Hash using SHA-512 algorithm */
            $stringToHash = $customerKey . number_format($currentTimeInMillis, 0, '', '') .
                $apiKey;
            $hashValue = hash("sha512", $stringToHash);
            /* The Array containing the request information */
            $jsonRequest = array("customerKey" => $customerKey, "phone" => $mobile_number);
            /* JSON encode the request array to get JSON String */
            $jsonRequestString = json_encode($jsonRequest);
            $customerKeyHeader = "Customer-Key: " . $customerKey;
            $timestampHeader = "Timestamp: " . number_format($currentTimeInMillis, 0, '', ''
                );
            $authorizationHeader = "Authorization: " . $hashValue;
            /* Initialize curl */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
                $customerKeyHeader, $timestampHeader, $authorizationHeader));
            curl_setopt($ch, CURLOPT_URL, $generateUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequestString);
            curl_setopt($ch, CURLOPT_POST, 1);
            /* Calling the rest API */
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                print curl_error($ch);
            } else {
                curl_close($ch);
            }
            /* If a valid response is received, get the JSON response */
            $response = (array)json_decode($result);
            $status = $response['status'];
            if ($status == 'SUCCESS') {
                $_SESSION["txid"] = $response['txId'];
                $_SESSION["account_name"] =$user_name;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["user_email"] = $user_email;
                $_SESSION["user_apt"] = $user_apt;
                $_SESSION["mobile_number"] = $mobile_number;
                $_SESSION["province"] = $province;
                $_SESSION["user_password"] = $user_password;
                $_SESSION["country"] = $country;
                $_SESSION["user_language"] = $language;
                $_SESSION["city"] = $city;
                $_SESSION["nationality"] = $nationality;
                $_SESSION["country_birth"] = $country_birth;
                $_SESSION["post_code"] = $post_code;
                $_SESSION["zip_code"] = $zip_code;
                $_SESSION["load_address"] = $load_address;
                $_SESSION["image_url"] = $image_url;

                $this->load->view('register/validate.php');
            } else {
                echo $response['message'];
            }

        }
//
        else{
//            redirect('/register/index', 'refresh');
            $this->load->view('register/validate.php');
        }

    }

    public function verify()
    {
        if (isset($_POST['sms'])&& isset($_SESSION["txid"])) {
            $sms = $_POST['sms'];

            $validateUrl = "https://auth.miniorange.com/moas/api/auth/validate";
            /* The customer Key provided to you */
            $customerKey = "120306";
            /* The customer API Key provided to you */
            $apiKey = "Cnq4LaoXHi5VuPVgPqWAqHsqIQMfMwfO";
            /* Current time in milliseconds since midnight, January 1, 1970 UTC. */
            $currentTimeInMillis = round(microtime(true) * 1000);
            /* Creating the Hash using SHA-512 algorithm */
            $stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) .
                $apiKey;
            $hashValue = hash("sha512", $stringToHash);
            /* The Array containing the validate information */
            $jsonRequest = array('txId' =>$_SESSION["txid"] ,'token' =>$sms );
            /* JSON encode the request array to get JSON String */
            $jsonRequestString = json_encode($jsonRequest);
            $customerKeyHeader = "Customer-Key: " . $customerKey;
            $timestampHeader = "Timestamp: " . number_format ( $currentTimeInMillis, 0, '', ''
                );
            $authorizationHeader = "Authorization: " . $hashValue;
            /* Initialize curl */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
                $customerKeyHeader,$timestampHeader, $authorizationHeader));
            curl_setopt($ch, CURLOPT_URL, $validateUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequestString);
            curl_setopt($ch, CURLOPT_POST, 1);
            /* Calling the rest API */
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                print curl_error($ch);
            } else {
                curl_close($ch);
            }
            /* If a valid response is received, get the JSON response */
            $response = (array)json_decode($result);
            $status = $response['status'];
            if($status == 'SUCCESS') {
//            send register request to java site
                $data = array("login" => $_SESSION["account_name"], "firstName" => $_SESSION["first_name"], "lastName" =>$_SESSION["last_name"], "email" =>  $_SESSION["user_email"],"password" => $_SESSION["user_password"],"phone" =>  $_SESSION["mobile_number"],"imageUrl" =>$_SESSION["image_url"],"langKey" => $_SESSION["user_language"],"activated"=>"true");
                $data_string = json_encode($data,JSON_UNESCAPED_UNICODE);

                $ch = curl_init('http://mefon.scopeactive.com:8080/uaa/api/register');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization : Basic bWVmb25fYXBwOlA5MDgyMGJiMTc0M2UxMGNlYQ=='));
//    die($ch);
                $result = curl_exec($ch);
                $sss = json_decode($result);
                if (isset($sss->{'message'})) {
                    if ($_SESSION["language"]=='chinese'){
                        $error['register']="用户已存在或者邮件重复使用。";
                    }
                    else{
                        $error['register']="The user exists or the email address has been registered with Mefon";
                    }
//                    session_destroy();

                    $this->load->view('register/index.php',$error);

                } else {
                    $this->load->model('user');
                    $data1['user_name']=$_SESSION["account_name"] ;
                    $data1['first_name']=$_SESSION["first_name"] ;
                    $data1['last_name']=$_SESSION["last_name"];
                    $data1['user_email']=$_SESSION["user_email"];
                    $data1['apt']=$_SESSION["user_apt"];
                    $data1['mobile_number']=$_SESSION["mobile_number"];
                    $data1['zip_code']=$_SESSION["zip_code"];
                    $data1['load_address']=$_SESSION["load_address"];
                    $data1['province']=$_SESSION["province"];
                    $data1['country']=$_SESSION["country"] ;
                    $data1['language']=$_SESSION["user_language"];
                    $data1['city']=$_SESSION["city"] ;
                    $data1['nationality']=$_SESSION["nationality"];
                    $data1['country_birth']=$_SESSION["country_birth"] ;
                    $data1['post_code']=$_SESSION["post_code"];
                    $data1['image_url']=$_SESSION["image_url"];
                    $result=$this->user->add_user($data1);
                    if ($result=='True'){
                        $email=$this->user->sendmail($data1);
//                        send email is success
                        if($email){
                            $dat='success';
                            redirect('/welcome/index/'.$dat);

                        }else{
                            $dat='email_faild';
                            redirect('/welcome/index/'.$dat);
                        }

                    }


                }
            } else {
                $data['message']=$response['message'];
                $this->load->view('register/validate.php',$data);
//                header( 'Location: validate.php?message='.$response['message'] ) ;

            }
        }
        else{
            redirect('/register/index', 'refresh');
        }

    }
    public function sendmail(){
        $account='公司';
        $to='star1987lei@gmail.com';
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.office365.com';
        $config['smtp_port'] = '587';
        $config['smtp_user'] = 'admin@mefon.ca';
        $config['smtp_pass'] = 'M3fon@2018';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";

        $this->email->initialize($config);
        //Email content
        $htmlContent = '<h1>Hi! '.$account.'</h1><p>Thank you for registering with Mefon, please use your userID - '.$account.' to login the website and mobile application. 
        </p>
        <p>
        Thanks & Regards,</p>
        <p>
        Mefon team

        </p>';

        $from='admin@mefon.ca';
        $this->email->to($to);
        $this->email->from($from, 'Mefon');
        $this->email->subject('Register Mefon');
        $this->email->message($htmlContent);

        //Send email
        if ($this->email->send()) {
            echo('ok') ;
        } else {
            echo('false') ;
        }

    }


    public function test()
    {   $string='gdsfg dgsfgdfg gdfg';
        $string1 = str_replace(' ', '', $string);
        echo($string1);


    }
    public function file_send()
    {
        $file_path = iconv("utf-8", "cp936", 'assets/user_images/test.jpg');

        $config['upload_path']          = './assets';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('image'))
        {
           echo('no');
        }
        else
        {
           echo('ok');
        }

    }



}

