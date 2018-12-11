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
                    <a style="text-decoration: none;" onclick="show_message()" href="http://new.mefon.ca/download/Outside-China.apk" class="button"><?=$this->lang->line('down_apk');?></a>
                </div>
                <p></p>
                <div class="button_wrap" ">
                <br>
                <a style="text-decoration: none;" onclick="show_message()" href="http://new.mefon.ca/download/Within-China.apk" class="button"><?=$this->lang->line('down_apk_baidu');?></a>
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
<div id="myModal" class="modal" style="display: none">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-body">
            <br/>
            <br/>
            <div class="Privacy">
                <?php
                echo($this->lang->line('down_message'));
                ?></div>


            <button class="close" style="background-color: #00CC00;width: 17%;border-radius: 5%;">
                OK
            </button>
        </div>
    </div>

</div>
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

        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */

    }

    /* Modal Content */
    .modal-content {
        background-color: #18dcbf;
        margin: auto;
        border-radius: 4%;
        border: 1px solid #888;
        width: 21%;

        height: 250px;
    }

    @media (max-width: 700px) {
        .modal-content {
            width: 96%;
        }
        #togglePasswordField {

            margin-top: 15px;
        }
    }

    /* The Close Button */
    .close {
        font-size: 20px;
        font-weight: bold;
        margin-left: 42%;

    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-body {
        margin-top: 35px;
        margin-bottom: 50px;
        height:178px;
        background-color: white;
    }

    .Privacy {
        width: 85%;
        margin-left: 7%;
        margin-bottom: 20px;
    }
</style>
<script>
   function show_message(){
       var elem = document.getElementById("myModal");
       elem.style.display = 'block';
       return true;

   }

   var modal = document.getElementById('myModal');
   var span = document.getElementsByClassName("close")[0];
   // When the user clicks on <span> (x), close the modal
   span.onclick = function (){
       modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function (event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }


</script>
