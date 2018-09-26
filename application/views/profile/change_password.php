<?php
$this->load->view('header.php')
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz3b9EpGPYdYCb1wAWx2ZRU7N9uqfQ5WQ&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="<?php echo base_url(); ?>assets/js/address.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/MeFon – 5G Biometrics Security_files/jquery.js.download"></script>
<style>

    form {
        width: 40%;
        margin-left: 30%;
        margin-top: 90px;
    }
    input{
        float: left;

    }
    #togglePasswordField{
        margin-left: -45px;
        margin-top: 20px;
    }


</style>
<form method="post" onsubmit="return validateForm()" action="<?php echo site_url('welcome/update_password') ?>" enctype="multipart/form-data">
    <?php
    if (isset($status)) {

        if ($status == 'ok') {
            ?>
            <div id='success' style="display: block; color: green" align="center">
                <?php echo $this->lang->line('pass_success'); ?>
            </div>
            <?php
        } else {
            ?>
            <div id='false' style="display: block; color: red" align="center">
                <?php echo $this->lang->line('pass_false'); ?>
            </div>
        <?php }
    }
    ?>

    <h2 align="center" style="padding-bottom: 60px"><?= $this->lang->line('change_password'); ?></h2>



    <div >
        <label ><?=$this->lang->line('password');?><span class="um-req" title="Required">*</span></label>
        <input type="password" id="pass" style="margin-top: 30px;margin-bottom: 30px" name="new_pass"  align="center" onfocusout="pass_validation()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  placeholder="<?=$this->lang->line('pass_rule');?>" required>

    </div>
    <div>
        <label><?=$this->lang->line('confirm_password');?><span >*</span></label>
        <br/>
        <input  type="password" id="confirm" style="margin-top: 30px;margin-bottom: 30px"  name="confirm_user_password" class="input_confirm" align="center" onfocusout="validate()" required>
        <image  id="togglePasswordField" src=" <?php echo base_url(); ?>assets/images/eye.png" width="40" height="60" ></image>
        <p id="pass_error" style="display: none;color: red"><?=$this->lang->line('pass_same');?></p>
        <p id="pass_validation" style="display: none;color: red"><?=$this->lang->line('pass_validation');?></p>
    </div>
    <button type="submit" style="width: 100%"><?= $this->lang->line('update'); ?></button>
</form>
<?php
$this->load->view('footer.php')
?>
</body>
</html>
<script>
    (function() {

        try {
            var passwordField = document.getElementById('pass');
            passwordField.type = 'text';
            passwordField.type = 'password';
            var togglePasswordField = document.getElementById('togglePasswordField');
            togglePasswordField.addEventListener('click', togglePasswordFieldClicked, false);
            togglePasswordField.style.display = 'inline';

        }
        catch(err) {

        }

    })();

    function togglePasswordFieldClicked() {

        var passwordField = document.getElementById('confirm');
        var value = passwordField.value;

        if(passwordField.type == 'password') {
            passwordField.type = 'text';
        }
        else {
            passwordField.type = 'password';
        }

        passwordField.value = value;

        var passwordField1 = document.getElementById('pass');
        var value1 = passwordField1.value;

        if(passwordField1.type == 'password') {
            passwordField1.type = 'text';
        }
        else {
            passwordField1.type = 'password';
        }

        passwordField1.value = value1;


    }


    var myInput = document.getElementById("pass");
    myInput.onfocus = function() {
        document.getElementById("pass_error").style.display = "none";
        document.getElementById("pass_validation").style.display = "none";
    }
    function validate() {
        var x= document.getElementById("pass");
        var y= document.getElementById("confirm");
        var pass_error=document.getElementById("pass_error");
        if(x.value==y.value) {
            pass_error.style.display = "none";return;
        }
        else{pass_error.style.display = "block";}

    }
    function pass_validation(){
        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;
        var myInput = document.getElementById("pass");
        var pass_validation=document.getElementById("pass_validation");
        if(myInput.value.match(lowerCaseLetters)&&myInput.value.match(upperCaseLetters)&&myInput.value.match(numbers)&&myInput.value.length >= 8) {
            pass_validation.style.display = "none";return;
        }
        else{
            pass_validation.style.display = "block";
        }

    }
    function validateForm() {
        var x= document.getElementById("pass");
        var y= document.getElementById("confirm");
        var pass_error=document.getElementById("pass_error");
        if(x.value==y.value) {
            pass_error.style.display = "none";return true;
        }
        else{pass_error.style.display = "block";return false;}

    }




</script>
</script>
