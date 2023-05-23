<?php
// connection to database
include("../../../../backend/conn.php");
include("../../../../backend/session.php");

$currentFile = "../shared/course_page.php";

if (isset($_GET['courseid'])) {
    $courseID = $_GET['courseid'];

    #Extracting course information for all courses matched user_id from database
    $course_info = "SELECT * FROM course WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";
    $course_info_result = mysqli_query($con, $course_info);
    $course_info_row = mysqli_fetch_assoc($course_info_result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/add_course.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <title>Add Course</title>

    <script>
    // a pop-up function that use at php code
    function pop_up_success() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Course Successfully Posted!',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: '<a href="homepage.php" style="text-decoration:none; color:white; ">Continue</a>'
        })
    }

    function pop_up_error_imgFile() {
        Swal.fire({
            icon: 'warning',
            title: 'ALERT',
            text: 'Invalid File Type. Only (.jpg .jpeg .png) allowed!',
        })
    }

    function pop_up_error_emptyTextField() {
        Swal.fire({
            icon: 'warning',
            title: 'ALERT',
            text: 'Please Do Not Let Any Input Field Empty!',
        })
    }
    </script>

</head>

<body>
    <?php include '../shared/navbar.php'; ?>
    <div class="container">
        <h2>ADD COURSE</h2>

        <form novalidate method="POST" id="post-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Image:</label>

                <!-- second design -->
                <div class="upload-section">
                    <label for="file-input">
                        <p>Select an Image to Upload</p>
                    </label>
                    <input id="file-input" type="file" name="uploadedFile"
                        value='<?php echo ($_GET['currentfile'] === $currentFile) ? $course_info_row["course_image"] : "" ?>'
                        required>
                    <div id="preview-container">
                        <img src="<?php echo ($_GET['currentfile'] === $currentFile) ? $course_info_row["course_image"] : "" ?>"
                            id="preview-image">
                        <?php
                        if (($_GET['currentfile'] === $currentFile)) {
                            echo "";
                        } else {
                            echo "<div id=\"preview-message\">No image selected</div>";
                        }

                        ?>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="input" type="text" id="title" name="title" placeholder="e.g. What is html..."
                    value="<?php echo ($_GET['currentfile'] === $currentFile) ? $course_info_row["course_title"] : "" ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="input" id="description" name="description" rows="5" placeholder="e.g. What is html..."
                    required><?php echo ($_GET['currentfile'] === $currentFile) ? $course_info_row["course_desc"] : "" ?></textarea>
            </div>

            <?php
            if ($_GET['currentfile'] === $currentFile) {
                echo "
                <button class=\"button\" type=\"submit\" id=\"submit-btn\" name=\"update-btn\">
                    Update Course
                </button>
                ";
            } else {
                echo "
                <button class=\"button\" type=\"submit\" id=\"submit-btn\" name=\"submitbtn\">
                    Create Course
                </button>
                ";
            }
            ?>

        </form>
    </div>

    <?php
    // Post oursec
    // if isset is POST 'submit' only execute the code below
    if (isset($_POST['submitbtn'])) {

        date_default_timezone_set('Asia/Kuala_Lumpur');
        // $course_image = file_get_contents($_FILES['uploadedFile']['tmp_name']);
        $course_title = $_POST['title'];
        $course_desc = addslashes($_POST['description']);
        $posted_date = date("Y-m-d H:i:s");

        if (empty($course_title) or empty($course_desc)) {
            echo "<script>pop_up_error_emptyTextField()</script>";
        } else {

            $imgfile = $_FILES['uploadedFile'];

            $allowedFileType = array('jpg', 'jpeg', 'png');
            $validationFile = pathinfo($imgfile['name'], PATHINFO_EXTENSION);

            if (!in_array($validationFile, $allowedFileType)) {
                echo ("<script>pop_up_error_imgFile()</script>");
            } else {

                $userSupDoc = $_FILES['uploadedFile']['tmp_name'];
                if ($_FILES['uploadedFile']['size'] > 0) {
                    //get image type
                    $supDocType = strtolower(pathinfo($userSupDoc, PATHINFO_EXTENSION));
                    //encode image into base64
                    $processedDoc = base64_encode(file_get_contents($userSupDoc));
                    //set image content with type and base64
                    $course_image = 'data:image/' . $supDocType . ';base64,' . $processedDoc;

                    $post_sql = "INSERT INTO course (user_id, course_title, course_desc, course_date_posted, course_image, course_click, course_status) 
                            VALUES ('$_SESSION[user_id]', '$course_title', '$course_desc', '$posted_date', '$course_image', '0', '2')";

                    $post_result = mysqli_query($con, $post_sql);

                    if ($post_result) {
                        echo "<script>pop_up_success()</script>";
                    } else {
                        echo "<script>alert('Something went wrong')</script>";
                    }
                }
            }
        }
        mysqli_close($con);
    }
    
    if (isset($_POST['update-btn'])) {

        date_default_timezone_set('Asia/Kuala_Lumpur');
        // $course_image = file_get_contents($_FILES['uploadedFile']['tmp_name']);
        $course_title = $_POST['title'];
        $course_desc = addslashes($_POST['description']);
        $posted_date = date("Y-m-d H:i:s");

        if (empty($course_title) or empty($course_desc)) {
            echo "<script>pop_up_error_emptyTextField()</script>";
        } else {

            $imgfile = $_FILES['uploadedFile'];

            $allowedFileType = array('jpg', 'jpeg', 'png');
            $validationFile = pathinfo($imgfile['name'], PATHINFO_EXTENSION);

            if (!in_array($validationFile, $allowedFileType)) {
                echo ("<script>pop_up_error_imgFile()</script>");
            } else {

                $userSupDoc = $_FILES['uploadedFile']['tmp_name'];
                if ($_FILES['uploadedFile']['size'] > 0) {
                    //get image type
                    $supDocType = strtolower(pathinfo($userSupDoc, PATHINFO_EXTENSION));
                    //encode image into base64
                    $processedDoc = base64_encode(file_get_contents($userSupDoc));
                    //set image content with type and base64
                    $course_image = 'data:image/' . $supDocType . ';base64,' . $processedDoc;

                    $update_sql = "UPDATE course SET course_title='$course_title', course_desc='$course_desc', course_image='$course_image'
                        WHERE user_id = $_SESSION[user_id] AND course_id = $courseID";

                    $update_result = mysqli_query($con, $update_sql);

                    if ($update_result) {
                        echo "<script>pop_up_success()</script>";
                    } else {
                        echo "<script>alert('Something went wrong')</script>";
                    }
                }
            }
        }
        mysqli_close($con);
    }


    ?>

    <script>
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const imageInput = document.getElementById('image');
    const submitBtn = document.getElementById('submit-btn');
    const postForm = document.getElementById('post-form');

    // upload image - second design
    const fileInput = document.getElementById("file-input");
    const previewImage = document.getElementById("preview-image");
    const previewMessage = document.getElementById("preview-message");
    const previewContainer = document.getElementById("preview-container");

    fileInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
                previewMessage.style.display = "none";
                previewImage.style.display = "block";
            });
            reader.readAsDataURL(file);
        } else {
            previewImage.style.display = "none";
            previewMessage.style.display = "block";
            previewMessage.innerHTML = "No image selected";
        }
    });
    </script>

    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>