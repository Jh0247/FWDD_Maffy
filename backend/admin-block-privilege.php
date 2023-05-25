<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script>
  function pop_block_student() {
    Swal.fire({
      icon: 'warning',
      title: 'ALERT',
      text: 'You dont have privilege to access this page!',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'Continue'
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        to_student();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function pop_block_teacher() {
    Swal.fire({
      icon: 'warning',
      title: 'ALERT',
      text: 'You dont have privilege to access this page!',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'Continue'
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        to_teacher();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }    
    })
  }

  function to_teacher() {
    window.location = '../teacher/homepage.php'
  }

  function to_student() {
    window.location = '../student/homepage.php'
  }
</script>
  <?php 
    if ($_SESSION['privilege'] == 'teacher'){        
      echo "<script>
        document.getElementById('all').style.display = 'none';
        pop_block_teacher();
      </script>";
    }
    else if ($_SESSION['privilege'] == 'student'){
    echo "<script>
          document.getElementById('all').style.display = 'none';
          pop_block_student();
        </script>";
    }
  ?>