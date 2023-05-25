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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/view-list.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Maffy</title>
</head>
<body>
  <div id="all" class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    
    <?php include '../admin/loading.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col h-full items-center sm:items-start mx-3 md:mx-9 text-center sm:text-left">
        <!-- dynamic change name based on type param passed --> 
        <h2 class="title my-4">
          <?php 
          if (isset($_GET['type'])) {
            echo $_GET['type'] == 'student' 
            ? 'Student' 
            : ($_GET['type'] == 'course' 
              ? 'Course' 
              : ($_GET['type'] == 'request-teacher'
              ? 'Request Teacher'
                : ($_GET['type'] == 'teacher'
                ? 'Teacher'
                  : ($_GET['type'] == 'performance-teacher'
                  ? 'Most Performance Teacher'
                    : ($_GET['type'] == 'trend-course'
                    ? 'Trend Course'
                      : ($_GET['type'] == 'feedback'
                      ? 'Feedback'
                        : 'Nothing to show'
                        )
                      )
                    )
                  )
                )
              ); 
          } else {
            echo 'Nothing to show';
          }
          ?>
        </h2>

        <!-- search bar container -->
        <div class="search-cont sm:my-2">
          <input id="search-bar" type="text" class="search__input" placeholder="Search something..">
          <span class="search__button">
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
        </div>

        <!-- search result list -->
        <div id="search-results" class="result-container max-h-5/6 h-fit w-full my-5 overflow-auto">
        <?php
        if (isset($_GET['type'])) {
          if($_GET['type'] == 'teacher') {
            ?>
            <fieldset name="switch" id="switch" class="radio-inputs">
              <label class="radio">
                <input checked name="switch" value="all" id="all" type="radio">
                <label for="all" class="radio-lable">All</label>
              </label>
              <label class="radio">
                <input name="switch" value="active" id="active" type="radio">
                <label for="active" class="radio-lable">Active</label>
              </label>
              <label class="radio">
                <input name="switch" value="ban" id="ban" type="radio">
                <label for="ban" class="radio-lable">Banned</label>
                </label>
            </fieldset>
            <?php
            $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 2  AND user_active != 0";
            if (isset($_GET['switch'])) {
              $switch = $_GET['switch'];
              switch ($switch) {
                case 'active':
                  $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 2  AND user_active = 1";
                  break;
                case 'ban':
                  $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 2  AND user_active = 2";
                  break;
              }
            }

            $result = mysqli_query($con, $sql) ; 
            
            if(mysqli_num_rows($result) > 0) {
              foreach($result as $data) {
                if($data['user_active'] == 2) {
                  echo '<a href="../shared/user_profile.php?id='. $data["user_id"] .'" class="item-cont bg-block flex flex-row justify-around md:justify-between">';
                } else {
                  echo '<a href="../shared/user_profile.php?id='. $data["user_id"] .'" class="item-cont flex flex-row justify-around md:justify-between">';
                }
                ?>
                <!-- for teacher list -->
                <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                  <!-- img cont  -->
                  <div class="md:mr-5">
                    <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                  </div>
                  <!-- name and details -->
                  <div class="flex flex-col justify-center">
                    <?php
                    if($data['user_active'] == 2) {
                      echo '<h2>' . $data["username"] .  ' <i class="fa-solid fa-ban"></i> </h2>';
                      echo '<h3>' . $data["user_email"] . '</h3>';
                      echo '<small>Last Login: ' . (isset($data["user_last_login"]) ? $data["user_last_login"] : 'Never login') . '</small>';
                    } else {
                      echo '<h2>' . $data["username"] . '</h2>';
                      echo '<h3>' . $data["user_email"] . '</h3>';
                      echo '<small>Last Login: ' . (isset($data["user_last_login"]) ? $data["user_last_login"] : 'Never login') . '</small>';
                    }
                    ?>
                  </div>
                </div>
                <!-- arrow -->
                <div class="flex flex-col justify-center">
                  <span class="arrow-btn">
                    <i class="fa-solid fa-chevron-right"></i>
                  </span>
                </div>
              </a>
              <?php
              }
            }  else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          }
          else if($_GET['type'] == 'student') {
            ?>
            <fieldset name="switch" id="switch" class="radio-inputs">
              <label class="radio">
                <input checked name="switch" value="all" id="all" type="radio">
                <label for="all" class="radio-lable">All</label>
              </label>
              <label class="radio">
                <input name="switch" value="active" id="active" type="radio">
                <label for="active" class="radio-lable">Active</label>
              </label>
              <label class="radio">
                <input name="switch" value="ban" id="ban" type="radio">
                <label for="ban" class="radio-lable">Banned</label>
                </label>
            </fieldset>
            <?php
            $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 3";
            if (isset($_GET['switch'])) {
              $switch = $_GET['switch'];
              switch ($switch) {
                case 'active':
                  $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 3 AND user_active = 1";
                  break;
                case 'ban':
                  $sql = "SELECT user_id, privilege_id, username, user_image, user_email, user_active, user_last_login FROM user WHERE privilege_id = 3 AND user_active = 2";
                  break;
              }
            }
            
            $result = mysqli_query($con, $sql) ; 

            if(mysqli_num_rows($result) > 0){
              foreach($result as $data) {
                if($data['user_active'] == 2) {
                  echo '<a href="../shared/user_profile.php?id='. $data["user_id"] .'" class="item-cont bg-block flex flex-row justify-around md:justify-between">';
                } else {
                  echo '<a href="../shared/user_profile.php?id='. $data["user_id"] .'" class="item-cont flex flex-row justify-around md:justify-between">';
                }
                ?>
                <!-- for student list -->
                <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                  <!-- img cont  -->
                  <div class="md:mr-5">
                    <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                  </div>
                  <!-- name and details -->
                  <div class="flex flex-col justify-center">
                  <?php
                    if($data['user_active'] == 2) {
                      echo '<h2>' . $data["username"] .  ' <i class="fa-solid fa-ban"></i> </h2>';
                      echo '<h3>' . $data["user_email"] . '</h3>';
                      echo '<small>Last Login: ' . (isset($data["user_last_login"]) ? $data["user_last_login"] : 'Never login') . '</small>';
                    } else {
                      echo '<h2>' . $data["username"] . '</h2>';
                      echo '<h3>' . $data["user_email"] . '</h3>';
                      echo '<small>Last Login: ' . (isset($data["user_last_login"]) ? $data["user_last_login"] : 'Never login') . '</small>';
                    }
                  ?>
                  </div>
                </div>
                <!-- arrow -->
                <div class="flex flex-col justify-center">
                  <span class="arrow-btn">
                    <i class="fa-solid fa-chevron-right"></i>
                  </span>
                </div>
              </a>
            <?php
              }
            } else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          }
          else if($_GET['type'] == 'request-teacher') {
            $sql = mysqli_query($con, "SELECT user_id, privilege_id, username, user_image, user_email, user_support_doc, user_active FROM user WHERE privilege_id = 2 AND user_active = 0");
            if(mysqli_num_rows($sql) > 0) {
              foreach($sql as $data) {
              ?>
                <!-- for request teacher list -->
                <div class="item-cont flex flex-col md:flex-row  md:justify-between">
                  <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                    <!-- img cont  -->
                    <div class="md:mr-5">
                      <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                    </div>
                    <!-- name and details -->
                    <div class="flex flex-col justify-center">
                      <h2><?php echo $data['username']; ?></h2>
                      <h3><?php echo $data['user_email']; ?></h3>
                    </div>
                  </div>
                  <div class="flex flex-row justify-around">
                    <!-- view -->
                    <button id="download-doc" class="flex flex-col justify-center" onclick="document.getElementById('modal<?=$data['user_id']?>').style.display='block'">
                      <span class="download-btn mr-4">
                        <i class="fa-solid fa-file-image"></i>
                      </span>
                    </button>
                    <!-- approve -->
                    <button id="check-approval" name="checkBtn" class="flex flex-col justify-center" onclick="displayCheck('update_active', <?php echo $data['user_id']; ?>);">
                      <span class="check-btn mr-4">
                        <i class="fa-regular fa-circle-check"></i>
                      </span>
                    </button>
                    <!-- reject -->
                    <button id="xmark-reject" name="rejectBtn" class="flex flex-col justify-center" onclick="displayXmark('delete', <?php echo $data['user_id']; ?>);">
                      <span class="xmark-btn mr-4">
                        <i class="fa-regular fa-circle-xmark"></i>
                      </span>
                    </button>
                  </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                </form>
                <div id="modal<?=$data['user_id']?>" class="pop-modal">
                  <span class="close" onclick="document.getElementById('modal<?=$data['user_id']?>').style.display='none'">&times;</span>
                  <img src="<?=$data['user_support_doc']?>" alt="User support doc" class="pop-img">
                </div>
                <?php
              }
            } else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          } 
          else if($_GET['type'] == 'performance-teacher') {
            $sql = mysqli_query($con, 
              "SELECT user.user_id, user.privilege_id, user.username, user.user_image, user.user_email, course.course_status, 
              COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
              INNER JOIN course ON course.user_id = user.user_id    
              WHERE privilege_id = 2 AND user_active = 1 AND course_status = 1
              GROUP BY user.user_id
              ORDER BY total_view DESC");
              if(mysqli_num_rows($sql) > 0) {
                foreach($sql as $data) {
                  $avg_score = $data['total_view']/$data['total_course'];
                  ?>
                  <!-- for performance teacher list -->
                  <a href="../shared/user_profile.php?id=<?php echo $data['user_id']; ?>" class="item-cont flex flex-row justify-around md:justify-between">
                    <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                      <!-- img cont  -->
                      <div class="md:mr-5">
                        <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                      </div>
                      <!-- name and details -->
                      <div class="flex flex-col justify-center">
                        <h2><?php echo $data['username']; ?></h2>
                        <h3><?php echo $data['user_email']; ?></h3>
                        <div class="flex flex-row ">
                          <div class="count-course mr-2">
                            <i class="icon-book fa-solid fa-book-bookmark"></i>
                            <?php echo $data['total_course']; ?>
                          </div>
                          <div class="count-view mr-2">
                            <span><i class="icon-eye mr-1 fa-solid fa-eye"></i> </span>
                            <?php echo $data['total_view']; ?>
                          </div>
                          <div class="score-view mr-2 justify-center md:justify-start">
                            <span><i class="icon-score mr-1 fa-solid fa-award"></i> </span>
                            <?php echo $avg_score; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- arrow -->
                    <div class="flex flex-col justify-center">
                      <span class="arrow-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                      </span>
                    </div>
                  </a>
                  <?php
                }
              } else {
                ?>
                <div class="no-item-cont">
                  <span class="text-center">No data available</span>
                </div>
                <?php
              }
          }
          else if($_GET['type'] == 'course') {
            ?>
            <fieldset name="switch" id="switch" class="radio-inputs">
              <label class="radio">
                <input checked name="switch" value="all" id="all" type="radio">
                <label for="all" class="radio-lable">All</label>
              </label>
              <label class="radio">
                <input name="switch" value="active" id="active" type="radio">
                <label for="active" class="radio-lable">Active</label>
              </label>
              <label class="radio">
                <input name="switch" value="ban" id="ban" type="radio">
                <label for="ban" class="radio-lable">Deactived</label>
                </label>
            </fieldset>
            <?php
            $sql = "SELECT * FROM course";
            if (isset($_GET['switch'])) {
              $switch = $_GET['switch'];
              switch ($switch) {
                case 'active':
                  $sql = "SELECT * FROM course WHERE course_status = 1";
                  break;
                case 'ban':
                  $sql = "SELECT * FROM course WHERE course_status = 2";
                  break;
              }
            }
            
            $result = mysqli_query($con, $sql) ; 
            if(mysqli_num_rows($result) > 0) {
              foreach($result as $data) {
                if($data['course_status'] == 2) {
                  echo '<a href="../shared/course_page.php?userid=' . $_SESSION['user_id'] . '&courseid=' . $data['course_id'] . '" class="item-cont bg-block flex flex-row justify-around md:justify-between">';
                } else {
                  echo '<a href="../shared/course_page.php?userid=' . $_SESSION['user_id'] . '&courseid=' . $data['course_id'] . '" class="item-cont flex flex-row justify-around md:justify-between">';
                }
                ?>
                <!-- for course list -->
                  <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                    <!-- img cont  -->
                    <div class="md:mr-5">
                      <img src="<?=$data['course_image']?>" alt="profile pic" class="profile-img">
                    </div>
                    <!-- name and details -->
                    <div class="flex flex-col justify-center">
                      <?php
                      if($data['course_status'] == 2) {
                        echo '<h2 class="course-title">' . $data["course_title"] . ' <i class="fa-solid fa-ban"></i></h2>';
                        echo '<h3 class="course-desc">' . $data["course_desc"] . '</h3>';
                      } else {
                        echo '<h2 class="course-title">' . $data["course_title"] . '</h2>';
                        echo '<h3 class="course-desc">' . $data["course_desc"] . '</h3>';
                      }
                      ?>
                    </div>
                  </div>
                  <!-- arrow -->
                  <div class="flex flex-col justify-center">
                    <span class="arrow-btn">
                      <i class="fa-solid fa-chevron-right"></i>
                    </span>
                  </div>
                </a>
                <?php 
              }
            } else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          }
          else if($_GET['type'] == 'trend-course') {
            $sql = mysqli_query($con, "SELECT * FROM course INNER JOIN user on course.user_id = user.user_id WHERE course_status = 1 ORDER BY course_click DESC");
            if(mysqli_num_rows($sql) > 0) {
              foreach($sql as $data) {
                ?>
                <!-- for trend course list -->
                <a href="../shared/course_page.php?userid=<?php echo $_SESSION['user_id']; ?>&courseid=<?php echo $data['course_id']; ?>" class="item-cont flex flex-row justify-around md:justify-between">
                  <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                    <!-- img cont  -->
                    <div class="md:mr-5">
                      <img src="<?=$data['course_image']?>" alt="profile pic" class="profile-img">
                    </div>
                    <!-- name and details -->
                    <div class="flex flex-col justify-center">
                      <h2 class="course-title"><?php echo $data['course_title']; ?></h2>
                      <h3 class="course-author"><?php echo $data['username']; ?></h3>
                      <span class="course-desc"><?php echo $data['course_desc']; ?></span>
                      <span class="view-count">
                        <i class="icon-eye mr-1 fa-solid fa-eye"></i> 
                        <?php echo $data['course_click']; ?>
                      </span>

                    </div>
                  </div>
                  <!-- arrow -->
                  <div class="flex flex-col justify-center">
                    <span class="arrow-btn">
                      <i class="fa-solid fa-chevron-right"></i>
                    </span>
                  </div>
                </a>
                <?php
              }
            } else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          }
          else if($_GET['type'] == 'feedback') {
            $sql = mysqli_query($con, "SELECT * FROM feedback INNER JOIN user ON user.user_id = feedback.user_id WHERE user.user_active = 1");
            if(mysqli_num_rows($sql) > 0) {
              foreach($sql as $data) {
                echo '<a href="view-feedback.php?id=' . $data["feedback_id"] . '" class="item-cont flex flex-row justify-around md:justify-between">';
              ?>
                <!-- for feedback list -->
                <div class="flex flex-col md:flex-row text-center md:text-left items-center">  <!-- left content  -->
                  <!-- img cont  -->
                  <div class="md:mr-5">
                    <img src="<?=$data['user_image']?>" alt="profile pic" class="profile-img">
                  </div>
                  <!-- name and details -->
                  <div class="flex flex-col justify-center">
                    <h2><?php echo $data['username']; ?></h2>
                    <h3><?php echo $data['feedback_content']; ?></h3>
                  </div>
                </div>
                <!-- arrow -->
                <div class="flex flex-col justify-center">
                  <span class="arrow-btn">
                    <i class="fa-solid fa-chevron-right"></i>
                  </span>
                </div>
              </a>
              <?php
              }
            } else {
              ?>
              <div class="no-item-cont">
                <span class="text-center">No data available</span>
              </div>
              <?php
            }
          }
          else {
            ?>
            <!-- Nothing to show -->
              show image nothing to show
            <?php
          }
        }
        ?>
        </div>
      </div>
    </div>
  </div>

<?php include("../../../../backend/admin-block-privilege.php"); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../admin/javascript/sidebar.js"></script>
<script type="text/javascript" src="../admin/javascript/view-list.js"></script>
<script type="text/javascript" src="../admin/javascript/loading.js"></script>
</body>
<?php
  //Close connection of database
  mysqli_close($con);
?>
</html>