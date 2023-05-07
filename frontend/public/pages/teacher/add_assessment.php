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
    <link rel="stylesheet" href="../../../src/stylesheets/teacher/add_assessment.css">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/nav_bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Add Assessment</title>
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
        <form novalidate id="post-form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="input" type="text" id="title" name="title" placeholder="e.g. What is html..." required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="input" id="content" name="content" rows="5" placeholder="e.g. What is html..."
                    required></textarea>
            </div>

            <!-- add additional note -->
            <div class="form-group">
                <label for="publish" class="check-container">
                    <input type="checkbox" id="publish" name="publish">
                    <div class="checkmark"></div>
                    Add Additional Note Link
                </label>
            </div>
            <div class="form-group" id="publish-date-group" style="display: none;">
                <input class="input" type="text" id="publish-date" name="title" placeholder="e.g. https://..." required>
            </div>

            <!-- add assessment exercise -->
            <div class="form-group">
                <label for="publish-exercise" class="check-container">
                    <input type="checkbox" id="publish-exercise" name="publish-exercise">
                    <div class="checkmark"></div>
                    Add Assessment Exercise
                </label>
            </div>
            <div class="exercise-container" id="exercise-group" style="display: none;">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="input" id="title" name="title" placeholder="e.g. What is html..."
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="input" id="description" name="description"
                        placeholder="e.g. What is html..." required>
                </div>
                <div class="form-group">
                    <label for="pratice">Practice:</label>
                    <textarea class="input" id="pratice" name="pratice" rows="5" placeholder="e.g. What is html..."
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <input type="text" class="input" id="answer" name="answer" placeholder="e.g. What is html..."
                        required>
                </div>
            </div>
            <button class="button" type="submit" id="submit-btn">
                Create Assessment
            </button>
        </form>
    </div>

    <script src="../../../src/stylesheets/teacher/add_assessment.js"></script>
    <script src="../../../src/stylesheets/shared/nav_bar.js"></script>
</body>

</html>