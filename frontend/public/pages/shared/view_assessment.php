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

    #Get the note content from database
    $note = mysqli_query($con,"SELECT note_content FROM note WHERE assessment_id = '".$assessment_id."'");
    $note_url = mysqli_fetch_assoc($note);
    
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


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
            <a id="res-note">Extra Note</a>            
          </div>
        </div>
        <div class="second-container">
          <p><?=$row['assessment_content']?></p>
        </div>


        <!-- code session --> 
        <div class="code-part">
          <div class="form-group" id="add-code-div">
            <div style="display: flex; flex-direction: column;">
              <h3 class="language-title"><?=$row['assessment_language']?></h3>
              <textarea id="code-editor" name="code" rows="10" cols="80" class="code-editor">
                <?= htmlspecialchars($row['assessment_code']) ?>
              </textarea>
            </div>
          </div>
        </div>
      <?php
            }
          }
            ?>

  <div class="exercise-container">
    <div id="exercise-group">
      <?php
      $practice = mysqli_query($con, "SELECT * FROM practice WHERE assessment_id = '$assessment_id'");
      if (mysqli_num_rows($practice) > 0) {
        while ($row = mysqli_fetch_assoc($practice)) {
      ?>
          <h3 class="practice-title"><?= $row['practice_title']; ?></h3>
          <div class="fir-container">
            <div class="answer-type">
              <h4><?= htmlspecialchars($row['practice_question']); ?></h4>
              <div class="answer-part">
                <input type="text" id="answer" class="answer">
                <?php $storedAnswer = $row['practice_answer'];?>
                <div><p id="result"></p></div>
                <button type="button" class="check-btn" onclick="checkAnswer('<?= $storedAnswer; ?>')">
                Check Answer
              </button>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>

 
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
              "SELECT comment.comment_word, comment.user_id, comment.assessment_id, comment.comment_date_posted, user.user_image, user.username
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
                          <a href="../shared/user_profile?id=<?php echo $comment_data['user_id'];?>"><img src="<?=$comment_data['user_image']?>"></a>
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
          <button class="shareBtn" id="btn-share">Share</button>
        </div>
      </div>
    </div>

    <div style="display: flex;flex-direction: row;justify-content: flex-end;">
    <!--Rightside sidebar-->
    <nav id="right-sidebar">
      <ul>
        <li>
            <div class="Share-icone" id="share">
            <i class="fa fa-share-alt fa-2x" aria-hidden="true"></i>
            </div>
        </li>
        <li>
          <div class="mail-icon" id="note">
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

  <script>
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

  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Generate QR Code function
    function generateQRCode(text, width, height) {
      var qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" + encodeURIComponent(text) + "&size=" + width + "x" + height;
      var qrCodeImage = '<img src="' + qrCodeUrl + '" alt="QR Code">';

      // Create a pop-up container
      var popupContainer = $('<div class="popup-container"></div>');
      popupContainer.append(qrCodeImage);

      // Create a close button
      var closeButton = $('<span class="close-button">&times;</span>');
      closeButton.on('click', function() {
        popupContainer.remove();
      });
      popupContainer.append(closeButton);

      $('body').append(popupContainer);
    }

    // Button click event listener
    $('#share').on('click', function() {
      var text = "http://localhost:8080/Maffy/FWDD_Maffy/frontend/public/pages/shared/view_assessment.php?ass_id=<?php echo $assessment_id;?>&courseid=<?php echo $course_id; ?>";
      var width = 500;
      var height = 500;

      generateQRCode(text, width, height);
    });

    $('#note').on('click', function() {
      var text = "<?php echo $note_url['note_content'];?>";
      var width = 500;
      var height = 500;

      generateQRCode(text, width, height);
    });

    $('#res-note').on('click', function() {
      var text = "<?php echo $note_url['note_content'];?>";
      var width = 500;
      var height = 500;

      generateQRCode(text, width, height);
    });

    $('#btn-share').on('click', function() {
      var text = "http://localhost:8080/Maffy/FWDD_Maffy/frontend/public/pages/shared/view_assessment.php?courseid=<?php echo $course_id; ?>";
      var width = 500;
      var height = 500;

      generateQRCode(text, width, height);
    });
  </script>

  <script>
    $(document).ready(function() {
      // Initialize CodeMirror editor
      var codeEditor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
        mode: "htmlmixed",
        theme: "monokai",
        lineNumbers: true,
        autofocus: true,
        indentUnit: 2,
        tabSize: 2,
        smartIndent: true,
        lineWrapping: true
      });

      // Set the code in the editor
      var code = codeEditor.getValue();
        codeEditor.setValue(code);

      // Change mode based on selected language
      var selectedMode = "htmlmixed";
      codeEditor.setOption("mode", selectedMode);
    });

    function checkAnswer(storedAnswer) {
      var userAnswer = $("#answer").val();

      if (userAnswer === storedAnswer) {
        $("#result").text("Correct!");
      } else {
        $("#result").text("Incorrect!");
      }
    };
  </script>

</body>
</html>