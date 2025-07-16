<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['font_file'])) {
        $file = $_FILES['font_file'];
        $uploadDir = 'uploads/';
        $fileName = basename($file['name']);
        $uploadFile = $uploadDir . $fileName;
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt === 'ttf') {
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                echo "File uploaded successfully!";
            } else {
                echo "File upload failed!";
            }
        } else {
            echo "Please upload a valid .ttf file.";
        }
    } else {
        echo "No file received.";
    }
}
?>