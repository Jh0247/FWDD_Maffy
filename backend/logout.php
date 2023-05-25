<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script>
  function pop_logout() {
    Swal.fire({
      icon: 'success',
      title: 'SUCCESS!',
      text: 'Logged out!',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'Continue'
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        to_home();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function to_home() {
    window.location = '../frontend/public/pages/shared/home.php'
  }
</script>

<?php
// Logout the user
  session_start();
  echo("
  <div>
    <script>pop_logout()</script>
  </div>
  ");  
  session_unset();
  session_destroy();
?>