    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?= JS_PATH ?>materialize.min.js"></script>
    <script>
        $(".dropdown-trigger").dropdown();

        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
        
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });        

        $(document).ready(function(){
            $('.modal').modal();
        });

        $(document).ready(function(){
            $('select').formSelect();
        });

        $(document).ready(function(){
            $('.tabs').tabs();
        });

        
    </script>
</body>

</html>