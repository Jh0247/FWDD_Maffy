<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    
    require_once("../teacher/component/teacher_homepage_course.php");

    #Extracting course information for trend courses from database
    $trendCourse_info = "SELECT * FROM course ORDER BY course_click DESC LIMIT 3";
    $trendCourse_info_result = mysqli_query($con, $trendCourse_info);
    $trendCourse_info_row = mysqli_fetch_assoc($trendCourse_info_result);

    #Extracting course information for all courses from database
    $course_info = "SELECT * FROM course";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/homepage.css">
    <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Homepage</title>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <!-- Trend Courses -->
    <h2 class="topic">Trend Courses</h2>
    <div class="big-container">

        <?php 
            do{                    
                trendCourses($trendCourse_info_row["course_id"], $trendCourse_info_row["user_id"], $trendCourse_info_row["course_title"], $trendCourse_info_row["course_image"]);
                // Append course ID to button name attribute
                $button_name = "course_button_" . $trendCourse_info_row["course_id"];
                // Check if button is clicked
                if (isset($_POST[$button_name])) {
                    // Update course_click in database
                    $course_id = $trendCourse_info_row["course_id"];
                    $update_query = "UPDATE course SET course_click = course_click + 1 WHERE course_id = $course_id";
                    mysqli_query($con, $update_query);
                    $redirect_url = "../shared/course_page.php?userid=$_SESSION[user_id]&courseid=$trendCourse_info_row[course_id]";
                    echo "<script>window.location.href = '$redirect_url';</script>";
                    exit();
                }
            } while ($trendCourse_info_row = mysqli_fetch_assoc($trendCourse_info_result))
        ?>

    </div>

    <!-- Posted courses -->
    <div class="down-container">
        <h2 class="down-topic">All Courses</h2>
        <div class="flex-container">
            <?php 
                do{
                    allCourses($course_info_row["course_id"], $course_info_row["user_id"], $course_info_row["course_title"], $course_info_row["course_image"]);
                    // Append course ID to button name attribute
                    $allcourse_button_name = "all_course_button_" . $course_info_row["course_id"];
                    // Check if button is clicked
                    if (isset($_POST[$allcourse_button_name])) {
                        // Update course_click in database
                        $allcourse_id = $course_info_row["course_id"];
                        $_allcourse_update_query = "UPDATE course SET course_click = course_click + 1 WHERE course_id = $allcourse_id";
                        mysqli_query($con, $_allcourse_update_query);
                        $redirect_url = "../shared/course_page.php?userid=$_SESSION[user_id]&courseid=$course_info_row[course_id]";
                        echo "<script>window.location.href = '$redirect_url';</script>";
                        exit();
                    }
                } while ($course_info_row = mysqli_fetch_assoc($course_info_result))
            ?>
        </div>
    </div>

    <?php 
    
    // if(isset($_POST['submit'])) {
            
    //     $result = mysqli_query($con, "UPDATE course SET course_click = course_click + 1 WHERE course_id = $courseID");
    //     if($result) {
    //         header("Location: ../../pages/shared/course_page.php?userid=$_SESSION[user_id]&courseid=$courseID");
    //         exit();
    //     } else {
    //         echo "<script>alert('Something went wrong')</script>";
    //     }
        
    //     mysqli_close($con);
    // }
    
    ?>

    <script>
    // Pop out edit password container 
    const editPasswordBtn = document.getElementById('edit-password-btn');
    const passwordPopup = document.getElementById('password-popup');
    const savePasswordBtn = document.getElementById('save-password-btn');
    const cancelPasswordBtn = document.getElementById('cancel-password-btn');

    editPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'block';
    });

    cancelPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });

    savePasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });
    </script>

    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>