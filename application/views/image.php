<?php
require ('header.php')
?>
<style>
    div.gallery {
        margin-left: 10%;
        margin-top: 5%;
        border: 1px solid #ccc;
        float: left;
        width: 20%;
    }

    div.gallery:hover {
        border: 1px solid #777;
    }

    div.gallery img {
        width: 100%;
        height: 300px;

    }

    div.desc {
        padding: 15px;
        text-align: center;
    }
</style>

                    <?php
                    foreach ($someObjects as $someObject ){?>

                        <div class="gallery">
                            <a  href=<?=$someObject->url?>>
                                <img style="border: 0;" src=<?=$someObject->url?>  width="600" height="400"/>
                            </a>
                            <div class="desc">Add a description of the image here</div>
                        </div>
                        <?php
                    }
                    ?>


<div style="clear: both">

</div>



<?php
require ('footer.php')
?>
</body>
</html>
