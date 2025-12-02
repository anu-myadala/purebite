<?php
/**
 * session_helper.php
 * 
 * Helper functions to ensure consistent session management
 * and compatibility with combined website redirect.php
 */

/**
 * Ensures user_id is set in session if user is logged in
 * This prevents NULL user_id errors in redirect.php
 */
function ensureUserID() {
    if (isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
        // Generate a consistent numeric ID from username
        // This ensures the same username always gets the same ID
        $_SESSION['user_id'] = abs(crc32($_SESSION['user'])) % 1000000;
    }
}

/**
 * Get user_id from session, or return null if not logged in
 * @return int|null
 */
function getCurrentUserID() {
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    }
    if (isset($_SESSION['user'])) {
        // Generate and store it
        ensureUserID();
        return $_SESSION['user_id'];
    }
    return null;
}

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user']);
}

?>

