<?php 
  // connection to database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  $user_id = $_SESSION['user_id'];
  $user_sql = mysqli_query($con, "SELECT * FROM user WHERE user_id = $user_id");
  $user_data = mysqli_fetch_array($user_sql);

  if (isset($_POST['submitBtn'])) {
    $content = $_POST['feedback'];
    $sql = "INSERT INTO `feedback` (`user_id`, `feedback_content`) VALUES ($user_id, '$content')";

      $result = mysqli_query($con, $sql);
      if ($result){
        echo("<script>alert('Your feedback submit successfully!')</script>");
      }
      else{
        echo("<script>alert('Please try again later.')</script>");
      }
  }
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/feedback.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Feedback</title>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../shared/navbar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col h-fit mx-6 sm:mx-12 text-left">
        <p class="term h-1/6 my-4 md:my-16 ml-5">Feedback</p>
        <form method="post" enctype="multipart/form-data" class="form-arrangement">
          <div name="user" id="myTextarea" class="user">
          <h2>Username: <?php echo $user_data['username']; ?><h2>
          <h2>Email: <?php echo $user_data['user_email']; ?></h2>
          </div><br>
          <textarea name="feedback" id="myTextarea" class="feedback" placeholder="Write your feedback content here.."></textarea>
          <button type="submit" class="mt-4" value="submit" name="submitBtn"> Submit </button>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript" src="./javascript/sidebar.js"></script>
</body>
</html>