<?php
//koneksi
require 'koneksi.php';
require 'item.php';
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: index.php");
} else {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM client WHERE email = '$email' LIMIT 1";
  $result = $koneksi->query($sql);
  $pecah = $result->fetch_assoc();
  $client_id = $pecah['client_id']; // ambil client id
}

//Menghapus produk dalam keranjang
if (isset($_GET['clear']) && !isset($_POST['update'])) {
  $select = $koneksi->query("SELECT * FROM cart_client WHERE client_id = '$client_id'");

  $delcart = $select->fetch_assoc();
  $delcartid = $delcart['cart_id'];
  $koneksi->query("DELETE FROM cart_goods WHERE cart_id = '$delcartid'");

  header('Location: categories.php');
}


// update produk
if (isset($_POST['update'])) {
  $query = $koneksi->query("SELECT * FROM `cart_client` WHERE `client_id` = $client_id");

  $fetch = $query->fetch_assoc();

  $idcart = $fetch['cart_id'];
  $select = $koneksi->query("SELECT * FROM `cart_goods` WHERE `cart_id` = $idcart AND 'qty' > '0'");

  if ($select->num_rows == 0) {
    header('Location: categories.php');
  }
  while ($fetch_cg = $select->fetch_assoc()) {
    $goods_id[] = $fetch_cg['goods_id'];
  };
  $i = 0;

  foreach ($_POST['quantity'] as $qty) {

    $koneksi->query("UPDATE `cart_goods` SET `qty` = '$qty' WHERE `goods_id` =" . $goods_id[$i]);
    $i++;
  }
  $hasil = $koneksi->query("DELETE FROM `cart_goods` WHERE `qty` = 0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cart</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="e-commerce project">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
  <link href="plugins/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="styles/cart.css">
  <link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
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
          <li class="menu_mm"><a href="categories.php">woman</a></li>
          <li class="menu_mm"><a href="categories.php">man</a></li>
          <li class="menu_mm"><a href="categories.php">lookbook</a></li>
          <li class="menu_mm"><a href="#">blog</a></li>
          <li class="menu_mm"><a href="#">contact</a></li>
        </ul>
      </nav>
      <div class="menu_extra">
        <div class="profile_header menu_mm">
          <div class="profile-img">
            <img id="profile-pic" src="images/user.svg" alt="" class="rounded-circle">
          </div>
          <div class="profile-name">
            <p class="name"><?php if (isset($_SESSION['email'])) {
                              echo $pecah['name'];
                            } ?></p>
            <a href="logout.php" class="logout">Logout</a>
          </div>
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
          <li><a href="#">blog<i class="fas fa-angle-right" aria-hidden="true"></i></a></li>
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
                            echo $pecah['name'];
                          } ?></p>
          <a href="logout.php" class="logout">Logout</a>
        </div>
      </div>
    </div>


    <!-- Home -->

    <div class="home">
      <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/product_background.jpg" data-speed="0.8"></div>
      <div class="home_container">
        <div class="home_content">
          <div class="home_title">Cart</div>
          <div class="breadcrumbs">
            <ul class="d-flex flex-row align-items-center justify-content-start">
              <li><a href="index.html">Home</a></li>
              <li>My Cart</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Cart -->

    <div class="cart_section">
      <div class="section_container">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="cart_container">
                <form method="post">

                  <!-- Cart Bar -->
                  <div class="cart_bar">
                    <ul class="cart_bar_list item_list d-flex flex-row align-items-center justify-content-start">
                      <li>Product</li>
                      <li>Size</li>
                      <li>Price</li>
                      <li>Quantity</li>
                      <li>Total</li>
                    </ul>
                  </div>

                  <!-- Cart Items -->
                  <div class="cart_items">
                    <ul class="cart_items_list">
                      <!-- Cart Item -->
                      <?php
                      $query = $koneksi->query("SELECT * FROM `cart_client` WHERE `client_id` =" . $client_id);
                      $fetch_cc = $query->fetch_assoc();
                      $cart_id = $fetch_cc['cart_id'];

                      $query = $koneksi->query("SELECT * FROM `cart_goods` WHERE `cart_id` = $cart_id");
                      if ($query->num_rows > 0) {
                        while ($fetch_cg = $query->fetch_assoc()) {
                          $goods_id = $fetch_cg['goods_id'];
                          $fetch = $koneksi->query("SELECT * FROM `goods` WHERE `goods_id` = '$goods_id'");
                          $goods = $fetch->fetch_object();
                          $price = $goods->goods_prc;
                          $qty = $fetch_cg['qty'];
                      ?>
                          <li class="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                            <div class="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">

                              <div>
                                <div class="product_image"><img src="images/<?= $goods->goods_pic ?>" alt=""></div>
                              </div>

                              <div class="product_name"><a href="product.html"><?= $goods->goods_name; ?></a></div>
                            </div>
                            <div class="product_size text-lg-center product_text"><span>Size: </span>One Size</div>
                            <div class="product_price text-lg-center product_text"><span>Price: </span>Rp.
                              <?= $goods->goods_prc; ?>.000,-</div>
                            <div class="product_quantity_container">
                              <div class="product_quantity ml-lg-auto mr-lg-auto text-center">
                                <span class="product_text">
                                  <input class="product_num" type="text" name="quantity[]" value="<?= $fetch_cg['qty'] ?>" readonly>
                                </span>
                                <input type="hidden" name="product_id" value="<?= $goods->goods_id ?>">
                                <div class="qty_sub qty_button trans_200 text-center"><span>-</span></div>
                                <div class="qty_add qty_button trans_200 text-center"><span>+</span></div>
                              </div>
                            </div>
                            <div class="product_total text-lg-center product_text"><span>Total:
                              </span>Rp. <?= number_format($price * $fetch_cg['qty'], 0, '.', '.'); ?>.000,-
                            </div>
                          </li>
                      <?php
                        }
                      }

                      ?>
                    </ul>
                  </div>

                  <!-- Cart Buttons -->
                  <div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="cart_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                      <button class="button button_continue trans_200"><a href="categories.php">continue
                          shopping</a></button>
                      <button class="button button_clear trans_200"> <a href="cart.php?clear=yes; ?>">clear cart</a></button>
                      <input type="submit" class="button button_update trans_200" name="update" value="Update Cart">
                    </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class=" section_container cart_extra_container">
        <div class="container">
          <div class="row">

            <!-- Shipping & Delivery -->
            <div class="col-xxl-6">
              <div class="cart_extra cart_extra_1">
                <div class="cart_extra_content cart_extra_coupon">
                  <div class="cart_extra_title">Coupon code</div>
                  <div class="coupon_form_container">
                    <form action="#" id="coupon_form" class="coupon_form">
                      <input type="text" class="coupon_input" required="required">
                      <button class="coupon_button">apply code</button>
                    </form>
                  </div>
                  <div class="shipping">
                    <div class="cart_extra_title">Shipping Method</div>
                    <ul>
                      <li class="shipping_option d-flex flex-row align-items-center justify-content-start">
                        <label class="radio_container">
                          <input type="radio" id="radio_1" name="shipping_radio" class="shipping_radio">
                          <span class="radio_mark"></span>
                          <span class="radio_text">Next day delivery</span>
                        </label>
                        <div class="shipping_price ml-auto">Rp. 35.000,-</div>
                      </li>
                      <li class="shipping_option d-flex flex-row align-items-center justify-content-start">
                        <label class="radio_container">
                          <input type="radio" id="radio_2" name="shipping_radio" class="shipping_radio">
                          <span class="radio_mark"></span>
                          <span class="radio_text">Standard delivery</span>
                        </label>
                        <div class="shipping_price ml-auto">Rp. 28.000,-</div>
                      </li>
                      <li class="shipping_option d-flex flex-row align-items-center justify-content-start">
                        <label class="radio_container">
                          <input type="radio" id="radio_3" name="shipping_radio" class="shipping_radio" checked>
                          <span class="radio_mark"></span>
                          <span class="radio_text">Personal Pickup</span>
                        </label>
                        <div class="shipping_price ml-auto">Free</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Cart Total -->
            <?php
            $hasil = $koneksi->query("SELECT g.goods_prc, cg.qty FROM goods g, cart_goods cg WHERE cg.goods_id = g.goods_id");
            $subtotal = 0;
            while ($tot = $hasil->fetch_assoc()) {
              $total = $tot['goods_prc'] * $tot['qty'];
              $subtotal += $total;
            }
            ?>
            <div class="col-xxl-6">
              <div class="cart_extra cart_extra_2">
                <div class="cart_extra_content cart_extra_total">
                  <div class="cart_extra_title">Cart Total</div>
                  <ul class="cart_extra_total_list">
                    <li class="d-flex flex-row align-items-center justify-content-start">
                      <div class="cart_extra_total_title">Subtotal</div>
                      <div class="cart_extra_total_value ml-auto"><?php echo number_format($subtotal, 0, '.', '.'); ?>.000,-</div>
                    </li>
                    <li class="d-flex flex-row align-items-center justify-content-start">
                      <div class="cart_extra_total_title">Shipping</div>
                      <div class="cart_extra_total_value ml-auto">Free</div>
                    </li>
                    <li class="d-flex flex-row align-items-center justify-content-start">
                      <div class="cart_extra_total_title">Total</div>
                      <div class="cart_extra_total_value ml-auto">Rp.
                        <?php echo number_format($subtotal, 0, '.', '.'); ?>.000,-</div>
                    </li>
                  </ul>
                  <div class="checkout_button trans_200"><a href="#!">proceed to checkout</a></div>
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
                    <p>Van.zy Adalah sebuah produsen fashion asal Indonesia yang berbasis di Surabaya dan dimiliki oleh
                      Vanzy Fashion Ltd. Perusahaan ini didirikan oleh Arief Graifhan.</p>
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
                    </script> Vanzy Store Ltd., All rights reserved.
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
  <script src="js/cart.js"></script>

  <?php if (isset($_GET["id"]) || isset($_GET["index"])) {
    header('Location: cart.php');
  } ?>
</body>

</html>