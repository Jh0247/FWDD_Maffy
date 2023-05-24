<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $user_id = $_SESSION['user_id'];
  $profile_result = mysqli_query($con, "SELECT * FROM user where user_id = $user_id");
  $profile_data = mysqli_fetch_array($profile_result);

  //if click on the update button
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/edit_profile.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
</head>

<body>
<div class="w-screen h-screen flex flex-row">
  <?php include '../shared/navbar.php';?>
  <div class="w-full overflow-auto">
    <div class="details-container">
      <div class="back-btn-cont">
        <button onclick="history.back()" class="backbutton"><</button>
      </div> <!-- back button -->
      <form method="post" enctype="multipart/form-data" class="first-container">
        <div class="flex flex-row items-center">
          <img src="<?=$profile_data['user_image']?>" class="profile-image" id="image" onclick="chooseImage()">
          <div class="file-handle">
            <p>Feeling bored on your current profile?</p>
            <p>Change it to let your friend know more about you.</p>
            <input type="file" id="real-file" hidden="hidden" name="profileImage" onchange="previewImage(event);" />
          </div>
        </div>
        <div class="flex flex-col">
          <div class="flex flex-row">
            <p class="user-info-title">Username: </p>
            <input type="text" name="username" class="input" placeholder="Username" value="<?=$profile_data['username']?>">
          </div>
          <div class="flex flex-row mt-5">
            <p class="user-info-title">Email: </p>
            <input type="text" name="email" class="input" placeholder="Email" value="<?=$profile_data['user_email']?>">
          </div>
          <div class="flex flex-row mt-5">
            <p class="user-info-title">Description: </p>
            <input type="text" name="desc" class="input" placeholder="Write something about youself.." value="<?=$profile_data['user_desc']?>">
          </div>
        </div>
        <!-- type="submit" name="submitBtn"-->
        <div id="submit-cont">
          <button class="update full-rounded">
            <span>Save details</span>
            <div class="border full-rounded"></div>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- pop out edit password container -->
  <form id="form">
    <div id="pass-popout-container">
      <div id="password-popup">
        <h2>Edit Password</h2>
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password">
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password">
        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" id="confirm-password">
        <div class="button-row">
          <button type="submit" id="save-password-btn">Save</button>
          <button type="submit" id="cancel-password-btn">Cancel</button>
        </div>
      </div>
    </div>
  </form>

  <!-- edit password -->
  <script>
  // Pop out edit password container
  const editPasswordBtn = document.getElementById('edit-password-btn');
  const passwordPopup = document.getElementById('password-popup');
  const savePasswordBtn = document.getElementById('save-password-btn');
  const cancelPasswordBtn = document.getElementById('cancel-password-btn');

  editPasswordBtn.addEventListener('click', () => {
    navLinks.classList.remove('active');
    navLinks.classList.add('inactive');
    navToggle.classList.remove('active');
    navToggle.classList.add('inactive');

    passwordPopup.style.display = 'block';
  });

  editPasswordBtn.addEventListener('click', () => {
    passwordPopup.style.display = 'block';
  });

  cancelPasswordBtn.addEventListener('click', () => {
    passwordPopup.style.display = 'none';
  });

  savePasswordBtn.addEventListener('click', () => {
    passwordPopup.style.display = 'none';
  });


  // not refresh the page when submit btn is click in <form>
  $(document).ready(function() {
    $('#form').submit(function(event) {
      event.preventDefault(); // prevent form from refreshing the page
      var formData = $(this).serialize(); // get form data
      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        success: function(response) {
          // handle success response
        },
        error: function(xhr, status, error) {
          // handle error response
        }
      });
    });
  });

  function chooseImage() {
    document.getElementById('real-file').click();
  }
  </script>
  <script src="../student/JavaScript/edit_profile.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>
</body>
</html>