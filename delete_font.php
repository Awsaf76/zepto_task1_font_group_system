<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $fontName = $data['fontName'];
    $filePath = 'uploads/' . $fontName;

    if (file_exists($filePath)) {
        unlink($filePath);
        echo "Font deleted successfully!";
    } else {
        echo "Font file not found!";
    }
}
?>