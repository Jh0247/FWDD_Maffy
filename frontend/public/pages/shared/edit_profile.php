<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/edit_profile.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php 
    if ($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student'){
      include '../shared/navbar.php'; 
    } else {
      include '../admin/loading.php';
      include '../admin/sidebar.php';
    }
    ?>
    <div class="w-full overflow-auto">

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
    </div>
  </div>

  <script src="./JavaScript/edit_profile.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>

</body>
</html>