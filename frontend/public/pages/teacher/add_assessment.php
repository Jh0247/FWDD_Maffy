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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/theme/monokai.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/css/css.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/jsx/jsx.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/sql/sql.min.js"></script>
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
            confirmButtonText: "<a href=\"#\" onclick=window.location.href=\"../../../public/pages/shared/course_page.php?userid=<?php echo $_SESSION['user_id']; ?>&courseid=<?php echo $courseID; ?>\" style=\"text-decoration:none; color:white; \">Continue</a>"
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

    <!-- go back to previous page js function -->
    <div class="back-btn-container">
        <a href="#" onclick="goBack()" class="back-btn" id="back-btn">
            <i class="fas fa-chevron-left"></i> Back
        </a>
    </div>

    <!-- Post Assessment main container -->
    <div class="container">
        <h2>POST ASSESSMENT</h2>
        <form novalidate id="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="input" type="text" id="title" name="ass-title" placeholder="e.g. What is html..."
                    required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="input" type="text" id="content" name="ass-content" rows="3"
                    placeholder="e.g. What is html..." required></textarea>
            </div>

            <!-- add code session -->
            <div class="form-group">
                <label for="publish-code" class="check-container">
                    <input type="checkbox" id="publish-code" name="add_code" onchange="toggleBoldAddCode(this)">
                    <div class="checkmark"></div>
                    <div id="myText-addCode">Add Programming Code</div>
                </label>
            </div>
            <div class="form-group" id="add-code-div" style="display: none;">
                <label for="title">Programming Code:</label>
                <div class="custom-select">
                    <select id="language-select" onchange="setMode(this.value)">
                        <option value="htmlmixed">html</option>
                        <option value="css">css</option>
                        <option value="javascript">javascript</option>
                        <option value="php">php</option>
                        <option value="text/x-java">java</option>
                        <option value="python">python</option>
                        <option value="jsx">react</option>
                        <option value="xml">ajax</option>
                        <option value="javascript">jquery</option>
                        <option value="sql">sql</option>
                    </select>
                </div>
                <textarea class="input" id="code-editor" name="code" rows="10" cols="80" class="code-editor"></textarea>
            </div>

            <!-- add additional note -->
            <div class="form-group">
                <label for="publish-link" class="check-container">
                    <input type="checkbox" id="publish-link" name="add_link" onchange="toggleBoldAddLink(this)">
                    <div class="checkmark"></div>
                    <div id="myText-addLink">Add Additional Note Link</div>
                </label>
            </div>
            <div class="exercise-container" id="add-link-div" style="display: none;">
                <div class="form-group">
                    <label for="title">Additonal Note Title:</label>
                    <input class="input" type="text" id="add_link_input" name="add_link_title"
                        placeholder="e.g. Additional Link for..." required>
                </div>
                <div class="form-group">
                    <label for="title">Additonal Note URL Link:</label>
                    <input class="input" type="text" id="add_link_input" name="add_link" placeholder="e.g. https://..."
                        required>
                </div>
            </div>

            <!-- add assessment exercise -->
            <div class="form-group">
                <label for="publish-exercise" class="check-container">
                    <input type="checkbox" id="publish-exercise" name="add_exercise"
                        onchange="toggleBoldAddExercise(this)">
                    <div class="checkmark"></div>
                    <div id="myText-addExercise">Add Assessment Exercise</div>
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
            $ass_title = $_POST['ass-title'];
            $ass_content = addslashes($_POST['ass-content']);
            $code = addslashes($_POST['code']);
            $exercise_title = $_POST['exercise-title'];
            $exercise_desc = $_POST['exercise-desc']; 
            $exercise_pratice = $_POST['exercise-practice']; 
            $escaped_input_exericse = mysqli_real_escape_string($con, $exercise_pratice);
            $exercise_ans = $_POST['exercise-answer']; 
            $addLink_title = $_POST['add_link_title'];
            $ass_link = $_POST['add_link'];
            $escaped_input_link = mysqli_real_escape_string($con, $ass_link);
            $posted_date = date("Y-m-d H:i:s");
            

            if(empty($ass_title) or empty($ass_content)) {
                echo "<script>pop_up_error_emptyTextField()</script>";
            } 
            else {
                // insert assessment title and content to databese
                $ass_sql = "INSERT INTO assessment (course_id, assessment_title, assessment_content, assessment_code, assessment_date_posted) 
                        VALUES ('$courseID', '$ass_title', '$ass_content', IFNULL('$code', NULL), '$posted_date')";

                $ass_result = mysqli_query($con, $ass_sql);

                // Get the ID of the last inserted row
                $last_ass_id = mysqli_insert_id($con);

                // insert exercise data into the database
                $exercise_sql = "INSERT INTO practice (assessment_id, practice_title, practice_desc, practice_question, practice_answer) 
                        VALUES ('$last_ass_id', IFNULL('$exercise_title', NULL), IFNULL('$exercise_desc', NULL), IFNULL('$escaped_input_exericse', NULL), IFNULL('$exercise_ans', NULL))";

                $exercise_result = mysqli_query($con, $exercise_sql);

                // insert note data into the database
                $note_sql = "INSERT INTO note (assessment_id, note_title, note_content) 
                VALUES ('$last_ass_id', IFNULL('$addLink_title', NULL), IFNULL('$escaped_input_link', NULL))";

                $note_result = mysqli_query($con, $note_sql);

                // check if the sql correct or not
                if($ass_result and $note_result and $exercise_result ) {
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
    const publishLinkCheckbox = document.getElementById('publish-link');
    const publishExerciseCheckbox = document.getElementById('publish-exercise');
    const publishCodeCheckbox = document.getElementById('publish-code');
    const addLinkDiv = document.getElementById('add-link-div');
    const addCodeDiv = document.getElementById('add-code-div');
    const publishExerciseGroup = document.getElementById('exercise-group');
    const submitBtn = document.getElementById('submit-btn');
    const postForm = document.getElementById('form');

    // display hidden add code field
    publishCodeCheckbox.addEventListener('change', () => {
        if (publishCodeCheckbox.checked) {
            addCodeDiv.style.display = 'block';
        } else {
            addCodeDiv.style.display = 'none';
        }
    });

    // display hidden add link input field 
    publishLinkCheckbox.addEventListener('change', () => {
        if (publishLinkCheckbox.checked) {
            addLinkDiv.style.display = 'block';
        } else {
            addLinkDiv.style.display = 'none';
        }
    });

    // display hidden add exercise input field 
    publishExerciseCheckbox.addEventListener('change', () => {
        if (publishExerciseCheckbox.checked) {
            publishExerciseGroup.style.display = 'block';
        } else {
            publishExerciseGroup.style.display = 'none';
        }
    });

    // bold text when checkox checked
    function toggleBoldAddCode(checkbox) {
        var textElement = document.getElementById("myText-addCode");
        textElement.style.fontWeight = checkbox.checked ? "bold" : "normal";
    }

    // bold text when checkox checked
    function toggleBoldAddLink(checkbox) {
        var textElement = document.getElementById("myText-addLink");
        textElement.style.fontWeight = checkbox.checked ? "bold" : "normal";
    }

    // bold text when checkox checked
    function toggleBoldAddExercise(checkbox) {
        var textElement = document.getElementById("myText-addExercise");
        textElement.style.fontWeight = checkbox.checked ? "bold" : "normal";
    }

    // back button function
    function goBack() {
        window.history.back();
    }

    // Initialize CodeMirror editor
    var codeEditor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
        mode: "htmlmixed",
        theme: "monokai",
        lineNumbers: true,
        autofocus: true,
        indentUnit: 2,
        tabSize: 2,
        smartIndent: true,
        lineWrapping: true
    });

    // Set the mode dynamically based on user selection
    function setMode(mode) {
        codeEditor.setOption("mode", mode);
    }
    </script>
</body>

</html>