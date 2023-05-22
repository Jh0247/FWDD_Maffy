<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/edit.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <!--Nav Bar Code-->
  <nav id="navBar">
    <div class="nav-left">
      <!-- <div class="hamburger">
        <div class="side-bar"></div>
      </div> -->
      <div class="logo">
        <a href="./student_homepage.html"><img class="logo-image" src="../../images/Maffy.png" alt="Website Icon"> </a>
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
        <li><a class="btn" href="./View_All_Course.html">Courses</a></li>
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

  <div class="first-container">

    <div class="first-row">
        <img src="./profile.jpg" class="profile-image" id="image">
        <div class="file-handle">
            <p>Please Choose a new profile picture</p>
            <input type="file" id="real-file" hidden="hidden" accept="image/png,image/png" name="profileImage" onchange="previewImage(event);" />
            <button type="button" id="custom-button">Choose a image</button>
            <span id="custom-text">No image chosen yet</span>
        </div>
    </div>

    <div class="second-row">
      <p>Username: </p>
      <input type="text" name="text" class="input" placeholder="Username">
      <p>Email: </p>
      <input type="text" name="text" class="input" placeholder="Useremail">
    </div>

    <div class="thrid-row">
      <a class="update" href="#">I am a button</a>
    </div>

  </div>

  <script src="./JavaScript/edit_profile.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>

</body>
</html>