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
        width: 300px;

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
    #image_link{
        width: 100%;
        margin-left: 5%;
        margin-top: -100px;
        font-size: 16px;
        word-break: break-all;
        color:blue;
    }
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 80%;
        }
        #img01{
            width: 100%;
        }
        #image_link{
            width: 90%;
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
                            <div class="example-image example-image-link">
                                       <img id="myImg<?=$j?>"   src="<?=$someObject->thumbnail?>" onclick="show(<?=$j?>)" data-url="<?=$someObject->thumbnail?>">
                                <p><?=$this->lang->line('citizenship').':  '.$someObject->ownerInfo->citizenship?></p>
                                <p><?=$this->lang->line('first_name').':  '.$someObject->ownerInfo->firstName?></p>
                                <p><?=$this->lang->line('last_name').':  '.$someObject->ownerInfo->lastName?></p>
                                <p><?=$this->lang->line('postal_code').':  '.$someObject->ownerInfo->postalCode?></p>
                                <p><?=$this->lang->line('origin_land').':  '.$someObject->ownerInfo->origin?></p>
                            <?php
                           $xx= empty($someObject->ownerInfo->keywords);
                           if($xx==1){?>
                               <p><?=$this->lang->line('key_words').':  '?></p>
                          <?php }
                          else{?>
                              <p><?=$this->lang->line('key_words').':  '.$someObject->ownerInfo->keywords[0]?></p>
                              <?php
                          }
                            ?>


                            </div>
                            <?php
                        }}
                    ?>

    </div>
</div>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <div class="modal-content">
        <img  id="img01" >
        <p id="image_link"></p>
    </div>


</div>

    <style>
        .example-image-link:hover {
            background-color: #d2d4d6;
            transition: none; }
        .example-image p{
            margin-left: 8px;
            margin-top: 22px;
            margin-bottom: 20px;
            color: #00acf0;
        }
        .example-image img{
            width: 320px;
            margin-left: -2px;
        }
        .example-image {
            display: inline-block;
            padding: 2px;
            margin: 50px 25px 25px 40px;
            background-color: #fff;
            line-height: 0;
            border-radius: 4px;
            transition: background-color 0.5s ease-out;
            width: 320px;
            border-radius: 4px; }

        * {
            box-sizing: border-box;
        }



        @media only screen and (max-width: 800px) {
            .example-image{
                width: 42%;
                margin: 20px 0 0 15px;
            }
            .example-image img{
                width: 103%;
                /*margin-left: -2px;*/
            }.example-image p{
                 margin-left: 10px;
                font-size: 13px;

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
        var link=document.getElementById("image_link");
        modal.style.display = "block";
        var image_url=$("#"+id).data('url');
        modalImg.src = image_url;
        image_url=image_url.split("?")[0];
        link.innerHTML=image_url;
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
