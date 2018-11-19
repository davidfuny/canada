<?php
$this->load->view('header.php')
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz3b9EpGPYdYCb1wAWx2ZRU7N9uqfQ5WQ&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="<?php echo base_url(); ?>assets/js/address.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/autosize.js"></script>
<style>

    form {
        width: 40%;
        margin-left: 30%;
        margin-top: 70px;
    }
    textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 11px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 20px;
        font-size: 15px;
    }
    @media only screen and (max-device-width: 1069px) {
        form {
            width: 90%;
            margin-left: 5%;
            margin-top: 20px;
        }
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
            <textarea id="autocomplete" placeholder=""
                   onFocus="geolocate()" row="2"></textarea>
        </div>
        <div>
            <label><?= $this->lang->line('apt'); ?></label>
            <input name="apt" type="text" required value="<?php
            echo $apt;
            ?>"></input>
        </div>
        <div>
            <label><?= $this->lang->line('street_adderss'); ?><span class="um-req"
                                                                    title="Required">*</span></label>
            <input  id="street_number" name="load_address" type="text" required
                    value="<?php
                    echo $street;
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
            echo $city;
            ?>"></div>

        <div>
            <label><?= $this->lang->line('province'); ?><span class="um-req" title="Required">*</span></label>
            <input name="province" type="text"
                   id="administrative_area_level_1" required value="<?php
            echo $province;
            ?>">
        </div>
        <div>
            <label><?= $this->lang->line('zip_code'); ?><span class="um-req" title="Required">*</span></label>
            <input id="postal_code" name="zip_code" type="text" value="<?php
            echo $zipcode;
            ?>"></div>

        <div>
            <label><?= $this->lang->line('country'); ?><span class="um-req" title="Required">*</span></label>
            <input id="country" name="country" required type="text"
                   value="<?php
                   echo $country;
                   ?>">
        </div>


    <button type="submit"><?= $this->lang->line('update'); ?></button>
</form>
<?php
$this->load->view('footer.php')
?>
<script type="text/javascript">
    ( function ( document, window, index ) {
        autosize(document.getElementById("autocomplete"));//auto size
    }( document, window, 0 ));
</script>
</body>

</html>
