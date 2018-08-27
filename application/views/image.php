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
<style>
    /*body {font-family: Arial, Helvetica, sans-serif;}*/

    .image:hover {opacity: 0.7;}

    /* The Modal (background) */

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 500px;
        height: 560px;
        /*width:25%;*/
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>

                    <?php
                    $j=0;
                    foreach ($someObjects as $someObject ){
                       $j=$j+1;
                        ?>

                        <div class="gallery">

                                <img id="myImg<?=$j?>" style="border: 0;" src="<?=$someObject->url?>" onclick="show(<?=$j?>)" class="image" width="600" height="400"/>

                            <div class="desc">Add a description of the image here</div>
                        </div>
                        <?php
                    }
                    ?>


<div style="clear: both">

</div>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" >

</div>

<script>
    // Get the modal
    var modal = document.getElementById('myModal');
    function show(j){
        var id='myImg'+j;
        var img = document.getElementById(id);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = img.src;
    }
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

<?php
require ('footer.php')
?>
</body>
</html>
