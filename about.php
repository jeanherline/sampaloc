<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/home.css">

   <style>
      *,
      *:before,
      *:after {
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }

      .popup {
         background-color: #ffffff;
         width: 430px;
         padding: 30px 40px;
         position: absolute;
         transform: translate(-50%, -50%);
         left: 50%;
         top: 50%;
         border-radius: 8px;
         font-family: "Poppins", sans-serif;
         display: none;
         text-align: center;
      }

      .popup button {
         display: block;
         margin: 0 0 20px auto;
         background-color: transparent;
         font-size: 30px;
         color: #ffffff;
         background: #03549a;
         border-radius: 100%;
         width: 40px;
         height: 40px;
         border: none;
         outline: none;
         cursor: pointer;
      }

      .popup h2 {
         margin-top: 10px;
         font-size: 27px;
      }

      .popup p {
         font-size: 14px;
         text-align: justify;
         margin: 18px 0;
         line-height: 25px;
      }

      .sure a {
         display: block;
         font-size: 20px;
         width: 200px;
         position: relative;
         margin: 10px auto;
         text-align: center;
         background-color: #0f72e5;
         border-radius: 20px;
         color: #ffffff;
         text-decoration: none;
         padding: 8px 0;
      }
   </style>
</head>

<body>
   <div class="popup">
      <button id="close">&times;</button>
      <h2>We'd Welcome your Feedback</h2>
      <p>
         Thank you for visiting our website. We would appreciate your ample time on giving brief resident
         satisfaction survey to let us know how we can improve your experience.

      </p>
      <div class="sure">
         <a
            href="https://docs.google.com/forms/d/e/1FAIpQLSfaLsFe-56OE4sBeYpb42oC3Qn9Xp3Ic3k7Nsh5EJxFYzIIjA/viewform?usp=sf_link">Sure!
         </a>
      </div>
   </div>
   <!--Script-->
   <script type="text/javascript">

      window.addEventListener("load", function () {
         setTimeout(
            function open(event) {
               document.querySelector(".popup").style.display = "block";
            },
            2000
         )
      });
      document.querySelector("#close").addEventListener("click", function () {
         document.querySelector(".popup").style.display = "none";
      });

      window.onbeforeunload = function () {
         localStorage.removeItem('.popup');
      };

   </script>

   <!-- header section starts  -->

   <section class="header">

      <div class="logo">
         <img src="assets/images/bLogo.png" alt="">
         <a>Barangay Sampaloc</a>
      </div>

      <nav class="navbar">
         <a href="index.php">Home</a>
         <a href="contactMain.php">Contact Us</a>
         <?php
         if (isset($_SESSION['loggedin'])) {
            if ($_SESSION['loggedin'] == TRUE) {
               if ($_SESSION['role'] == 'Secretary' or $_SESSION['role'] == 'Chairman') {
                  ?>
                  <a href="officials.php">Account</a>
                  <?php
               } elseif ($_SESSION['role'] == 'Kagawad') {
                  ?>
                  <a href="blotter.php">Account</a>
                  <?php
               } else {
                  ?>
                  <a href="clearance.php">Account</a>
                  <?php
               }
            }
         }
         ?>

         <?php
         if (isset($_SESSION['loggedin'])) {
            if ($_SESSION['loggedin'] == TRUE) {
               ?>
               <a href="logout.php"><button class="btn" id="btn1">Log Out</button></a>
               <?php
            }
         } else {
            ?>
            <a href="register.php">Sign up</a>
            <a href="login.php"><button class="btn" id="btn1">Log In</button></a>
            <?php
         }
         ?>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </section>

   <!-- header section ends -->

   <div class="heading" style="background:url(assets/images/header-bg-1.png) no-repeat">
      <h1>about us</h1>
   </div>

   <!-- about section starts  -->

   <section class="about">

      <div class="images">
         <img src="assets/images/bOfficial.jpg" alt="">
      </div>

      <div class="content">
         <h3>Barangay Officials 2018-2023</h3><br><br><br>
         <h3>
            <font color=green>Vision</font color>
         </h3>
         <p>Maayos at malusog na pamayanan na pinamamahayan ng malusog na mamamayan.</p>
         <h3>
            <font color=green>Mission</font color>
         </h3>
         <p>Maiangat ang antas ng kalusugan ng mga mamamayan lalo't higit ang mga batang
            hindi pa nag-aral, mga buntis, at mga nagpapasusong ina.
         </p>

      </div>

   </section>

   <section class="footer">
      <div class="credit"> ©2023 Copyright Barangay Sampaloc</div>

   </section>


   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

   <script src="assets/js/script.js"></script>

</body>

</html>