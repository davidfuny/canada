<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }



        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }
        li{
            display: none;
        }
    </style>

</head>
<body>

<h2>My Phonebook</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

<ul id="myUL">
    <li ><a href="#" onclick="select(this)">Adele</a></li>
    <li><a href="#" onclick="select(this)">Agnes</a></li>

    <li><a href="#" onclick="select(this)">Billy</a></li>
    <li><a href="#" onclick="select(this)">Bob</a></li>

    <li><a href="#" onclick="select(this)">Calvin</a></li>
    <li><a href="#" onclick="select(this)">Christina</a></li>
    <li><a href="#" onclick="select(this)">Cindy</a></li>
</ul>

<script>

    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();

        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if(filter==''){
                li[i].style.display = "none";
            }
            else{
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "block";
                } else {
                    li[i].style.display = "none";
                }
            }

        }
    }
    function select(e){
        var content=e.innerHTML;
        var input = document.getElementById("myInput");
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        input.value=content;
        for (i = 0; i < li.length; i++) {
            li[i].style.display = "none";
        }
        input.focus();

    }



</script>

</body>
</html>
