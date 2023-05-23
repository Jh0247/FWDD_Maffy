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
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/edit.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
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
      <!-- <a class="update" href="#">Save</a> -->
      <input type="submit" class="update" value="Save">
    </div>

  </div>

  <script src="../student/JavaScript/edit_profile.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>

</body>
</html>
