<?php
    // connection to database
    include("../../../../backend/conn.php");
    include("../../../../backend/session.php");
    
    require_once("../teacher/component/single_assessment_container.php");
    
    $user_privilege = 0;
    
    if(isset($_SESSION['user_id'])) {
        // Retrieve user information from database
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
        $user = mysqli_fetch_array($query);
        $user_privilege = $user['privilege_id'];
    };
    
    $courseID = $_GET['courseid'];
    
    #Extracting course information for all courses from database
    $all_course_info = "SELECT * FROM course WHERE course_id = $courseID";
    $all_course_info_result = mysqli_query($con, $all_course_info);
    $all_course_info_row = mysqli_fetch_assoc($all_course_info_result);
    
    #Extracting course information for all courses matched user_id from database
    $course_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);

    #Extracting course information for all courses from database
    $ass_info = "SELECT * FROM assessment WHERE course_id = $courseID";
    $ass_info_result = mysqli_query($con, $ass_info);
    $ass_info_row = mysqli_fetch_assoc($ass_info_result);

    #Counting the assessment number
    $count_ass = "SELECT COUNT(*) AS count FROM assessment WHERE course_id = $courseID";
    $count_ass_result = mysqli_query($con, $count_ass);
    $count_ass_row = mysqli_fetch_assoc($count_ass_result);
    $count = $count_ass_row['count'];

    // check if the count is greater than or equal to 3 to display "Published", otherwise "Unpublished"
    $status = ($count >= 3) ? "Published" : "Unpublished";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/course_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fontawesome.com/icons/eye-slash?f=sharp&s=solid" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Course</title>

    <script>
    // a pop-up function that use at php code
    function pop_up_success_delete() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Course Successfully Delete!',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: '<a href="../teacher/homepage.php" style="text-decoration:none; color:white; ">Continue</a>'
        })
    }

    function pop_up_success_deactive() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Course Successfully Deactivate!',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: '<a href="../teacher/homepage.php" style="text-decoration:none; color:white; ">Continue</a>'
        })
    }

    function pop_up_success_active() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Course Successfully Activate!',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: '<a href="../teacher/homepage.php" style="text-decoration:none; color:white; ">Continue</a>'
        })
    }
    </script>
</head>

