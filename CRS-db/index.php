
<?php
session_start();
if(!isset($_SESSION['Username'])){
echo "You are not logged in \n Please login";
header('location: login.php');
}
// $_SESSION['cart'] = [];

require_once ('./php/dp-component.php');
require_once ('./php/CreateDb.php');


// create instance of Createdb class
$database = new CreateDb("crs_db", "products_table");
$database_2 = new CreateDb("crs_db", "message_table");


if (isset($_POST['add'])){
  /// print_r($_POST['product_id']);
  if(isset($_SESSION['cart'])){

      $item_array_id = array_column($_SESSION['cart'], "product_id");

      if(in_array($_POST['product_id'], $item_array_id)){
          echo "<script>alert('Product is already added in the cart..!')</script>";
          echo "<script>window.location = 'index.php'</script>";
      }else{

          $count = count($_SESSION['cart']);
          $item_array = array(
              'product_id' => $_POST['product_id']
          );


          $_SESSION['cart'][$count] = $item_array;
      }

  }else{

      $item_array = array(
              'product_id' => $_POST['product_id']
      );

      // Create new session variable
      $_SESSION['cart'][0] = $item_array;
      // print_r($_SESSION['cart']);
  }
}
if(isset($_POST['sendMsg'])){
  $usernaeMsg = $_POST['UsernameMsg'];
 $emailMsg = $_POST['EmailMsg'];
 $subjectMsg = $_POST['SubjectMsg'];
 $textareaMsg = $_POST['TextareaMsg'];
 $sql = "INSERT INTO $database_2->tablename( `name`, `email`, `subject`, `message`) VALUES ('$usernaeMsg','$emailMsg','$subjectMsg','$textareaMsg')" ;
        if (mysqli_query($database_2->con, $sql)) {
          echo "Message Successfully Sent";
          // header('location: login.php');
          unset($_POST['sendMsg']);
          $_POST = array();
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($database_2->con);
          }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="My portfolio, I am junior web developer and CIS Engineer from Karachi, Pakistan">
    <meta name="keywords" content="Sibtain Ahmed, Muhammad Ahmer, Portfolio, Web developer">
    <meta name="author" content="Sibtain Ahmed">

    <title>CRS Store</title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /> -->
    <link rel="stylesheet" href="mainStyle.css" />
    <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->
  
    <link rel="stylesheet" href="p-image.css" />
    <!-- <script defer  src="bio-data.js"></script> -->
    <script defer type="module" src="bio-data.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.0/lottie.min.js"></script> -->
    <!-- Swiper Link  -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script defer src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Typed.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.min.js"></script>

 
  </head>

<!-- /* ======================================= Body Starts Here ========================================= */ -->
  <body>

    <!-- /* =============================================
    Header section 
    ================================================ */ -->

    <header class="header">
      <section class="section header-section">
        <div class="scroll-tracker"></div>
        <div class="container header-container">
            <a class="header-logo" href="#"><img src="./images/crs-logo.png" alt="crs-logo"></a>
            <!-- <a class="header-logo" href="#"><img src="./images/SignatureLogo.webp" alt="crs-logo"></a> -->
            <nav>
            <ul class="nav-list nav-list-1">
                <li class="nav-list_item"><a href="#hero-section-id">Home</a></li>
                <li class="nav-list_item"><a href="#footer-section-id">About</a></li>
                <li class="nav-list_item"><a href="#portfolio-section-id">Discounts</a></li>
                <li class="nav-list_item"><a href="#services-section-id">Products</a></li>
                <li class="nav-list_item"><a href="#contact-section-id">Contact</a></li>
                </ul>
        </nav>
      <a href="logout.php"><button  class="filled-btn header-contact-btn">Logout <span><ion-icon name="log-out-outline"></ion-icon></span></button></a>

      <!-- /* ============================  Animated Button ========================== */ -->

      <button class="menu hamburger-btn" aria-label="Main Menu">
        <svg width="100" height="100" viewBox="0 0 100 100">
          <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
          <path class="line line2" d="M 20,50 H 80" />
          <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
        </svg>
      </button>
      <div class="side-navbar">
        <ul class="nav-list">
          <li class="nav-list_item"><a href="#hero-section-id">Home</a></li>
          <li class="nav-list_item"><a href="#footer-section-id">About</a></li>
          <li class="nav-list_item"><a href="#services-section-id">Discounts</a></li>
          <li class="nav-list_item"><a href="#portfolio-section-id">Products</a></li>
          <li class="nav-list_item"><a href="#contact-section-id">Help</a></li>
          <li class="nav-list_item"><a href="logout.php">Logout</a></li>
          <!-- <li class="list_item"><a href="#">More</a></li> -->
      </ul>
      </div>

      </div>
      </section>
    </header>

    <!-- /* =============================================
    Hero section 
    ================================================ */ -->

    <main>
      <section id="hero-section-id" class="section hero-section ">
        <div class="container grid-two-column hero-container">
          <div class="hero-heading-div">
            <span>Welcome to</span>
            <h1>Gamer's Paradise</h1>
            <h3>Here you will find <span id="typing-animation"></span></h3>
            <p class="para hero-para">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae, fuga. Culpa facere molestias, exercit</p>
            <a href="#portfolio-section-id" class="btn hire-me-btn">Avail Discount</a>
          </div>
          <div class="hero-img-div">
            <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_YrdJ2K8cQY.json" background="transparent"  speed="1"   loop autoplay></lottie-player>
            <!-- <img class="hero-img" src="./images/crs-logo.png" alt="" srcset=""> -->
          </div>
         
     
        </div>
      </section>
    </main>

    <!-- /* =============================================
    Bio Data section / About Section
    ================================================ */ -->

    <section id="bio-data-section-id" class="section bio-data-section">
      <div class="container bio-container grid-two-column">
        <div class="bio-image-div">
          <lottie-player src="https://assets6.lottiefiles.com/private_files/lf30_obrdkagu.json"  background="transparent"  speed="1"  loop  autoplay></lottie-player>
        </div>
        <!-- <div id="bio-heading-div-id" class="bio-heading-div fade-in"> -->
        <div id="bio-heading-div-id" class="bio-heading-div ">
          <div class="heading-div">
            <h2>Why CRS ?</h2>
          </div>
          <div class="bio-para-div">
            <p class="bio-para para">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              Voluptates accusamus, facere fuga explicabo ex dignissimos velit
              aspernatur neque fugit nihil. Id porro, aliquid explicabo a nisi
              voluptates in earum laudantium Lorem ipsum, dolor sit amethr
            </p>
          </div>
          <h3>Website Score on different Platforms</h3>
          <div class="bio-main-progress-stats">
            <div class="progress-stats">
              <h3>Availability</h3>
              <div class="progress-bar progress-bar-1">
                <span>90%</span>
              </div>
            </div>
            <div class="progress-stats">
              <h3>Services</h3>
              <div class="progress-bar progress-bar-2">
                <span>80%</span>
              </div>
            </div>
            <div class="progress-stats">
              <h3>Interface</h3>
              <div class="progress-bar progress-bar-3">
                <span>70%</span>
              </div>
            </div>
            <!-- <div class="progress-stats">
              <h3>Vue.js</h3>
              <div class="progress-bar progress-bar-4">
                <span>10%</span>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>

    <!-- /* =============================================
    project section 
    ================================================ */ -->

    <section id="portfolio-section-id" class="section project-section">
      <div class="container project-container">
        <div class="heading-div">
          <h3>Discounted Products</h3>
        </div>
        <p class="projects-para para">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam
          dolor adipisci facere saepe, cum ducimus iste architecto officia sint
          itaque inventore obcaecati hic vitae, ipsam laudantium incidunt, nisi
          quibusdam molestias?
        </p>
        <!-- <div class="projects-btn-div flex">
          <div class="btn project-btn project-btn-1" data-btn-no="1">
            Windows
          </div>
          <div class="btn project-btn project-btn-2" data-btn-no="2">
            Android
          </div>
          <div class="btn project-btn project-btn-3" data-btn-no="3">
            IOS
          </div>
        </div> -->
        <div class="project-images-div grid-three-column">
        <?php
                $result = $database->getDiscountData(); 
                while ($row = mysqli_fetch_assoc($result)){
                  dpComponent($row['productName'], $row['oldPrice'], $row['newPrice'],$row['imageAddress'],$row['productRating'], $row['id']);
                }
            ?>
        </div>
      </div>
    </section>

    <!-- /* =============================================
    Stats section 
    ================================================ */ -->

    <section class=" stats-section">
      <div class=" stats-container">
        <div class="stats-wrapper">
          <div class="stats-div">
            <h3 class="stats-no" data-stats-no="5000">0+</h3>
            <span>Sold Products</span>
          </div>

          <div class="stats-div">
            <h3 class="stats-no" data-stats-no="3500">0+</h3>
            <span>5 Star Ratings</span>
          </div>

          <div class="stats-div">
            <h3 class="stats-no" data-stats-no="500">0+</h3>
            <span>Current Months Sales</span>
          </div>

          <div class="stats-div">
            <h3 class="stats-no" data-stats-no="1000">0+</h3>
            <span>Availaible Products</span>
          </div>
        </div>
      </div>
    </section>

    <!-- /* =============================================
    Services section 
    ================================================ */ -->

    <section id="services-section-id" class="section services-section">
      <div class="container services-container">
        <div class="heading-div">
          <h3>Products</h3>
        </div>
        <p class="para">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit quae
          laboriosam!
        </p>
        <div class="grid-three-column services-card-div">
        <?php
                $result = $database->getNonDiscountData(); 
                while ($row = mysqli_fetch_assoc($result)){
                  NonDPComponent($row['productName'], $row['newPrice'],$row['imageAddress'],$row['productRating'], $row['id']);
                }
            ?>
        </div>
      </div>
    </section>

    <!-- /* =============================================
    Freelancing section (Parallax Effect)
    ================================================ */ -->

    <section class="section freelancing-section">
      <div class="overlay"></div>
      <div class="container">
        <div class="freelancing-container">
          <h3 class="freelancing-heading">
            Support available <span>24/7</span>
          </h3>
          <p class="para">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Lorem
            ipsum dolor, sit amet consectetur adipisicing elit.
          </p>
          <div class="btn hire-me-btn"><a href="#contact-section-id" style="color:white;">Contact Us</a></div>
        </div>
      </div>
    </section>

    <!-- /* =============================================
    Testimonial section 
    ================================================ */ -->

    <section class="section testimonial-section">
      <div class="container testimonial-container">
        <div class="heading-div">
          <h3>Clients Review</h3>
        </div>

        <!-- <==========================  Swiper  =====================> -->
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
           
            <div class="swiper-slide">
              <div class="s-slide-upper">
                <span class="quotes-icon-1"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
                <p class="para testimonial-para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sint ipsam doloribus, aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!</p>
                <span class="quotes-icon-2"><img src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
              </div>
              <div class="s-slide-lower">
                <figure class="testimonial-client-img">

                  <img loading="lazy" class="img-testimonial" src="./images/clients-img/KazimNaqvi.jpg" alt="">
                </figure>
                    
              
                <div class="testimonial-client-detail">
                  <h3>Kazim Naqvi</h3>
                  <span>CEO Microsoft</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="s-slide-upper">
                <span class="quotes-icon-1"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
                <p class="para testimonial-para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sint ipsam doloribus, aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!</p>
                <span class="quotes-icon-2"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
              </div>
              <div class="s-slide-lower">
                <figure class="testimonial-client-img">

                  <img loading="lazy" class="img-testimonial" src="./images/clients-img/AhmerCloseSquare.jpeg" alt="">
                </figure>
                    
              
                <div class="testimonial-client-detail">
                  <h3>Sibtain Ahmed</h3>
                  <span>CEO Amazaon</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="s-slide-upper">
                <span class="quotes-icon-1"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
                <p class="para testimonial-para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sint ipsam doloribus, aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!</p>
                <span class="quotes-icon-2"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
              </div>
              <div class="s-slide-lower">
                <figure class="testimonial-client-img">

                  <img loading="lazy" class="img-testimonial" src="./images/clients-img/Mustafa-Suri.webp" alt="">
                </figure>
                    
              
                <div class="testimonial-client-detail">
                  <h3>Mustafa Suri</h3>
                  <span>CEO Facebook</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="s-slide-upper">
                <span class="quotes-icon-1"><img loading="lazy" src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
                <p class="para testimonial-para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sint ipsam doloribus, aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!aspernatur qui nulla, sed, aut quae quisquam cumque! Optio, non!</p>
                <span class="quotes-icon-2"><img src="./images/clients-img/left-quote-svgrepo-com.svg" alt=""></span>
              </div>
              <div class="s-slide-lower">
                <figure class="testimonial-client-img">

                  <img loading="lazy" class="img-testimonial" src="./images/clients-img/HasanFarooqi.jpg" alt="">
                </figure>
                    
              
                <div class="testimonial-client-detail">
                  <h3>Hassan Farooqi</h3>
                  <span>Entrepreneur</span>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

          <!-- If we need navigation buttons -->
          <!-- <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div> -->

          <!-- If we need scrollbar -->
          <!-- <div class="swiper-scrollbar"></div> -->
        </div>
      </div>
    </section>

    <!-- /* =============================================
    Contact section
    ================================================ */ -->
    <span class="separator"></span>

    <section id="contact-section-id" class="section contact-section hidden">
      <div class="container contact-container">
        <div class="heading-div">
          <h3>Contact Us</h3>
        </div>
        <p class="para">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat
          possimus, rerum quos rem veritatis maiores aut iusto ratione
          necessitatibus atqueaut iusto ratione necessitatibus atque.
        </p>
        <!-- action="https://formspree.io/f/xnqrvlpa" -->
        <form
        method="POST" action="index.php" class="contact-form grid-two-column">
          <div>
            <label for="username-inp"></label>
            <input required autocomplete="off" minlength="3" name="UsernameMsg" type="text" id="username-inp" placeholder="Full Name" />
          </div>
          <div>
            <label for="email-inp"></label>
            <input required minlength="5" name="EmailMsg" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" id="email-inp" placeholder="abc123@xyz.com" />
          </div>
          <div class="col-span-2">
            <label for="subject-inp"></label>
            <input required autocomplete="off" minlength="5" maxlength="70" name="SubjectMsg" type="text" id="subject-inp" placeholder="Subject" />
          </div>
          <div class="col-span-2">
            <label for="msg-inp"></label>
            <textarea required autocomplete="off" minlength="5" maxlength="500"
              name="TextareaMsg"
              placeholder="Write your message here....."
              id="msg-inp"
              cols="30"
              rows="10"
            ></textarea>
          </div>

          <div class="col-span-2">
            <!-- <label for="subject-inp"></label> -->
            <button
            name="sendMsg"
              type="submit"
              id="submit-btn"
              value="Send Message"
              class="btn col-span-2"
            >
              Send Message
            </button>
          </div>
        </form>
      </div>
    </section>

    <!-- ========================================
    Footer section
    ========================================= -->

    <footer>
      <section id="footer-section-id" class="section footer-section">
        <div class="container footer-container">
          <div class="footer-grid grid-four-column">
            <div class="footer-inner-grid">
              <h4>About</h4>
              <p class="para">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
                mollitia placeat ex! Cumque itaque repudiandae facilis
                necessitatibus vel
              </p>
            </div>
            <div class="footer-inner-grid">
              <h4>Links</h4>
              <ul>
                <li>
                  <span
                    ><ion-icon
                      name="arrow-forward-circle-outline"
                    ></ion-icon></span
                  ><a href="#"> Home</a>
                </li>
                <li>
                  <span
                    ><ion-icon
                      name="arrow-forward-circle-outline"
                    ></ion-icon></span
                  ><a href="#"> About</a>
                </li>
                <li>
                  <span
                    ><ion-icon
                      name="arrow-forward-circle-outline"
                    ></ion-icon></span
                  ><a href="#"> Services</a>
                </li>
                <li>
                  <span
                    ><ion-icon
                      name="arrow-forward-circle-outline"
                    ></ion-icon></span
                  ><a href="#"> Contact</a>
                </li>
              </ul>
            </div>
            <div class="footer-inner-grid">
              <h4>Services</h4>
              <ul>
                <li>
                  <span><ion-icon name="arrow-forward-outline"></ion-icon></span
                  ><a href="#"> Games Instlallation</a>
                </li>
                <li>
                  <span><ion-icon name="arrow-forward-outline"></ion-icon></span
                  ><a href="#"> For Windows</a>
                </li>
                <li>
                  <span><ion-icon name="arrow-forward-outline"></ion-icon></span
                  ><a href="#"> For Software Instlallation</a>
                </li>
                <li>
                  <span><ion-icon name="arrow-forward-outline"></ion-icon></span
                  ><a href="#"> Gaming Accessoris</a>
                </li>
                <li>
                  <span><ion-icon name="arrow-forward-outline"></ion-icon></span
                  ><a href="#"> License Keys</a>
                </li>
              </ul>
            </div>
            <div class="footer-inner-grid">
              <h4>Have a Question ?</h4>
              <address>
                <p>
                  <span>
                    <ion-icon name="location-outline"></ion-icon>
                  </span>

                  Karachi, Pakistan
                </p>
                <p>
                  <span>
                    <ion-icon name="call-outline"></ion-icon>
                  </span>
                  <a href="tel:+92 3332458472"> +92 3332458472 </a>
                </p>
                <p>
                  <span>
                    <ion-icon name="mail-outline"></ion-icon>
                  </span>
                  <a href="mailto:mahmer2012@gmail.com"> info@mahmer.com </a>
                </p>
                <p>
                  <span>
                    <ion-icon name="at-circle-outline"></ion-icon>
                  </span>
                  <a href="https://www.facebook.com/MhAhmer"> MhAhmer </a>
                </p>
              </address>
            </div>
          </div>
          <div class="footer-logo-div">
            <ion-icon class="footer-icon" name="logo-discord"></ion-icon>
            <ion-icon class="footer-icon" name="logo-twitter"></ion-icon>
            <ion-icon class="footer-icon" name="logo-instagram"></ion-icon>
            <ion-icon class="footer-icon" name="logo-youtube"></ion-icon>
          </div>
          <p class="para copyright-para">
            Copyright @2022 | All Rights Reserved | Design by CRS |
            Made by CEP:33
          </p>
        </div>
      </section>
    </footer>

    <!-- ========================================
    Sroll To Button
    ========================================= -->

    <div class="scrollTop-btn stroke-btn">
      <a href="cart.php">
        <ion-icon class="scroll-icon" name="cart"></ion-icon>
        <?php
            if (isset($_SESSION['cart'])){
                $count = count($_SESSION['cart']);
                echo "<span class=\"cart-count-span\">$count</span>";
            }else{
                echo "<span class=\"cart-count-span\">0</span>";
            }
          ?>
      </a>
    </div>


    <!-- ========================================
    Popup Modal
    ========================================= -->

  <div class="modal-backside">
      <div id="modal">
        <div class="modal-cross">+</div>
        <img class="modal-vector" src="./images/webMaintainace.webp" alt="">
        <div class="modal-text-div">
          
          <h4 class="modal-heading-sorry">Sorry</h4>
         <span class="modal-span">Website Under Development</span>
         <p class="modal-para">Because I am presently working on website, much of the data is <strong>dummy</strong> and certain features are incomplete. Inshallah, I'll finish it shortly.</p>
          <a href="#" class="modal-btn filled-btn" id="modal_btn_1">No Issue</a>
          <a href="#" class="modal-btn stroke-btn" id="modal_btn_2">Ok, Compelete ASAP</a>
      </div>
    </div>
  </div>


  <!-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script> -->
    
    <!-- ========================================
    ionicons
    ========================================= -->

    <script defer
      type="module"-
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <!-- <script defer
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script> -->
    
    <!-- <link rel="stylesheet" href="bio-data.css" /> -->
    <!-- <script defer src="style.css"></script> -->

    <!-- ========================================
    Swiper
    ========================================= -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!-- Swiper JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  </body>
</html>
