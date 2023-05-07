// Get the loading modal
var success_modal = document.getElementById("loading-success");
var fail_modal = document.getElementById("loading-fail");

// Get the loader
var suc_loader = document.querySelector(".loading-suc");
var fail_loader = document.querySelector(".loading-fail");

var success = document.querySelector(".success-container");
var fail = document.querySelector(".fail-container");

// Function to show the loading modal
function showLoadingSuccess() {
  success_modal.style.display = "block";
  suc_loader.style.display = "block";
  success.style.display = "none";
}

function showSuccess() {
  suc_loader.style.display = "none";
  success.style.display = "block";
  setTimeout(function() {
    success_modal.style.display = "none";
  }, 3000);
}

function displayCheck(queryType, userId) {
  console.log(queryType, "This is query type passed");
  console.log(userId, "This is userId passed");
  showLoadingSuccess();

  setTimeout(function() {
    $.ajax({
      url: "backend/update-user-status.php",
      type: "POST",
      data: {
        user_id: userId,
        query_type: queryType
      },
      success: function(response) {
        showSuccess();
        location.reload(); 
      }
    });
  }, 2000);
}

function showLoadingFail() {
  fail_modal.style.display = "block";
  fail_loader.style.display = "block";
  fail.style.display = "none";
}

function showFail() {
  fail_loader.style.display = "none";
  fail.style.display = "block";
  setTimeout(function() {
    fail_modal.style.display = "none";
  }, 3000);
}

function displayXmark(queryType, userId) {
  showLoadingFail();

  setTimeout(function() {
    $.ajax({
      url: "backend/update-user-status.php",
      type: "POST",
      data: {
        user_id: userId,
        query_type: queryType
      },
      success: function(response) {
        showFail();
        location.reload(); 
      }
    });
  }, 2000);
}