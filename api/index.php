<?php

// Ensure serverless writable storage directories exist in /tmp
if (!is_dir('/tmp/views')) {
    @mkdir('/tmp/views', 0755, true);
}
if (!is_dir('/tmp/cache')) {
    @mkdir('/tmp/cache', 0755, true);
}
if (!is_dir('/tmp/sessions')) {
    @mkdir('/tmp/sessions', 0755, true);
}

// Forward request to Laravel public/index.php
require __DIR__ . '/../public/index.php';
