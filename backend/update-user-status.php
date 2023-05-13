<?php
  // Retrieve the user_id and query_type parameters from the POST request
  $user_id = $_POST['user_id'];
  $query_type = $_POST['query_type'];

  // Connect to the database
  include("../backend/conn.php");

  // Execute the appropriate database query based on the query_type parameter
  if ($query_type == "update_active") {
    $update_query = mysqli_query($con, "UPDATE `user` SET `user_active`= 1 WHERE user_id = " . mysqli_real_escape_string($con, $user_id));
  } elseif ($query_type == "update_freeze") {
    $update_freeze_query = mysqli_query($con, "UPDATE `user` SET `user_active`= 2 WHERE user_id = " . mysqli_real_escape_string($con, $user_id));
  } elseif ($query_type == "delete") {
    $delete_query = mysqli_query($con, "DELETE FROM `user` WHERE user_id = " . mysqli_real_escape_string($con, $user_id));
  } else {
    // Invalid query type
    http_response_code(400);
    echo "Invalid query type.";
    exit();
  }

  // Check if the query was executed successfully
  if (isset($update_query) && $update_query || isset($update_freeze_query) && $update_freeze_query || isset($delete_query) && $delete_query) {
    // Send a success response
    http_response_code(200);
    echo "Query executed successfully.";
  } else {
    // Send an error response
    http_response_code(500);
    echo "Error executing query: " . mysqli_error($con);
  }

  // Close the database connection
  mysqli_close($con);
?>
