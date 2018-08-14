<?php
require ('header.php')
?>
<div class="mobile_section">
    <div class="imgcontainer">

        <p><img class="police" src="<?php echo base_url(); ?>assets/images/police.png" alt="" ></p>
        <form class='form' action="" method="post">
            <div class="container">
                <div class="container">
                    <?php
                    foreach ($someObjects as $someObject ){?>

                        <div class="image">
                            <img src=<?=$someObject->url?> alt="Avatar" class="avatar">
                        </div>


                        <?php
                    }
                    ?>

                </div>

            </div>



    </div></form>

</div>
</div>

<?php
require ('footer.php')
?>
</body>
</html>
