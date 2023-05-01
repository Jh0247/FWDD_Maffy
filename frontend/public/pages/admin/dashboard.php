<!--Connection to Database-->
<?php include("../../../../backend/conn.php")?>
  <?php include("../../../../backend/session.php");
  if ($_SESSION['privilege'] == 'teacher'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../teacher/homepage.php'</script>");
  }
  else if ($_SESSION['privilege'] == 'student'){
    echo("<script>alert('You do not have the privilege to access this page.')</script>");
    echo("<script>window.location = '../student/homepage.php'</script>");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/dashboard.css">
  <script src="https://cdn.tailwindcss.com"></script>
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
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2>4899</h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/intro.png" alt="image">
                </div>
              </div>
              <h3 class="h-1/6">Total Teacher</h3>
            </div>
          </a>

          <!-- total student -->
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2>489</h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/intro.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Total Student</h3>
            </div>
          </a>

          <!-- total course -->
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2>4899</h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/intro.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Total Course</h3>
            </div>
          </a>

          <!-- total feedback -->
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2>4899</h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/intro.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Total Feedback</h3>
            </div>
          </a>

          <!-- img, name, total course, total view -->
          <!-- Most performance teacher -->
          <div class="item-card two-column-teacher">
            <div class="flex flex-col mx-3 mt-2">
              <h3 class="h-1/6" style="border-bottom: 1px solid #FF914D ;">Most Performance Teacher</h3>
              <a href="#" class="user-content my-2">
                <div class="flex flex-row items-center">
                  <div class="profile-img">
                    <img src="../../images/intro.png">
                  </div>
                  <div class="user-name ml-7">
                    Teacher name
                  </div>
                </div>
                <div class="count-course">
                  19 Courses
                </div>
                <div class="count-view">
                  3000 Views
                </div>
              </a>

              <a href="#" class="user-content my-2">
                <div class="flex flex-row items-center">
                  <div class="profile-img">
                    <img src="../../images/intro.png">
                  </div>
                  <div class="user-name ml-7">
                    Teacher name
                  </div>
                </div>
                <div class="count-course">
                  19 Courses
                </div>
                <div class="count-view">
                  3000 Views
                </div>
              </a>
            </div>
          </div>

          <!-- total requesting teacher -->
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row h-5/6">
                <div class="flex flex-col xl:justify-center w-1/6 xl:pl-4">
                  <h2>4899</h2>
                </div>
                <div class="flex flex-row justify-center w-5/6">
                  <img src="../../images/intro.png" alt="introduction">
                </div>
              </div>
              <h3 class="h-1/6">Requesting Account</h3>
            </div>
          </a>
          <!-- most trend course -->
          <div id="ds-trend-course" class="item-card two-column mb-5 lg:mb-0">
            <div class="flex flex-col mx-3 mt-2">
              <h3 class="h-1/6" style="border-bottom: 1px solid #FF914D ;">Most Trend Course Assessment</h3>
              <div class="h-5/6 flex flex-col">
                <a href="#" class="course-content justify-between text-left px-3">
                  <div class="flex flex-col justify-between">
                    <span class="course-title">
                      <small class="text-xs">&ltTITLE&gt</small>
                      Teach Jojo Eat Chagee
                    </span>
                    <span class="name-title">
                      <small class="text-xs">&ltNAME&gt</small>
                      Ho Chang Yong
                    </span>
                    <span class="course-desc">
                      <small class="text-xs">&ltDESC&gt</small>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                      incididunt ut labore et dolore magna aliqua.
                    </span>
                  </div>
                  <span class="view-count">
                    View: 5201
                  </span>
                </a> <!-- end -->

                <a href="#" class="course-content justify-between text-left px-3">
                  <div class="flex flex-col justify-between">
                    <span class="course-title">
                      <small class="text-xs">&ltTITLE&gt</small>
                      Teach Jojo Eat Chagee
                    </span>
                    <span class="name-title">
                      <small class="text-xs">&ltNAME&gt</small>
                      Ho Chang Yong
                    </span>
                    <span class="course-desc">
                      <small class="text-xs">&ltDESC&gt</small>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                      incididunt ut labore et dolore magna aliqua.
                    </span>
                  </div>
                  <span class="view-count">
                    View: 5201
                  </span>
                </a> <!-- end -->
              </div>
            </div>
          </div>
          <!-- mobile responsive for trend course -->
          <a href="#" id="mb-trend-course" class="item-card mb-5">
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
</script>
<script type="text/javascript" src="../admin/javascript/sidebar.js"></script>

</body>
</html>