<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    
    require_once("../teacher/backend/single_assessment_container.php");
    
    $courseID = $_GET['courseid'];
    
    #Extracting course information for all courses from database
    $course_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);

    #Extracting course information for all courses from database
    $ass_info = "SELECT * FROM assessment WHERE course_id = $courseID";
    $ass_info_result = mysqli_query($con, $ass_info);
    $ass_info_row = mysqli_fetch_assoc($ass_info_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/course_page.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Add Course</title>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <header>
        <div class="cover-image">
            <img src="<?php echo $course_info_row["course_image"]; ?>" alt="Cover Image">
            <div class="cover-text">
                <h1>
                    <?php echo $course_info_row["course_title"]; ?>
                </h1>
                <p>
                    <?php echo $course_info_row["course_desc"];?>
                </p>
            </div>
        </div>
    </header>

    <!-- status container -->
    <?php 
    
        if($user_privilege == '2'){
            echo("
            <div class=\"container\">
                <div class=\"options\">
                    <div class=\"option\">
                        <a href=\"../teacher/add_assessment.php?userid=$_SESSION[user_id]&courseid=$courseID\"><i class=\"fas fa-plus\"></i> Add Assessment</a>
                    </div>
                    <div class=\"option\">
                        <a href=\"#\"><i class=\"fas fa-edit\"></i> Edit</a>
                    </div>
                    <div class=\"option\">
                        <a href=\"#\"><i class=\"fas fa-trash\"></i> Delete</a>
                    </div>
                    <div class=\"option filter\">
                        <a href=\"#\"><i class=\"fas fa-filter\"></i> Filter</a>
                    </div>
                </div>
                <div class=\"publish-container\">
                    <p class=\"published\">Unpublished</p>
                </div>
        
            </div>
            ");
        }
    
    ?>


    <!-- hidden filter column -->
    <div class="filter-container hidden">
        <h3>Filter Options</h3>
        <h4>Filter By:</h4>
        <div class="filter-row">
            <div class="filter-column">
                <input type="checkbox" id="latest" name="latest">
                <label for="latest">Latest</label>
                <br><br>
                <input type="checkbox" id="oldest" name="oldest">
                <label for="oldest">Oldest</label>
            </div>
            <div class="filter-column">
                <div class="filter-radio">
                    <input type="radio" id="comment" name="filter" value="comment">
                    <label for="comment">Comment</label>
                </div>
                <div class="filter-radio">
                    <input type="radio" id="exercise" name="filter" value="exercise">
                    <label for="exercise">Exercise</label>
                </div>
                <div class="filter-radio">
                    <input type="radio" id="additional-note" name="filter" value="additional-note">
                    <label for="additional-note">Additional Note</label>
                </div>
            </div>
        </div>
        <button class="apply-btn">Apply</button>
    </div>

    <!-- single asssessment status container -->
    <?php 
        
        do{
            single_ass($ass_info_row["assessment_id"], $ass_info_row["course_id"], $ass_info_row["assessment_title"], $ass_info_row["assessment_content"]);
        } while ($ass_info_row = mysqli_fetch_assoc($ass_info_result))
    
    ?>

    <script>
    const myDiv = document.getElementById("next-page");
    myDiv.addEventListener("click", () => {
        window.location.href =
            "../../../public/pages/teacher/view_courses.html"; // replace with your desired URL
    });
    </script>

    <script src="../../../src/stylesheets/teacher/course_page.js"></script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>