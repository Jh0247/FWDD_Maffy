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
  
  //sql query to get the specific feeback details
  $feedback_id = $_GET['id'];

  $feedback_sql = mysqli_query($con, 
    "SELECT * FROM feedback 
    INNER JOIN user on feedback.user_id = user.user_id 
    WHERE feedback_id = $feedback_id");
  $result = mysqli_fetch_array($feedback_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/view-feedback.css" />
  <title>Feedback</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col h-fit mx-6 sm:mx-9 text-left">
        <div class="flex flex-row h-1/6 my-5 sm:my-8 align-center">
          <button onclick="history.back()" class="backbutton"><</button>
          <h2 class="title ml-4">
            Feedback details
          </h2>
        </div> <!-- back button -->
        <div class="card">
          <div class="user-container">
            <p class="user my-2 ml-3"><?php echo $result['username']; ?></p>
            <p class="email my-2 ml-3"><?php echo $result['user_email']; ?></p>
          </div>
          <div class="feedback" name="feedback">
            <?php echo $result['feedback_content']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="./javascript/sidebar.js"></script>
</body>
</html>