<?php

function offenraum_custom_post_friend()
{
    $labels = array(
        'name' => _x('Friend', 'post type general name'),
        'singular_name' => _x('Friend', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New Friend'),
        'edit_item' => __('Edit Friend'),
        'new_item' => __('New Friend'),
        'all_items' => __('All Friend'),
        'view_item' => __('View Friend'),
        'search_items' => __('Search Friend'),
        'not_found' => __('No friend found'),
        'not_found_in_trash' => __('No friend found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Friends'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Freunde des OFfenraums',
        'public' => true,
        'menu_position' => 7,
        'supports' => array('title'),
        'has_archive' => false,
    );
    register_post_type('friend', $args);
}

function offenraum_custom_post_friend_box()
{
    add_meta_box(
        'offenraum_custom_post_friend_box',
        'Details',
        'offenraum_custom_post_friend_box_content',
        'friend',
        'normal',
        'high'
    );
}

function offenraum_custom_post_friend_box_content($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'offenraum_custom_post_friend_box_content_nonce');

    echo sprintf('<p><label>Order<br><input type="number" name="menu_order" placeholder="1" value="%d"></label></p>', $post->menu_order);

    echo sprintf('<p><label>Span<br><input type="number" name="span" placeholder="2" value="%d"></label></p>', get_post_meta($post->ID, 'span', true));

    echo sprintf('<p><label>Offset<br><input type="number" name="offset" placeholder="2" value="%d"></label></p>', get_post_meta($post->ID, 'offset', true));

    echo sprintf('<p><label>URL<br><input type="text" name="friend_url" placeholder="http://somedomain.com/image.jpg" value="%s"></label></p>', get_post_meta($post->ID, 'url', true));

    $xfn = explode(' ', get_post_meta($post->ID, 'url_xfn', true));
    echo "<h4>XFN</h4><dl>";
    foreach (offenraum_get_xnf() as $cat => $values) {
        echo "<dt>$cat</dt><dd>";
        foreach ($values as $k => $v) {
            echo sprintf('<label><input type="checkbox" name="url_xfn_%s" value="1" %s> <code>%s</code> %s<br>', $k, in_array($k, $xfn) ? 'checked' : '', $k, $v);
        }
        echo "</dd>";
    }
    echo "</dl>";

    echo sprintf('<p><label>Image URL<br><input type="text" id="friend_image_url" name="friend_image_url" placeholder="http://somedomain.com/image.jpg" value="%s"></label></p>', get_post_meta($post->ID, 'image_url', true));
}

function offenraum_custom_post_friend_box_save($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!wp_verify_nonce($_POST['offenraum_custom_post_friend_box_content_nonce'], plugin_basename(__FILE__)))
        return;

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
    $friend_url = $_POST['friend_url'];
    $friend_image_url = $_POST['friend_image_url'];
    $span = (int)$_POST['span'];
    $offset = (int)$_POST['offset'];
    update_post_meta($post_id, 'url', $friend_url);
    update_post_meta($post_id, 'image_url', $friend_image_url);
    update_post_meta($post_id, 'span', $span);
    update_post_meta($post_id, 'offset', $offset);
    $xfn = array();
    foreach (offenraum_get_xnf() as $cat => $values) {
        foreach ($values as $k => $v) {
            $xfn_set = isset($_POST['url_xfn_' . $k]) and $_POST['url_xfn_' . $k] == '1';
            if ($xfn_set) {
                $xfn[] = $k;
            }
        }
    }
    update_post_meta($post_id, 'url_xfn', join(' ', $xfn));
}

add_action('init', 'offenraum_custom_post_friend');
add_action('add_meta_boxes', 'offenraum_custom_post_friend_box');
add_action('save_post', 'offenraum_custom_post_friend_box_save');