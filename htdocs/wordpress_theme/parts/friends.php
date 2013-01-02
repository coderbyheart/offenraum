<?php

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
                $subels_xfn = get_post_meta($post->ID, 'url_xfn', true);
                $spanLeft -= ($subels_offset + $subels_span);
                ?>
                <a href="<?php echo $subels_url; ?>" rel="<?php echo $subels_xfn; ?>" title="<?php the_title() ?>"><img src="<?php echo $subels_image_url; ?>" alt="<?php the_title() ?>" class="col<?php echo $subels_span; ?> offset<?php echo $subels_offset; ?>"></a>

                <?php if ($spanLeft == 0): ?></div><p>&nbsp;</p><div class="clearfix"><?php $spanLeft = 16; endif; ?>
                <?php
            endwhile; // $subels->have_posts()
            ?></div><?php // clearfix
        endif; // $subels->have_posts()
        wp_reset_query(); 