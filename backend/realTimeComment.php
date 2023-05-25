<?php
    include("../backend/conn.php");
    include("../backend/session.php");

    $sender = $_POST["sender_id"];
    $assessment_id = $_POST["assessment_id"];
    $output = "";

    $comments = mysqli_query($con, 
      "SELECT comment.comment_word, comment.assessment_id, comment.comment_date_posted, user.user_image, user.username
      FROM comment
      INNER JOIN user ON user.user_id = comment.user_id
      INNER JOIN assessment ON assessment.assessment_id = comment.assessment_id
      WHERE comment.assessment_id = " . $assessment_id . "
      ORDER BY comment.comment_id ASC");

    while($comment = mysqli_fetch_assoc($comments)){
      if ($comment["assessment_id"] == $assessment_id) {
        $output .= '
        <div class="comment">
        <div class="subComment">
          <img src="'.$comment['user_image'].'">
          <div class="prev-comment">
            <p>'.$comment['comment_word'].'</p>
            <!-- <p>Comment somethingComment somethingComment somethingComment somethingComment somethingComment something</p> -->
          </div>
        </div>
      </div>
        ';
      }
      else
      {
        $output .= "
        <div class=\"comment\">
        <div class=\"subComment\">
          <img src=\"".$comment['user_image']."\">
          <div class=\"prev-comment\">
            <p>\"".$comment['comment_word']."\"</p>
            <!-- <p>Comment somethingComment somethingComment somethingComment somethingComment somethingComment something</p> -->
          </div>
        </div>
      </div>
        ";
      }
    }
    echo $output;
?>