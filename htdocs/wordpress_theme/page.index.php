<?php
/*
Template Name: Index
*/

get_header();

?>

<h1><?php bloginfo('title'); ?><br>
    <small><?php bloginfo('description'); ?></small>
</h1>

<?php

the_page_content('offenraum');

// Render sub pages
$the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC', get_pageID_by_slug('offenraum')));
while ($the_query->have_posts()) :
    $the_query->the_post();
    ?>
<h2 id="<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
<?php

    if ($post->post_name == 'coworker'):
        $subels = new WP_Query(sprintf('post_type=coworker&post_status=publish&orderby=menu_order&order=ASC'));
        $spanLeft = 16;
        if ($subels->have_posts()):
            ?>
        <div class="clearfix"><?php
            while ($subels->have_posts()):
                $subels->the_post();
                $subels_url = get_post_meta($post->ID, 'url', true);
                $subels_image_url = get_post_meta($post->ID, 'image_url', true);
                $subels_span = get_post_meta($post->ID, 'span', true);
                $subels_offset = get_post_meta($post->ID, 'offset', true);
                $spanLeft -= ($subels_offset + $subels_span);
                ?>

                <div class="col<?php echo $subels_span; ?> offset<?php echo $subels_offset; ?> compactlines" itemscope itemtype="http://schema.org/Organization">
                    <a href="<?php echo $subels_url; ?>" itemprop="url" rel="friend neighbor met co-worker" title="<?php the_title() ?> &mdash; <?php echo $post->post_content; ?>"><img src="<?php echo $subels_image_url; ?>" alt="<?php the_title() ?> &mdash; <?php echo $post->post_content; ?>" height="100" itemprop="image"><br><span itemprop="name"><?php the_title() ?></span></a><br>
                    <small itemprop="description"><?php echo $post->post_content; ?></small>
                    <br>
                </div>
                <?php if ($spanLeft == 0): ?></div><p>&nbsp;</p><div class="clearfix"><?php $spanLeft = 16; endif; ?>
                <?php
            endwhile;
            ?></div><?php
        endif; elseif ($post->post_name == 'freunde'):
        $subels = new WP_Query(sprintf('post_type=friend&post_status=publish&orderby=menu_order&order=ASC'));
        $spanLeft = 16;
        if ($subels->have_posts()):
            ?>
            <div class="clearfix">
            <?php
            while ($subels->have_posts()):

                $subels->the_post();
                $subels_url = get_post_meta($post->ID, 'url', true);
                $subels_image_url = get_post_meta($post->ID, 'image_url', true);
                $subels_span = get_post_meta($post->ID, 'span', true);
                $subels_offset = get_post_meta($post->ID, 'offset', true);
                $spanLeft -= ($subels_offset + $subels_span);
                ?>
                <a href="<?php echo $subels_url; ?>" rel="friend neighbor met" title="<?php the_title() ?>"><img src="<?php echo $subels_image_url; ?>" alt="<?php the_title() ?>" class="col<?php echo $subels_span; ?> offset<?php echo $subels_offset; ?>"></a>

                <?php if ($spanLeft == 0): ?></div><p>&nbsp;</p><div class="clearfix"><?php $spanLeft = 16; endif; ?>
                <?php
            endwhile;
            ?></div><?php // clearfix
        endif; else:
        the_content();
    endif;
endwhile; ?>

<?php get_footer(); ?>