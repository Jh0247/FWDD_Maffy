<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    
    require_once("../teacher/backend/teacher_homepage_course.php");

    #Extracting course information for trend courses from database
    $trendCourse_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id] ORDER BY course_click DESC LIMIT 3";
    $trendCourse_info_result = mysqli_query($con, $trendCourse_info);
    $trendCourse_info_row = mysqli_fetch_assoc($trendCourse_info_result);

    #Extracting course information for all courses from database
    $course_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id]";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/homepage.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick-theme.css" /> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
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
            } while ($trendCourse_info_row = mysqli_fetch_assoc($trendCourse_info_result))
        ?>

    </div>

    <!-- Posted courses -->
    <div class="down-container">
        <h2 class="down-topic">Posted Courses</h2>
        <div class="flex-container">
            <?php 
                do{
                    allCourses($course_info_row["course_id"], $course_info_row["user_id"], $course_info_row["course_title"], $course_info_row["course_image"]);
                } while ($course_info_row = mysqli_fetch_assoc($course_info_result))
            ?>
        </div>
    </div>

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