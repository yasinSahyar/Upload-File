<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['selectFile'])) {
        $uploaddir = "uploads/";

        // Create the "uploads" directory if it doesn't exist
        if (!file_exists($uploaddir) && !mkdir($uploaddir, 0755, true)) {
            die("Failed to create the 'uploads' directory.");
        }

        $uploadfile = $uploaddir . basename($_FILES['selectFile']['name']);
        
        // Check if the file has a valid extension (e.g., allow only certain image types)
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $fileExtension = strtolower(pathinfo($_FILES['selectFile']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Error: Invalid file type. Please upload a valid image file.";
        } else {
            if (move_uploaded_file($_FILES['selectFile']['tmp_name'], $uploadfile)) {
                echo "File upload was successful!";
            } else {
                echo "File upload failed!";
            }
        }
    } else {
        echo "No file selected for upload.";
    }
}
?>