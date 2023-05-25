<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script>
  function pop_login() {
    Swal.fire({
      icon: 'warning',
      title: 'ALERT',
      text: 'Please login first!',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'Continue'
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        to_login();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function to_login() {
    window.location = '../shared/login.php'
  }
</script>

<?php
if(!isset($_SESSION)) {
  session_start();
}

// check if user is logged in
if (!isset($_SESSION['username']))
{
  echo("
  <div>
    <script>pop_login()</script>
  </div>
  ");
}
?>