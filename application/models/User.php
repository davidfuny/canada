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
    public function sendmail($data){
//        $this->load->library('encrypt');
        $account=$data['user_name'];
        $to=$data['user_email'];
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.outlook.com';
        $config['smtp_port'] = '587';
        $config['smtp_user'] = 'zzz@outlook.com';
        $config['smtp_pass'] = 'admin1987';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
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

        $from='zzz@outlook.com';
        $this->email->to($to);
        $this->email->from($from, 'Mefon');
        $this->email->subject('Register Mefon');
        $this->email->message($htmlContent);

        //Send email
        if ($this->email->send()) {
          return true;
        } else {
            echo('failed');
        }

    }




}