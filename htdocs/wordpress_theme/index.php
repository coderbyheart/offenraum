<?php

get_header(); ?>

<h1><?php bloginfo('title'); ?><br>
    <small>Blog</small>
</h1>

<p>In unserem Blog berichten wir und unsere Coworker aus dem Alltag in Offenbach's erstem Coworking Space.</p>

<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post">
    <h2>
        <a href="<?php the_permalink(); ?>#post"><?php the_title(); ?></a><br>
        <small><?php echo strftime('%d. %B %Y', get_the_date('U')); ?></small>
    </h2>
    <p></p>
    <?php the_content(); ?>

    <nav class="nav-single">
        <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'twentytwelve') . '</span> %title'); ?></span>
        <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'twentytwelve') . '</span>'); ?></span>
    </nav>
    <!-- .nav-single -->
</div>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>