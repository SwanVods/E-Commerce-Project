<?php
require 'koneksi.php';
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM client WHERE email = '$email' LIMIT 1";
  $result = $koneksi->query($sql);
  $pecah = $result->fetch_assoc();
}

if (isset($_GET['id'])) {
  $query = $koneksi->query("SELECT * FROM `goods` WHERE `goods_id` =" . $_GET['id']);
  $fetch = $query->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Vanzy Products</title>
  <meta charset="utf-8">
  <meta name="description" content="e-commerce project">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
  <link href="plugins/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="styles/product.css">
  <link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
</head>

<body>

  <div class="super_container">

    <!-- Header -->

    <header class="header">
      <div class="header_content d-flex flex-row align-items-center justify-content-start">

        <!-- Hamburger -->
        <div class="hamburger menu_mm"><i class="fa fa-bars menu_mm" aria-hidden="true"></i></div>

        <!-- Logo -->
        <div class="header_logo">
          <a href="#">
            <div>VAN<br><span>.zy</span></div>
          </a>
        </div>

        <!-- Navigation -->
        <nav class="header_nav">
          <ul class="d-flex flex-row align-items-center justify-content-start">
            <li><a href="index.php">home</a></li>
            <li><a href="#">woman</a></li>
            <li><a href="#">man</a></li>
            <li><a href="#">lookbook</a></li>
            <li><a href="#">blog</a></li>
            <li><a href="#">contact</a></li>
          </ul>
        </nav>

        <!-- Header Extra -->
        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">

          <!-- Language -->
          <div class="info_languages has_children">
            <div class="language_flag"><img src="images/flag_1.svg" alt="https://www.flaticon.com/authors/freepik">
            </div>
            <div class="dropdown_text">IND</div>
            <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

            <!-- Language Dropdown Menu -->
            <ul>
              <li><a href="#">
                  <div class="language_flag"><img src="images/flag_2.svg" alt="https://www.flaticon.com/authors/freepik"></div>
                  <div class="dropdown_text">ENG</div>
                </a></li>
            </ul>

          </div>

          <!-- Currency -->
          <div class="info_currencies has_children">
            <div class="dropdown_text">IDR</div>
            <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

            <!-- Currencies Dropdown Menu -->
            <ul>
              <li><a href="#">
                  <div class="dropdown_text">USD</div>
                </a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>


    <!-- Menu -->

    <div class="menu d-flex flex-column align-items-start justify-content-start menu_mm trans_400">
      <div class="menu_close_container">
        <div class="menu_close">
          <div></div>
          <div></div>
        </div>
      </div>
      <div class="menu_top d-flex flex-row align-items-center justify-content-start">

        <!-- Language -->
        <div class="info_languages has_children">
          <div class="language_flag"><img src="images/flag_6.svg" alt="https://www.flaticon.com/authors/freepik"></div>
          <div class="dropdown_text">IND</div>
          <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

          <!-- Language Dropdown Menu -->
          <ul>
            <li><a href="#">
                <div class="language_flag"><img src="images/flag_1.svg" alt="https://www.flaticon.com/authors/freepik">
                </div>
                <div class="dropdown_text">ENG</div>
              </a></li>
          </ul>

        </div>

        <!-- Currency -->
        <div class="info_currencies has_children">
          <div class="dropdown_text">IDR</div>
          <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

          <!-- Currencies Dropdown Menu -->
          <ul>
            <li><a href="#">
                <div class="dropdown_text">USD</div>
              </a></li>
          </ul>
        </div>

      </div>

      <div class="menu_search">
        <form action="#" class="header_search_form menu_mm">
          <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
          <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
            <i class="fa fa-search menu_mm" aria-hidden="true"></i>
          </button>
        </form>
      </div>
      <nav class="menu_nav">
        <ul class="menu_mm">
          <li class="menu_mm"><a href="index.php">home</a></li>
          <li class="menu_mm"><a href="#">woman</a></li>
          <li class="menu_mm"><a href="#">man</a></li>
          <li class="menu_mm"><a href="#">lookbook</a></li>
          <li class="menu_mm"><a href="blog.html">blog</a></li>
          <li class="menu_mm"><a href="contact.html">contact</a></li>
        </ul>
      </nav>
      <div class="menu_extra">
        <div class="profile_header menu_mm">
          <div class="profile-img">
            <img id="profile-pic" src="images/user.svg" alt="" class="rounded-circle">
          </div>
          <div class="profile-name">
            <p class="name"><?php if (isset($_SESSION['email'])) {
                              echo $ambil['name'];
                            } ?></p>
            <a href="logout.php" class="logout">Logout</a>
          </div>
        </div>

        <!-- Login menu -->
        <div class="login_menu">
          <a href="signup.php" class="signup">Sign Up</a>
          <a href="login.php" class="login">Already a member?</a>
        </div>
      </div>
    </div>

    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Info -->
      <div class="info">
        <div class="info_content d-flex flex-row align-items-center justify-content-start">

          <!-- Language -->
          <div class="info_languages has_children">
            <div class="language_flag"><img src="images/flag_6.svg" alt="https://www.flaticon.com/authors/freepik">
            </div>
            <div class="dropdown_text">IND</div>
            <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

            <!-- Language Dropdown Menu -->
            <ul>
              <li><a href="#">
                  <div class="language_flag"><img src="images/flag_1.svg" alt="https://www.flaticon.com/authors/freepik"></div>
                  <div class="dropdown_text">ENG</div>
                </a></li>
            </ul>

          </div>

          <!-- Currency -->
          <div class="info_currencies has_children">
            <div class="dropdown_text">IDR</div>
            <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

            <!-- Currencies Dropdown Menu -->
            <ul>
              <li>
                <a href="#">
                  <div class="dropdown_text">USD</div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Logo -->
      <div class="sidebar_logo">
        <a href="#">
          <div>VAN<br><span>.zy</span></div>
        </a>
      </div>

      <!-- Search bar -->
      <div class="search">
        <form action="#" class="search_form" id="sidebar_search_form">
          <input type="text" class="search_input" placeholder="Search" required="required">
          <button class="search_button">
            <i class="fa fa-search" aria-hidden="true">
            </i>
          </button>
        </form>
      </div>

      <!-- Sidebar Navigation -->
      <nav class="sidebar_nav">
        <ul>
          <li><a href="index.php">home<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
          <li><a href="#">woman<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
          <li><a href="#">man<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
          <li><a href="#">lookbook<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
          <li><a href="blog.html">blog<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
          <li><a href="#">contact<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
        </ul>
      </nav>

      <!-- profile -->
      <div class="profile">
        <div class="profile-img">
          <img id="profile-pic" src="images/user.svg" alt="" class="rounded-circle">
        </div>
        <div class="profile-name">
          <p class="name"><?php if (isset($_SESSION['email'])) {
                            echo $ambil['name'];
                          } ?></p>
          <a href="logout.php" class="logout">Logout</a>
        </div>
      </div>

      <!-- Login menu -->
      <div class="login_menu">
        <a href="signup.php" class="signup">Sign Up</a>
        <a href="login.php" class="login">Already a member?</a>
      </div>

    </div>

    <!-- Home -->

    <div class="home">
      <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/product_background.jpg" data-speed="0.8"></div>
      <div class="home_container">
        <div class="home_content">
          <div class="home_title">Shop</div>
          <div class="breadcrumbs">
            <ul class="d-flex flex-row align-items-center justify-content-start">
              <li><a href="index.html">Home</a></li>
              <li><a href="categories.html">Woman</a></li>
              <li><a href="categories.html">Accessories</a></li>
              <li>Shoulder Bag</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Products -->

    <div class="product">

      <!-- Sorting & Filtering -->
      <div class="products_bar">
        <div class="section_container">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="products_bar_content d-flex flex-row align-items-center justify-content-start">
                  <div class="product_categories">
                    <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                      <li class="active"><a href="#">All</a></li>
                      <li><a href="#">Hot Products</a></li>
                      <li><a href="#">New Products</a></li>
                      <li><a href="#">Sale Products</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Content -->
      <div class="section_container">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="product_content_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
                <div class="product_content order-lg-1 order-2">
                  <div class="product_content_inner">
                    <div class="product_image_row d-flex flex-md-row flex-column align-items-md-end align-items-start justify-content-start">
                      <div class="product_image_1 product_image">
                        <img src="images/<?= $fetch['goods_pic'] ?>" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product_sidebar order-lg-2 order-1">
                  <form action="#" id="product_form" class="product_form">
                    <div class="product_name"><?= $fetch['goods_name'] ?></div>
                    <div class="product_price">Rp. <?= $fetch['goods_prc'] ?>.000,-</div>
                    <div class="product_color">Color: <span>Brown</span></div>
                    <div class="product_size">
                      <div class="product_size_title">Select Size</div>
                      <div class="product_size_list">
                        <ul>
                          <li class="size_available">
                            <input type="radio" id="radio_1" name="product_radio" class="regular_radio radio_1">
                            <label for="radio_1">35</label>
                          </li>
                          <li class="size_available">
                            <input type="radio" id="radio_2" name="product_radio" class="regular_radio radio_2">
                            <label for="radio_2">36</label>
                          </li>
                          <li class="size_available">
                            <input type="radio" id="radio_3" name="product_radio" class="regular_radio radio_3">
                            <label for="radio_3">37</label>
                          </li>
                          <li class="size_available">
                            <input type="radio" id="radio_4" name="product_radio" class="regular_radio radio_4">
                            <label for="radio_4">38</label>
                          </li>
                          <li>
                            <input type="radio" id="radio_5" name="product_radio" class="regular_radio radio_5" disabled>
                            <label for="radio_5">39</label>
                          </li>
                          <li>
                            <input type="radio" id="radio_6" name="product_radio" class="regular_radio radio_6" disabled>
                            <label for="radio_6">40</label>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <button class="cart_button trans_200" name="buy" value="<?php echo $pecah['goods_id']; ?>">add to cart</button>
                    <div class="similar_products_button trans_200"><a href="categories.php">see similar products</a></div>
                  </form>
                  <div class="product_links">
                    <ul class="text-center">
                      <li><a href="#">See guide</a></li>
                      <li><a href="#">Shipping</a></li>
                      <li><a href="#">Returns</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
      <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div class="newsletter_content text-center">
              <div class="newsletter_title_container">
                <div class="newsletter_title">subscribe to our newsletter</div>
                <div class="newsletter_subtitle">we won't spam, we promise!</div>
              </div>
              <div class="newsletter_form_container">
                <form action="#" id="newsletter_form" class="newsletter_form">
                  <input type="email" class="newsletter_input" placeholder="your e-mail here" required="required">
                  <button class="newsletter_button">submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->

    <footer class="footer">
      <div class="footer_content">
        <div class="section_container">
          <div class="container">
            <div class="row">

              <!-- About -->
              <div class="col-xxl-3 col-md-6 footer_col">
                <div class="footer_about">
                  <!-- Logo -->
                  <div class="footer_logo">
                    <a href="#">
                      <div>VAN<br><span>.zy</span></div>
                    </a>
                  </div>
                  <div class="footer_about_text">
                    <p>Van.zy Adalah sebuah produsen fashion asal Indonesia yang berbasis di Surabaya dan dimiliki oleh Vanzy Fashion Ltd. Perusahaan ini didirikan oleh Arief Graifhan.</p>
                  </div>
                  <div class="cards">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                      <li><a href="#"><img src="images/card_1.jpg" alt=""></a></li>
                      <li><a href="#"><img src="images/card_2.jpg" alt=""></a></li>
                      <li><a href="#"><img src="images/card_3.jpg" alt=""></a></li>
                      <li><a href="#"><img src="images/card_4.jpg" alt=""></a></li>
                      <li><a href="#"><img src="images/card_5.jpg" alt=""></a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Questions -->
              <div class="col-xxl-3 col-md-6 footer_col">
                <div class="footer_questions">
                  <div class="footer_title">questions</div>
                  <div class="footer_list">
                    <ul>
                      <li><a href="#">About us</a></li>
                      <li><a href="#">Track Orders</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Shipping</a></li>
                      <li><a href="#">Blog</a></li>
                      <li><a href="#">Terms of Use</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Blog -->
              <div class="col-xxl-3 col-md-6 footer_col">
                <div class="footer_blog">
                  <div class="footer_title">blog</div>
                  <div class="footer_blog_container">

                    <!-- Blog Item -->
                    <div class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                      <div class="footer_blog_image"><a href="blog.html"><img src="images/footer_blog_1.jpg" alt=""></a>
                      </div>
                      <div class="footer_blog_content">
                        <div class="footer_blog_title"><a href="blog.html">what shoes to wear</a></div>
                        <div class="footer_blog_date">june 06, 2018</div>
                        <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                      </div>
                    </div>

                    <!-- Blog Item -->
                    <div class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                      <div class="footer_blog_image"><a href="blog.html"><img src="images/footer_blog_2.jpg" alt=""></a>
                      </div>
                      <div class="footer_blog_content">
                        <div class="footer_blog_title"><a href="blog.html">trends this year</a></div>
                        <div class="footer_blog_date">june 06, 2018</div>
                        <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Contact -->
              <div class="col-xxl-3 col-md-6 footer_col">
                <div class="footer_contact">
                  <div class="footer_title">contact</div>
                  <div class="footer_contact_list">
                    <ul>
                      <li class="d-flex flex-row align-items-start justify-content-start"><span>C.</span>
                        <div>Vanzy Store Indonesia</div>
                      </li>
                      <li class="d-flex flex-row align-items-start justify-content-start"><span>A.</span>
                        <div>Jl.Supratman 1409 Surabaya</div>
                      </li>
                      <li class="d-flex flex-row align-items-start justify-content-start"><span>T.</span>
                        <div>+62 882 0383 2314</div>
                      </li>
                      <li class="d-flex flex-row align-items-start justify-content-start"><span>E.</span>
                        <div>ariefg@myemail.com</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Social -->
      <div class="footer_social">
        <div class="section_container">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="footer_social_container d-flex flex-row align-items-center justify-content-between">
                  <!-- Instagram -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                      <div class="footer_social_title">instagram</div>
                    </div>
                  </a>
                  <!-- Google + -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-google-plus" aria-hidden="true"></i></div>
                      <div class="footer_social_title">google +</div>
                    </div>
                  </a>
                  <!-- Pinterest -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-pinterest" aria-hidden="true"></i></div>
                      <div class="footer_social_title">pinterest</div>
                    </div>
                  </a>
                  <!-- Facebook -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-facebook" aria-hidden="true"></i></div>
                      <div class="footer_social_title">facebook</div>
                    </div>
                  </a>
                  <!-- Twitter -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-twitter" aria-hidden="true"></i></div>
                      <div class="footer_social_title">twitter</div>
                    </div>
                  </a>
                  <!-- YouTube -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-youtube" aria-hidden="true"></i></div>
                      <div class="footer_social_title">youtube</div>
                    </div>
                  </a>
                  <!-- Tumblr -->
                  <a href="#">
                    <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                      <div class="footer_social_icon"><i class="fab fa-tumblr-square" aria-hidden="true"></i></div>
                      <div class="footer_social_title">tumblr</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Credits -->
      <div class="credits">
        <div class="section_container">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="credits_content d-flex flex-row align-items-center justify-content-center">
                  <div class="credits_text">
                    Copyright &copy;<script>
                      document.write(new Date().getFullYear());
                    </script> Arief G All rights reserved.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="styles/bootstrap-4.1.3/popper.js"></script>
  <script src="styles/bootstrap-4.1.3/bootstrap.min.js"></script>
  <script src="plugins/greensock/TweenMax.min.js"></script>
  <script src="plugins/greensock/TimelineMax.min.js"></script>
  <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
  <script src="plugins/greensock/animation.gsap.min.js"></script>
  <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
  <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
  <script src="plugins/easing/easing.js"></script>
  <script src="plugins/parallax-js-master/parallax.min.js"></script>
  <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
  <script src="plugins/Isotope/fitcolumns.js"></script>
  <script src="js/product.js"></script>
</body>

</html>