<?php 
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");
  if ($_SESSION['privilege'] == 'teacher'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../teacher/homepage.php'</script>");
  }
  else if ($_SESSION['privilege'] == 'student'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../student/homepage.php'</script>");
  }

  //sql query to count all teacher account
  $total_teacher_sql = mysqli_query($con, "SELECT COUNT(user_id) FROM user WHERE privilege_id = 2 AND user_active = 1");
  $count_teacher = mysqli_fetch_array($total_teacher_sql);

  //sql query to count all student account
  $total_student_sql = mysqli_query($con, "SELECT COUNT(user_id) FROM user WHERE privilege_id = 3 AND user_active = 1");
  $count_student = mysqli_fetch_array($total_student_sql);

  //sql query to get total number of course
  $total_course_sql = mysqli_query($con, "SELECT COUNT(course_id) FROM course");
  $count_course = mysqli_fetch_array($total_course_sql);

  //sql query to get total number of feedback
  $total_feedback_sql = mysqli_query($con, "SELECT COUNT(feedback_id) FROM feedback");
  $count_feedback = mysqli_fetch_array($total_feedback_sql);

  //sql query to count user that request for teacher account
  $total_request_teacher_sql = mysqli_query($con, "SELECT COUNT(user_id) FROM user WHERE privilege_id = 2 AND user_active = 0");
  $count_request_teacher = mysqli_fetch_array($total_request_teacher_sql);

  //sql query to get most performance teacher
  $trend_teacher_sql = mysqli_query($con, 
    "SELECT user.user_id, user.privilege_id, user.username, user.user_image, course.course_status, 
    COUNT(course_id) as total_course, SUM(course_click) as total_view FROM user
    INNER JOIN course ON course.user_id = user.user_id    
    WHERE privilege_id = 2 AND user_active = 1 AND course_status = 1
    GROUP BY user.user_id
    ORDER BY total_view DESC
    LIMIT 2");
  
  //sql query to get most performance courses
  $trend_course_sql = mysqli_query($con, 
    "SELECT * FROM course  WHERE course_status = 1
    ORDER BY course_click DESC
    LIMIT 2");

  $teacher_percentage = 0;
  $student_percentage = 0;

  $total_user = mysqli_query($con, 
    "SELECT COUNT(user_id) as count FROM user 
      WHERE privilege_id != 1 
      AND user_active = 1");

  if(mysqli_num_rows($total_user)>0) {
    $count = mysqli_fetch_assoc($total_user)['count'];
    if($count != 0) {
      $teacher_percentage = ($count_teacher[0]/($count_teacher[0] + $count_student[0]))*100;
      $student_percentage = ($count_student[0]/($count_student[0] + $count_teacher[0]))*100;
    }
  }
  //Close connection of database
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/dashboard.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Dashboard</title>
</head>

<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col mx-6 sm:mx-9 text-center sm:text-left">
        <h2 class="title my-4">Admin Dashboard</h2>

        <div class="grid-cont">
          <!-- total teacher -->
          <?php
            if($count_teacher[0] > 0) {
              echo '<a href="view-list.php?type=teacher" class="item-card">';
            } else {
              echo '<a class="no-item item-card">';
            }
            ?>
            <div class="flex flex-col lg:flex-row mx-3 mt-2">
              <h3 class="h-2/6 lg:w-2/6">Total Teacher</h3>
              <div class="b-skills lg:w-4/6 flex flex-col items-center">
                <div class="skill-item center-block">
                  <div class="chart-container">
                    <div class="chart" data-percent= <?php echo $teacher_percentage ?> data-bar-color="#52565f">
                      <span class="percent" data-after="%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- total student -->
          <?php
            if($count_student[0] > 0) {
              echo '<a href="view-list.php?type=student" class="item-card">';
            } else {
              echo '<a class="no-item item-card">';
            }
            ?>
            <div class="flex flex-col lg:flex-row mx-3 mt-2">
              <h3 class="h-2/6 lg:w-2/6">Total Student</h3>
              <div class="b-skills lg:w-4/6 flex flex-col items-center">
                <div class="skill-item center-block">
                  <div class="chart-container">
                    <div class="chart" data-percent= <?php echo $student_percentage ?> data-bar-color="#52565f">
                      <span class="percent" data-after="%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- total course -->
          <?php
            if($count_course[0] > 0) {
              echo '<a href="view-list.php?type=course" class="item-card">';
            } else {
              echo '<a class="no-item item-card">';
            }
            ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2> <?php echo $count_course[0]; ?> </h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/Courses.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Total Course</h3>
            </div>
          </a>

          <!-- total feedback -->
          <?php
            if($count_feedback[0] > 0) {
              echo '<a href="view-list.php?type=feedback" class="item-card">';
            } else {
              echo '<a class="no-item item-card">';
            }
            ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2> <?php echo $count_feedback[0]; ?> </h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/View_Feedback.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Total Feedback</h3>
            </div>
          </a>

          <!-- Most performance teacher -->
          <div class="item-card two-column-teacher">
            <div class="flex flex-col mx-3 mt-2">
              <h3 class="h-1/6" style="border-bottom: 1px solid #667e91 ;">Most Performance Teacher</h3>
              <?php
              if(mysqli_num_rows($trend_teacher_sql) > 0)
              {
                foreach($trend_teacher_sql as $teacher_data) // Run SQL query
                {
                  $teacher_avg_score = $teacher_data['total_view']/$teacher_data['total_course'];
              ?>
                <a href="../shared/user_profile.php?id=<?php echo $teacher_data['user_id']; ?>" class="user-content mobile-col my-2">
                  <div class="flex flex-row items-center">
                    <div class="profile-img">
                      <img src="<?=$teacher_data['user_image']?>">
                    </div>
                    <div class="flex flex-col">
                      <div class="user-name ml-3 md:ml-7">
                        <?php echo $teacher_data['username']; ?>
                      </div>
                      <div class="score-view ml-3 md:ml-7">
                        <span><i class="icon-score mr-1 fa-solid fa-award"></i> </span>
                        <?php echo $teacher_avg_score; ?>
                      </div>
                    </div>
                  </div>
                  <div class="count-course mr-2">
                    <i class="icon-book fa-solid fa-book-bookmark"></i>
                    <?php echo $teacher_data['total_course']; ?>
                  </div>
                  <div class="count-view mr-2">
                    <span><i class="icon-eye mr-1 fa-solid fa-eye"></i> </span>
                    <?php echo $teacher_data['total_view']; ?>
                  </div>
                </a>
              <?php
                }
              } else {
                echo '<h4 class = "mt-2">No user data available.</h4>';
              }
              ?>
            </div>
          </div>

          <!-- total requesting teacher -->
          <?php
            if($count_request_teacher[0] > 0) {
              echo '<a href="view-list.php?type=request-teacher" class="item-card">';
            } else {
              echo '<a class="no-item item-card">';
            }
            ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2> <?php echo $count_request_teacher[0]; ?> </h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/Request_Teacher.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Requesting Account</h3>
            </div>
          </a>

          <!-- most trend course -->
          <div id="ds-trend-course" class="item-card two-column mb-5 lg:mb-0">
            <div class="flex flex-col mx-3 mt-2">
              <h3 class="h-1/6" style="border-bottom: 1px solid #667e91 ;">Most Trend Course Assessment</h3>
              <div class="h-5/6 flex flex-col">
              <?php
              if(mysqli_num_rows($trend_course_sql) > 0)
              {
                foreach($trend_course_sql as $course_data) // Run SQL query
                {
                  ?>
                  <a href="../shared/course_page.php?userid=<?php echo $_SESSION['user_id']; ?>&courseid=<?php echo $course_data['course_id']; ?>" class="course-content justify-between text-left px-3">
                    <div class="flex flex-row my-3 items-center"> 
                      <i class="icon-book mr-3 fa-solid fa-book-bookmark"></i>
                      <div class="flex flex-col justify-between">
                        <span class="course-title">
                          <?php echo $course_data['course_title']; ?>
                        </span>
                        <span class="course-desc">
                          <?php echo $course_data['course_desc']; ?>
                        </span>
                      </div>
                    </div>

                    <span class="view-count">
                      <i class="icon-eye mr-1 fa-solid fa-eye"></i> 
                      <?php echo $course_data['course_click']; ?>
                    </span>
                  </a> <!-- end -->              
                  <?php
                }
              }else {
                echo '<h4 class = "mt-2">No course data available.</h4>';
              }
              ?>
              </div>
            </div>
          </div>

          <!-- mobile responsive for trend course -->
          <?php
            if(mysqli_num_rows($trend_course_sql) > 0) {
              echo '<a href="view-list.php?type=trend-course" id="mb-trend-course" class="item-card mb-5">';
            } else {
              echo '<a id="mb-trend-course" class="no-item item-card mb-5">';
            }
            ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6 justify-center w-full">
                <img src="../../images/intro.png" alt="introduction">
              </div>
              <h3 class="h-1/6">Most Trend Course</h3>
            </div>
          </a>

        </div>
      </div>
    </div>
  </div>
<script src="./javascript/jquery-2.2.4.min.js"></script>
<script src="./javascript/profile.min.js"></script>
<script>
  // get id
  const ds_trend = document.getElementById("ds-trend-course");
  const mb_trend = document.getElementById("mb-trend-course");
  const responsive_width = 468; // set the width

  const handleResize = () => {
    if (window.innerWidth <= responsive_width) {
      ds_trend.style.display = "none";
      mb_trend.style.display = "block";
    } else {
      mb_trend.style.display = "none";
      ds_trend.style.display = "block";
    }
  };

  window.addEventListener("resize", handleResize);
  handleResize();

  var $window = $(window);
  function run() {
    var fName = arguments[0],
      aArgs = Array.prototype.slice.call(arguments, 1);
    try {
      fName.apply(window, aArgs);
    } catch (err) {}
  }
  /* ==================== chart ============================== */
  function _chart() {
    $(".b-skills").appear(function () {
      setTimeout(function () {
        $(".chart").easyPieChart({
          easing: "easeOutElastic",
          delay: 3000,
          barColor: "#369670",
          trackColor: "#fff",
          scaleColor: false,
          lineWidth: 21,
          trackWidth: 21,
          size: 250,
          lineCap: "round",
          onStep: function (from, to, percent) {
            this.el.children[0].innerHTML = Math.round(percent);
          },
        });
      }, 150);
    });
  }
  $(document).ready(function () {
    run(_chart);
  });

  //always update admin page 
  setInterval(function() {
    location.reload();
  }, 10000);

</script>
<script type="text/javascript" src="../admin/javascript/sidebar.js"></script>

</body>
</html>