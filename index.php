<!DOCTYPE html>
<html>
<head>
<title>Attendance Monitoring Brgy. Sta Cruz</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="top-container w3-bar w3-top w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-left">
    <img src="images/logo.png" alt="logo" width="50" height="45">
    ATTENDANCE MONITORING FOR BARANGAY STA. CRUZ PASIG CITY
</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <i class="fa fa-user-circle"></i>
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Admin</strong></span></div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="users.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  User Profile</a>
    <a href="register.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-plus fa-fw"></i>  Register User</a>
    <a href="attendance.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list-ul fa-fw"></i>  Attendance Records</a>
    <a href="login.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out fa-fw"></i>  Sign Out</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Admin Dashboard</b></h5>
  </header>
  
  <?php require 'database/conn.php'; ?>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-third">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?php
              $qry = mysqli_query($conn, "SELECT COUNT(id) as id FROM users");
              if($qry) {
                $total_users = $qry->fetch_assoc();
                echo $total_users['id'];
              }
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Users</h4>
      </div>
    </div>
    <div class="w3-third">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-check-square-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?php 
              $qry = mysqli_query($conn, "SELECT COUNT(id) as id FROM attendance WHERE status = 'Present'");
              if($qry) {
                $total_users_present = $qry->fetch_assoc();
                echo $total_users_present['id'];
              }
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Present</h4>
      </div>
    </div>
    <div class="w3-third">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-exclamation-circle w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?php
              $qry = mysqli_query($conn, "SELECT COUNT(id) as id FROM attendance WHERE status = 'Absent'");
              if($qry) {
                $total_users = $qry->fetch_assoc();
                echo $total_users['id'];
              }
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Absent</h4>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <h5>Attendance</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <?php
        $qry = mysqli_query($conn, "SELECT u.name, a.status 
          FROM users u 
          INNER JOIN attendance a 
          ON u.id = a.user_id 
          GROUP BY u.id, a.status");
        // check attendance
        if($qry->num_rows > 0) {
          while($row = mysqli_fetch_assoc($qry)) {
      ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php 
                        if($row['status'] == 'Absent') {
                          ?><span class="w3-badge w3-red w3-padding"><?php echo $row['status']; ?></span><?php
                        } else {
                          ?><span class="w3-badge w3-green w3-padding"><?php echo $row['status']; ?></span><?php
                        } 
                    ?>
                </td>
              </tr>
      <?php
          }
        } else {
          echo "No users with attendance found.";
        }
      ?>
    </table><br>
    <a href="attendance.php" class="w3-button w3-dark-grey">View All Attendance  <i class="fa fa-arrow-right"></i></a>
  </div>
  <hr>

  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Contact Information</h5>
        <p>09991231212</p>
        <p>brgystacruz@gmail.com</p>
        <p>Pasig City</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>Attendance Monitoring for Brgy. Sta Cruz Pasig City</h4>
    <p>@Copyright 2024</p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>