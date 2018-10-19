<?php
require ('header.php')
?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<style>

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
        width: 400px;
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
            width: 80%;
        }
    }
</style>
<body>

<div class="image-row">
    <div class="image-set">
                    <?php
                    if(isset($someObjects)){
                        $j=0;
                        foreach ($someObjects as $someObject ){
                           $j=$j+1;
                            ?>
                                       <img id="myImg<?=$j?>"  class="example-image example-image-link" src="<?=$someObject->url?>" onclick="show(<?=$j?>)">

                            <?php
                        }}
                    ?>

    </div>
</div>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" >

</div>

    <style>
        .example-image-link:hover {
            background-color: #4ae;
            transition: none; }

        .example-image {
            display: inline-block;
            padding: 2px;
            margin: 50px 70px 25px 70px;
            background-color: #fff;
            line-height: 0;
            border-radius: 4px;
            transition: background-color 0.5s ease-out;
            width: 250px;
            border-radius: 4px; }

        * {
            box-sizing: border-box;
        }


        @media only screen and (max-width: 800px) {
            .example-image{
                width: 140px;
                margin: 20px 0 0 30px;
            }
        }


    </style>

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
        var urlReplace = "#"; // make the hash the id of the modal shown
        history.pushState(null, null, urlReplace); // push state that hash into the url
        $(window).on('popstate', function() {
            modal.style.display = "none";
        });
    }
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        history.back();
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            history.back();
        }
    }
</script>

<?php
require ('footer.php')
?>
</body>
</html>
