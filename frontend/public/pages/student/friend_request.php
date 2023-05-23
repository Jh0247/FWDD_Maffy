<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");

    $courses = "SELECT * FROM course";
    $total_courses = mysqli_query($con,$courses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/friend-request.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Request</title>
</head>
<body>
        <!--Nav Bar Code-->
  <nav id="navBar">
    <div class="nav-left">
      <div class="hamburger">
        <div class="side-bar"></div>
      </div>
      <div class="logo">
        <a href="#"><img class="logo-image" src="../../images/Maffy.png" alt="Website Icon"> </a>
      </div>
      <form action="" id="search-bar">
        <input type="search" required id="search-input">
        <i class="fa fa-search" id="search-icon"></i>
    </form>
    </div>

    <!-- student nav bar -->
    <div class="nav-right">
      <ul class="nav-links">
        <li><a class="btn" href="./student_homepage.html">Home</a></li>
        <li><a class="btn" href="./View_All_Course.html">Course</a></li>
        <li><a class="btn" href="./friend_request.html">Friend</a></li>
        <div class="profile-res">
          <li><a class="btn my-profile-btn" href="#">My Profile</a></li>
        </div>
        <div class="profile-dropdown_links">
          <li><a href="./profile.html">Profile</a></li>
          <li><a href="#">Setting</a></li>
          <li><a href="#">Logout</a></li>
        </div>
        
        <li>
          <div class="profile">
            <img src="../../images/user_profile.png" alt="Profile Icon" id="profile-icon">
            <div class="profile-dropdown" id="profile-dropdown">
              <a href="#">Profile</a>
              <a href="#">Setting</a>
              <a href="#">Logout</a>
            </div>
          </div>
        </li>
      </ul>
      <!--Nav Responsive Part-->
      <div>
        <button class="nav-toggle">
          <div class="bar">Menu</div>
        </button>
      </div>
    </div>
  </nav>

  <div class="content" style="display: flex; flex-direction: row;min-height: 100vh;margin-top:80px">
    <div>
      <!--Side Bar Code-->
      <div class="sidebar">
        <div class="top">
          <div class="logo">
            <h1>All Course Assessment</h1>
          </div>
        </div>
        <ul>
        <?php
        if(mysqli_num_rows($total_courses)>0){
          while($row = mysqli_fetch_assoc($total_courses)){
            echo "
              <li>
                <a href='#'>
                  <i class='fa fa-book' aria-hidden='true' class='sidebar-b-i'></i>
                  <span class=\"nav-item\">".$row['course_title']."</span>
                </a>
              </li>
            ";
          }
        }
        ?>
        </ul>
      </div>
    </div>
    <!--End of sidebar-->

      <!--Search Container-->
      <div class="friend-container">
        <div class="friend-content">
            <div class="left">
                <img src="../../images/user_profile.png">
                <h1>Username</h1>
            </div>
            <div class="right">
                <div class="decision">
                    <div>
                        <button class="accept"><i class="fa fa-check fa-3x" aria-hidden="true"></i></button>
                    </div>
                    <div>
                        <button class="reject"><i class="fa fa-times fa-3x" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

</body>
</html>