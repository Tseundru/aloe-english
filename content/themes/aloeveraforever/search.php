<?php get_header();
global $wp_query;
//dump($wp_query);
?>
<main class="main ">

  <div class="pageBlog__content">
    <h1 class="title">résultats pour : <?= get_search_query(); ?></h1>
    <div class="publication-list">
      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
        <?php if(get_post_type()=='post' ) : ?>
          <?php get_template_part('template-parts/posts/blogPostExerpt/blogPostExerpt'); ?>
          <?php elseif(get_post_type()=='product' ): ?>
            <?php get_template_part('template-parts/product/product-card'); ?>
            <?php endif; ?>
      <?php endwhile;?>
      <?php elseif(!have_posts()) :?>
        <p> Aucun résultats pour votre recherche</p>
      <?php endif;
      wp_reset_postdata();
      ?>
    </div>
    
  </div>




  
</main>
<?php get_footer(); ?>

<?php get_footer(); ?>