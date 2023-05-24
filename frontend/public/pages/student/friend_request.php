<?php
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $user_id = $_SESSION['user_id'];
  $friend_request_sql = mysqli_query($con, 
  "SELECT
    CASE
        WHEN first_user_id = $user_id THEN second_user_id
        ELSE first_user_id
    END AS second_user_id,
    CASE
        WHEN first_user_id = $user_id THEN first_user_id
        ELSE second_user_id
    END AS first_user_id,
    friend_status, friend_list_id, user.user_image, user.username
  FROM friend_list
  INNER JOIN user ON user.user_id =(
    CASE
        WHEN friend_list.second_user_id != $user_id THEN friend_list.second_user_id
        ELSE friend_list.first_user_id
    END)
  WHERE (first_user_id = $user_id OR second_user_id = $user_id)
  AND friend_status = 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/friend-request.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Request</title>
</head>
<body>
<div class="w-screen h-screen flex flex-col">
  <?php include '../shared/navbar.php';?>
  <div class="w-full h-full overflow-auto">
    <div class="content flex flex-row min-h-full mt-14">
      <div>
        <!--Side Bar Code-->
        <div class="sidebar">
          <div class="top">
            <div class="logo">
              <h1>Friend List</h1>
            </div>
          </div>
          <ul>
          <?php
          // get the user friend list
            $user_lists = mysqli_query($con, 
            "SELECT
              CASE
                  WHEN first_user_id = $_SESSION[user_id]  THEN second_user_id
                  ELSE first_user_id
              END AS second_user_id,
              CASE
                  WHEN first_user_id = $_SESSION[user_id]  THEN first_user_id
                  ELSE second_user_id
              END AS first_user_id,
              friend_status, user.username, user.user_image
              FROM friend_list
              INNER JOIN user ON user.user_id = friend_list.second_user_id
              WHERE (first_user_id = $_SESSION[user_id] OR second_user_id =$_SESSION[user_id])
              AND friend_status = 1;");
            if(mysqli_num_rows($user_lists) > 0) {
              foreach($user_lists as $data) {
                echo '
                <li>
                    <a href="../student/chat.php?friend=' . $data['second_user_id'] . '">
                      <img src="' . $data['user_image'] . '" alt="profile pic" class="user-profile-img">
                      <span class="nav-item">' . $data['username'] . '</span>
                    </a>
                  </li>
                ';
              }
            } else {
              ?>
              <li>
                <a href="../shared/view_all_course.php">
                  <i class="fa-solid fa-search"></i>
                  <span class="nav-item">Find a course friend!</span>
                </a>
              </li>
              <?php
            }
          ?>
          </ul>
        </div>
      </div>
      <!--End of sidebar-->
      <div class="friend-container">
        <h2 class="title">Friend Request</h2>
        <?php
          if(mysqli_num_rows($friend_request_sql) > 0) {
            foreach($friend_request_sql as $row_data) {
              ?>
              <div class="friend-content">
                <div class="left">
                  <img src="<?=$row_data['user_image']?>" alt="profile image" class="user-img">
                  <h1><?php echo $row_data['username']; ?></h1>
                </div>
                <div class="right">
                  <div class="decision">
                    <div>
                      <button class="accept" onclick="acceptAction(<?php echo $row_data['friend_list_id']; ?>)"><i class="fa fa-check fa-3x" aria-hidden="true"></i></button>
                    </div>
                    <div>
                      <button class="reject" onclick="rejectAction(<?php echo $row_data['friend_list_id']; ?>)"><i class="fa fa-times fa-3x" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="friend-content text-center py-10 mt-5">
              <h2 class="sm:ml-5">No Pending Freind Request</h2>
            </div>
            <?php
          }
          ?>
      </div>
    </div>
  </div>
</div>
<script>

  function acceptAction(target) {
    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    
    // Define the request parameters
    var url = '../../../../backend/update-friend-request.php';
    var params = 'type=accept&list_id=' + encodeURIComponent(target);

    // Configure the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    // Define the callback function for when the request completes
    xhr.onload = function() {
      if (xhr.status === 200) {
        location.reload();
      } else {
        // Request failed
        location.reload();
        console.log('Error: Accept request failed');
      }
    };

    xhr.send(params);
  }

  function rejectAction(target) {
    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    
    // Define the request parameters
    var url = '../../../../backend/update-friend-request.php';
    var params = 'type=reject&list_id=' + encodeURIComponent(target);

    // Configure the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    // Define the callback function for when the request completes
    xhr.onload = function() {
      if (xhr.status === 200) {
        location.reload();
      } else {
        // Request failed
        location.reload();
        console.log('Error: Reject request failed');
      }
    };

    xhr.send(params);
  }
</script>
</body>
</html>