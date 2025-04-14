<?php
$filename = $_GET['file'] ?? 'gift_output.txt';
$filepath = __DIR__ . '/' . basename($filename);

if (file_exists($filepath)) {
    header('Content-Type: text/plain');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($filepath);

    if (!empty($_GET['delete']) && $_GET['delete'] == '1') {
        unlink($filepath);
    }
    exit;
} else {
    echo "File not found.";
}
?>
