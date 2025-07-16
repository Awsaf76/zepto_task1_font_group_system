<?php
$fonts = [];
$dir = 'uploads/';
if (is_dir($dir)) {
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'ttf') {
                $fonts[] = $file;
            }
        }
        closedir($handle);
    }
}
header('Content-Type: application/json');
echo json_encode($fonts);
?>