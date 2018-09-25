<?php
$this->load->view('header.php')
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz3b9EpGPYdYCb1wAWx2ZRU7N9uqfQ5WQ&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="<?php echo base_url(); ?>assets/js/address.js" type="text/javascript"></script>
<style>

    form {
        width: 40%;
        margin-left: 30%;
        margin-top: 90px;
    }


</style>
<form method="post" onsubmit="return validateForm()" action="<?php echo site_url('welcome/update_password') ?>" enctype="multipart/form-data">
    <?php
    if (isset($status)) {

        if ($status == 'ok') {
            ?>
            <div style="color: red" align="center">
                <?php echo $this->lang->line('pass_success'); ?>
            </div>
            <?php
        } else {
            ?>
            <div style="color: red" align="center">
                <?php echo $this->lang->line('pass_false'); ?>
            </div>
        <?php }
    }
    ?>

    <h2 align="center" style="padding-bottom: 60px"><?= $this->lang->line('change_password'); ?></h2>
    <p id="pass_error" style="display: none;color: red"><?=$this->lang->line('wrong_pass');?></p>
    <p id="pass_same" style="display: none;color: red"><?=$this->lang->line('pass_same');?></p>
    <p id="pass_validation" style="display: none;color: red"><?=$this->lang->line('pass_validation');?></p>
    <div>
        <label class="label"><?= $this->lang->line('current_pass'); ?></label>
        <input id='current' name="current" type="password" onfocusout="validate()" required value="" style="margin: 16px 0;">
    </div>
    <div>
        <label class="label"><?= $this->lang->line('new_pass'); ?><span class="um-req" title="Required">*</span></label>
        <input  id='new_pass' name="new_pass" type="password" onfocusout="pass_validation()" required   style="margin: 16px 0;" value="">

    </div>
    <div>
        <label class="label"><?= $this->lang->line('confirm_password'); ?><span class="um-req" title="Required">*</span></label>
        <input id="confirm" name="confirm" type="password" onfocusout="confirm_pass()" required style="margin: 16px 0;" value=""></div>



    <button type="submit" style="width: 100%"><?= $this->lang->line('update'); ?></button>
</form>
<?php
$this->load->view('footer.php')
?>
</body>
</html>
<script>
    var myInput = document.getElementById("current");
    myInput.onfocus = function() {
        document.getElementById("pass_error").style.display = "none";
        document.getElementById("pass_validation").style.display = "none";
        document.getElementById("pass_same").style.display = "none";
    }
    function validate() {

        var x= document.getElementById("current");

        var pass_error=document.getElementById("pass_error");
        if(x.value==<?=$_SESSION["pass"]?>) {
            pass_error.style.display = "none";return;
        }
        else{pass_error.style.display = "block";}

    }
    function confirm_pass() {

        var x= document.getElementById("new_pass");
        var y= document.getElementById("confirm");
        var pass_error=document.getElementById("pass_same");
        if(x.value==y.value) {
            pass_error.style.display = "none";return;
        }
        else{
            pass_error.style.display = "block";}

    }
    function pass_validation(){
        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;
        var myInput = document.getElementById("new_pass");
        var pass_validation=document.getElementById("pass_validation");
        if(myInput.value.match(lowerCaseLetters)&&myInput.value.match(upperCaseLetters)&&myInput.value.match(numbers)&&myInput.value.length >= 8) {
            pass_validation.style.display = "none";return;
        }
        else{
            pass_validation.style.display = "block";
        }

    }
    function validateForm() {
        var pass_same=document.getElementById("pass_same");
        var pass_error=document.getElementById("pass_error");
        var pass_validation=document.getElementById("pass_validation");
        if(pass_same.style.display=="none" && pass_error.style.display=="none" && pass_validation.style.display=="none" ) {
            return true;
        }
        else{return false;}

    }
</script>
