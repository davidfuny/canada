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
        margin-top: 20px;
    }

</style>
<form method="post" action="<?php echo site_url('welcome/update_address') ?>" enctype="multipart/form-data">
    <?php
    if (isset($status)) {

        if ($status == 'success') {
            ?>
            <div style="color: red" align="center">
                <?php echo $this->lang->line('address_success'); ?>
            </div>
            <?php
        } else {
            ?>
            <div style="color: red" align="center">
                <?php echo $this->lang->line('address_false'); ?>
            </div>
        <?php }
    }
    ?>


    <div id="locationField">
        <label><?= $this->lang->line('residential'); ?><span class="um-req" title="Required">*</span></label>
        <input id="autocomplete" placeholder=""
               onFocus="geolocate()" type="text"></input>
    </div>
    <div>
        <label><?= $this->lang->line('apt'); ?></label>
        <input name="apt" type="text" required value="<?php
        echo $_SESSION["apt"];
        ?>">
    </div>
    <div>
        <label><?= $this->lang->line('street_adderss'); ?><span class="um-req"
                                                                title="Required">*</span></label>
        <input id="street_number" name="load_address" type="text" required
               value="<?php
               echo $_SESSION["load_address"];
               ?>">
        <input id="route" name="street" hidden value="">
    </div>

    <div>
        <label><?= $this->lang->line('city'); ?><span class="um-req" title="Required">*</span></label>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
        <input id="locality" name="city" type="text"
               required value="<?php
        echo $_SESSION["city"];
        ?>"></div>

    <div>
        <label><?= $this->lang->line('province'); ?><span class="um-req" title="Required">*</span></label>
        <input name="province" type="text"
               id="administrative_area_level_1" required value="<?php
        echo $_SESSION["province"];
        ?>">
    </div>
    <div>
        <label><?= $this->lang->line('zip_code'); ?><span class="um-req" title="Required">*</span></label>
        <input id="postal_code" name="zip_code" type="text" value="<?php
        echo $_SESSION["zip_code"];
        ?>"></div>

    <div>
        <label><?= $this->lang->line('country'); ?><span class="um-req" title="Required">*</span></label>
        <input id="country" name="country" required type="text"
               value="<?php
               echo $_SESSION["country"];
               ?>">
    </div>

    <button type="submit"><?= $this->lang->line('update'); ?></button>
</form>
<?php
$this->load->view('footer.php')
?>
</body>

</html>
