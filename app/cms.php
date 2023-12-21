<?php
require_once __DIR__ . '/Dotenv.php';

Dotenv::load();

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', $_ENV['WP_USE_THEMES']);

/** Loads the WordPress Environment and Template */
require __DIR__ . '/../cms/core/wp-blog-header.php';
