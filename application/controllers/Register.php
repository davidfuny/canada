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
            $_SESSION["language"]='english';
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
            $street = $_POST['street'];
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
            $user_password = $_POST['user_password'];
            $confirm_user_password = $_POST['confirm_user_password'];
            $user_name=strtolower($nationality.'.'.$last_name.'.'.$first_name.'.'.$post_code.'.'.$country_birth);

//
//          upload profile image


            $file_path='assets/user_images/'.$user_name.'.jpg';
            if(file_exists($file_path)){
                unlink($file_path);
            }
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$file_path)){
                $image_url=str_replace("index.php/","",site_url($file_path));
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
                $_SESSION["user_password"] = $user_password;
                $_SESSION["mobile_number"] = $mobile_number;

                $_SESSION["street"] =$street;
                $_SESSION["province"] = $province;
                $_SESSION["country"] = $country;
                $_SESSION["user_language"] = $language;
                $_SESSION["city"] = $city;
                $_SESSION["nationality"] = $nationality;
                $_SESSION["country_birth"] = $country_birth;
                $_SESSION["post_code"] = $post_code;
                $_SESSION["image_url"] = $image_url;

                $this->load->view('register/validate.php');
            } else {
                echo $response['message'];
            }

        }
//
        else{
            redirect('/register/index', 'refresh');
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
                $data_string = json_encode($data);
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
//    echo ($result);
                if (isset($sss->{'message'})) {
                    session_destroy();
                    $error['register']=$sss->{'message'};
                    $this->load->view('register/index.php',$error);

                } else {
                    $this->load->model('user');
                    $data1['user_name']=$_SESSION["account_name"] ;
                    $data1['first_name']=$_SESSION["first_name"] ;
                    $data1['last_name']=$_SESSION["last_name"];
                    $data1['user_email']=$_SESSION["user_email"];
                    $data1['pass']=$_SESSION["user_password"];
                    $data1['mobile_number']=$_SESSION["mobile_number"];

                    $data1['street']=$_SESSION["street"];
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
                        if($email){
                            $dat='success';
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
    public function send(){
        $this->load->model('user');
        $data['user_name']='tae';
        $data['user_email']='star1987lei@gmail.com';
        $email=$this->user->sendmail($data);
        if($email){
            echo('ok');
        }
//        $body = '<div style="font:12px/20px Arial, Helvetica, sans-serif;">';
//        $body .= 'Name :gfsdfg  <br/>
//
//				 Email :gsdfgsd<br/>
//
//				 Message:</div><br/>';
//
//
//        $from = "yifeili924@outlook.com";    //senders email address
//        $subject = 'Thanks for connecting with us.';  //email subject
//        //config email settings
//        //$config['protocol'] = 'smtp';
//        $config['smtp_crypto'] = 'tls';
//        $config['smtp_host'] = 'smtp.live.com';
//        $config['smtp_port'] = '587';
//        $config['smtp_user'] = $from;
//        $config['smtp_pass'] = 'admin1987';  //sender's password
//        $config['mailtype'] = 'html';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = 'TRUE';
//        $config['newline'] = "\r\n";
//        $config['crlf'] = "\r\n";
//        $receiver='star1987lei@gmail.com';
//        $this->load->library('email', $config);
//        $this->email->initialize($config);
//        //send email
//        $this->email->from('noreply@spwr.com');
//        $this->email->to($receiver);
//        $this->email->subject($subject);
//        $this->email->message($body);
//
//
//
//        if($this->email->send()){
//            echo('ok');
//        }else{
//            echo('false');
//        }
    }
}

