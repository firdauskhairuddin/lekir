<?php
// Determine the base path based on current directory depth
$current_path = $_SERVER['PHP_SELF'];
$base_path = './';
if (strpos($current_path, '/vulnerabilities/') !== false) {
    $parts = explode('/vulnerabilities/', $current_path);
    if (isset($parts[1]) && strpos($parts[1], '/') !== false) {
        $base_path = '../../';
    } else {
        $base_path = '../';
    }
} elseif (strpos($current_path, '/tools/') !== false || strpos($current_path, '/compare/') !== false || strpos($current_path, '/components/') !== false) {
    $base_path = '../';
}

// Determine the base path based on current directory depth
$current_path = $_SERVER['PHP_SELF'];
$depth = 0;

if (strpos($current_path, '/vulnerabilities/') !== false) {
    // Check if it's in a subcategory
    $parts = explode('/vulnerabilities/', $current_path);
    if (isset($parts[1]) && strpos($parts[1], '/') !== false) {
        $depth = 2;
    } else {
        $depth = 1;
    }
} elseif (strpos($current_path, '/tools/') !== false || strpos($current_path, '/compare/') !== false || strpos($current_path, '/components/') !== false) {
    $depth = 1;
}

$base_path = str_repeat('../', $depth);
if ($depth == 0) {
    $base_path = './';
}
?>
