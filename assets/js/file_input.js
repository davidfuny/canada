
    var image_error= document.getElementById("image_error");
    var inputs = document.querySelectorAll( '.inputfile1' );
    var image= document.getElementById("file-1");
    Array.prototype.forEach.call( inputs, function( input )
    {
        input.addEventListener( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();
            var preview = document.getElementById("user_iamge");
            var modal_image = document.getElementById("img01-image");
            if( fileName ){
                var file    = document.querySelector('input[type=file]').files[0];
                var reader  = new FileReader();
                reader.addEventListener("load", function () {
                    preview.src = reader.result;
                }, false);
                if (file) {
                    reader.readAsDataURL(file);
                    // image check
                    reader.onload = function (f) {
                        var user_image = $('#user_iamge');
                        user_image.load(function(){
                            square =300,   //定义画布的大小，也就是图片压缩之后的像素
                                canvas = document.createElement('canvas'),
                                context = canvas.getContext('2d'),
                                imageWidth = 0,    //压缩图片的大小
                                imageHeight = 0,
                                offsetX = 0,
                                offsetY = 0,
                                data = '';

                            canvas.width = square;
                            canvas.height = square;
                            context.clearRect(0, 0, square, square);

                            if (this.width > this.height) {
                                imageWidth = Math.round(square * this.width / this.height);
                                imageHeight = square;
                                offsetX = - Math.round((imageWidth - square) / 2);
                            } else {
                                imageHeight = Math.round(square * this.height / this.width);
                                imageWidth = square;
                                offsetY = - Math.round((imageHeight - square) / 2);
                            }
                            context.drawImage(this, offsetX, offsetY, imageWidth, imageHeight);
                            var data = canvas.toDataURL('image/jpeg',3);
                            var data_image=data.split("base64,")[1];
                            $.ajax({
                                url: "<?php echo site_url('register/send_file/')?>",
                                type: 'POST',
                                data:{
                                    "base64": data_image
                                },
                                dataType: 'json',
                                success: function (data) {
                                    var exist=$.parseJSON(data).result;
                                    alert(exist);
                                },
                                error: function (jqXhr, textStatus, errorMessage) {
                                    alert('error');
                                }
                            });
                            //压缩完成执行回调
                            callback(data);
                        });
                    };
                    reader.onerror = function (error) {
                        console.log('Error: ', error);
                    };
                    // end check image
                    EXIF.getData(file, function() {
                        // alert(EXIF.pretty(this));
                        EXIF.getAllTags(this);
                        var Orientation=EXIF.getTag(this, 'Orientation');

                        if(Orientation==6){

                            preview.classList.add("rotate");
                            modal_image.classList.add("rotate_modal");

                        }
                        else{
                            preview.classList.remove("rotate");
                            modal_image.classList.remove("rotate_modal");
                        }

                        return;


                    })
                }

                image_error.style.display = "none";
            }

            else
                preview.src ="<?php echo base_url(); ?>assets/images/user.png";
            preview.classList.remove("rotate");
            modal_image.classList.remove("rotate_modal");

        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
