<?php
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  if (isset($_GET['id'])){
    $posted_user_id = $_GET['id'];

    //sql to get user privileges
    $user_sql = mysqli_query($con, "SELECT * FROM user WHERE user_id = $posted_user_id");
    $user_role = mysqli_fetch_array($user_sql);
    $user_privilege = $user_role['privilege_id'];

    if ($user_privilege == '2') { //teacher
      $check_profile = mysqli_query($con, 
      "SELECT user.user_id, COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
      INNER JOIN course ON course.user_id = user.user_id    
      WHERE user.user_id = $posted_user_id AND course_status = 1");
      //get the row data to validate
      $row = mysqli_fetch_row($check_profile);

      //if no row then no course is shown
      if ($row && is_null($row[0])) {
        $profile_sql = mysqli_query($con, 
        "SELECT user_id, privilege_id, username, user_image, user_email, user_desc, user_active, user_support_doc FROM user
        WHERE user.user_id = $posted_user_id");
        $user_data = mysqli_fetch_array($profile_sql);
        $avg_score = 0;
      } else { //do sql to get data from database 
        $profile_sql = mysqli_query($con, 
          "SELECT user.user_id, user.privilege_id, user.username, user.user_image, user.user_email,
          user.user_desc, user_active, user_support_doc,
          COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
          INNER JOIN course ON course.user_id = user.user_id    
          WHERE user.user_id = $posted_user_id AND course_status = 1");
        $user_data = mysqli_fetch_array($profile_sql);
        $avg_score = $user_data['total_view']/$user_data['total_course'];
      }
      //course sql
      $result = mysqli_query($con, "SELECT * FROM course WHERE user_id = $posted_user_id");
    } else if ($user_privilege == '3') { //student
      //get user data
      $profile_sql = mysqli_query($con, "SELECT * FROM user WHERE user_id = $posted_user_id");
      $user_data = mysqli_fetch_array($profile_sql);

      //get user friend details
      $result = mysqli_query($con, 
      "SELECT * FROM friend_list WHERE first_user_id = $posted_user_id OR second_user_id = $posted_user_id");
    }
  } 
  else {
    //assign privilege
    $user_privilege = $_SESSION['privilege'];
    if ($user_privilege == 'teacher'){
      $posted_user_id = $_SESSION['user_id'];
      //profile sql to check score
      $check_profile = mysqli_query($con, 
      "SELECT user.user_id, COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
      INNER JOIN course ON course.user_id = user.user_id    
      WHERE user.user_id = $posted_user_id AND course_status = 1");
      //get the row data to validate
      $row = mysqli_fetch_row($check_profile);

      //if no row then no course is shown
      if ($row && is_null($row[0])) {
        $profile_sql = mysqli_query($con, 
        "SELECT user_id, privilege_id, username, user_image, user_email, user_desc, user_active, user_support_doc FROM user
        WHERE user.user_id = $posted_user_id");
        $user_data = mysqli_fetch_array($profile_sql);
        $avg_score = 0;
      } else { //do sql to get data from database 
        $profile_sql = mysqli_query($con, 
          "SELECT user.user_id, user.privilege_id, user.username, user.user_image, user.user_email, 
          user.user_desc, user_active, user_support_doc,
          COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
          INNER JOIN course ON course.user_id = user.user_id    
          WHERE user.user_id = $posted_user_id AND course_status = 1");
        $user_data = mysqli_fetch_array($profile_sql);
        $avg_score = $user_data['total_view']/$user_data['total_course'];
      }
      //course sql
      $result = mysqli_query($con, "SELECT * FROM course WHERE user_id = $posted_user_id");
    }
    else if ($user_privilege == 'student'){
      $posted_user_id = $_SESSION['user_id'];
      
      $profile_sql = mysqli_query($con, "SELECT * FROM user WHERE user_id = $posted_user_id");
      $user_data = mysqli_fetch_array($profile_sql);

      //friend sql
      $result = mysqli_query($con, 
      "SELECT * FROM friend_list WHERE first_user_id = $posted_user_id OR second_user_id = $posted_user_id");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/user_profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />    
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Profile Page</title>
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
    <div class="details-container items-center">
      <div class="flex flex-row w-full">
        <button onclick="history.back()" class="backbutton"><</button>
      </div>
      <div class="profile-container flex flex-row">
        <div class="user-container flex flex-col sm:flex-row">
          <!-- User profile image -->
          <div class="user-image mt-4">
            <img src="<?=$user_data['user_image']?>" alt="User Profile Image" class="profile-image">
          </div>

          <!-- User details -->
          <div class="user-details justify-center sm:ml-5">
            <h2><?php echo $user_data['username']; ?></h2>
            <p><?php echo $user_data['user_email']; ?></p>
          </div>
        </div>
        
        <div class="flex flex-col sm:flex-row">
          <!-- if not student the display this modal button to view suppor doc -->
          <?php
          if ($user_data['privilege_id'] != 3){
            ?>
            <!-- display file button -->
            <a id="download-doc" class="flex flex-col text-center" onclick="document.getElementById('modal').style.display='block'">
              <span class="download-btn mr-2 sm:mr-4">
                <i class="fa-solid fa-file-image"></i>
              </span>
            </a>
            <?php
          } else if ($_SESSION['privilege'] !== 'admin'){
            // to see student can add or remove friend
            if (isset($_GET['id'])){
              $page_user_id = $_GET['id'];
              $self_id = $_SESSION['user_id'];
              if($_SESSION['user_id'] != $page_user_id) {
                // validate see if friend or not
                $friend_result = mysqli_query($con, 
                "SELECT
                  CASE
                    WHEN first_user_id = $self_id THEN second_user_id
                    ELSE first_user_id
                  END AS second_user_id,
                  CASE
                    WHEN first_user_id = $self_id THEN first_user_id
                    ELSE second_user_id
                  END AS first_user_id,
                  friend_status, friend_list_id
                  FROM friend_list
                  INNER JOIN user ON user.user_id =(
                  CASE
                    WHEN friend_list.second_user_id != $self_id THEN friend_list.second_user_id
                    ELSE friend_list.first_user_id
                  END)
                  WHERE (first_user_id = $self_id OR second_user_id = $self_id)
                  AND (first_user_id = $page_user_id OR second_user_id = $page_user_id)");

                $get_friend_result = mysqli_fetch_array($friend_result);

                  if(isset($get_friend_result) && $get_friend_result['friend_status'] == 1) {
                    ?>
                    <button onclick="deleteAction(<?php echo $get_friend_result['friend_list_id']; ?>)" class="flex flex-col text-center">
                      <span class="download-btn mr-2 sm:mr-4">
                        <i class="fa-solid fa-user-slash"></i>
                      </span>
                    </button>
                    <?php
                  } else if (isset($get_friend_result) && $get_friend_result['friend_status'] == 0){
                    ?>
                    <span class="flex flex-col text-center">
                      <span class="mr-2 sm:mr-4">
                        <i class="fa-solid fa-spinner"></i>
                        PENDING
                      </span>
                    </span>
                    <?php
                  }
                  else {
                    ?>
                    <button onclick="requestAction(<?php echo $page_user_id; ?>)" class="flex flex-col text-center">
                      <span class="download-btn mr-2 sm:mr-4">
                        <i class="fa-solid fa-user-plus"></i>
                      </span>
                    </button>
                    <?php
                  }
                ?>
                <?php
              }
            }
          }
          ?>
          <a class="btn-container">
            <?php 
            if ($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student'){
              if (isset($_GET['id'])){
                $page_user_id = $_GET['id'];
                if($_SESSION['user_id'] == $page_user_id) {
              ?>
                <!-- Edit button -->
                <a href="../shared/edit_profile.php" class="edit-btn">Edit Profile</button>
                <a href="../shared/edit_profile.php" class="edit-icon"><i class="fas fa-edit"></i></button>
              <?php
                }
              } else {
                ?>
                <!-- Edit button -->
                <a href="../shared/edit_profile.php" class="edit-btn">Edit Profile</button>
                <a href="../shared/edit_profile.php" class="edit-icon"><i class="fas fa-edit"></i></button>
                <?php
              }
            } else {
              if ($user_data['user_active'] == 1) {
                ?>              
                <a class="edit-btn" onclick="displayCheck('update_freeze', <?php echo $user_data['user_id']; ?>)"><h2>lock Account</h2></a>
                <a class="edit-icon" onclick="displayCheck('update_freeze', <?php echo $user_data['user_id']; ?>)"><i class="fa-solid fa-lock"></i></a>
                <?php
              } else if ($user_data['user_active'] == 2){
                ?>
                <a class="edit-btn" onclick="displayCheck('update_active', <?php echo $user_data['user_id']; ?>)"><h2>Unlock Account</h2></a>
                <a class="edit-icon" onclick="displayCheck('update_active', <?php echo $user_data['user_id']; ?>)"><i class="fa-solid fa-lock-open"></i></a>
                <?php
              }
            }
            ?>
          </a>
        </div>
      </div>

      <!-- desc containers and teacher performance -->
      <div class="status-container flex flex-col sm:flex-row mt-5">
        <?php
          if ($user_privilege == 2) { //teacher
            ?>
            <div class="white-container flex flex-col sm:w-1/2">
              <h2>Description</h2>
              <h3><?php echo ($user_data['user_desc'] == null) ? "write something about me.." : $user_data['user_desc']; ?></h3>
            </div>
            <div class="white-container flex flex-col sm:w-1/2">
              <h2>Performance</h2>
              <div class="flex flex-row">
                <span><i class="icon-score mr-1 fa-solid fa-award"></i> </span>
                <span class="performance-text"><?php echo $avg_score; ?> </span>
              </div>
            </div>
            <?php
          } else if ($user_privilege == 3) {
            ?>
            <div class="white-container flex flex-col sm:w-full">
              <h2>Description</h2>
              <h3><?php echo ($user_data['user_desc'] == null) ? "write something about me.." : $user_data['user_desc']; ?></h3>
            </div>
            <?php
          }
        ?>
      </div>

      <!-- course asessment -->
      <div class="cont-size">
        <div class="my-3">
          <span class="title-details-text">
            <?php echo ($user_privilege == 2) ? 'Posted Course' : ""; ?>
          </span>
        </div>

        <?php
        if ($user_privilege == 2) { //teacher
          if(mysqli_num_rows($result) > 0) {
            foreach($result as $data) {
              if($data['course_status'] == 1) {
                echo '<a href="../shared/course_page.php?courseid=' . $data['course_id'] . '" class="assessment-container mt-3">';
              } else {
                echo '<a href="../shared/course_page.php?courseid=' . $data['course_id'] . '" class="assessment-container deactive mt-3">';
              }
              ?>
                <div class="header flex flex-col sm:flex-row">
                  <h2 class="course-title"><?php echo $data['course_title']; ?> </h2>
                  <div class="view-count"><i class="icon-eye mr-1 fa-solid fa-eye"></i><span id="view-count"><?php echo $data['course_click']; ?></span></div>
                </div>
                <p class="course-desc"><?php echo $data['course_desc']; ?></p>
              </a>
              <?php
            }
          } else {
            ?>
            <div class="assessment-container justify-center text-center mt-3">
              <h2 class="course-title">No course data available</h2>
            </div>
            <?php
          }
        }
        ?>
      </div>
      
      <!-- create teacher view doc modal -->
      <?php
        if ($_SESSION['privilege'] !== 'student'){
        ?>
        <div id="modal" class="pop-modal">
          <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
          <img src="<?=$user_data['user_support_doc']?>" alt="User support doc" class="pop-img">
        </div>
        <?php
        }
      ?>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../admin/javascript/loading.js"></script>
  <script type="text/javascript" src="../admin/javascript/sidebar.js"></script> 
  <?php
    mysqli_close($con);
  ?>
  <script>

  function requestAction(target) {
    var url = '../../../../backend/update-friend-request.php';
    var from_id = <?php echo $_SESSION['user_id']; ?>;
    var params = 'type=request&to_id=' + encodeURIComponent(target) + '&from_id=' + encodeURIComponent(from_id);
    
    $.ajax({
      url: url,
      type: 'POST',
      data: params,
      dataType: 'html',
      success: function(response) {
        location.reload();
      },
      error: function(xhr, status, error) {
        location.reload();
        console.log('Error: Request failed');
      }
    });
  }

  function deleteAction(target) {
    var url = '../../../../backend/update-friend-request.php';
    var params = 'type=reject&list_id=' + encodeURIComponent(target);
    
    $.ajax({
      url: url,
      type: 'POST',
      data: params,
      dataType: 'html',
      success: function(response) {
        location.reload();
      },
      error: function(xhr, status, error) {
        location.reload();
        console.log('Error: Reject request failed');
      }
    });
  }

  </script>
</body>
</html>