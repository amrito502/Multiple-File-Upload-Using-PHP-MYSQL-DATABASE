<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "multiple_file_upload");
if (!$conn) {
    echo "Error connecting to database";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["files"])) {
    $uploadDirectory = "uploads/";  // Specify the directory where you want to store uploaded files

    // Ensure the directory exists
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $files = $_FILES["files"];

    // Loop through each file
    for ($i = 0; $i < count($files["name"]); $i++) {
        $filename = $files["name"][$i];
        $targetPath = $uploadDirectory . $filename;

        // Check if file already exists
        if (file_exists($targetPath)) {
            $_SESSION['status'] = "File '$filename' already exists. Choose a different name or try again.";
            header("location: index.php");
        } else {
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($files["tmp_name"][$i], $targetPath)) {
                $sql = "INSERT INTO multiple_file (files) VALUES ('$filename')";
                $result = mysqli_query($conn, $sql);
                $_SESSION['status'] = "File '$filename' uploaded successfully.";
                header("location: index.php");
            } else {
                $_SESSION['status'] = "Error uploading file '$filename'. Please try again.";
                header("location: index.php");
            }
        }
    }
} else {
    echo "Invalid request.";
}
