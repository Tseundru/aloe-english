<div class="blogPostMeta">
  <?php if(is_single('post')):?>
  <div class="blogPostMeta__publishDate"><?= get_the_date('d M Y'); ?></div>
  <?php endif ;?>
  <div class="blogPostMeta__timeToRead"><?= temps_lecture(get_post()); ?> de lecture</div>
</div>