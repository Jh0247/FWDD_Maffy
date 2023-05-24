<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");

    #select the top 3 course
    $top_course = "SELECT * FROM course ORDER BY course_click DESC LIMIT 3";
    $top_result = mysqli_query($con,$top_course);
    //$top_course_row = mysqli_fetch_assoc($top_result);

    #select all the course from the database
    $all_course = "SELECT * FROM course";
    $course_result = mysqli_query($con,$all_course);
    // $course_row = mysqli_fetch_assoc($course_result);;

    mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/student/homepage.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <title>Home Page</title>
</head>
<body>

  <div class="home-cont">
    <?php include '../shared/navbar.php';?>
    <div class="home-arr">
      <!--img slide-->
      <div class="first-container">
        <h1>Trend Courses</h1>
        <div class="container">
          <div class="slides">
              <?php
              if(mysqli_num_rows($top_result)>0){
                while($row = mysqli_fetch_assoc($top_result)){
                  echo "<div class='slide'>";
                    echo "<img src=".$row['course_image']." alt='' />";
                    echo "<h1>".$row['course_title']."</h1>";
                    echo "<button class='slider-button' onclick=location.href='../shared/course_page.php?userid=$_SESSION[user_id]&courseid=$row[course_id]'><i class='fa fa-eye aria-hidden='true'></i>View</button>";
                    //echo "<button class='slider-button' onclick=location.href='../shared/view_assessment.php'><i class='fa fa-eye aria-hidden='true'></i>View</button>";
                  echo "</div>";
                }
              }
              ?>
          </div>
          <div class="slider-controls">
            <button id="prev-btn">
              <i class ="fa fa-chevron-left"></i>
            </button>
            <button id="next-btn">
              <i class="fa fa-chevron-right"></i>
            </button>
          </div>
        </div>    
      </div>
      
      <!--Course Assessment View-->
      
      <div class="course-container">
        <div>
          <h1>All Course</h1>
        </div>
        <div class="all-course">
          <?php
            if(mysqli_num_rows($course_result)>0){
              while($row = mysqli_fetch_assoc($course_result)){
                echo "<div class='d-container'>";
                echo  "<div class='image'>";
                echo    "<img src=".$row['course_image']." alt='' />";
                echo  "</div>";
                echo  "<div class='content'>";
                echo    "<h2>".$row['course_title']."</h2>";
                //echo    "<button class='button' onclick=location.href='../shared/course_page.php?userid=$_SESSION[user_id]&courseid=$row[course_id]'><i class='fa fa-eye aria-hidden='true'></i>View</button>";
                echo    "<button class='button' onclick=location.href='../shared/edit_profile.php'><i class='fa fa-eye aria-hidden='true'></i>View</button>";
                echo  "</div>";
                echo "</div>";
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="./JavaScript/homepage.js"></script>
<script src="./JavaScript/nav_bar.js"></script>
</html>