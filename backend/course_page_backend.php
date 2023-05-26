<?php 
    include("../backend/conn.php");
    include("../backend/session.php");

    // get the id value
    $user_id = $_POST["userid"];
    $course_id = $_POST["courseid"];
    $course_ID = $_POST["course_id"];
    
    if(isset($_POST['delete_submitbtn'])){
        // perform delete sql query
        $delete_course = "DELETE FROM course WHERE user_id = $user_id AND course_id = $course_id";
        $delete_result = mysqli_query($con, $delete_course);
    }
    
    if(isset($_POST['deactive_submitbtn'])){
        // perform deactivate sql
        $update_course_deactive = "UPDATE course SET course_status = 2 WHERE course_id = $course_id";
        $result_deactive = mysqli_query($con, $update_course_deactive);
    }
    
    if(isset($_POST['active_submitbtn'])){
        // perform activate sql
        $update_course_active = "UPDATE course SET course_status = 1 WHERE course_id = $course_ID";
        $result_active = mysqli_query($con, $update_course_active);
    }

    if(isset($_POST['publish_submitbtn'])){
        // perform activate sql
        $update_course_active = "UPDATE course SET course_status = 1 WHERE course_id = $course_ID";
        $result_active = mysqli_query($con, $update_course_active);
    }
?>