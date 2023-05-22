<?php
  include("../../../../backend/conn.php");
  if(!isset($_SESSION)) {
    session_start();
  };

  //sql query to get most performance courses
  $trend_course_sql = mysqli_query($con, 
  "SELECT * FROM course  WHERE course_status = 1
  ORDER BY course_click DESC
  LIMIT 5");
    
  //Close connection of database
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/home.css">
  <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="../../../src/stylesheets/shared/nav_bar.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Maffy - The learning Platform</title>
</head>

<body>
  <?php include '../shared/navbar.php'; ?>
  <div class="content">
    <!-- section for about us -->
    <section id="about-us" class="flex flex-col h-screen w-screen green-bg">
      <div class="overflow-hidden absolute h-4/6 w-screen">
        <img src="../../images/website.jpg" alt="technology" class="techImg">
      </div>
      <div class="flex justify-center items-center w-full relative top-24 sm:top-64 lg:top-80">
        <div class="flex about-us-cont flex-col sm:flex-row w-3/4 sm:w-5/6 lg:4/6">
          <!-- maffy details -->
          <div class="flex flex-col w-full sm:w-1/2">
            <!-- logo -->
            <div class="flex flex-row sm:flex-col sm:w-full h-28 sm:h-36 md:h-56 lg:h-64 pr-5 py-5 lg:px-16 justify-center">
              <img src="../../images/Maffy.png" alt="logo" class="logo-img">
            </div>
            <!-- contact us button -->
            <div id="normal-responsive-contact" class="flex flex-row sm:w-10/12 mb-5 justify-center lg:pl-6">
              <button class="learn-more contact-btn mx-5">
                <span class="circle" aria-hidden="true">
                  <span class="icon arrow"></span>
                </span>
                <span class="button-text">Contact Us</span>
              </button>
            </div>
          </div>
          <!-- content details -->
          <div class="sm:w-1/2 p-5">
            <h2 class="mb-4 sm:mb-8">Who we are</h2>
            <p class="about-us-details">
            Maffy is an innovative online platform for IT education, offering a wide range of courses taught by expert instructors. 
            With a user-friendly interface and interactive learning experiences, Maffy provides accessible education in 
            several programming courses.
            </p>
            <div id="mobile-responsive-contact" class="flex flex-row w-full my-5">
              <button class="learn-more contact-btn">
                <span class="circle" aria-hidden="true">
                  <span class="icon arrow"></span>
                </span>
                <span class="button-text">Contact Us</span>
              </button>
            </div> <!-- mobile-responsive-contact -->
          </div>
        </div>
      </div>
    </section>

    <!-- section for course -->
    <section id="course" class="course-container h-screen w-screen">
      <div class="flex flex-col items-center justify-center">
        <!-- text -->
        <h2 class="my-5 sm:my-10 lg:my-16">Our course</h2>
        <!-- slider -->
        <div class="w-screen h-full flex flex-row justify-center items-center">
          <div class="slider-container w-3/4 lg:w-5/6">

          <?php
            if(mysqli_num_rows($trend_course_sql) > 0)
            {
              foreach($trend_course_sql as $course_data) // Run SQL query
              {
                ?>
                <div class="slider-card mx-3 lg:mx-8">
                  <a href="" class="h-3/5">
                    <img src="<?=$course_data['course_image']?>">
                  </a>
                  <div class="slider-caption h-2/5">

                    <h2 class="my-3"><?php echo $course_data['course_title']; ?></h2>
                    <p><?php echo $course_data['course_desc']; ?></p>
                  </div>
                </div>          
                <?php
              }
            }
          ?>
          </div> <!-- slider container -->
        </div>
      </div>
    </section>

    <!-- section for faq -->
    <section id="faq" class="faq-container h-screen w-screen">
      <div class="flex flex-col items-center justify-center">
        <!-- text -->
        <h2 class="my-5 sm:my-10 lg:my-16 text-center">Frequently Asked Questions</h2>
        <div class="accordion">
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <h2 class="accordion-title">
                How can I enroll into a course by using the Maffy platform?
              </h2>
              <span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
              <p>
                Maffy is a free learning education website that serve all user to have a better understanding on multiple 
                programming languages, you do not need to enroll yourself into any course while you can direcrly view all the course
                available in the website.
              </p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-2" aria-expanded="false">
              <h2 class="accordion-title">
                How do I access the course materials?
              </h2>
              <span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
              <p>
                There were several way for you to access Maffy learning course which you can directly find some course in the homepage.
              </p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-3" aria-expanded="false">
              <h2 class="accordion-title">
                What should I do if I encounter technical issues?
              </h2>
              <span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
              <p>
                Please contact our website administrator by clicking on the contact us button above. Or you may send an email to "maffy@sample.com"
              </p>
            </div>
          </div>
          <div class="accordion-item">
            <button id="accordion-button-4" aria-expanded="false">
              <h2 class="accordion-title">
                Can I interact with other students on the platform?
              </h2>
              <span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
              <p>
                Yes. You may send a friend request to your friend and upon they accept the friend request, you may start sending message to your friend.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="footer" class="flex flex-row justify-center copyright">
      <p>COPYRIGHT @ MAFFY</p>
    </section>
  </div>

  <!-- ======================================================================================================= -->
  <!-- ==================================       Script       ================================================= -->
  <!-- ======================================================================================================= -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../../jquery-plugin/carousel/slick/slick.min.js"></script>
  <script>
    // this is the function for the slider with using jQuery plugin and some params
    $(document).ready(function() {
      $('.slider-container').slick({
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev">Previous</button>',
        nextArrow: '<button type="button"class="slick-next">Next</button>',
        responsive: [{
            breakpoint: 768,
            settings: {
              arrows: true,
              centerMode: true,
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 320,
            settings: {
              arrows: true,
              centerMode: true,
              slidesToShow: 1,
            }
          }
        ]
      });
    });

    //this javascript is for the accordion
    const items = document.querySelectorAll(".accordion button"); //get all class for accordion button
    function toggleAccordion() {
      const itemToggle = this.getAttribute('aria-expanded');

      for (i = 0; i < items.length; i++) {
        items[i].setAttribute('aria-expanded', 'false');
      }

      if (itemToggle == 'false') {
        this.setAttribute('aria-expanded', 'true');
      }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));

    document.addEventListener('DOMContentLoaded', function() {
      // Get all the navbar links
      var navbarLinks = document.querySelectorAll('nav a');

      // Attach click event listeners to each navbar link
      navbarLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
          e.preventDefault(); // Prevent the default link behavior

          // Get the target section ID from the href attribute
          var targetId = link.getAttribute('href');

          // Scroll to the target section
          document.querySelector(targetId).scrollIntoView({
            behavior: 'smooth' // Use smooth scrolling
          });
        });
      });
    });
  </script>
</body>

</html>