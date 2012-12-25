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
    <!--
    <link rel="stylesheet" href="/build/complete-min.20121218.css" type="text/css">
    -->
    <link rel="stylesheet" href="/assets/normalize.css" type="text/css">
    <link rel="stylesheet" href="/assets/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/assets/styles.20121225.css" type="text/css">
    <link rel="stylesheet" href="/wordpress_theme/style.20121225.css" type="text/css">
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
                ?>
                <li>
                    <a href="/#<?php echo $post->post_name; ?>"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a></li>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
        <ul>
            <?php
            // Render sub pages
            $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC&meta_key=menu&meta_value=sub', get_pageID_by_slug('offenraum')));
            while ($the_query->have_posts()) :
                $the_query->the_post();
                ?>
                <li>
                    <a href="/#<?php echo $post->post_name; ?>" class="dim"><i class="icon-<?php echo get_post_meta(get_the_ID(), 'icon', true); ?>"></i><?php the_title(); ?>
                    </a></li>
                <?php
            endwhile; 
            wp_reset_query();
            ?>
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
        <dl class="clearfix">
            <dt class="warning"><i class="icon-warning-sign"></i></dt>
            <dd class="warning"><strong>Eröffnung ziemlich bald*</strong></dd>
            <dt><i class="icon-map-marker"></i></dt>
            <dd>Senefelderstr. 63<br> 63069 Offenbach<br>
                <small>nur 6 Gehminuten vom Hauptbahnhof</small>
            </dd>
            <dt><i class="icon-group"></i></dt>
            <dd>Individuelle Arbeitsplätze<br>
                <small>+ Meetingraum, Küche, Dusche</small>
            </dd>
            <dt><i class="icon-user"></i></dt>
            <dd>17,50 € / Tag<br>150,– € / 10er-Ticket<br>295,– € / Monat<br>
                <small>Preise zzgl. MwSt.<br>Individuelle Tarife nach Vereinbarung.<br>10% Rabatt für Dauermieter ab dem
                    4. Monat und Studenten.
                </small>
            </dd>
            <dt><i class="icon-time"></i></dt>
            <dd>offen 9–21+<br>
                <small>24/7 für Dauermieter</small>
            </dd>
            <dt><i class="icon-heart-empty"></i></dt>
            <dd>Interesse?<br><a href="/#kontakt">Sprich mit uns!</a></dd>
        </dl>
    </div>
    
    <?php
    
    // Render slider
    $the_query = new WP_Query(sprintf('post_type=page&post_parent=%d&post_status=publish&orderby=menu_order&order=ASC', get_pageID_by_slug('big-picture')));
    if($the_query->have_posts()): ?>
    <div id="bigpic">
    <?php
    $n = 0;
    while ($the_query->have_posts()) :
	$the_query->the_post();
	$image_url = get_post_meta($post->ID, 'image_url', true);
	$image_width = (int)get_post_meta($post->ID, 'image_width', true);
	$image_height = (int)get_post_meta($post->ID, 'image_height', true);
	$image_offset = (int)get_post_meta($post->ID, 'image_offset', true);
	$url = get_post_meta($post->ID, 'url', true);
	$url_label = get_post_meta($post->ID, 'url_label', true);
	if (!$url_label) $url_label = 'mehr …';
	$hidden = $n > 0 ? 'hidden' : '';
	?>
	<?php if($url): ?><a href="<?php echo $url; ?>"><?php endif; // if($url) ?>
	  <div class="bigpic <?php echo $hidden; ?>" data-width="<?php echo $image_width; ?>" data-height="<?php echo $image_height; ?>" data-offset="<?php echo $image_offset; ?>">
	    <div class="text">
	      <p class="title"><?php the_title(); ?></p>
	      <?php the_content(); ?>
	      <?php if($url): ?><p class="label">
	      <?php echo $url_label; ?> &raquo;
	      </p><?php endif; // if($url) ?>
	    
	    </div>
	    
	    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" longdesc="<?php echo $url; ?>">
	    
	  </div>
	  <?php if($url): ?></a><?php endif; // if($url) ?>
	<?php
	$n++;
    endwhile; // $the_query->have_posts()
    ?>
      <i class="icon-chevron-left nav nav-left hidden"></i>
      <i class="icon-chevron-right nav nav-right hidden"></i>
    </div><?php endif; // $the_query->have_posts()
    wp_reset_query();
    
    ?>
</header>
<article>

