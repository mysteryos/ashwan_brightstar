            </section>
        </section>

        <footer id="footer">
            Copyright &copy; 2017 BrightStar Ltd.

            <ul class="f-menu">
                <li><a href="">Home</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Reports</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </footer>

        @foreach($js as $js_file)
            <script src='{{$js_file}}'></script>
        @endforeach

                <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
        <script src="/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
    </body>
</html>