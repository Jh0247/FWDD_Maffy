<?php
// Logout the user
  session_start();
  echo("<script>alert('Logged out successfully!')</script>");
  echo("<script>window.location = '../frontend/public/pages/shared/home.php'</script>");
  session_unset();
  session_destroy();
?>