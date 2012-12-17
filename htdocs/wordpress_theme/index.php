<?php

error_reporting(-1);
ini_set('display_errors', 1);

?>
<?php get_header(); ?>

<h1><?php bloginfo('title'); ?><br>
    <small><?php bloginfo('description'); ?></small>
</h1>

<?php the_page_content('offenraum'); ?>

<?php
// Render sub pages
$the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&order_by=menu_order&order=ASC', get_pageID_by_slug('offenraum')));
while ($the_query->have_posts()) :
    $the_query->the_post();
    ?>
<h2 id="<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
<?php
    the_content();
endwhile; ?>

<?php get_footer(); ?>