<?php
require ('header.php')
?>

<div class="mobile_section">
    <div class="imgcontainer">

        <p><img class="police" src="<?php echo base_url(); ?>assets/images/police.png" alt="" ></p>
        <form class='form' action="<?php echo site_url('welcome/show_image') ?>" method="post">
            <div class="container">
                <div class="container">
                    <div class="button_wrap" ">
                    <br>
                    <a style="text-decoration: none;" href="http://new.mefon.ca/download/Outside-China.apk" class="button"><?=$this->lang->line('down_apk');?></a>
                </div>
                <p></p>
                <div class="button_wrap" ">
                <br>
                <a style="text-decoration: none;" href="http://new.mefon.ca/download/Within-China.apk" class="button"><?=$this->lang->line('down_apk_baidu');?></a>
            </div>

            <p></p>
            <div class="button_wrap" ">
            <br>
            <a style="text-decoration: none;" href="<?php echo site_url('welcome/show_image') ?>" class="button"><?=$this->lang->line('show_image');?></a>
    </div>
</div>
</div>

</form>

</div>
</div>

<?php
require ('footer.php')
?>

</body>
</html>

<a style="text-decoration: none;" href="http://new.mefon.ca/download/app-release.apk" class="button"><?=$this->lang->line('down_apk');?></a>