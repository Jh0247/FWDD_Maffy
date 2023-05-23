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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/siderbar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/right-sidebar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/student/view-assessment.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <title>View Assessment</title>

    <style>

    </style>

</head>
<body>
<?php include '../shared/navbar.php';?>
  <!--middle-->
  <div class="sidebar-content" style="display: flex; flex-direction: row;min-height: 100vh;margin-top:80px;">
    <div>
    <!--side bar-->
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
                <a href='./homepage.php'>
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
    <!--End Side Bar-->
    </div>


    <!-- <div class="right" style="background-color: aqua; height: 300px; width: 300px;"> -->
    <div class="big-container">
      <div class="first-container">
        <div class="subContainer">
          <h1>Title</h1>
          <h4>Date</h4>
        </div>
        <div class="secSubContainer">
          <p>View</p>
          <a href="#">Additional Note</a>
        </div>
      </div>

      <div class="second-container">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

      </div>

      <div class="comment-container">
        <h2><i class="fa fa-comment-o" aria-hidden="true"></i>Comment</h2>
        <div class="comment">
          <div class="subComment">
            <img src="./profile.jpg">
            <div class="prev-comment">
              <p>Comment somethingComment somethingComment somethingComment somethingComment somethingComment something</p>
            </div>
          </div>
        </div>
        <!--For user to type the comment-->
        <form action="">
          <div class="comment">
            <div class="subComment">
              <img src="./profile.jpg">
              <input type="text" class="comment-box" placeholder="Comment">
              <button class="sendBtn">
                <span class="text">Post</span>
              </button>
            </div>
          </div>
        </form>
      </div>

      <form novalidate>
        <div class="exercise-container">
          <div class="form-group">
            <label for="publish-exercise" class="check-container">
              <input type="checkbox" id="publish-exercise" name="publish-exercise">
              <div class="checkmark"></div>
              Exercise
            </label>
          </div>
      
          <div class="exercise-container" id="exercise-group" style="display: none;">
            <h2>Exercises</h2>
            <div class="fir-container">
              <div class="sec-container">
                <h4>How to comment HTML tags?</h4>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!--share button-->
      <div class="bottom-container">
        <div class="bottom-sub-container">
          <button class="shareBtn">Share</button>
        </div>
      </div>
    </div>

    <div style="display: flex;flex-direction: row;justify-content: flex-end;">
    <!--Rightside sidebar-->
    <nav id="right-sidebar">
      <ul>
        <li>
          <div class="Share-icone">
            <a href="https://sci-hub.ru/10.1007/978-3-662-45317-9_6"></a><i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></a>
          </div>
        </li>
        <li>
          <div class="mail-icon">
            <i class="fa fa-book fa-2x" aria-hidden="true" class="sidebar-b-i"></i>
              <div class="mail-top"></div>
            </div>
          </div>
        </li>
      </ul>
    </nav>
    </div>

    </div>
  </div>

  <script src="./nav_bar.js"></script>
  <script src="./hamburger.js"></script>
  <script src="./exercise.js"></script>

  
</body>
</html>