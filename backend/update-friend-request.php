<?php
  $type = $_POST['type'];
  if($type == 'accept' || $type == 'reject'){
    $list_id = $_POST['list_id'];
  } else {
    $from_id = $_POST['from_id'];
    $to_id = $_POST['to_id'];
  }


  // Connect to the database
  include("../backend/conn.php");

  // Execute the appropriate database query based on the query_type parameter
  if ($type == "accept") {
    $accept_sql = mysqli_query($con, "UPDATE `friend_list` SET `friend_status` = 1 WHERE friend_list_id = '$list_id'");
  } elseif ($type == "request") {
    $request_sql = mysqli_query($con, "INSERT INTO `friend_list`(`first_user_id`, `second_user_id`, `friend_status`) VALUES ('$from_id', '$to_id', 0)");
  } elseif ($type == "reject") {
    $reject_sql = mysqli_query($con, "DELETE FROM `friend_list` WHERE friend_list_id = '$list_id'");
  } else {
    // Invalid query type
    http_response_code(400);
    echo "Invalid query type.";
    exit();
  }

  // Check if the query was executed successfully
  if (isset($accept_sql) && $accept_sql || isset($request_sql) && $request_sql || isset($reject_sql) && $reject_sql) {
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
