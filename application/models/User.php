<?php
/**
 * Created by PhpStorm.
 * User: 1989726
 * Date: 6/27/2018
 * Time: 12:15 PM
 */

class User extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function add_user($data){
        $this->db->insert('user', $data);
        return 'True';

    }
    public function add_image($data){
        $this->db->insert('image', $data);
        return 'True';

    }
    public function get_user($user){
        $query = $this->db->where('user_name', $user)->get('user');
        return $query->result();


    }
    public function update_user($data){
        $query = $this->db->where('user_name', $_SESSION["user_name"])->update('user',$data);

            return true;
    }
    public function sendmail($data){
//        $this->load->library('encrypt');
        $account=$data['user_name'];
        $to=$data['user_email'];
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'postfix';
        $config['smtp_host'] = 'localhost';
        $config['smtp_port'] = '25';
        $config['smtp_user'] = 'admin@mefon.ca';
        $config['smtp_pass'] = 'M3fon@2018';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";

        $this->email->initialize($config);
        if($data['language']=='en'){
            $htmlContent = '<h1>Hi! '.$account.'</h1><p>Thank you for registering with Mefon, please use your userID - '.$account.' to login the website and mobile application. 
        </p>
        <p>
        Thanks & Regards,</p>
        <p>
        Mefon team

        </p>';
        }
        else{
            $htmlContent = '<h1>您好! '.$account.'</h1><p>谢谢您注册Mefon, 请您用 '.$account.' 用户名来登录我们的网站。
        </p>
        <p>
        敬礼</p>
        <p>
        Mefon team

        </p>';
        }
        //Email content


        $from='admin@mefon.ca';
        $this->email->to($to);
        $this->email->from($from, 'Mefon');
        $this->email->subject('Register Mefon');
        $this->email->message($htmlContent);

        //Send email
        if ($this->email->send()) {
          return true;
        } else {
            return false;
        }

    }




}