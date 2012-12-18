<?php

function the_post_content($slug, $type = null)
{
    echo post_content($slug, $type);
}

function post_content($slug, $type = null)
{
    return get_post_by_slug($slug, $type)->post_content;
}

function the_page_content($page_slug)
{
    $page = get_page_by_slug($page_slug);
    setup_postdata($page);
    the_content();
    wp_reset_query();
}

function the_raw_page_content($page_slug)
{
    echo page_content($page_slug);
}

function page_content($page_slug)
{
    $page = get_page_by_slug($page_slug);
    return $page->post_content;
}

function get_page_by_slug($slug)
{
    $pageID = get_pageID_by_slug($slug);
    if ($pageID) {
        $post = get_post($pageID);
        wp_reset_query();
        return $post;
    }
    return null;
}

function get_pageID_by_slug($slug)
{
    global $wpdb;
    $page = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= 'page' AND post_status = 'publish'", $slug));
    if ($page)
        return $page;
    return null;
}

function get_post_by_slug($slug, $type = null)
{
    if ($type === null) $type = 'post';
    $args = array(
        'post_name' => $slug,
        'post_type' => $type,
        'post_status' => 'publish',
        'numberposts' => 1
    );
    $posts = get_posts($args);
    return $posts[0];

}

function fetch_page_children_by_slug($slug)
{
    global $wpdb;
    return $wpdb->query($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = %d AND post_type= 'page' AND post_status = 'publish' ORDER BY menu_order ASC", get_pageID_by_slug($slug)));
}