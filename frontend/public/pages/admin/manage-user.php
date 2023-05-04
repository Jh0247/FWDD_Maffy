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

  //sql query to count user that request for teacher account
  $total_request_teacher_sql = mysqli_query($con, "SELECT COUNT(user_id) FROM user WHERE privilege_id = 2 AND user_active = 0");
  $count_request_teacher = mysqli_fetch_array($total_request_teacher_sql);

  //Close connection of database
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/manage-user.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Manage User</title>
</head>

<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col items-center sm:items-start mx-0 sm:mx-9 text-center sm:text-left">
        <h2 class="title my-4">Teacher</h2>
        <div class="flex flex-col sm:flex-row">
          <?php
            if($count_teacher[0]>0) {
              echo '<a href="view-list.php?type=teacher" class="item-card">';
            } else {
              echo '<a class="no-item-card">';
            }
          ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/teacher.png">
              </div>
              <h3 class="h-1/6">View All Teacher</h3>
            </div>
          </a>
          <?php
            if($count_request_teacher[0]>0) {
              echo '<a href="view-list.php?type=request-teacher" class="item-card ml-0 sm:ml-16 mt-16 sm:mt-0">';
            } else {
              echo '<a class="no-item-card ml-0 sm:ml-16 mt-16 sm:mt-0">';
            }
          ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/intro.png">
              </div>
              <h3 class="h-1/6">Requesting Teacher Account</h3>
            </div>
          </a>
        </div>
        <h2 class="title my-4">Student</h2>
        <div class="flex flex-row mb-5">
          <?php
            if($count_student[0]>0) {
              echo '<a href="view-list.php?type=student" class="item-card">';
            } else {
              echo '<a class="no-item-card">';
            }
          ?>
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/Student.png">
              </div>
              <h3 class="h-1/6">View All Student</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="../admin/javascript/sidebar.js"></script>
</body>
</html>