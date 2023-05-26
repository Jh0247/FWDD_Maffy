<?php
// connection to database
include("../../../../backend/conn.php");
include("../../../../backend/session.php");

require_once("../teacher/component/single_assessment_container.php");

$user_privilege = 0;

if (isset($_SESSION['user_id'])) {
    // Retrieve user information from database
    $query = mysqli_query($con, "SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
    $user = mysqli_fetch_array($query);
    $user_privilege = $user['privilege_id'];
};
if (isset($_GET['courseid'])) {

    $courseID = $_GET['courseid'];

    #Extracting course information for all courses from database
    $all_course_info = "SELECT * FROM course WHERE course_id = $courseID";
    $all_course_info_result = mysqli_query($con, $all_course_info);
    $all_course_info_row = mysqli_fetch_assoc($all_course_info_result);

    #Extracting course information for all courses matched user_id from database
    $course_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);

    #Extracting assessment information for all courses from database
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
}

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
    <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


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
            text: 'Course Successfully Activate/Publish!',
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
        if ($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student') {

            include '../shared/navbar.php';
        ?>
        <div class="w-full overflow-auto">
            <header>
                <div class="cover-image">
                    <?php
                } else {
                    include '../admin/sidebar.php';
                    ?>
                    <div class="w-full overflow-auto">
                        <header>
                            <div class="cover-admin">
                                <?php
                            }
                                ?>
                                <img src="<?php echo $all_course_info_row["course_image"]; ?>" alt="Cover Image">
                                <div class="cover-text">
                                    <h1 class="cover-header-text" style="max-width: 100%;">
                                        <?php echo $all_course_info_row["course_title"]; ?>
                                        <a id="download-doc" class="flex flex-col text-center">
                                            <span id="qrcode">
                                                <button id="generate-button"><i class=" fas fa-qrcode"></i>
                                                </button>
                                            </span>
                                        </a>
                                    </h1>
                                    <p class="cover-p-text">
                                        <?php echo $all_course_info_row["course_desc"]; ?>
                                    </p>
                                </div>

                            </div>
                        </header>

                        <!-- status container -->
                        <?php
                            if ($user_privilege == '2') {
                                if ($course_info_row["user_id"] == $_SESSION["user_id"]) {
                                    echo ("
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
                                        
                                    </div>
                                    <div class=\"publish-container\">
                                        " . ($course_info_row["course_status"] === '1' ? "
                                            <p class=\"published\">Published</p>
                                        " : "
                                            " . ($status = ($count >= 3) ? "
                                                <form method=\"POST\" enctype=\"multipart/form-data\">
                                                    <div class=\"publish-container\">
                                                        <button class=\"published post-btn\" name=\"active-submitbtn\" >Publish Now!</button>
                                                    </div>
                                                </form>
                                            " : "
                                                <p class=\"published\">$status</p>
                                            ") . "
                                        ") . "
                                    </div>
                                </div>
                                ");
                                } else {
                                    echo ("
                                <div class=\"container\">
                                    <div class=\"publish-container\">
                                    " . ($course_info_row["course_status"] === '1' && $status === ($count >= 3) ? "
                                        <P class=\"published\">Published</p>
                                    " : "
                                        <P class=\"published\">Unpublished</p>
                                    ") . "
                                    </div>
                                </div>
                                ");
                                }
                            } else {
                                echo ("
                            <div class=\"container\">
                                <div class=\"publish-container\">
                                " . ($status = ($count >= 3) ? "
                                    <P class=\"published\">$status</p>
                                " : "
                                    " . ($course_info_row["course_status"] === '1' && $status === ($count >= 3) ? "
                                        <P class=\"published\">Published</p>
                                    " : "
                                        <P class=\"published\">$status</p>
                                    ") . "
                                ") . "
                                    
                                </div>
                            </div> 
                            ");
                            }
                        ?>

                        <!-- search bar container -->
                        <div class="search-cont">
                            <input id="search-bar" type="text" class="search__input" placeholder="Search assessment..">
                            <span class="search__button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                        <!-- search result list -->
                        <div id="search-results" class="result-container">
                            <?php
                            if ($count >= 1) {
                                
                                if(mysqli_num_rows($ass_info_result)>0) {
                                    foreach($ass_info_result as $data) {

                                    echo "
                                    <a class=\"view-ass\" href=\"../shared/view_assessment.php?ass_id=$data[assessment_id]&courseid=$courseID\">
                                        <div class=\"left-details\">
                                            <div class=\"assessment-container\" id=\"next-page\">
                                                <div class=\"header\">
                                                    <h2 style=\"font-weight: bold; font-size: 24px\">".$data['assessment_title']."</h2>
                                                </div>
                                                <h3 class=\"desc\">".$data['assessment_content']."</h3>
                                            </div>
                                        </div>
                                    </a>
                                    ";
                                    }
                                }
                            } else {
                            if ($course_info_row["user_id"] == $_SESSION["user_id"]) {
                            echo ("
                            <div class=\"container\">
                                <div class=\"options\">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                                <div class=\"publish-container\">
                                    <button
                                        onclick=\"location.href='../teacher/add_assessment.php?userid=$_SESSION[user_id]&courseid=$courseID'
                                        \" class=\"published post-btn\">Post Assessment Now</button>
                                </div>
                            </div>
                            ");
                            } else {
                            echo ("
                            <div class=\"container\">
                                <div class=\"options\">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                            </div>
                            ");
                            }
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    // delete course
                    if (isset($_POST['delete-submitbtn'])) {
                        $delete_course = "DELETE FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
                        $delete_result = mysqli_query($con, $delete_course);

                        if ($delete_result) {
                            echo "<script>pop_up_success_delete()</script>";
                        }
                    }

                    // deactive course
                    if (isset($_POST['deactive-submitbtn'])) {
                        $update_course_deactive = "UPDATE course SET course_status = 2 WHERE course_id = $courseID";
                        $result_deactive = mysqli_query($con, $update_course_deactive);

                        if ($result_deactive) {
                            echo "<script>pop_up_success_deactive()</script>";
                        }
                    }

                    // active course 
                    if (isset($_POST['active-submitbtn'])) {
                        $update_course_active = "UPDATE course SET course_status = 1 WHERE course_id = $courseID";
                        $result_active = mysqli_query($con, $update_course_active);

                        if ($result_active) {
                            echo "<script>pop_up_success_active()</script>";
                        }
                    }

                    ?>
                    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>

                    <script>
                    //get class and id
                    const searchBar = document.getElementById("search-bar");
                    const items = document.querySelectorAll(".view-ass");

                    //add event listener
                    searchBar.addEventListener("input", () => {
                        //get search bar value
                        const query = searchBar.value.trim().toLowerCase();

                        items.forEach(item => {
                            const name = item.querySelector("h2").textContent.trim().toLowerCase();
                            const email = item.querySelector("h3").textContent.trim().toLowerCase();

                            if (name.includes(query) || email.includes(query)) {
                                item.style.display = "flex";
                            } else {
                                item.style.display = "none";
                            }
                        });
                    });

                    // Generate QR Code function
                    function generateQRCode(text, width, height) {
                        var qrCodeUrl = "https://chart.googleapis.com/chart?cht=qr&chs=" + width + "x" + height +
                            "&chl=" + encodeURIComponent(text);
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
                    $('#generate-button').on('click', function() {
                        var text =
                            "http://localhost:8080/Maffy/FWDD_Maffy/frontend/public/pages/shared/course_page.php?userid=<?php echo ($_SESSION["user_id"]); ?>&courseid=<?php echo ($courseID); ?>";
                        var width = 500;
                        var height = 500;

                        generateQRCode(text, width, height);
                    });
                    </script>
                    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
                    <script type="text/javascript" src="../admin/javascript/sidebar.js"></script>
</body>

</html>