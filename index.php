<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barangay Sampaloc</title>
  <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />

  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/css/home.css">

</head>

<body>
  <section class="header">
    <div class="logo">
      <img src="assets/images/bLogo.png" alt="">
      <a href="index.php">
        <font color=black>Barangay Sampaloc</font color>
      </a>
    </div>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="#about">About</a>
      <a href="#services">Services</a>


      <?php

      if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] == TRUE) {
          $userid = $_SESSION['userid']; ?>
          <a href="contactMain.php?$userid=<?php echo $userid; ?>">Contact Us</a>
          <a href="logout.php"><button class="btn" id="btn1">Log Out</button></a>
          <?php
        }
      } else {
        ?>
        <a href="contactMain.php">Contact Us</a>
        <a href="#signup">Sign up</a>
        <a href="login.php"><button class="btn" id="btn1">Log In</button></a>
        <?php
      }
      ?>

    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
  </section>

  <section class="home">
    <div class="swiper home-slider">
      <div class="swiper-wrapper">

        <div class="swiper-slide slide" style="background:url(assets/images/main-1.png) no-repeat">
          <div class="content">
            <span>The New Barangay Sampaloc</span>
            <h3>Ito ay atin, Mahalin natin</h3>

            <?php
            if (isset($_SESSION['loggedin'])) {
              if ($_SESSION['loggedin'] == TRUE) {
                if ($_SESSION['role'] == 'Secretary' or $_SESSION['role'] == 'Chairman') {
                  ?>
                  <a href="officials.php"><button class="btn">Hello,
                      <?php echo $_SESSION['username'] ?>
                    </button></a>
                  <?php
                } elseif ($_SESSION['role'] == 'Kagawad') {
                  ?>
                  <a href="blotter.php"><button class="btn">Hello,
                      <?php echo $_SESSION['username'] ?>
                    </button></a>
                  <?php
                } elseif (
                  $_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'Restricted' ||
                  $_SESSION['role'] == 'SK Chairman' || $_SESSION['role'] == 'Treasurer'
                ) {
                  ?>
                  <a href="clearance.php"><button class="btn">Hello,
                      <?php echo $_SESSION['username'] ?>
                    </button></a>
                  <?php
                }
              }
            } else {
              ?>
              <a href="https://web.facebook.com/profile.php?id=100064518436649" class="btn">Discover More</a>
              <?php
            }
            ?>

          </div>
        </div>
        <div class="swiper-slide slide" style="background:url(assets/images/main-2.png) no-repeat"></div>s
        <div class="swiper-slide slide" style="background:url(assets/images/main-3.png) no-repeat"></div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>

  <section class="home-about" id="about">

    <div class="images">
      <img src="assets/images/about.png" alt="">
    </div>

    <div class="content">
      <h3>ABOUT US</h3>
      <p>Check out the Barangay Official's Banner, the organization's mission and <br>overarching aspirations of what
        the Barangay hopes to achieve or to become.</p>
      <a href="about.php" class="btn">Read more</a>
    </div>

  </section>

  <section class="home-packages" id="services">

    <h1 class="heading-title">Online Services</h1>

    <div class="box-container">

      <div class="box">
        <div class="images">
          <img src="assets/images/b-clearance.png" alt="">
        </div>
        <div class="content">
          <h3>Barangay Clearance</h3>
          <p>Request a barangay clearance and obtain <br> through our local Barangay Office.</p>
          <?php
          if (isset($_SESSION['loggedin'])) {
            if ($_SESSION['loggedin'] == TRUE) {
              if ($_SESSION['role'] == 'Secretary' or $_SESSION['role'] == 'Chairman' or $_SESSION['role'] == 'Kagawad') {
                ?>
                <a href="clearance.php"><button class="btn">Check Clearance Requests</button></a>
                <?php
              } elseif ($_SESSION['role'] == 'Resident') {
                ?>
                <a href="clearance.php"><button class="btn">Request Now</button></a>
                <?php
              } elseif ($_SESSION['role'] == 'Restricted') {
                ?>
                <a href="#"><button class="btn">Account Restricted</button></a>
                <?php
              }
            }
          } else {
            ?>
            <a href="login.php" class="btn">Request Now</a>
            <?php
          }
          ?>
        </div>
      </div>

      <div class="box">
        <div class="images">
          <img src="assets/images/b-permit.png" alt="">
        </div>
        <div class="content">
          <h3>Barangay Business Permit</h3>
          <p>Request a barangay business permit and obtain <br> through our local Barangay Office.</p>
          <?php
          if (isset($_SESSION['loggedin'])) {
            if ($_SESSION['loggedin'] == TRUE) {
              if ($_SESSION['role'] == 'Secretary' or $_SESSION['role'] == 'Chairman' or $_SESSION['role'] == 'Kagawad') {
                ?>
                <a href="permit.php"><button class="btn">Check Clearance Requests</button></a>
                <?php
              } elseif ($_SESSION['role'] == 'Resident') {
                ?>
                <a href="permit.php"><button class="btn">Request Now</button></a>
                <?php
              } elseif ($_SESSION['role'] == 'Restricted') {
                ?>
                <a href="#"><button class="btn">Account Restricted</button></a>
                <?php
              }
            }
          } else {
            ?>
            <a href="login.php" class="btn">Request Now</a>
            <?php
          }
          ?>

        </div>
      </div>
    </div>

  </section>

  <section class="services" id="services">

    <h3 class="heading-title"> Walk-in Services </h3>

    <div class="box-container">

      <div class="box">
        <img src="assets/images/icon-1.png" alt="">
        <h3>Barangay ID</h3>
      </div>

      <div class="box">
        <img src="assets/images/icon-2.png" alt="">
        <h3>Indigency</h3>
      </div>

      <div class="box">
        <img src="assets/images/icon-3.png" alt="">
        <h3>Barangay Clearance</h3>
      </div>

      <div class="box">
        <img src="assets/images/icon-4.png" alt="">
        <h3>Business Permit</h3>
      </div>

      <div class="box">
        <img src="assets/images/icon-5.png" alt="">
        <h3>Blotter and Complaints</h3>
      </div>
    </div>

  </section>
  <div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/news-events-tabs.css">

    <section class="announcements and events">
      <div class="container">
        <div class="row">
          <div class="col-lg-push-4 col-md-4 col-md-push-4">
            <div class="searchForm type2">
              <form action="" class="searchForm"><!-- Add The Appropriate Action for Your Site's Search Form/Page -->
              </form>
            </div>
          </div>
          <div class="clearfix visible-sm visible-xs">
            &nbsp;
          </div>
          <div class="col-lg-push-3 col-md-3 col-md-push-4">
          </div>
          <div class="clearfix visible-sm visible-xs">
            &nbsp;
          </div>
          <div class="col-lg-4 col-lg-pull-8 col-md-4 col-md-pull-8">
            <ul class="nav nav-pills" role="tablist">
              <li class="active">
                <a data-toggle="tab" href="#tab1" role="tab">Announcements</a>
              </li>
              <li>
                <a data-toggle="tab" href="#tab2" role="tab">Events</a>
              </li>
            </ul>
          </div>
        </div><!-- / row -->
        <hr>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab1">
            <div class="row">
              <div class="col-md-6">
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>2</em>Nov</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a
                        href="https://web.facebook.com/permalink.php?story_fbid=pfbid02NxV9vDtV7AzvihJjnpprekvUPsXv9k8xad96tFKXTNqh4XW3xKWVAgKjkFD5HaHkl&id=100064518436649">Iskolar
                        Program Requirements</a>
                    </h4>
                    <div class="meta-data">
                      <span class="longDate">Nov 2 - Nov 18, 2022</span>
                    </div>
                    <p>
                      Educational Financial Assistance para sa mga Kabataang mag-aaral ng Barangay Sampaloc, San Rafael,
                      Bulacan.
                    </p>
                  </div><!-- / media-body -->
                </div><!-- / media -->
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>28</em>Nov</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a href="#">Philippine National ID</a>
                    </h4>

                    <p>
                      Click the announcement to see the list of names. Stay Safe!
                    </p>
                  </div><!-- / media-body -->
                </div><!-- / media -->
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>5</em>Dec</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a
                        href="https://web.facebook.com/permalink.php?story_fbid=pfbid0pHoP5NdafRAAc4e7M8tkjxGTs4MrM71i8Rmmb7vTzpBou6HzgBKMymKyhkHTqq5tl&id=100064518436649">Solo
                        Parents Meeting</a>
                    </h4>
                    <p>
                      The solo parents meeting is cancelled. See the post for the other information.
                      Thank you and Stay safe!
                  </div><!-- / media-body -->
                </div><!-- / media -->
              </div><!-- / .col-md-6 -->
              <div class="col-md-6">
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>12</em>Jan</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a
                        href="https://web.facebook.com/permalink.php?story_fbid=pfbid0MUsDGZ5LhN9mD1mPjUhcQtcgvny6nhpwRiPpFsnmcuhEzWohF9o5qnZt1onFaT7al&id=100064518436649">Philippine
                        National ID</a>
                    </h4>
                    <p>
                      Click the announcement to see the list of names. Stay Safe!
                    </p>
                  </div><!-- / media-body -->
                </div><!-- / media -->
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>22</em>Jan</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a
                        href="https://web.facebook.com/permalink.php?story_fbid=pfbid023yeZFLAF9Edm18LZiLRUdPZjzMwgXcFAZTX6uRkyn57yGjZh15dEGQ4c4psH5Eq6l&id=100064518436649">Senior
                        Meeting</a>
                    </h4>
                    <div class="meta-data">
                      <span class="longDate">Jan 22, 2023</span> <span class="timeEl"> - 1:00pm</span>
                    </div>
                    <p>
                      Important meeting for all the senior citizen. Please see the post for other information. Thank you
                      and Stay safe!
                    </p>
                  </div><!-- / media-body -->
                </div><!-- / media -->
                <div class="media">
                  <a class="pull-left" href="#"><span class="dateEl"><em>8</em>Feb</span></a>
                  <div class="media-body">
                    <h4 class="media-heading">
                      <a href="#">PWD Meeting</a>
                    </h4>
                    <div class="meta-data">
                      <span class="longDate">Feb 9, 2023</span> <span class="timeEl"> - 3:00pm</span>
                    </div>
                    <p>
                      IMPORTANT: PWD Meeting. See the post for the other information. Thank you and Stay safe!
                    </p>
                  </div><!-- / media-body -->
                </div><!-- / media -->
              </div><!-- / .col-md-6 -->
            </div><!-- / row -->
            <div class="text-center">
              <br>
              <a class="btn btn-default" href="https://web.facebook.com/profile.php?id=100064518436649">SEE ALL
                ANNOUNCEMENTS</a>
            </div>
          </div>
          <div class="tab-pane fade" id="tab2">
            <div class="row">
              <div class="col-md-6">
                <div class="blogPost--small">
                  <div class="media">
                    <span class="pull-left"><a href="#"><span class="date"><span>12</span>
                          <small>Sep</small></span></a></span>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a
                          href="https://web.facebook.com/permalink.php?story_fbid=pfbid02uecPdi4uXs5TrtUC3ERLkvZtFpKvCMGetfjErpasuzK7LTkN13t1JrhDP2n94P5Dl&id=1142857372520948">Sangguniang
                          Kabataan InterColor Basketball League 2022</a>
                      </h4>
                      <p>
                        Game Schedule for September 12, 2022
                      </p>
                    </div>
                  </div>
                </div><!-- / blogPost -->
                <div class="blogPost--small">
                  <div class="media">
                    <span class="pull-left"><a href="#"><span class="date"><span>25</span>
                          <small>Oct</small></span></a></span>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a
                          href="https://web.facebook.com/permalink.php?story_fbid=pfbid0qvhmJFrdaPNLNjpnbptFiHyWm7vRzdWuw3xt7qFN3RXiHgsyew8hfL2iSDA8hnK1l&id=100064518436649">SPOOKY
                          NIGHT , TRICK OR TREAT</a>
                      </h4>
                      <p>
                        Handog ng Sangguniang Kabataan ng Barangay Sampaloc at sa Pakikipag tulungan ng TAU GAMMA PHI
                        Sampaloc Riles Community Chapter.
                        Click the event link to see the further information. Thank you and Stay Safe!
                      </p>
                    </div>
                  </div>
                </div><!-- / blogPost -->
              </div><!-- / .col-md-6 -->
              <div class="col-md-6">
                <div class="blogPost--small">
                  <div class="media">
                    <span class="pull-left"><a href="#"><span class="date"><span>29</span>
                          <small>Oct</small></span></a></span>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a
                          href="https://web.facebook.com/permalink.php?story_fbid=pfbid0KCir5Kr3NT5y5v4HVhhtATTMYSubv1kGqYvLGRpBDCo9gDnTkhiEWw9VNEjqxw7yl&id=100064518436649">Barangay
                          Assembly Day</a>
                      </h4>
                      <p>
                        2ND Semester CY 2022. Click the event to see the other information. Thank you and Stay safe!
                      </p>
                    </div>
                  </div>
                </div><!-- / blogPost -->
                <div class="blogPost--small">
                  <div class="media">
                    <span class="pull-left"><a href="#"><span class="date"><span>20</span>
                          <small>Dec</small></span></a></span>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a
                          href="https://web.facebook.com/permalink.php?story_fbid=pfbid029PJLfPkyRFVwnDEcvxw8nR4hgu9vfkctJ1mWgDgvDVqDUL6TTTFwtyhpHsDAEXt8l&id=100064518436649">"PAMASKO
                          PARA SA MGA BAKUNA AY KUMPLETO" RAFFLE DRAW!</a>
                      </h4>
                      <p>
                        ANO PA ANG HINIHINTAY NINYO? IHANDA NA ANG MGA VACCINATION CARDS!
                        At kung kulang ka pa sa bakuna...
                        MAGPA-BAKUNA NA UPANG MANALO AT MAGING PROTEKTADO NGAYONG DARATING NA KAPASKUHAN!
                        Click the link of the event to see the other information.
                      </p>
                    </div>
                  </div>
                </div><!-- / blogPost -->
              </div><!-- / row -->
              <div class="text-center">
                <br>
                <a class="btn btn-default" href="https://web.facebook.com/profile.php?id=100064518436649">SEE ALL
                  EVENTS</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  </div>

  <?php
  if (!isset($_SESSION['loggedin'])) {
    ?>
    <section class="home-offer" id="signup">
      <div class="content">
        <h3>No Account Yet?</h3>
        <p>Create a new resident account.</p>
        <a href="register.php"><button class="btn" id="btn2">Register here</button></a>
      </div>
    </section>
    <?php
  }
  ?>

  <section class="footer">
    <div class="box-container">

      <div class="box">
        <h3>Quick Links</h3>
        <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
        <a href="#services"> <i class="fas fa-angle-right"></i> Services</a>
        <a href="register.php"> <i class="fas fa-angle-right"></i> Register</a>
      </div>

      <div class="box">
        <h3>Contact Info</h3>
        <a href=""> <i class="fas fa-phone"></i> +639-854-2463 </a>
        <a href=""> <i class="fas fa-phone"></i> +639-355-9571 </a>
        <a href=""> <i class="fas fa-envelope"></i> barangaysampaloc@gmail.com </a>
        <a href="https://goo.gl/maps/oa1xg7UuKCrehJMg9"> <i class="fas fa-map"></i> XWHH+VG4, San Rafael, Bulacan
        </a>
      </div>

      <div class="credit"> ©2023 Copyright Barangay Sampaloc</div>

  </section>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="assets/js/script.js"></script>

</body>

</html>