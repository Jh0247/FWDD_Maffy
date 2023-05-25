<?php
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");

    $assessment_id = $_GET['ass_id'];
    $course_id = $_GET['courseid'];

    #select assessment
    $assessment = mysqli_query($con, "SELECT * FROM assessment WHERE assessment_id ='$assessment_id'");

    $courses = "SELECT * FROM course";
    $total_courses = mysqli_query($con,$courses);

    #select the comment data
    $comment = "SELECT * FROM comment WHERE assessment_id = '$assessment_id'";
    $comment_result = mysqli_query($con,$comment);
    
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
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/theme/monokai.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/css/css.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/jsx/jsx.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/sql/sql.min.js"></script>


    <title>View Assessment</title>

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
                <a href='../shared/course_page.php?user_id=$_SESSION[user_id]&courseid=$row[course_id]'>
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


    <div class="big-container">
      <div class="first-container">
        <div class="subContainer">
          <?php
          if(mysqli_num_rows($assessment) > 0){
            while($row = mysqli_fetch_assoc($assessment)){
          ?>
            <h1><?=$row['assessment_title']?></h1>
            <h4><?=$row['assessment_date_posted']?></h4>              
          </div>
        </div>
        <div class="second-container">
          <p><?=$row['assessment_content']?></p>
        </div>
        <?php
          }
        }
        ?>

        <!-- add code session -->
        <div class="code-part">
            <div class="form-group" id="add-code-div">
                <label for="title">Programming Code:</label>
                <div class="custom-select">
                    <select id="language-select" onchange="setMode(this.value)">
                    <!-- dont need select, just get from db see what language then pass to js to identify the code background -->
                        <option value="htmlmixed">html</option>
                        <option value="css">css</option>
                        <option value="javascript">javascript</option>
                        <option value="php">php</option>
                        <option value="text/x-java">java</option>
                        <option value="python">python</option>
                        <option value="jsx">react</option>
                        <option value="xml">ajax</option>
                        <option value="javascript">jquery</option>
                        <option value="sql">sql</option>
                    </select>
                </div>
                <textarea class="input texttt" id="code-editor" name="code" rows="10" cols="80" class="code-editor"></textarea>
              </div>
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

      <div class="comment-container">
        <div>
          <i class="fa fa-comment-o comment" aria-hidden="true"></i>
          <h2>Comment</h2>
        </div>
        <div id="comment-content">
        <?php                  
          if(mysqli_num_rows($comment_result) == 0){
        ?>
          <p>This assessment don't have comment</P>
        <?php

          }else{
              // php to get the friend list id
              $comment = mysqli_query($con,
              "SELECT comment.comment_word, comment.assessment_id, comment.comment_date_posted, user.user_image, user.username
              FROM comment
              INNER JOIN user ON user.user_id = comment.user_id
              INNER JOIN assessment ON assessment.assessment_id = comment.assessment_id
              WHERE comment.assessment_id = " . $assessment_id . "
              ORDER BY comment.comment_id ASC");

              if(mysqli_num_rows($comment) > 0)
              {
                while($row = mysqli_fetch_assoc($comment)) {
                  if($row["assessment_id"] == $assessment_id){
                foreach($comment as $comment_data) // Run SQL query
                    {
          ?>
                      <div class="comment">
                        <div class="subComment">
                          <!-- <img src="./profile.jpg"> -->
                          <img src="<?=$comment_data['user_image']?>">
                          <div class="prev-comment">
                            <p><?=$comment_data['comment_word']?></p>
                          </div>
                        </div>
                      </div>
          <?php
                    }
                  }
                  }
                }
              }
          ?>
        </div>

        <!--For user to type the comment-->
          <div class="comment">
            <div class="subComment">
              <!-- <img src="./profile.jpg"> -->
              <?php
              #Get user id
              $user = mysqli_query($con,"SELECT * FROM user where user_id = '" . $_SESSION['user_id'] . "'");
              $users = mysqli_fetch_assoc($user);
              ?>
              <img src="<?=$users['user_image']?>">
              <input type="text" class="comment-box" placeholder="Comment" id="comment-text">
              <button class="sendBtn" id="post">
                Post
              </button>
            </div>
          </div>
      </div>

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

  <!-- <script>
    // when click on the send button
    $(document).ready(function() {
      $("#post").on("click", function() {
        // assign value
        var commentText = $("#comment-text").val();

        // pass to insert message
        $.ajax({
          url: "../../../../backend/insertComment.php",
          method: "POST",
          data: {
            sender_id: "<?php echo $_SESSION['user_id']; ?>",
            assessment_id: "<?php echo $assessment_id; ?>",
            commentText: commentText
          },
          dataType: "text",
          success: function(data) {
            $("#comment-text").val("");
          }
        });
      });
      //refresh the page
      setInterval(function() {

        $.ajax({
          url: "../../../../backend/realTimeComment.php",
          method: "POST",
          data :{
            sender_id: "<?php echo $_SESSION['user_id']; ?>",
            assessment_id: "<?php echo $assessment_id; ?>",
          },
          dataType:"Text",
          success:function(data){
            $("#comment-content").html(data);
          }
        })
      }, 700);
    });

  </script> -->
  <script src="./nav_bar.js"></script>
  <script src="./hamburger.js"></script>
  <script src="../student/JavaScript/exercise.js"></script>

  <script>
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const publishLinkCheckbox = document.getElementById('publish-link');
    const publishExerciseCheckbox = document.getElementById('publish-exercise');
    const publishCodeCheckbox = document.getElementById('publish-code');
    const addLinkDiv = document.getElementById('add-link-div');
    const addCodeDiv = document.getElementById('add-code-div');
    const publishExerciseGroup = document.getElementById('exercise-group');
    const submitBtn = document.getElementById('submit-btn');
    const postForm = document.getElementById('form');


    // Initialize CodeMirror editor
    var codeEditor = CodeMirror(document.getElementById("code-editor"), {
  mode: "htmlmixed",
  theme: "monokai",
  lineNumbers: true,
  autofocus: true,
  indentUnit: 2,
  tabSize: 2,
  smartIndent: true,
  lineWrapping: true
});
 


    // Set the mode dynamically based on user selection
    function setMode(mode) {
        codeEditor.setOption("mode", mode);
    }
  </script>
  
</body>
</html>