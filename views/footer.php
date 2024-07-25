    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {
            myFunction()
        };

        // Get the header
        var myNav = document.getElementById("myNavbar");

        // Get the offset position of the navbar
        var sticky = myNav.offsetTop;

        // Add the sticky class to the myNav when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset > sticky) {
                myNav.classList.add("sticky");
            } else {
                myNav.classList.remove("sticky");
            }
        }

        document.addEventListener("scroll", function() {
            if (window.scrollY > 0) {
                myNav.classList.add("nav-shadow");
            } else {
                myNav.classList.remove("nav-shadow");
            }
        });

        function redirect(id) {
            window.location.href = "index.php?page=chi-tiet-san-pham&product-id=" + id;
        }
    </script>

    <footer>
        <p class="m-0 py-2">COPYRIGHT © 2024 Sieu Thi Truc Tuyen. All rights reserved.</p>
    </footer>
</body>

</html>