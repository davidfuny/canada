<?php
$this->load->view('header.php');
?>

<div class="mobile_section">
    <div class="imgcontainer">

        <p><img class="police" src="<?php echo base_url(); ?>assets/images/police.png" alt="" ></p>
        <form class='form' action="<?php echo site_url('register/verify') ?>" method="post">
            <div class="container">
                <div style="color: red" align="center"> <?php
                    if(isset($message)) {
                        echo ($message);
                    }
                    ?></div>
                <label for="uname" id="'user"><b>SMS</b></label>
                <input type="text" placeholder="SMS number" name="sms" required>


                <button type="submit" id="'login"><?=$this->lang->line('verify');?></button>

            </div>
        </form>

    </div>
</div>
<br>
<div  class="site-footer">

    <div class="textwidget" style="text-align: center;margin: auto"><p>All products and company names are patented worldwide, trademarks <sup>TM</sup> or registered<sup>®</sup> trademarks of MeFon.</p></div></section>


</div>
</body>
</html>