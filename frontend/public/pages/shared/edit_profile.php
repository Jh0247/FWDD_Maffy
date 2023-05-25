<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $user_id = $_SESSION['user_id'];
  $profile_result = mysqli_query($con, "SELECT * FROM user where user_id = $user_id");
  $profile_data = mysqli_fetch_array($profile_result);

  //if click on the update button
  if (isset($_POST['updateProfileBtn'])) {

    $username = strtolower($_POST['username']);
    $email = $_POST['email'];
    $mydesc = $_POST['mydesc'];

    $update = TRUE;
    //Get all user data
    $validation_user_query = "SELECT * FROM user";
    $validation_user_query_run = mysqli_query($con, $validation_user_query);
    if (!$validation_user_query_run){
      die('Error validation query: ' . mysqli_error($con));
    }

    //validation process for unique username
    if(mysqli_num_rows($validation_user_query_run) > 0) {
      foreach($validation_user_query_run as $row)
      {
        if($row['username'] == $username && $row['username'] != $_SESSION['username'])
        {
          echo("<script>alert('Username already exists!')</script>");
          $update = FALSE; //turn false to stop update process
          break;
        }
      }
    }

    if($update){
      $userProfile = $_FILES['profileImage']['tmp_name'];
      //update when got image
      if ($_FILES['profileImage']['size'] > 0){
        echo("<script>alert('got file exists!')</script>");
        //get image type
        $profileImg = strtolower(pathinfo($userProfile,PATHINFO_EXTENSION));
        //encode image into base64
        $submitImg = base64_encode(file_get_contents($userProfile));
        //set image content with type and base64
        $processImg = 'data:image/'.$profileImg.';base64,'.$submitImg;
        $sql = "UPDATE `user` SET `username`= '$username', `user_email` = '$email', `user_desc` = '$mydesc', `user_image`= '$processImg' WHERE `user_id` = " . $_SESSION['user_id'];
        $result = mysqli_query($con, $sql);
      } else {
      // update when no image
      $sql = "UPDATE `user` SET `username` = '$username', `user_email` = '$email', `user_desc` = '$mydesc' WHERE `user_id` = " . $_SESSION['user_id'];
      $result = mysqli_query($con, $sql);
      }
      if ($result){
        header("Location: ../shared/user_profile.php");
      }
      else{
        echo("Error description: " . mysqli_error($con));
      }
    }
  }

  //if edit password
  if (isset($_POST['savePasswordBtn'])) {
    // Get user id
    $user_id = $_SESSION['user_id'];
  
    // Get user details
    $result = mysqli_query($con, "SELECT * FROM user WHERE user_id = $user_id");
  
    // Check if the query executed successfully
    if ($result) {
      // Get the result row
      $row = mysqli_fetch_assoc($result);
  
      // Check if the current password matches
      if ($row['password'] == $_POST['currentpsw']) {
        // Check if the new password matches the confirm password
        if ($_POST['newpsw'] == $_POST['confirmpsw']) {
          // Update user password
          $new_password = mysqli_real_escape_string($con, $_POST['newpsw']);
          $update_sql = "UPDATE user SET password = '$new_password' WHERE user_id = $user_id";
  
          // Execute the update query
          if (mysqli_query($con, $update_sql)) {
            echo '<script>alert("Your Password Has Been Changed Successfully!");</script>';
          } else {
            // Display error message for database
            echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
          }
        } else {
          // Notify user that new password does not match confirm password
          echo '<script>alert("New Password does not match with Confirm Password.");</script>';
        }
      } else {
        // Notify user that current password is incorrect
        echo '<script>alert("Current password is incorrect.");</script>';
      }
    } else {
      // Display error message for database query
      echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
  }
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/edit_profile.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
</head>

<body>
<div id="all" class="w-screen h-screen flex flex-row">
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
          <!-- password icon -->
          <span class="forgot-password" id="edit-password-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon"><g stroke-width="1.5" stroke-linecap="round" stroke="#5d41de">
              <circle stroke="#394955" r="2.5" cy="10" cx="10"></circle><path stroke="#394955" fill-rule="evenodd" d="m8.39079 2.80235c.53842-1.51424 2.67991-1.51424 3.21831-.00001.3392.95358 1.4284 1.40477 2.3425.97027 1.4514-.68995 2.9657.82427 2.2758 2.27575-.4345.91407.0166 2.00334.9702 2.34248 1.5143.53842 1.5143 2.67996 0 3.21836-.9536.3391-1.4047 1.4284-.9702 2.3425.6899 1.4514-.8244 2.9656-2.2758 2.2757-.9141-.4345-2.0033.0167-2.3425.9703-.5384 1.5142-2.67989 1.5142-3.21831 0-.33914-.9536-1.4284-1.4048-2.34247-.9703-1.45148.6899-2.96571-.8243-2.27575-2.2757.43449-.9141-.01669-2.0034-.97028-2.3425-1.51422-.5384-1.51422-2.67994.00001-3.21836.95358-.33914 1.40476-1.42841.97027-2.34248-.68996-1.45148.82427-2.9657 2.27575-2.27575.91407.4345 2.00333-.01669 2.34247-.97026z" clip-rule="evenodd"></path></g></svg>
            <span class="lable">Edit Password</span>
          </span>
          </div>
          <div class="flex flex-row mt-5">
            <p class="user-info-title">Username: </p>
            <input type="text" name="username" class="input" placeholder="Username" value="<?=$profile_data['username']?>">
          </div>
          <div class="flex flex-row mt-5">
            <p class="user-info-title">Email: </p>
            <input type="text" name="email" class="input" placeholder="Email" value="<?=$profile_data['user_email']?>">
          </div>
          <div class="flex flex-row mt-5">
            <p class="user-info-title">Description: </p>
            <textarea id="desc" name="mydesc" class="desc" placeholder="Write something about youself.." value="<?=$profile_data['user_desc']?>"></textarea>
          </div>
        </div>
        <div id="submit-cont">
          <button class="update full-rounded" name="updateProfileBtn">
            <span>Save details</span>
            <div class="border full-rounded"></div>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- pop out edit password container -->
  <form method="post" id="form" enctype="multipart/form-data">
    <div id="pass-popout-container">
      <div id="password-popup">
        <h2>Edit Password</h2>
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password" name="currentpsw">
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="newpsw">
        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" id="confirm-password" name="confirmpsw">
        <div class="button-row">
          <button type="submit" name="savePasswordBtn" id="save-password-btn">Save</button>
          <button id="cancel-password-btn">Cancel</button>
        </div>
      </div>
    </div>
  </form>
  <script>
  function pop_block() {
    Swal.fire({
      icon: 'warning',
      title: 'ALERT',
      text: 'Please use desktop to access this page!',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'Continue'
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        to_profile();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function to_profile() {
    window.location = '../shared/user_profile.php'
  }

  </script>
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

  function chooseImage() {
    document.getElementById('real-file').click();
  }

  window.onload = function() {
    // Check the width of the browser window
    var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (windowWidth < 760) {
      document.getElementById('all').style.display = 'none';
      pop_block();
    }
  };
  </script>
  <script src="../student/JavaScript/edit_profile.js"></script>
  <script src="./JavaScript/nav_bar.js"></script>
</body>
</html>