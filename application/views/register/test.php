

<body>
<input type="text" id="test1" name="test1" value="test123" onclick="moveEnd(this);" />
</body>
<script>



    function moveEnd(obj) {
        obj.focus();
        var len = obj.value.length;
        if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character', len);
            sel.collapse();
            sel.select();
        } else if (typeof obj.selectionStart == 'number'
            && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = len;
        }
        document.addEventListener('keydown', function(ev){
            console.log(ev.which);
        });

        var e = new KeyboardEvent('keydown',{'keyCode':69,'which':69});
        console.log(e);
        document.dispatchEvent(e);
    }


</script>