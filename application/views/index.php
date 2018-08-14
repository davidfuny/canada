<?php
    require ('header.php')
?>
    <div class="mobile_section">
        <div class="imgcontainer">

            <p><img class="police" src="<?php echo base_url(); ?>assets/images/police.png" alt="" ></p>
            <form class='form' action="<?php echo site_url('welcome/login') ?>" method="post">
                <div class="container">
                    <div style="color: red" align="center"> <?php

                        if(isset($message)) {
                            echo $this->lang->line('unvalid_username');
                        }
                        if(isset($register)) {

                            echo ($this->lang->line('your_username').$register);
//
                        }
                        ?></div>

                    <input type="text"  name="uname"  placeholder="<?=$this->lang->line('username');?>" required>


                    <input type="password" name="psw" placeholder="<?=$this->lang->line('password');?>" required>

                    <button type="submit" id="'login"><?=$this->lang->line('login');?></button>


                </div></form>

        </div>
    </div>

<?php
require ('footer.php')
?>
</body>
</html>
