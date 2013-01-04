<?php
/*
Template Name: Index
*/

get_header();

?>

<h1><?php bloginfo('title'); ?><br>
    <small><?php bloginfo('description'); ?></small>
</h1>

<?php the_page_content('offenraum'); ?>
<div class="center">
    <a href="/buchen" class="button"><i class="icon-calendar"></i> Jetzt deinen Schreibtisch buchen …</a>
</div>
<?php
// Render sub pages
$the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC', get_pageID_by_slug('offenraum')));
while ($the_query->have_posts()) :
    $the_query->the_post();
    $onMobileIndex = get_post_meta(get_the_ID(), 'on_mobile_index', true) !== '0';
    if (!$onMobileIndex): ?><div class="desktop"><?php endif;
    ?>
<h2 id="<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
<?php
    if ($post->post_name == 'coworker') {
      require_once 'parts/coworker.php';
    } elseif ($post->post_name == 'freunde') {
      require_once 'parts/friends.php';
    } else {
      the_content();
    }
    if (!$onMobileIndex): ?></div><?php endif; // <div class="desktop">
endwhile; // $the_query->have_posts()
wp_reset_query(); ?>

<?php get_footer(); ?>