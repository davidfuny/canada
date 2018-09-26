<?php
    require ('header.php')
?>
    <div class="mobile_section">
        <div class="imgcontainer">

            <p><img class="police" src="<?php echo base_url(); ?>assets/images/police.png" alt="" ></p>
            <form class='form' action="<?php echo site_url('welcome/login') ?>" method="post">
                <div class="container">
                     <?php

                        if(isset($message)) {?>
                         <div style="color: red" align="center">
                             <?php
                             echo $this->lang->line('unvalid_username');?></div>
                         <?php
                     }
                        if(isset($register)) {?>
                            <div id="myModal" class="modal" style="display: block">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <br/>
                                        <br/>
                                        <div class="Privacy">
                                            <?php
                                            echo ($this->lang->line('your_username').$register.$this->lang->line('registered_success').$email);?></div>

                                        <button class="close" style="background-color: #00CC00;width: 30%;border-radius: 5%;">OK</button>
                                    </div>
                                </div>

                            </div>

                    <?php
                        }
                        if(isset($email_faild)) {?>
                            <div id="myModal" class="modal" style="display: block">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <br/>
                                        <br/>
                                        <div class="Privacy">
                                            <?php
                                            echo ($this->lang->line('your_username').$email_faild.$this->lang->line('registered_faild').$email.$this->lang->line('write_id'));
                                            ?></div>


                                        <button class="close" style="background-color: #00CC00;width: 30%;border-radius: 5%;">OK</button>
                                    </div>
                                </div>

                            </div>
                    <?php
                        }
                        ?>

                    <input type="text"  name="uname"  placeholder="<?=$this->lang->line('username');?>" required>


                    <input type="password" name="psw" placeholder="<?=$this->lang->line('password');?>" required>

                    <button type="submit" id="'login"><?=$this->lang->line('login');?></button>


                </div></form>

        </div>
    </div>
<!--<div id="myModal" class="modal" style="display: block">-->
<!---->
<!--    <!-- Modal content -->
<!--    <div class="modal-content">-->
<!--        <div class="modal-body">-->
<!--            <br/>-->
<!--            <br/>-->
<!--            <div class="Privacy" >xxxxxxxxxx is registered with Mefon successfully! A notification email has been sent to gdsgsdf@ghg.hbgh</div>-->
<!---->
<!--           <button class="close" style="background-color: #00CC00;width: 30%;border-radius: 5%;">OK</button>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->



<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<style>


    .modal {

        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 200px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        /*overflow: auto; !* Enable scroll if needed *!*/

        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

    }

    /* Modal Content */
    .modal-content {
        background-color:#18dcbf;
        margin: auto;
        border-radius: 4%;
        border: 1px solid #888;
        width: 26%;

        height: 320px;
    }

    /* The Close Button */
    .close {
        font-size: 28px;
        font-weight: bold;

    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .modal-body{
        margin-top: 50px;
        margin-bottom: 50px;
        height: 220px;
        background-color: white;
    }
    .Privacy{    width: 85%;
        margin-left: 7%;
        margin-bottom: 20px;}
</style>
<?php
require ('footer.php')
?>
</body>
</html>
