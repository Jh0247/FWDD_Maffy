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
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/user_profile.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>User Profile Page</title>

</head>

<body>
    <div class="container">
        <?php 
        if($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student'){
            include '../shared/navbar.php';
        } else {
            include '../admin/sidebar.php';
        }
        ?>
        <div class="profile-container">
            <div class="user-container">
                <!-- User profile image -->
                <div class="user-image">
                    <img src="../../images/user_profile.png" alt="User Profile Image">
                </div>

                <!-- User details -->
                <div class="user-details">
                    <h2>User Name</h2>
                    <p>User Phone Number</p>
                    <p>User Email</p>
                </div>
            </div>
            <div class="btn-container">
                <!-- Edit button -->
                <button class="edit-btn">Edit Profile</button>
                <button class="edit-icon"><i class="fas fa-edit"></i></button>
            </div>
        </div>

        <!-- Two white containers -->
        <div class="status-container">
            <div class="white-container">Description</div>
            <div class="white-container">Performance</div>
        </div>

        <h3 style="margin-bottom: 20px; margin-top: 50px;">Posted Assessment</h3>
        <div class="assessment-container" id="next-page">
            <div class="header">
                <h2>COURSE 1</h2>
                <div class="view-count">View: <span id="view-count">0</span></div>
            </div>
            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
                consectetur ante nec, congue mi.</p>
            <div class="assessment-options">
                <div class="status-radio">
                    <input type="radio" id="comment" value="comment">
                    <label for="comment">Comment</label>
                </div>
                <div class="status-radio">
                    <input type="radio" id="exercise" value="exercise">
                    <label for="exercise">Exercise</label>
                </div>
                <div class="status-radio">
                    <input type="radio" id="additional-note" value="additional-note">
                    <label for="additional-note">Additional Note</label>
                </div>
            </div>
        </div>

        <div class="assessment-container" id="next-page">
            <div class="header">
                <h2>COURSE 1</h2>
                <div class="view-count">View: <span id="view-count">0</span></div>
            </div>
            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget orci tempor,
                consectetur ante nec, congue mi.</p>
            <div class="assessment-options">
                <div class="status-radio">
                    <input type="radio" id="comment" value="comment">
                    <label for="comment">Comment</label>
                </div>
                <div class="status-radio">
                    <input type="radio" id="exercise" value="exercise">
                    <label for="exercise">Exercise</label>
                </div>
                <div class="status-radio">
                    <input type="radio" id="additional-note" value="additional-note">
                    <label for="additional-note">Additional Note</label>
                </div>
            </div>
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

    <script src="../../../src/stylesheets/teacher/course_page.js"></script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>