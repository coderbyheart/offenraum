<!doctype html>
<html lang="de-de">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('title'); ?> · <?php bloginfo('description'); ?></title>
    <meta name="description" content="<?php the_raw_page_content('meta-description'); ?>">
    <meta name="author" content="Markus Tacker | http://tckr.cc/">
    <!-- See /humans.txt for more infos -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Bitter:400,700">
    <?php
    // define('BUST', time());
    define('BUST', '20130104');?>
    <link rel="stylesheet" href="/build/complete-min.<?php echo BUST; ?>.css" type="text/css">
    <!--
    <link rel="stylesheet" href="/assets/normalize.css" type="text/css">
    <link rel="stylesheet" href="/assets/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/assets/styles.<?php echo BUST; ?>.css" type="text/css">
    <link rel="stylesheet" href="/wordpress_theme/style.<?php echo BUST; ?>.css" type="text/css">
    -->
    <?php wp_head(); ?>
</head>
<body itemscope itemtype="http://schema.org/Organization">
<header>
    <nav>
        <ul>
            <?php
            // Render sub pages
            $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC&meta_key=menu&meta_value=main', get_pageID_by_slug('offenraum')));
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $onMobileIndex = get_post_meta(get_the_ID(), 'on_mobile_index', true) !== '0';
                ?>
                <li>
                    <a href="/#<?php echo $post->post_name; ?>" 
                    <?php if(!$onMobileIndex): ?>class="desktop"<?php endif; ?>
                    ><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a>
                    <?php if(!$onMobileIndex): ?>
                    <a href="<?php the_permalink(); ?>" class="mobile"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a>
                    <?php endif; ?>
		</li>
                <?php
            endwhile;
            wp_reset_query();
            ?>
            <li class="mobile"><a href="/big-picture/"><i class="icon-picture"></i> Bilder</a></li>
        </ul>
        <ul>
            <?php
            // Render sub pages
            $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC&meta_key=menu&meta_value=sub', get_pageID_by_slug('offenraum')));
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $onMobileIndex = get_post_meta(get_the_ID(), 'on_mobile_index', true) !== '0';
                ?>
                <li>
                    <a href="/#<?php echo $post->post_name; ?>" 
                    class="dim <?php if(!$onMobileIndex): ?>desktop<?php endif; ?>"
                    ><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a>
                    <?php if(!$onMobileIndex): ?>
                    <a href="<?php the_permalink(); ?>" class="dim mobile"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a>
                    <?php endif; ?>
                </li>
                <?php
            endwhile; 
            wp_reset_query();
            ?>
            <li><a href="/datenschutz/" class="dim"><i class="icon-umbrella"></i> Datenschutz</a></li>
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