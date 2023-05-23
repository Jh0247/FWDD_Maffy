<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");

    $courses = "SELECT * FROM course";
    $total_courses = mysqli_query($con,$courses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/friend-request.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Request</title>
</head>
<body>
<?php include '../shared/navbar.php';?>

  <div class="content" style="display: flex; flex-direction: row;min-height: 100vh;margin-top:80px">
    <div>
      <!--Side Bar Code-->
      <div class="sidebar">
        <div class="top">
          <div class="logo">
            <h1>All Course Assessment</h1>
          </div>
        </div>
        <ul>
        <?php
        if(mysqli_num_rows($total_courses)>0){
          while($row = mysqli_fetch_assoc($total_courses)){
            echo "
              <li>
                <a href='#'>
                  <i class='fa fa-book' aria-hidden='true' class='sidebar-b-i'></i>
                  <span class=\"nav-item\">".$row['course_title']."</span>
                </a>
              </li>
            ";
          }
        }
        ?>
        </ul>
      </div>
    </div>
    <!--End of sidebar-->

      <!--Search Container-->
      <div class="friend-container">
        <div class="friend-content">
            <div class="left">
                <img src="../../images/user_profile.png">
                <h1>Username</h1>
            </div>
            <div class="right">
                <div class="decision">
                    <div>
                        <button class="accept"><i class="fa fa-check fa-3x" aria-hidden="true"></i></button>
                    </div>
                    <div>
                        <button class="reject"><i class="fa fa-times fa-3x" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

</body>
</html>