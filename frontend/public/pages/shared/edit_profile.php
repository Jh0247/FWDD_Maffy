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
    <link rel="stylesheet" href="../../../src/stylesheets/shared/edit_profile.css">
    <script src="https://kit.fontawesome.com/873ab321fe.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <div class="w-screen h-screen flex flex-row">
        <?php 
    if ($_SESSION['privilege'] == 'teacher' || $_SESSION['privilege'] == 'student'){
      include '../shared/navbar.php'; 
    } else {
      include '../admin/loading.php';
      include '../admin/sidebar.php';
    }
    ?>
        <div class="w-full overflow-auto">

            <div class="first-container">

                <div class="first-row">
                    <img src="./profile.jpg" class="profile-image" id="image">
                    <div class="file-handle">
                        <p>Please Choose a new profile picture</p>
                        <input type="file" id="real-file" hidden="hidden" accept="image/png,image/png"
                            name="profileImage" onchange="previewImage(event);" />
                        <button type="button" id="custom-button">Choose a image</button>
                        <span id="custom-text">No image chosen yet</span>
                    </div>
                </div>

                <div class="second-row">
                    <p>Username: </p>
                    <input type="text" name="text" class="input" placeholder="Username">
                    <p>Email: </p>
                    <input type="text" name="text" class="input" placeholder="Useremail">
                </div>

                <div class="thrid-row">
                    <a class="update" href="#">I am a button</a>
                </div>

            </div>
        </div>
    </div>

    <!-- pop out edit password container -->
    <form id="form">
        <div id="pass-popout-container">
            <div id="password-popup">
                <h2>Edit Password</h2>
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password">
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password">
                <div class="button-row">
                    <button type="submit" id="save-password-btn">Save</button>
                    <button type="submit" id="cancel-password-btn">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <!-- edit password -->
    <script>
    // Pop out edit password container
    const editPasswordBtn = document.getElementById('edit-password-btn');
    const passwordPopup = document.getElementById('password-popup');
    const savePasswordBtn = document.getElementById('save-password-btn');
    const cancelPasswordBtn = document.getElementById('cancel-password-btn');

    editPasswordBtn.addEventListener('click', () => {
        navLinks.classList.remove('active');
        navLinks.classList.add('inactive');
        navToggle.classList.remove('active');
        navToggle.classList.add('inactive');

        passwordPopup.style.display = 'block';
    });

    editPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'block';
    });

    cancelPasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });

    savePasswordBtn.addEventListener('click', () => {
        passwordPopup.style.display = 'none';
    });


    // not refresh the page when submit btn is click in <form>
    $(document).ready(function() {
        $('#form').submit(function(event) {
            event.preventDefault(); // prevent form from refreshing the page

            var formData = $(this).serialize(); // get form data

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // handle success response
                },
                error: function(xhr, status, error) {
                    // handle error response
                }
            });
        });
    });
    </script>

    <script src="./JavaScript/edit_profile.js"></script>
    <script src="./JavaScript/nav_bar.js"></script>

</body>

</html>