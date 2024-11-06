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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <script src="js/allscript.js"></script>
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
    <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="users.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  User Profile</a>
    <a href="register.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-user-plus fa-fw"></i>  Register User</a>
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
    <h5><b><i class="fa fa-user-plus"></i> Register New User</b></h5>
  </header>
  
  <?php require 'database/conn.php'; ?>

  <div class="w3-container">
    <div class="w3-card">
        <div class="w3-container w3-blue">
            <h2>Fill up new user information</h2>
        </div>
        <form action="add-new-user.php"  method="post">
        <div class="w3-row">
            <div class="w3-half p16">
                <p>
                    <label>ID Number</label>
                    <input class="w3-input" type="text" name="id_number" required>
                </p>
                <p>
                    <label>Full Name</label>
                    <input class="w3-input" type="text" name="name" required>
                </p>
                <p>
                    <label>Chose a deparment</label>
                    <div class="w3-container">
                        <select id="department" name="department">
                        <?php require 'database/conn.php'; ?>
                        <?php
                            $qry = mysqli_query($conn,"SELECT * FROM department");
                            if ($qry->num_rows > 0) {
                                while ($row = mysqli_fetch_array($qry)) {
                                ?><option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option><?php    
                            }
                            }
                        ?>
                        </select>
                    </div>
                </p>
                <p>
                    <label for="gender">Shift</label>
                    <input class="w3-radio" type="radio" name="shift" value="AM" checked>
                    <label>AM</label>
                    <input class="w3-radio" type="radio" name="shift" value="PM">
                    <label>PM</label>
                </p>
            </div>
            <div class="w3-half">
                <!-- Camera Capture -->
                <div class="p16" id="camera">
                    <label for="photo">Capture Photo:</label>
                    <video id="video" autoplay></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <button type="button" id="capture-button" class="w3-btn w3-blue">Capture Image</button>
                    <input type="hidden" name="captured_image" id="captured_image">
                </div>
            </div>
        </div>
        <div class="w3-row pl16 pb16">
            <button type="submit" class="w3-btn w3-green">Register</button>
            </form>
        </div>
    </div>
  </div>
  <hr>

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

// Wait for the DOM to load
window.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture-button');
    const capturedImageInput = document.getElementById('captured_image');
    const deparment = document.getElementById('department');


    deparment.addEventListener('click', function () {  
        // Get department name
        deparment.textContent('Department One')
    });

    // Get access to the webcam
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        }).catch(function(err) {
            console.error("Error accessing webcam: ", err);
        });
    }

    // Capture the image when the capture button is clicked
    captureButton.addEventListener('click', function() {
        
        const context = canvas.getContext('2d');
        // Set the canvas size to match the video dimensions
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Draw the image from the video element onto the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        // Convert the canvas image to base64 (Data URL)
        const imageDataURL = canvas.toDataURL('image/png');
        
        // Store the base64 image in the hidden input field
        capturedImageInput.value = imageDataURL;
        
        // Stop the webcam feed after capturing
        video.srcObject.getTracks().forEach(track => track.stop());
        
        alert("Image captured and ready to be submitted!");
    });
});

</script>

</body>
</html>