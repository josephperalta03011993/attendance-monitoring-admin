<?php
    include 'database/conn.php';

    // Get form data from POST request
    $id_number = $_POST['id_number'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $shift = $_POST['shift'];
    $captured_image = $_POST['captured_image']; // This is the base64 encoded image

    // Check if image data is present
    if (!empty($captured_image)) {
        // Remove the header (data:image/png;base64,) part
        $image_parts = explode(";base64,", $captured_image);
        $image_base64 = base64_decode($image_parts[1]);

        // Create a unique file name for the image
        $fileName = 'uploads/user_' . uniqid() . '.png';

        // Save the image to the 'uploads' directory
        file_put_contents($fileName, $image_base64);

        // Insert the user data into the 'users' table
        $query = "INSERT INTO users (id_number, name, department, shift, image_path, role) 
        VALUES ('$id_number', '$name', '$department', '$shift', '$fileName', '2')";
        $query_run = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($query_run) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: No image captured.";
    }

    // Close the database connection
    mysqli_close($conn);
?>

<script type="text/javascript">
    alert("Registration successful!!");
    window.location.href = "register.php";
</script>
