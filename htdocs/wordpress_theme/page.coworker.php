<?php
/*
Template Name: Coworker
*/

get_header('compact');
while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php require_once 'parts/coworker.php'; ?>
<?php endwhile; ?>
<?php get_footer(); ?>