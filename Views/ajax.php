<div class="row s6 center-align centered">
    <p><b>Start typing a name in the input field below:</b></p>
    <form>
    First name: <input type="text" onkeyup="showHint(this.value)">
    </form>
    <p>Suggestions: <span id="txtHint"></span></p>
</div>


<script>

    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "<?= FRONT_ROOT ?>client/searchFullNames/q=" + str, true);
            xmlhttp.send();
        }
    }


</script>