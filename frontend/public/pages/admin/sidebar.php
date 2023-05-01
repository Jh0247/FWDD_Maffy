<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/admin/sidebar.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="layout h-screen has-sidebar fixed-sidebar fixed-header">
    <aside id="sidebar" class="sidebar break-point-sm">
      <a id="btn-collapse" class="sidebar-collapser"><i class="fa-solid fa-chevron-right"></i></a>
      <div class="sidebar-layout">
        <div class="sidebar-header">
          <div class="sidebar-logo">
            <div>M</div>
            <img src="../../images/Maffy.png" alt="logo" class="logo-img">
          </div>
        </div>
        <div class="sidebar-content h-96">
          <nav class="menu">
            <ul>
              <li class="menu-item">
                <a>
                  <span class="menu-icon">
                    <i class="fa-solid fa-user white-color"></i>
                  </span>
                  <span class="menu-header-admin white-color"> Maffy Admin </span>
                </a>
              </li>
              <li class="menu-item">
                <a href="#">
                  <span class="menu-icon">
                    <i class="fa fa-th-large"></i>
                  </span>
                  <span class="menu-header"> Dashboard </span>
                </a>
              </li>
              <li class="menu-header" style="padding-top: 20px"><span> Management </span></li>
              <li class="menu-item">
                <a href="#">
                  <span class="menu-icon">
                    <i class="fa-solid fa-user-group"></i>
                  </span>
                  <span class="menu-title">Manage User</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="#">
                  <span class="menu-icon">
                    <i class="fa-solid fa-book-bookmark"></i>
                  </span>
                  <span class="menu-title">Manage Courses</span>
                </a>
              </li>
              <li class="menu-header" style="padding-top: 20px"><span> Support </span></li>
              <li class="menu-item">
                <a href="#">
                  <span class="menu-icon">
                    <i class="fa fa-file-text"></i>
                  </span>
                  <span class="menu-title">View Feedback</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="#">
                  <span class="menu-icon">
                    <i class="fa fa-gears"></i>
                  </span>
                  <span class="menu-title">Terms & Condition</span>
                </a>
              </li>
            </ul>
            <ul>
              <li class="menu-item">
                <!-- link to backend logout to destroy session -->
                <a href="../../../../backend/logout.php">
                  <span class="menu-icon">
                    <i class="fa fa-laptop"></i>
                  </span>
                  <span class="menu-header"> Logout </span>
                </a>
              </li>
            </ul>
          </nav>
        </div> <!-- sidebar -->
      </div>
    </aside>
    <div id="overlay" class="overlay"></div>
    <div class="layout">
      <main class="content">
        <div id="btn-toggle" class="toggler-cont">
          <a class="sidebar-toggler break-point-sm">
            <i class="fa-solid fa-bars"></i>
          </a>
        </div>
      </main>
      <div class="overlay"></div>
    </div>
  </div>
<script type="text/javascript" src="./javascript/sidebar.js"></script>
</body>
</html>