<?php

/**
 * Browser-based storage symlink creator for Niagahoster shared hosting.
 * Access this file via browser: https://yourdomain.com/fix-storage-link.php
 * DELETE THIS FILE after use!
 */

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "Symlink already exists at: $link<br>";
} else {
    if (symlink($target, $link)) {
        echo "SUCCESS: Symlink created!<br>";
        echo "Target: $target<br>";
        echo "Link: $link<br>";
    } else {
        echo "FAILED: Could not create symlink.<br>";
        echo "Try running manually via SSH: ln -s $target $link<br>";
    }
}

echo "<br><strong style='color:red;'>DELETE THIS FILE after use for security!</strong>";
