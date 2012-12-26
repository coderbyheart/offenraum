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
	    
	    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
	    
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