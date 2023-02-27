<?php

$imageId = get_field('block_construct_imageFull_image')['ID'];

if (!get_field('block_construct_imageFull_image_with_title')):?>
  <?php write_responsive_image($imageId, 'full') ?>
  <?php else :?>
    <?php write_src_set_image($imageId, '.imageTitle'.$imageId); ?>
  <div class="<?='imageTitle imageTitle'.$imageId?> <?= get_field('block_construct_imageFull_image_title_size') ?>">
    <h2 class="imageTitle__title ">
      <?= get_field('block_construct_imageFull_image_title'); ?>
    </h2>
  </div>
<?php endif; ?>


  