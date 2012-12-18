<?php

function offenraum_custom_post_coworker()
{
    $labels = array(
        'name' => _x('Coworker', 'post type general name'),
        'singular_name' => _x('Coworker', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New Coworker'),
        'edit_item' => __('Edit Coworker'),
        'new_item' => __('New Coworker'),
        'all_items' => __('All Coworker'),
        'view_item' => __('View Coworker'),
        'search_items' => __('Search Coworker'),
        'not_found' => __('No coworker found'),
        'not_found_in_trash' => __('No coworker found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Coworkers'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Holds our coworker and product specific data',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive' => true,
    );
    register_post_type('coworker', $args);
}

function offenraum_custom_post_coworker_box()
{
    add_meta_box(
        'offenraum_custom_post_coworker_box',
        'Details',
        'offenraum_custom_post_coworker_box_content',
        'coworker',
        'normal',
        'high'
    );
}

function offenraum_custom_post_coworker_box_content($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'offenraum_custom_post_coworker_box_content_nonce');

    echo sprintf('<p><label>Order<br><input type="number" name="menu_order" placeholder="1" value="%d"></label></p>', $post->menu_order);

    echo sprintf('<p><label>Span<br><input type="number" name="span" placeholder="2" value="%d"></label></p>', get_post_meta($post->ID, 'span', true));

    echo sprintf('<p><label>Offset<br><input type="number" name="offset" placeholder="2" value="%d"></label></p>', get_post_meta($post->ID, 'offset', true));

    echo sprintf('<p><label>URL<br><input type="text" name="coworker_url" placeholder="http://somedomain.com/image.jpg" value="%s"></label></p>', get_post_meta($post->ID, 'url', true));

    echo sprintf('<p><label>Image URL<br><input type="text" id="coworker_image_url" name="coworker_image_url" placeholder="http://somedomain.com/image.jpg" value="%s"></label></p>', get_post_meta($post->ID, 'image_url', true));
}

function offenraum_custom_post_coworker_box_save($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!wp_verify_nonce($_POST['offenraum_custom_post_coworker_box_content_nonce'], plugin_basename(__FILE__)))
        return;

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
    $coworker_url = $_POST['coworker_url'];
    $coworker_image_url = $_POST['coworker_image_url'];
    $span = (int)$_POST['span'];
    $offset = (int)$_POST['offset'];
    update_post_meta($post_id, 'url', $coworker_url);
    update_post_meta($post_id, 'image_url', $coworker_image_url);
    update_post_meta($post_id, 'span', $span);
    update_post_meta($post_id, 'offset', $offset);
}

add_action('init', 'offenraum_custom_post_coworker');
add_action('add_meta_boxes', 'offenraum_custom_post_coworker_box');
add_action('save_post', 'offenraum_custom_post_coworker_box_save');