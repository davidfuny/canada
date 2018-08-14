<?php
$this->load->view('header.php');
$user_name=$_SESSION["user_name"] ;
?>
<form class='form'>

    <div class="imgcontainer">
        <img src="<?php echo base_url(); ?>assets/images/avartar.png" alt="Avatar" class="avatar">
    </div>

<!--    <div class="container">-->
        <div style="color: red" align="center"> <?php
            if(isset($message)) {
                echo ($message);
            }
            ?></div>
        <label for="uname" style="text-align: center;padding-bottom: 20px"><b><?=$this->lang->line('active_link');?></b></label>



<!--    </div>-->
</form>
<div style="text-align: center"><a href="<?php echo site_url('register/active') ?>" style="text-decoration: none;text-align: center">http://mefon.scopeactive.com:8080/uaa/api/users/<b style="color: red"><?=$user_name?></b>/activate</a></div>
<br>
<div  class="site-footer">

    <div class="textwidget" style="text-align: center;margin: auto"><p>All products and company names are patented worldwide, trademarks <sup>TM</sup> or registered<sup>®</sup> trademarks of MeFon.</p></div></section>


</div>
</body>
</html>