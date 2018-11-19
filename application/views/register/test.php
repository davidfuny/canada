
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<body>
<p><label>input: <input type="text" name="foo" id="input" value="" /></label></p>

<p>
    <button class="keydown" data-code="13">Trigger keydown Enter</button>
    <button class="keypress" data-code="13">Trigger keypress Enter</button>
    <button class="keyup" data-code="13">Trigger keyup Enter</button>
</p>

<p>
    <button class="keydown" data-code="65">Trigger keydown 'a'</button>
    <button class="keypress" data-code="65">Trigger keypress 'a'</button>
    <button class="keyup" data-code="65">Trigger keyup 'a'</button>
</p>

<hr />

<div id="console"></div>
</body>
<script>
    console.d = function(log){
        $('#console').text(log);
    }

    var callback = function(e){
        console.log(e.type, e);
        var text = e.type;
        var code = e.which ? e.which : e.keyCode;
        if(13 === code){
            text += ': ENTER';
        } else {
            text += ': keycode '+code;
        }
        console.d(text);
    };

    $('#input').keydown(callback);
    $('#input').keypress(callback);
    $('#input').keyup(callback);

    $('.keydown').click(function(e){
        $('#input').focus();
        var code = $(this).data('code');
        $('#input').trigger(
            jQuery.Event( 'keydown', { keyCode: code, which: code } )
        );
    });

    $('.keypress').click(function(e){
        $('#input').focus();
        var code = $(this).data('code');
        $('#input').trigger(
            jQuery.Event( 'keypress', { keyCode: code, which: code })
        );
    });
    $('.keyup').click(function(e){
        $('#input').focus();
        var code = $(this).data('code');
        $('#input').trigger(
            jQuery.Event( 'keyup', { keyCode: code, which: code })
        );
    });

</script>