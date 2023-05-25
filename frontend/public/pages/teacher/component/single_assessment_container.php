<?php 
function single_ass($assID, $courseID, $assTitle, $assDesc) {

    $element = "
    <a class=\"view-ass\" href=\"../shared/view_assessment.php?ass_id=$assID&courseid=$courseID\">
        <div class=\"assessment-container\" id=\"next-page\">
            <div class=\"header\">
                <h2>$assTitle</h2>
            </div>
            <h3 class=\"desc\">$assDesc</h3>
            <div class=\"assessment-options\">
                <div class=\"status-radio\">
                    <input type=\"radio\" id=\"comment\" value=\"comment\">
                    <label for=\"comment\">Comment</label>
                </div>
                <div class=\"status-radio\">
                    <input type=\"radio\" id=\"exercise\" value=\"exercise\">
                    <label for=\"exercise\">Exercise</label>
                </div>
                <div class=\"status-radio\">
                    <input type=\"radio\" id=\"additional-note\" value=\"additional-note\">
                    <label for=\"additional-note\">Additional Note</label>
                </div>
            </div>
        </div>
    </a>
    ";

    echo $element;

}