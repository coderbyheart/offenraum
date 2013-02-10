<?php
/*
Template Name: Page
*/

get_header();
while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php if($post->post_parent):
$parent = get_page($post->post_parent); ?>
<nav><a href="<?php echo get_permalink($post->post_parent); ?>">&laquo; <?php echo $parent->post_title; ?></a></nav>
<?php endif; // $post->post_parent ?>
<?php the_content(); ?>
<?php edit_post_link('Bearbeiten', '<p><small><i class="icon-edit"></i> ', '</small></p>'); ?>
<?php endwhile; ?>
<?php get_footer(); ?>