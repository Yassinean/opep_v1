

<body>
    <header>
        <nav>
            <div class="nav-content">
                <div class="logo">
                    <a href="#"><img src="img/logo.png" width="50%" alt=""></a>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="signup.php">signup</a></li>
                    <li><a href="signin.php">Login</a></li>
                    <li><a href="panier.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
            </div>
        </nav><br><br><br><br><br><br><br><br>


        <script>
            let nav = document.querySelector("nav");
            window.onscroll = function () {
                if (document.documentElement.scrollTop > 20) {
                    nav.classList.add("sticky");
                } else {
                    nav.classList.remove("sticky");
                }
            }
        </script>

</body>

</html>