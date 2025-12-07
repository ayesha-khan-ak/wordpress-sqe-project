<?php
/**
 * Custom Functions for SQE Project
 * 
 * This file contains custom WordPress functions that are tested
 * and will show coverage in test reports.
 * 
 * @package SQEProject
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Custom user creation function
 * 
 * @param string $username Username
 * @param string $email Email address
 * @param string $password Password
 * @return int|WP_Error User ID on success, WP_Error on failure
 */
function sqe_create_user($username, $email, $password) {
    if (empty($username) || empty($email) || empty($password)) {
        return new WP_Error('missing_params', 'Username, email, and password are required');
    }
    
    $user_id = wp_create_user($username, $password, $email);
    
    if (is_wp_error($user_id)) {
        return $user_id;
    }
    
    return $user_id;
}

/**
 * Custom post creation function
 * 
 * @param string $title Post title
 * @param string $content Post content
 * @param string $status Post status
 * @return int|WP_Error Post ID on success, WP_Error on failure
 */
function sqe_create_post($title, $content, $status = 'publish') {
    if (empty($title)) {
        return new WP_Error('missing_title', 'Post title is required');
    }
    
    $post_data = array(
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => $status,
        'post_author'  => get_current_user_id() ?: 1,
    );
    
    $post_id = wp_insert_post($post_data);
    
    if (is_wp_error($post_id)) {
        return $post_id;
    }
    
    return $post_id;
}

/**
 * Custom authentication function
 * 
 * @param string $username Username
 * @param string $password Password
 * @return WP_User|WP_Error User object on success, WP_Error on failure
 */
function sqe_authenticate_user($username, $password) {
    if (empty($username) || empty($password)) {
        return new WP_Error('missing_credentials', 'Username and password are required');
    }
    
    $user = wp_authenticate($username, $password);
    
    return $user;
}

/**
 * Get user posts count
 * 
 * @param int $user_id User ID
 * @return int Number of posts
 */
function sqe_get_user_posts_count($user_id) {
    if (empty($user_id)) {
        return 0;
    }
    
    $args = array(
        'author'         => $user_id,
        'post_type'      => 'post',
        'post_status'    => 'any',
        'posts_per_page' => -1,
    );
    
    $query = new WP_Query($args);
    
    return $query->found_posts;
}

/**
 * Validate post data
 * 
 * @param array $post_data Post data array
 * @return bool|WP_Error True if valid, WP_Error if invalid
 */
function sqe_validate_post_data($post_data) {
    if (!is_array($post_data)) {
        return new WP_Error('invalid_data', 'Post data must be an array');
    }
    
    if (empty($post_data['post_title'])) {
        return new WP_Error('missing_title', 'Post title is required');
    }
    
    $allowed_statuses = array('publish', 'draft', 'pending', 'private', 'trash');
    if (!empty($post_data['post_status']) && !in_array($post_data['post_status'], $allowed_statuses)) {
        return new WP_Error('invalid_status', 'Invalid post status');
    }
    
    return true;
}

