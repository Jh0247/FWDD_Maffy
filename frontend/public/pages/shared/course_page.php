<?php
// connection to database
include("../../../../backend/conn.php");
include("../../../../backend/session.php");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


    <title>Single Course Page</title>

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
    <div id="all" class="w-screen h-screen flex flex-row">
        <?php
        $user_privilege = 0;

        if (isset($_SESSION['user_id'])) {
            // Retrieve user information from database
            $query = mysqli_query($con, "SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
            $user = mysqli_fetch_array($query);
            $user_privilege = $user['privilege_id'];
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
        };
        if (isset($_SESSION['user_id'])) {
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
                        ?>
                        <div class="container">
                            <div class="options">
                                <div class="option">
                                    <a
                                        href="../teacher/add_assessment.php?userid=<?php echo $_SESSION["user_id"]; ?>&courseid=<?php echo $courseID; ?>"><i
                                            class="fas fa-plus"></i> Add Assessment</a>
                                </div>
                                <div class="option">
                                    <a
                                        href="../teacher/add_course.php?userid=<?php echo $_SESSION["user_id"]; ?>&courseid=<?php echo $courseID; ?>&currentfile=../shared/course_page.php"><i
                                            class="fas fa-edit"></i> Edit</a>
                                </div>
                                <form method="POST" class="options">
                                    <div class="option">
                                        <?php if ($course_info_row['user_id'] === $_SESSION['user_id'] && $course_info_row['course_id'] === $courseID && $course_info_row['course_status'] === '1') { ?>

                                        <button type=" submit" id="deactive-btn" name="deactive_submitbtn"><i
                                                class="fas fa-eye-slash"></i> Deactivate</button>
                                        <?php } else { ?>
                                        <button type="submit" id="active-btn" name="active_submitbtn"><i
                                                class="fas fa-eye"></i> Activate</button>
                                        <?php } ?>

                                    </div>
                                    <div class="option">
                                        <button type="submit" id="delete-btn" name="delete_submitbtn"><i
                                                class="fas fa-trash"></i> Delete</button>
                                    </div>
                                </form>
                            </div>
                            <div class="publish-container">
                                <?php if ($course_info_row["course_status"] === '1'): ?>
                                <p class="published">Published</p>
                                <?php else: ?>
                                <?php if ($count >= 3): ?>
                                <form method="POST">
                                    <div class="publish-container">
                                        <button class="published post-btn" id="publish-btn"
                                            name="publish_submitbtn">Publish
                                            Now!</button>
                                    </div>
                                </form>
                                <?php else: ?> <p class="published"><?php echo $status; ?></p>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        } else {
                        ?>
                        <div class="container">
                            <div class="publish-container">
                                <?php if ($course_info_row["course_status"] === '1' && $status === ($count >= 3)): ?>
                                <p class="published">Published</p>
                                <?php else: ?>
                                <p class="published">Unpublished</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        }
                        } else {
                        ?>
                        <div class="container">
                            <div class="publish-container">
                                <?php if ($count >= 3): ?>
                                <p class="published"><?php echo $status; ?></p>
                                <?php elseif ($course_info_row["course_status"] === '1'): ?>
                                <p class="published">Published</p>
                                <?php else: ?>
                                <p class="published"><?php echo $status; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
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
                            ?>
                            <a class="view-ass"
                                href="../shared/view_assessment.php?ass_id=<?php echo $data["assessment_id"]; ?>&courseid=<?php echo $courseID; ?>">
                                <div class="left-details">
                                    <div class="assessment-container" id="next-page">
                                        <div class="header">
                                            <h2 style="font-weight: bold; font-size: 24px">
                                                <?php echo $data['assessment_title']; ?></h2>
                                        </div>
                                        <h3 class=" desc"><?php echo $data['assessment_content']; ?></h3>
                                    </div>
                                </div>
                            </a>
                            <?php                          
                            }
                            }
                            } else {
                            if ($course_info_row["user_id"] == $_SESSION["user_id"]) {
                            ?>
                            <div class="container">
                                <div class="options">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                                <div class="publish-container">
                                    <button
                                        onclick="location.href='../teacher/add_assessment.php?userid=<?php echo $_SESSION['user_id']; ?>&courseid=<?php echo $courseID; ?>'"
                                        class="published post-btn">Post Assesment Now</button>
                                </div>
                            </div>
                            <?php
                            } else {
                            ?>
                            <div class=" container">
                                <div class="options">
                                    <p>This Course Have No Assessment Posted</p>
                                </div>
                            </div>
                            <?php
                            }
                            }
                            ?>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>

                    <script>
                    // delete the course function
                    $(document).ready(function() {
                        $("#delete-btn").on("click", function(e) {
                            e.preventDefault();
                            var courseid =
                                "<?php echo $course_info_row['course_id']; ?>";
                            // Send AJAX request
                            $.ajax({
                                url: "../../../../backend/course_page_backend.php",
                                type: "POST",
                                data: {
                                    delete_submitbtn: true,
                                    userid: "<?php echo $_SESSION['user_id']; ?>",
                                    courseid: courseid
                                },
                                success: function(response) {
                                    // Request was successful, handle the response here
                                    // Display success message or perform any other actions
                                    pop_up_success_delete();
                                },
                                error: function(xhr, status, error) {
                                    // Request encountered an error, handle it here
                                    console.log(xhr
                                        .responseText
                                    ); // Display the error message
                                }
                            });
                        });
                    });

                    // activate the course function
                    $(document).ready(function() {
                        $("#active-btn").on("click", function(e) {
                            e.preventDefault();
                            var course_id =
                                "<?php echo $course_info_row['course_id']; ?>";
                            // Send AJAX request
                            $.ajax({
                                url: "../../../../backend/course_page_backend.php",
                                type: "POST",
                                data: {
                                    active_submitbtn: true,
                                    course_id: course_id
                                },
                                success: function(response) {
                                    // Request was successful, handle the response here
                                    // Display success message or perform any other actions
                                    pop_up_success_active();
                                },
                                error: function(xhr, status, error) {
                                    // Request encountered an error, handle it here
                                    console.log(xhr
                                        .responseText
                                    ); // Display the error message
                                }
                            });
                        });
                    });

                    // publish the course function
                    $(document).ready(function() {
                        $("#publish-btn").on("click", function(e) {
                            e.preventDefault();
                            var course_id =
                                "<?php echo $course_info_row['course_id']; ?>";
                            // Send AJAX request
                            $.ajax({
                                url: "../../../../backend/course_page_backend.php",
                                type: "POST",
                                data: {
                                    publish_submitbtn: true,
                                    course_id: course_id
                                },
                                success: function(response) {
                                    // Request was successful, handle the response here
                                    // Display success message or perform any other actions
                                    pop_up_success_active();
                                },
                                error: function(xhr, status, error) {
                                    // Request encountered an error, handle it here
                                    console.log(xhr
                                        .responseText
                                    ); // Display the error message
                                }
                            });
                        });
                    });

                    // deactivate the course function
                    $(document).ready(function() {
                        $("#deactive-btn").on("click", function(e) {
                            e.preventDefault();
                            var courseid =
                                "<?php echo $course_info_row['course_id']; ?>";
                            // Send AJAX request
                            $.ajax({
                                url: "../../../../backend/course_page_backend.php",
                                method: "POST",
                                data: {
                                    deactive_submitbtn: true,
                                    courseid: courseid
                                },
                                dataType: "text",
                                success: function(response) {
                                    // Request was successful, handle the response here
                                    // Display success message or perform any other actions
                                    pop_up_success_deactive();
                                },
                                error: function(xhr, status, error) {
                                    // Request encountered an error, handle it here
                                    console.log(xhr
                                        .responseText
                                    ); // Display the error message
                                }
                            });
                        });
                    });


                    //get class and id
                    const searchBar = document.getElementById("search-bar");
                    const items = document.querySelectorAll(".view-ass");

                    //add event listener
                    searchBar.addEventListener("input", () => {
                        //get search bar value
                        const query = searchBar.value.trim().toLowerCase();

                        items.forEach(item => {
                            const name = item.querySelector("h2").textContent.trim()
                                .toLowerCase();
                            const email = item.querySelector("h3").textContent.trim()
                                .toLowerCase();

                            if (name.includes(query) || email.includes(query)) {
                                item.style.display = "flex";
                            } else {
                                item.style.display = "none";
                            }
                        });
                    });

                    // Generate QR Code function
                    function generateQRCode(text, width, height) {
                        var qrCodeUrl = "https://chart.googleapis.com/chart?cht=qr&chs=" + width + "x" +
                            height +
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
                            "http://localhost:8080/Maffy/FWDD_Maffy/frontend/public/pages/shared/course_page.php?courseid=<?php echo ($courseID); ?>";
                        var width = 500;
                        var height = 500;

                        generateQRCode(text, width, height);
                    });
                    </script>
                    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
                    <script type="text/javascript" src="../admin/javascript/sidebar.js"></script>
</body>

</html>