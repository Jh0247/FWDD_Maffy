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
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/add_course.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <title>Add Course</title>

</head>

<body>
    <?php include '../shared/navbar.php';?>
    <div class="container">
        <h2>ADD COURSE</h2>
        <form novalidate id="post-form">
            <div class="form-group">
                <label for="title">Image:</label>

                <!-- second design -->
                <div class="upload-section">
                    <label for="file-input">
                        <p>Select an Image to Upload</p>
                    </label>
                    <input id="file-input" type="file">
                    <div id="preview-container">
                        <img id="preview-image">
                        <div id="preview-message">No image selected</div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="input" type="text" id="title" name="title" placeholder="e.g. What is html..." required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="input" id="description" name="description" rows="5" placeholder="e.g. What is html..."
                    required></textarea>
            </div>

            <button class="button" type="submit" id="submit-btn">
                Create Course
            </button>
        </form>
    </div>

    <script>
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const imageInput = document.getElementById('image');
    const submitBtn = document.getElementById('submit-btn');
    const postForm = document.getElementById('post-form');

    postForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const title = titleInput.value.trim();
        const description = descriptionInput.value.trim();
        // const image = imageInput.value.trim();

        if (title === '' || description === '') {
            showError('Please fill in all the fields');
        } else {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating Course...';
            setTimeout(() => {
                submitBtn.textContent = 'Course Created!';
                resetForm();
            }, 2000);
        }
    });

    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('error');
        errorDiv.textContent = message;
        postForm.appendChild(errorDiv);
        setTimeout(() => {
            errorDiv.remove();
        }, 1000);
    }

    function resetForm() {
        postForm.reset();
        submitBtn.disabled = false;
        submitBtn.textContent = 'Create Course';
    }

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