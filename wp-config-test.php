<?php
/**
 * WordPress Test Configuration
 * 
 * This file is used for PHPUnit tests
 * Configure database connection for test environment
 */

// Database configuration for tests
define('DB_NAME', getenv('WP_TESTS_DB_NAME') ?: 'wordpress_test');
define('DB_USER', getenv('WP_TESTS_DB_USER') ?: 'wordpress');
define('DB_PASSWORD', getenv('WP_TESTS_DB_PASSWORD') ?: 'wordpress');
define('DB_HOST', getenv('WP_TESTS_DB_HOST') ?: 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// WordPress configuration
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);

// Security keys (for testing only - use random keys in production)
define('AUTH_KEY', 'test-key-change-in-production');
define('SECURE_AUTH_KEY', 'test-key-change-in-production');
define('LOGGED_IN_KEY', 'test-key-change-in-production');
define('NONCE_KEY', 'test-key-change-in-production');
define('AUTH_SALT', 'test-salt-change-in-production');
define('SECURE_AUTH_SALT', 'test-salt-change-in-production');
define('LOGGED_IN_SALT', 'test-salt-change-in-production');
define('NONCE_SALT', 'test-salt-change-in-production');

// Table prefix for tests
$table_prefix = getenv('WP_TESTS_TABLE_PREFIX') ?: 'wp_test_';

// WordPress debugging
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('SAVEQUERIES', true);

/* That's all, stop editing! Happy testing. */

