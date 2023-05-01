<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/manage-user.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Manage User</title>
</head>

<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../admin/sidebar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col items-center sm:items-start mx-0 sm:mx-9 text-center sm:text-left">
        <h2 class="title my-4">Teacher</h2>
        <div class="flex flex-col sm:flex-row">
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/intro.png">
              </div>
              <h3 class="h-1/6">Total Teacher</h3>
            </div>
          </a>
          <a href="#" class="item-card ml-0 sm:ml-16 mt-16 sm:mt-0">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/intro.png">
              </div>
              <h3 class="h-1/6">Requesting Teacher Account</h3>
            </div>
          </a>
        </div>
        <h2 class="title my-4">Student</h2>
        <div class="flex flex-row mb-5">
          <a href="#" class="item-card">
            <div class="flex flex-col mx-3 mt-2">
              <div class="flex flex-row justify-center w-full h-5/6">
                <img src="../../images/intro.png">
              </div>
              <h3 class="h-1/6">View All Student</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="../admin/javascript/sidebar.js"></script>
</body>
</html>