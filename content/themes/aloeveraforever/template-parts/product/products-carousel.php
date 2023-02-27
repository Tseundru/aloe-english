

<main class="products__main swiper-container">
    <div class="carousel swiper-wrapper">
      <?php

      if($args['methode']==='filter'){
        $queryArgs = [
          'post_type'  => 'product',
          'posts_per_page' => 10,
          'tax_query' => [
            [
              'taxonomy' => 'product_badge',
              'field'    => 'slug',
              'terms'    => array( $args['filter'] ),
              
        
            ]
          ]
        ];
      }elseif($args['methode']==='ids'){
        $queryArgs= [
          'post__in' => $args['ids'],
          'post_type'  => 'product',
          'posts_per_page' => 10,
        ];
      }



      $query = new WP_Query($queryArgs);
      
      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
        
        if(!get_field('product_stop_field')){
          
          get_template_part('template-parts/product/product-card');
          
         }
        endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>
    <!-- If we need pagination -->

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
  </main>