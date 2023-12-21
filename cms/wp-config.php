<?php
require_once __DIR__ . '/../app/config.php';

$table_prefix = $_ENV['WP_TABLE_PREFIX'] ?? 'wp_';

define('ABSPATH', __DIR__ . $_ENV['WP_ABSPATH']);
define('DB_NAME', $_ENV['DB_NAME'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? '');
define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_CHARSET', $_ENV['DB_CHARSET'] ?? '');
define('DB_COLLATE', $_ENV['DB_COLLATE'] ?? '');
define('WP_HOME', $_ENV['WP_HOME']);
define('WP_SITEURL', $_ENV['WP_SITEURL']);
define('WP_CONTENT_DIR', __DIR__ . $_ENV['WP_CONTENT_DIR']);
define('WP_CONTENT_URL', $_ENV['WP_CONTENT_URL']);

require_once ABSPATH . '/wp-settings.php';
