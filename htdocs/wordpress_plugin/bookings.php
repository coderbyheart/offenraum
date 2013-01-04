<?php

function offenraum_custom_post_booking()
{
    $labels = array(
        'name' => _x('Booking', 'post type general name'),
        'singular_name' => _x('Booking', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New Booking'),
        'edit_item' => __('Edit Booking'),
        'new_item' => __('New Booking'),
        'all_items' => __('All Booking'),
        'view_item' => __('View Booking'),
        'search_items' => __('Search Booking'),
        'not_found' => __('No booking found'),
        'not_found_in_trash' => __('No booking found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Bookings'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Belegungsanzeige',
        'public' => true,
        'menu_position' => 9,
        'supports' => array(),
        'has_archive' => false,
    );
    register_post_type('booking', $args);
}

function offenraum_custom_post_booking_box()
{
    add_meta_box(
        'offenraum_custom_post_booking_box',
        'Details',
        'offenraum_custom_post_booking_box_content',
        'booking',
        'normal',
        'high'
    );
}

function offenraum_custom_post_booking_box_content($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'offenraum_custom_post_booking_box_content_nonce');

    echo sprintf('<p><label>Date<br><input type="date" name="booking_date" placeholder="YYYY-MM-DD" value="%s" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"></label></p>', get_post_meta($post->ID, 'booking_date', true));

    $free = get_post_meta($post->ID, 'booking_free', true);
    if ($free === "") $free = 100;
    echo sprintf('<p><label>Frei<br><input type="number" name="booking_free" placeholder="100" value="%d" min="0" max="100" step="50"></label></p>', $free);

}

function offenraum_custom_post_booking_box_save($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!wp_verify_nonce($_POST['offenraum_custom_post_booking_box_content_nonce'], plugin_basename(__FILE__)))
        return;

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    $booking_date = $_POST['booking_date'];
    $booking_free = $_POST['booking_free'];
    update_post_meta($post_id, 'booking_date', $booking_date);
    update_post_meta($post_id, 'booking_free', $booking_free);
}

add_action('init', 'offenraum_custom_post_booking');
add_action('add_meta_boxes', 'offenraum_custom_post_booking_box');
add_action('save_post', 'offenraum_custom_post_booking_box_save');