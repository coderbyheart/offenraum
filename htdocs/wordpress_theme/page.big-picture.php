<?php
/*
Template Name: Big Picture
*/

get_header('compact');

?>

<?php

    // Render pictures
    $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC', get_pageID_by_slug('big-picture')));
    if($the_query->have_posts()): ?>
    <?php
    while ($the_query->have_posts()) :
	$the_query->the_post();
	$image_url = get_post_meta($post->ID, 'image_url', true);
	$image_width = (int)get_post_meta($post->ID, 'image_width', true);
	$image_height = (int)get_post_meta($post->ID, 'image_height', true);
	$image_offset = (int)get_post_meta($post->ID, 'image_offset', true);
	$url = get_post_meta($post->ID, 'url', true);
	$url_label = get_post_meta($post->ID, 'url_label', true);
	if (!$url_label) $url_label = 'mehr …';
	?>
	<h2><?php the_title(); ?></h2>
	<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" longdesc="<?php echo $url; ?>" class="size-full">
	<?php the_content(); ?>
	<?php if($url): ?><p class="label">
	<a href="<?php echo $url; ?>">
	<?php echo $url_label; ?> &raquo;
	</a></p><?php endif; // if($url) ?>
	<?php
    endwhile; // $the_query->have_posts()
    endif; // $the_query->have_posts()
    wp_reset_query();
    
    ?>
<?php get_footer(); ?>