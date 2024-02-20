<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "multiple_file_upload");
if (!$conn) {
    echo "Error connecting to database";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="" style="background-color: lightskyblue;">
    <div class="container bg-primary p-2 my-3">
        <h3 class="text-center bg-danger text-white py-3">Multiple File Upload Using PHP & MYSQL DATABASE</h3>
        <div class="row my-4">
            <?php
            if (isset($_SESSION['status'])) {
                echo  "<h5 class='text-white'>" . $_SESSION['status'] . "</h5>";
                unset($_SESSION['status']);
            }
            ?>
            <div class="col-md-12 px-4">
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <label for="file" class="text-white">Select Multiple Files to Upload:</label> <br>
                    <input class=" form-control my-3" type="file" name="files[]" id="files" multiple required>
                    <input type="submit" value="Upload File" class="btn btn-sm btn-info text-white">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $sql = "SELECT * FROM multiple_file";
            $result = mysqli_query($conn, $sql);
            foreach ($result as $row) {
            ?>
                <div class="col-md-4 mb-3">
                    <div class="shadow bg-gray">
                        <img src="uploads/<?php echo $row['files'] ?>" alt="img_gallray" class="mb-3 px-3 my-2" style="width: 100%; height: 230px;">
                    </div>
                </div>

            <?php

            }

            ?>
        </div>
</body>

</html>