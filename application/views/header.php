<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/police.png">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php
$user_language=$_SESSION["language"];
$this->lang->load('content',$user_language);

?>
<ul>
    <div class="nav_bar">
        <div class="wrapper">
            <div class="logo">
                <a href=""><img src="<?php echo base_url(); ?>assets/images/logo.png"></a>
            </div>

            <div class="nav">

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn"><img src="<?= base_url('assets/images/'.$user_language.'.png'); ?>" alt="">&nbsp;<?=$this->lang->line('lang');?></a>
                    <div class="dropdown-content">
                        <a href="<?php echo site_url('language/index/english') ?>"><img src="<?= base_url('assets/images/english.png'); ?>" alt=""> &nbsp;  <?=$this->lang->line('english');?></a>
                        <a href="<?php echo site_url('language/index/chinese') ?>"><img src="<?= base_url('assets/images/chinese.png'); ?>" alt="">   &nbsp; <?=$this->lang->line('chines');?></a>

                    </div>
                </li>
                <?php
                if (isset($_SESSION["user_name"])){?>
                    <li><a href="<?php echo site_url('welcome/logout') ?>"><?=$this->lang->line('logout');?></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><?=$this->lang->line('profile');?></a>
                        <div class="dropdown-content">
                            <a href="<?php echo site_url('welcome/change_address') ?>"><?=$this->lang->line('change_address');?></a>
                            <a href="<?php echo site_url('welcome/change_password') ?>"><?=$this->lang->line('change_password');?></a>

                        </div>
                    </li>
                <?php }
                else{?>
                    <li><a href="<?php echo site_url('welcome/') ?>"><?=$this->lang->line('login');?></a></li>
                    <li><a href="<?php echo site_url('register/') ?>"><?=$this->lang->line('register');?></a></li>
                <?php }
                ?>

                <li><a href="<?php echo site_url('welcome/') ?>"><?=$this->lang->line('home');?></a></li>
            </div>


        </div>
    </div>
</ul>
