<?php get_header();
$taxonomy =  Post_Type_Distributor::TAXONOMY_NAME_LOCATION;
$tax_terms = get_terms($taxonomy, [
  'hide_empty' => false,
  'include' => [],
  'meta_key'=>'location_type',
 'meta_value'=>'Région',
]);
?>

<div class="headerPicture">
  <?php write_src_set_image(get_post_thumbnail_id(), '.headerPicture__imageBlur, .headerPicture__image'); ?>
  <div class=" headerPicture__imageBlur"></div>
  <div class="headerPicture__image">
    <div class="headerPicture__image__text">
      <h1 class="headerPicture__image__text__title">Forever Living Products France </h1>
      <h2 class="headerPicture__image__text__subtitle">Distributeur Forever France</h2>
    </div>
  </div>
</div>

<main class="main">
 
  <!-- Breadcrumb -->
  <nav class="breadcrumb">
    <ul class="breadcrumb__list">
      <li class="breadcrumb__list__item">
      <?php the_title(); ?>
        </a>
      </li>
    </ul>
  </nav>
  
  <section class="products topSeller">
  <header class="products__header">
    <h2 class="products__header__title title title--2">Produits Forever Les plus vendus en France</h2>
    
    <p class="products__header__subtitle">Vos produits Forever Living préférés, découvrez les produits les plus vendus dans l'hexagone.
      <a href=<?= get_term_link('top-vente', 'product_badge'); ?> class="products__header__subtitle__link" title="Meilleures ventes des produits Forever">Voir Tous</a>
    </p>
  </header>
  <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'favorite','methode'=>'filter']);?>
</section>


  <section class="accordion">
      <header class="accordion__header js-accordion">
        <h2 class="accordion__header__title title title--2">
          Vous recherchez un distributeur Forever Living Products En France
        </h2>
        <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
      </header>
      <main class="accordion__main">
        <p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products en France</strong>  et commercialise ses produits à base d'aloe vera dans <strong class="invisible">tous les départements de France Métropole et dans les Dom-Tom.</strong> </p>
        <p><strong>Trouvez ci dessous la liste des régions et départements de France ou nous distribuons nos Produits.</strong> </p>
        <?php foreach($tax_terms as $term)  :?>
        <h3><a href="<?= get_term_link($term->term_id, 'location')?>"><?=$term->name?></a></h3>
        <?php 
            $departments = get_terms($taxonomy, [
            'hide_empty' => false,
            'include' => [],
            'meta_query' =>[
              'relation' => 'AND',
              [
                'key'=>'location_type',
                'value'=>'Département',
                'compare' => '='
              ],
              [
                'key'=>'region',
                'value'=>$term->name,
                'compare' => '='
              ]
            ]
        ]);
        ?>
        <p>
          <?php
        foreach($departments as $department):?>
        <a href="<?= get_term_link($department->term_id, 'location')?>"><?=$department->name?> ,</a>
        <?php endforeach; ?>
        </p>
        <?php endforeach; ?>
      </main>
    </section>
    <section class="accordion">
      <header class="accordion__header js-accordion">
        <h2 class="accordion__header__title title title--2">
          Vous souhaitez devenir distributeur Forever Living Products En France
        </h2>
        <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
      </header>
      <main class="accordion__main">
        <p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products en France</strong>  recrute et forme des distributeurs <strong class="invisible">Forever Living Products dans toute la France</strong>. </p>
        <p>Si vous souhaitez rejoindre notre équipe de distributeurs et vous aussi commencer à gagner de l'argent en recommandant nos produits autour de vous n'hésitez pas à nous contacter.
      </p>
  </main>
        
        
    </section>


    <!-- New products -->
<section class="products newProducts">
      <header class="products__header">
        <h2 class="products__header__title title title--2">Nouveaux produits Forever Living en France</h2>
        <p class="products__header__subtitle">
          Vos nouveaux produits préférés de la marque Forever Living fraichement arrivés sur le marché français 
          <a href=<?= get_term_link('nouveaute', 'product_badge'); ?>
            class="products__header__subtitle__link" title="Nouveaux produits Forever">Voir Tous
          </a>
        </p>
      </header>
     <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'nouveaute','methode'=>'filter']);?>
    </section>
    <!-- Last Posts -->
<section class="lastPosts">
      <header class="lastPosts__header">
        <h2 class="lastPosts__header__title title title--2">
          Derniers articles du blog Forever France
</h2>
      </header>
      <main class="lastPosts__main swiper-container">
      <?php 
      $recent_posts_args = [
        'numberposts' => 5,
        'post_status' => 'publish'
      ];
      $recent_posts = wp_get_recent_posts($recent_posts_args , 'object'); 
      
      ?>
        <div class="lastPosts__main__list swiper-wrapper">
          <?php foreach($recent_posts as $post): ?>
           <?php  get_template_part('template-parts/posts/latestPost/latestPost', null, $post); ?>
          <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </main>

    </section>
</main>
<?php get_footer(); ?>
