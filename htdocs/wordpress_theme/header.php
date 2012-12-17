<!doctype html>
<html lang="de-de">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('title'); ?> · <?php bloginfo('description'); ?><?php wp_title('|', true, 'right'); ?></title>
    <meta name="description" content="<?php the_page_content('meta-description'); ?>">
    <meta name="author" content="Markus Tacker | http://tckr.cc/">
    <!-- See /humans.txt for more infos -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Bitter:400,700">
    <!--
    <link rel="stylesheet" href="/build/complete-min.20121207.css" type="text/css">
    -->
    <link rel="stylesheet" href="/assets/normalize.css" type="text/css">
    <link rel="stylesheet" href="/assets/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/assets/styles.css" type="text/css">
    <?php wp_head(); ?>
</head>
<body itemscope itemtype="http://schema.org/Organization">
<header>
    <nav>
        <ul>
            <?php
            // Render sub pages
            $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&order_by=menu_order&order=ASC&meta_key=menu&meta_value=main', get_pageID_by_slug('offenraum')));
            while ($the_query->have_posts()) :
                $the_query->the_post();
                ?>
                <li><a href="#<?php echo $post->post_name; ?>"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?></a></li>
                <?php
            endwhile; ?>
        </ul>
        <ul>
            <?php
            // Render sub pages
            $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&order_by=menu_order&order=ASC&meta_key=menu&meta_value=sub', get_pageID_by_slug('offenraum')));
            while ($the_query->have_posts()) :
                $the_query->the_post();
                ?>
                <li><a href="#<?php echo $post->post_name; ?>" class="dim"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?></a></li>
                <?php
            endwhile; ?>
        </ul>
        <ul class="mobile">
            <li>
                <a href="http://twitter.com/OFfenraum" title="OFfenraum bei Twitter" rel="me" class="dim"><i class="icon-twitter"></i>
                    Twitter</a></li>
            <li>
                <a href="https://plus.google.com/111661941086180047910" title="OFfenraum bei Google+" rel="publisher" class="dim"><i class="icon-google-plus-sign"></i>Google+</a>
            </li>
            <li>
                <a href="https://www.facebook.com/OFfenraum" title="OFfenraum bei Facebook" rel="me" class="dim"><i class="icon-facebook-sign"></i>
                    Facebook</a></li>
        </ul>
    </nav>
    <div id="vcard">
        <img src="/build/logo.png" class="logo" alt="OFfenraum &middot; coworking space offenbach/main" itemprop="image">
        <?php the_page_content('flyer'); ?>
    </div>

    <?php $bigpic = page_content('big-picture'); ?>
    <div id="bigpic">
        <a class="label" href="http://www.flickr.com/photos/tacker/sets/72157632154336130/"><i class="icon-camera"></i>
            <?php echo $bigpic; ?></a><img src="<?php echo get_post_meta(50, 'image_url', true); ?>" class="bigpic" alt="<?php echo $bigpic; ?>">
    </div>
</header>
<article>

