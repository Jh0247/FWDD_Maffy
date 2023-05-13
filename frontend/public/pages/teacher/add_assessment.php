<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");

    $courseID = $_GET['courseid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/add_assessment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <title>Add Assessment</title>

    <script>
    // a pop-up function that use at php code
    function pop_up_success() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Assessment Successfully Posted!',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: "<a href=\"../shared/course_page.php?userid=$_SESSION[user_id]&courseid=$courseID\" style=\"text-decoration:none; color:white; \">Continue</a>"
        })
    }

    function pop_up_error_emptyTextField() {
        Swal.fire({
            icon: 'warning',
            title: 'ALERT',
            text: 'Please Do Not Let the Assessment Title or Assessment Description Empty!',
        })
    }
    </script>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <div class="back-btn-container">
        <a href="#" onclick="goBack()" class="back-btn" id="back-btn">
            <i class="fas fa-chevron-left"></i> Back
        </a>
    </div>


    <div class="container">
        <h2>POST ASSESSMENT</h2>
        <form novalidate id="post-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="input" type="text" id="title" name="ass-title" placeholder="e.g. What is html..."
                    required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="input" id="content" name="ass-content" rows="5" placeholder="e.g. What is html..."
                    required></textarea>
            </div>

            <!-- add additional note -->
            <div class="form-group">
                <label for="publish" class="check-container">
                    <input type="checkbox" id="publish" name="add_link">
                    <div class="checkmark"></div>
                    Add Additional Note Link
                </label>
            </div>
            <div class="form-group" id="publish-date-group" style="display: none;">
                <input class="input" type="text" id="publish-date" name="add_link" placeholder="e.g. https://..."
                    required>
            </div>

            <!-- add assessment exercise -->
            <div class="form-group">
                <label for="publish-exercise" class="check-container">
                    <input type="checkbox" id="publish-exercise" name="add_exercise">
                    <div class="checkmark"></div>
                    Add Assessment Exercise
                </label>
            </div>
            <div class="exercise-container" id="exercise-group" style="display: none;">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="input" id="title" name="exercise-title" placeholder="e.g. What is html..."
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="input" id="description" name="exercise-desc"
                        placeholder="e.g. What is html..." required>
                </div>
                <div class="form-group">
                    <label for="pratice">Practice:</label>
                    <textarea class="input" id="pratice" name="exercise-practice" rows="5"
                        placeholder="e.g. What is html..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <input type="text" class="input" id="answer" name="exercise-answer"
                        placeholder="e.g. What is html..." required>
                </div>
            </div>
            <button class="button" type="submit" id="submit-btn" name="submitbtn">
                Create Assessment
            </button>
        </form>
    </div>

    <?php 
        // if isset is POST 'submit' only execute the code below
        if(isset($_POST['submitbtn'])) {
            
            date_default_timezone_set('Asia/Kuala_Lumpur');
            // $course_image = file_get_contents($_FILES['uploadedFile']['tmp_name']);
            $ass_title = $_POST['ass-title'];
            $ass_content = addslashes($_POST['ass-content']);
            $ass_link = addslashes($_POST['add_link']);
            $exercise_title = $_POST['exercise-title'];
            $exercise_desc = $_POST['exercise-desc']; 
            $exercise_pratice = $_POST['exercise-practice']; 
            $exercise_ans = $_POST['exercise-answer']; 
            $posted_date = date("Y-m-d H:i:s");

            if(empty($ass_title) or empty($ass_content)) {
                echo "<script>pop_up_error_emptyTextField()</script>";
            } 
            else {
     
                $ass_sql = "INSERT INTO assessment (course_id, assessment_title, assessment_content, assessment_date_posted) 
                        VALUES ('$courseID', '$ass_title', '$ass_content', '$posted_date')";

                $ass_result = mysqli_query($con, $ass_sql);

                // Get the ID of the last inserted row
                $last_ass_id = mysqli_insert_id($con);

                $exercise_sql = "INSERT INTO practice (assessment_id, practice_title, practice_desc, practice_question, practice_answer) 
                        VALUES ('$last_ass_id', '$exercise_title', '$exercise_desc', '$exercise_pratice', '$exercise_ans')";

                $exercise_result = mysqli_query($con, $exercise_sql);

                if($ass_result and $exercise_result) {
                    echo "<script>pop_up_success()</script>";
                } else {
                    echo "<script>alert('Something went wrong')</script>";
                }
                        
            }
            mysqli_close($con);
        }
    ?>

    <script>
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const publishCheckbox = document.getElementById('publish');
    const publishExerciseCheckbox = document.getElementById('publish-exercise');
    const publishDateGroup = document.getElementById('publish-date-group');
    const publishExerciseGroup = document.getElementById('exercise-group');
    const submitBtn = document.getElementById('submit-btn');
    const postForm = document.getElementById('post-form');

    publishCheckbox.addEventListener('change', () => {
        if (publishCheckbox.checked) {
            publishDateGroup.style.display = 'block';
        } else {
            publishDateGroup.style.display = 'none';
        }
    });

    publishExerciseCheckbox.addEventListener('change', () => {
        if (publishExerciseCheckbox.checked) {
            publishExerciseGroup.style.display = 'block';
        } else {
            publishExerciseGroup.style.display = 'none';
        }
    });

    // back button
    function goBack() {
        window.history.back();
    }
    </script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>