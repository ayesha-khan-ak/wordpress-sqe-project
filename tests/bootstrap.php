<?php
/**
 * PHPUnit Bootstrap File for WordPress Tests
 * 
 * This file initializes the testing environment for WordPress.
 * It loads WordPress core files from the cloned wordpress/ directory.
 * 
 * WordPress Location: ../wordpress/ (cloned from GitHub)
 */

// Define WordPress root path (cloned WordPress directory)
$wordpress_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'wordpress';

// Check if WordPress is cloned
if (!file_exists($wordpress_path . DIRECTORY_SEPARATOR . 'wp-load.php')) {
    trigger_error(
        "WordPress not found at: {$wordpress_path}\n" .
        "Please clone WordPress: git clone https://github.com/WordPress/WordPress.git wordpress",
        E_USER_ERROR
    );
}

// Define ABSPATH before loading WordPress
if (!defined('ABSPATH')) {
    define('ABSPATH', $wordpress_path . DIRECTORY_SEPARATOR);
}

// Define WordPress test constants
if (!defined('WP_TESTS_PHPUNIT_POLYFILLS_PATH')) {
    $polyfills_path = dirname(__DIR__) . '/vendor/yoast/phpunit-polyfills';
    if (file_exists($polyfills_path)) {
        define('WP_TESTS_PHPUNIT_POLYFILLS_PATH', $polyfills_path . '/phpunitpolyfills-autoload.php');
    }
}

// Load WordPress
if (!defined('WP_USE_THEMES')) {
    define('WP_USE_THEMES', false);
}

// Load WordPress core
require_once $wordpress_path . DIRECTORY_SEPARATOR . 'wp-load.php';

// Check if WordPress loaded successfully
if (!function_exists('wp_insert_post')) {
    trigger_error(
        "WordPress functions not available. WordPress may not have loaded correctly.",
        E_USER_WARNING
    );
}

// Include test helper functions
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'test-helpers.php')) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'test-helpers.php';
}

// Set up test database configuration from environment or defaults
if (!defined('DB_NAME')) {
    $db_name = getenv('WP_TESTS_DB_NAME') ?: 'wordpress_test';
    $db_user = getenv('WP_TESTS_DB_USER') ?: 'wordpress';
    $db_password = getenv('WP_TESTS_DB_PASSWORD') ?: 'wordpress';
    $db_host = getenv('WP_TESTS_DB_HOST') ?: 'localhost';
    
    // These constants will be used if wp-config.php doesn't exist
    define('DB_NAME', $db_name);
    define('DB_USER', $db_user);
    define('DB_PASSWORD', $db_password);
    define('DB_HOST', $db_host);
}

