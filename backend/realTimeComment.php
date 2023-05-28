<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    $sender = $_POST["sender_id"];
    $assessment_id = $_POST["assessment_id"];
    $output = "";

    $comments = mysqli_query($con, 
      "SELECT comment.comment_word, comment.user_id ,comment.assessment_id, comment.comment_date_posted, user.user_image, user.username
      FROM comment
      INNER JOIN user ON user.user_id = comment.user_id
      INNER JOIN assessment ON assessment.assessment_id = comment.assessment_id
      WHERE comment.assessment_id = " . $assessment_id . "
      ORDER BY comment.comment_id ASC");

      if(mysqli_num_rows($comments) == 0){
        echo "<p>This assessment don't have comment yet</p>";
      }else{
        while($comment = mysqli_fetch_assoc($comments)){
          if ($comment["assessment_id"] == $assessment_id) {
            $output .= '
            <div class="comment">
                <div class="subComment">
                    <img src="' . $comment['user_image'] . '">
                    <div style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row; gap: 0.2rem;">
                            <a href="../shared/user_profile?id=' . $comment['user_id'] . '" class="username">
                                <p>' . $comment['username'] . '</p>
                            </a>
                            <p class="date">' . $comment['comment_date_posted'] . '</p>
                        </div>
                        <div class="prev-comment">
                            <p class="comment-data">' . $comment['comment_word'] . '</p>
                        </div>
                    </div>
                </div>
            </div>
            ';
            
            
          }
          else
          {
            $output .= '
            <div class="comment">
                <div class="subComment">
                    <img src="' . $comment['user_image'] . '">
                    <div style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row; gap: 0.2rem;">
                            <a href="../shared/user_profile?id=' . $comment['user_id'] . '" class="username">
                                <p>' . $comment['username'] . '</p>
                            </a>
                            <p class="date">' . $comment['comment_date_posted'] . '</p>
                        </div>
                        <div class="prev-comment">
                            <p class="comment-data">' . $comment['comment_word'] . '</p>
                        </div>
                    </div>
                </div>
            </div>
            ';
          }
        }
      }


    echo $output;
?>