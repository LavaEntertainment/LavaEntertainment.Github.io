<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["videoFile"]) && $_FILES["videoFile"]["error"] == 0) {
        $targetDir = "uploads/"; // Specify the directory where you want to save uploaded videos
        $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);
        $uploadOk = true;
        $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is a video file
        $allowedTypes = array("mp4", "avi", "wmv", "mov");
        if (!in_array($videoFileType, $allowedTypes)) {
            echo "Sorry, only MP4, AVI, WMV, and MOV files are allowed.";
            $uploadOk = false;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
            $uploadOk = false;
        }

        // Check file size (adjust the max file size as needed)
        if ($_FILES["videoFile"]["size"] > 100000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = false;
        }

        // If everything is ok, upload the file
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["videoFile"]["name"]) . " has been uploaded.";
                // You can add additional code here to save the file path to a database or perform other actions
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Error: No file uploaded.";
    }
}
?>
