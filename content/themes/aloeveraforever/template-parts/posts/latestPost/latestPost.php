
 <?php $post = $args; ?>
 <?php $image_ID = get_post_thumbnail_id($post->ID); ?>
 <?php // write_src_set_image($image_ID , 'lastPosts__main__list__item') ?>
<article class="lastPosts__main__list__item swiper-slide">
<?php write_responsive_image($image_ID, 'large', 'lastPosts__main__list__item__img', 1); ?>
 <span class="lastPosts__main__list__item__title title title--3"><?= $post->post_title ?></span>
 <div class="overlay"><a class="buttonOverlay buttonOverlay--readmore" href="<?php the_permalink($post->ID)?>" title="<?php the_title(); ?>">Lire la suite</a></div>
</article>