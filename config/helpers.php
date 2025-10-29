<?php
// config/helpers.php - Helper functions

/**
 * Format money in Kenyan Shillings
 */
function format_kes($amount) {
    return 'KSh ' . number_format($amount, 2);
}

/**
 * Format date in a user-friendly way
 */
function format_date($date) {
    return date('M j, Y', strtotime($date));
}

/**
 * Get current year
 */
function current_year() {
    return date('Y');
}

/**
 * Sanitize input data
 */
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>