<body>
    <div class="w-screen h-screen flex flex-row">
        <?php 
        if($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student'){
            include '../shared/navbar.php';
        } else {
            include '../admin/sidebar.php';
        }
        ?>
        <div class="w-full overflow-auto">
            <header>
                <div class="cover-image">

                    <img src="<?php echo $all_course_info_row["course_image"]; ?>" alt="Cover Image">
                    <div class="cover-text">
                        <h1>
                            <?php echo $all_course_info_row["course_title"]; ?>
                        </h1>
                        <p>
                            <?php echo $all_course_info_row["course_desc"];?>
                        </p>
                    </div>

                </div>
            </header>

            <!-- status container -->
            <?php 
    
            if($user_privilege == '2'){
                if($course_info_row["user_id"] == $_SESSION["user_id"]){
                    echo("
                    <div class=\"container\">
                        <div class=\"options\">
                            <div class=\"option\">
                                <a href=\"../teacher/add_assessment.php?userid=$_SESSION[user_id]&courseid=$courseID\"><i class=\"fas fa-plus\"></i> Add Assessment</a>
                            </div>
                            <div class=\"option\">
                                <a href=\"../teacher/add_course.php?userid=$_SESSION[user_id]&courseid=$courseID&currentfile=../shared/course_page.php\"><i class=\"fas fa-edit\"></i> Edit</a>
                            </div>
                            <form method=\"POST\" class=\"options\" enctype=\"multipart/form-data\">
                                <div class=\"option\">
                                    " . ($course_info_row['user_id'] === $_SESSION['user_id'] && $course_info_row['course_id'] === $courseID && $course_info_row['course_status'] === '1' ? "
                                        <button type=\"submit\" name=\"deactive-submitbtn\"><i class=\"fas fa-eye-slash\"></i> Deactive</button>
                                    " : "
                                        <button type=\"submit\" name=\"active-submitbtn\"><i class=\"fas fa-eye\"></i> Activate</button>
                                    ") . "
                                </div>
                                <div class=\"option\">
                                    <button type=\"submit\" name=\"delete-submitbtn\"><i class=\"fas fa-trash\"></i> Delete</button>
                                </div>
                            </form>
                            <div class=\"option filter\">
                                <a href=\"#\"><i class=\"fas fa-filter\"></i> Filter</a>
                            </div>
                        </div>
                        <div class=\"publish-container\">
                            <p class=\"published\">$status</p>
                        </div>
                    </div>
                    ");
                }else{
                    echo("
                    <div class=\"container\">
                        <div class=\"options\">
                            <div class=\"option filter\">
                                <a href=\"#\"><i class=\"fas fa-filter\"></i> Filter</a>
                            </div>
                        </div>
                        <div class=\"publish-container\">
                            <p class=\"published\">$status</p>
                        </div>
                    </div>
                    ");
                }
                
            } else {
                echo("
                <div class=\"container\">
                    <div class=\"options\">
                        <div class=\"option filter\">
                            <a href=\"#\"><i class=\"fas fa-filter\"></i> Filter</a>
                        </div>
                    </div>
                    <div class=\"publish-container\">
                        <p class=\"published\">$status</p>
                    </div>
                </div> 
                ");
            }
            ?>

            <!-- hidden filter column -->
            <form method="GET" class=" options" enctype="multipart/form-data">
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
            </form>
            <?php 
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $filter = [];
    
                if (isset($_GET['latest'])) {
                $filter[] = 'DESC';
                }
    
                if (isset($_GET['oldest'])) {
                $filter[] = 'ASC';
                }
    
                if (!empty($filter)) {
                $orderBy = implode(', ', $filter);
    
                // Perform the SQL query using the selected filter options
                $filter_query = "SELECT * FROM assessment ORDER BY assessment_date_posted $orderBy";
                $filter_result = mysqli_query($con, $filter_query);
                }
                }
            ?>

            <!-- single asssessment status container -->
            <?php 
            // while($row = mysqli_fetch_assoc($filter_result)){
                if($count >= 1) {
                    do{
                        single_ass($ass_info_row["assessment_id"], $ass_info_row["course_id"], $ass_info_row["assessment_title"], $ass_info_row["assessment_content"]);
                    } while ($ass_info_row = mysqli_fetch_assoc($ass_info_result));
                }
                else {
                    if($course_info_row["user_id"] == $_SESSION["user_id"]){
                        echo
                        ("
                            <div class=\"container\">
                                <div class=\"options\">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                                <div class=\"publish-container\">
                                    <button onclick=\"location.href='../teacher/add_assessment.php?userid=$_SESSION[user_id]&courseid=$courseID'\" class=\"published post-btn\" >Post Assessment Now</button>
                                </div>
                            </div> 
                        ");
                    }else{
                        echo
                        ("
                            <div class=\"container\">
                                <div class=\"options\">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                            </div> 
                        ");
                    }
                }
            // }
            ?>
        </div>
    </div>

    <?php
      
    // delete course
    if(isset($_POST['delete-submitbtn'])) {
        $delete_course = "DELETE FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
        $delete_result = mysqli_query($con, $delete_course);

        if($delete_result){
            echo "<script>pop_up_success_delete()</script>";
        } 
    }

    // deactive course
    if(isset($_POST['deactive-submitbtn'])) {
        $update_course_deactive = "UPDATE course SET course_status = 2 WHERE course_id = $courseID";
        $result_deactive = mysqli_query($con, $update_course_deactive);

        if($result_deactive){
            echo "<script>pop_up_success_deactive()</script>";
        }
    }

    // active course 
    if(isset($_POST['active-submitbtn'])) {
        $update_course_active = "UPDATE course SET course_status = 1 WHERE course_id = $courseID";
        $result_active = mysqli_query($con, $update_course_active);

        if($result_active){
            echo "<script>pop_up_success_active()</script>";
        }
    }

    ?>

    <script>
    const filterOption = document.querySelector('.filter');
    const filterContainer = document.querySelector('.filter-container');

    // Event listener for Filter option click
    filterOption.addEventListener('click', () => {
        if (filterContainer.style.display === "block") {
            filterContainer.style.display = "none";
        } else {
            filterContainer.style.display = "block";
        }
    });

    const applyButton = document.querySelector('.apply-button');
    applyButton.addEventListener('click', applyFilters);

    function applyFilters() {
        const lastestCheckbox = document.querySelector('#lastest-checkbox');
        const oldestCheckbox = document.querySelector('#oldest-checkbox');
        const commentRadio = document.querySelector('#comment-radio');
        const exerciseRadio = document.querySelector('#exercise-radio');
        const noteRadio = document.querySelector('#note-radio');

        const lastestChecked = lastestCheckbox.checked;
        const oldestChecked = oldestCheckbox.checked;
        const commentChecked = commentRadio.checked;
        const exerciseChecked = exerciseRadio.checked;
        const noteChecked = noteRadio.checked;

        // Code to filter based on selected options
    }
    </script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>