<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
$fontName = $data['fontName'];
foreach ($_SESSION['groups'] as $key => $group) {
    if (in_array($fontName, $group)) {
        unset($_SESSION['groups'][$key]);
    }
}
echo "Font groups updated successfully!";
?>