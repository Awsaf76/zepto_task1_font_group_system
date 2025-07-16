<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];
if (isset($_SESSION['groups'][$index])) {
    unset($_SESSION['groups'][$index]);
    $_SESSION['groups'] = array_values($_SESSION['groups']); // ✅ Reindex after deletion
    echo "Group deleted successfully.";
} else {
    echo "Group not found.";
}
?>