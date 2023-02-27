<?php get_header();
$location = get_queried_object();
$taxonomy =  Post_Type_Distributor::TAXONOMY_NAME_LOCATION;

$pageFrance = get_page_by_title('Forever Living Products France');

$location_type = get_field('location_type_field', 'location_' . $location->term_id);
$location_code_postal = get_field('code_postal_field');
$location_code_departement= strlen(get_field('departement_code_field')) > 1 ? get_field('departement_code_field') : '0'.get_field('departement_code_field') ;
$locationName = '';
$locationTerms = '';

switch ($location_type) {
  case 'Région':
    $locationName = 'en ' . $location->name;
    $locationSituation = '<p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products '. $locationName.' </strong> et commercialise ses produits à base d\'aloe vera dans <strong class="invisible">toute la <a href="'.get_permalink($pageFrance->ID).'" title="Forever Living Products France"> France Metropolitaine</a> et dans les Dom-Tom.</strong> </p>';
    $locationIntro = 'Trouvez ci dessous la liste des département et villes de ' . $location->name . ' ou nous distribuons nos Produits.';
    $locationTerms = get_terms($taxonomy, [
      'hide_empty' => false,
      'include' => [],
      'meta_query' => [
        'relation' => 'AND',
        [
          'key' => 'location_type',
          'value' => 'Département',
          'compare' => '='
        ],
        [
          'key' => 'region',
          'value' => $location->name,
          'compare' => '='
        ]
      ]
    ]);
    break;
  case 'Département':
    $locationName = 'dans le département ' . $location->name.' ('.$location_code_departement.')';
    $region = get_field('region', 'location_' . $location->term_id);
    $regionID = get_term_by('name', $region, 'location')->term_id;

    $locationIntro = 'Trouvez ci dessous la liste des villes du département ' . $location->name . ' ou nous distribuons nos Produits.';
    $locationSituation = '<p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products '. $locationName.' </strong> et commercialise ses produits à base d\'aloe vera dans <strong class="invisible">toute la Région <a href="'.get_term_link($regionID).'"  title="Distributeur Forever Living Products '.$region.'">'.$region.'</a>.</strong> </p>'; 
    $locationTerms = get_terms($taxonomy, [
      'hide_empty' => false,
      'include' => [],
      'meta_query' => [
        'relation' => 'AND',
        [
          'key' => 'location_type',
          'value' => 'Ville',
          'compare' => '='
        ],
        [
          'key' => 'Département',
          'value' => $location->name,
          'compare' => '='
        ],
        [
          'key' => 'big_city',
          'value' => true,
          'compare' => '='
        ]
      ]
    ]);
    break;
  case 'Ville':
    $locationName = 'à ' . $location->name.' ('.$location_code_postal.')';
    $locationIntro = 'Trouvez ci dessous la liste des villes proches de ' . $location->name . ' ou nous distribuons nos Produits.';
    $departement = get_field('departement', 'location_' . $location->term_id);
    $departementID = get_term_by('name', $departement, 'location')->term_id;
    $region = get_field('region', 'location_' . $location->term_id);
    $locationSituation = '<p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products '. $locationName.' </strong> et commercialise ses produits à base d\'aloe vera dans <strong class="invisible">tout le département <a href="'.get_term_link($departementID).'" title="Distributeur Forever Living Products '.$departement.'">'.$departement.'</a>.</strong> </p>';
    break;
}


?>

<div class="headerPicture">
  <?php write_src_set_image(get_post_thumbnail_id($pageFrance->ID), '.headerPicture__imageBlur, .headerPicture__image'); ?>
  <div class=" headerPicture__imageBlur"></div>
  <div class="headerPicture__image">
    <div class="headerPicture__image__text">
      <h1 class="headerPicture__image__text__title is_center">Distributeur Forever Living <br><?= $location->name; ?></h1>
      <h2 class="headerPicture__image__text__subtitle is_center">Distributeur Forever Living Products France</h2>
    </div>
  </div>
</div>

<main class="main">

  <!-- Breadcrumb -->
  <nav class="breadcrumb">
    <ul class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?= get_permalink($pageFrance->ID); ?>" title="Forever Living Products France" itemprop="item"> <meta itemprop="name" content="France" />France</a><meta itemprop="position" content="1" />
      </li>
      <?php if ($location_type === 'Région') : ?>
        <li class="breadcrumb__list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <meta itemprop="name" content="<?= $location->name ?>" />
        <div itemprop="item"><?= $location->name ?></div>
        <meta itemprop="position" content="2" />
        </li>
      <?php endif; ?>

      <?php if ($location_type === 'Département' || $location_type === 'Ville') :
        
      ?>
        <li class="breadcrumb__list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="<?= get_term_link($region, 'location') ?>" title="Distributeur Forever Living <?= $region ?>" itemprop="item" ><?= $region ?></a>
          <meta itemprop="name" content="<?= $region ?>" />
          <meta itemprop="position" content="2" />
        </li>
      <?php endif; ?>
      <?php if ($location_type === 'Ville') :?>
        <li class="breadcrumb__list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="<?= get_term_link($departement, 'location') ?>" title="Distributeur Forever Living <?= $departement ?>" itemprop="item"><?= $departement ?></a>
          <meta itemprop="name" content="<?= $departement ?>" />
          <meta itemprop="position" content="3" />
        </li>
      <?php endif; ?>
      <?php if ($location_type === 'Ville' || $location_type === 'Département' ) :?>
      <li class="breadcrumb__list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <div itemprop="item"><?= $location->name ?></div>
          <meta itemprop="name" content="<?= $location->name ?>" />
          
          <meta itemprop="position" content="<?= $location_type === 'Ville' ? '4' : '3'?>" />
        </li>
        <?php endif; ?>
    </ul>
  </nav>
  <section class="products topSeller">
    <header class="products__header">
      <h2 class="products__header__title title title--2">Produits Forever Les plus vendus <?= $locationName; ?></h2>

      <p class="products__header__subtitle">Vos produits Forever Living préférés, découvrez les produits les plus vendus <?= $locationName; ?>.
        <a href=<?= get_term_link('top-vente', 'product_badge'); ?> class="products__header__subtitle__link" title="Meilleures ventes des produits Forever">Voir Tous</a>
      </p>
    </header>
    <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'favorite', 'methode' => 'filter']); ?>
  </section>


  <section class="accordion">
    <header class="accordion__header js-accordion">
      <h2 class="accordion__header__title title title--2">
        Vous recherchez un distributeur Forever Living Products <?= $locationName; ?>
      </h2>
      <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
    </header>
    <main class="accordion__main">
    <?= $locationSituation ?>
      <p><strong><?= $locationIntro ?></strong> </p>

      <!-- REGIONS -->
      <?php if ($location_type === 'Région') : ?>
        <?php foreach ($locationTerms as $locationTerm) : ?>
          <h3><a href="<?= get_term_link($locationTerm->term_id, 'location') ?>"><?= $locationTerm->name ?></a></h3>
          <?php
          $cities = get_terms($taxonomy, [
            'hide_empty' => false,
            'include' => [],
            'meta_query' => [
              'relation' => 'AND',
              [
                'key' => 'location_type',
                'value' => 'Ville',
                'compare' => '='
              ],
              [
                'key' => 'departement',
                'value' => $locationTerm->name,
                'compare' => '='
              ],
              [
                'key' => 'big_city',
                'value' => true,
                'compare' => '='
              ],

            ]
          ]);
          ?>
          <p>
            <?php foreach ($cities as $city) : ?>
              <a href="<?= get_term_link($city->term_id, 'location') ?>"> <?= $city->name ?></a> ,
            <?php endforeach; ?>
          </p>

      <?php
        endforeach;
      endif;
      ?>

      <!-- DEPARTEMENTS -->

      <?php if ($location_type === 'Département') : ?>
        <?php
        $cities = get_terms($taxonomy, [
          'hide_empty' => false,
          'include' => [],
          'meta_query' => [
            'relation' => 'AND',
            [
              'key' => 'location_type',
              'value' => 'Ville',
              'compare' => '='
            ],
            [
              'key' => 'departement',
              'value' => $location->name,
              'compare' => '='
            ],
            [
              'key' => 'big_city',
              'value' => true,
              'compare' => '='
            ]
            

          ]
        ]);
        ?>
        <p>
          <?php
          foreach ($cities as $city) : ?>
            <a href="<?= get_term_link($city->term_id, 'location') ?>"> <strong><?= $city->name ?></strong> </a> ,
          <?php endforeach; ?>
        </p>
      <?php endif;
      ?>


      <!-- VILLES -->
      <?php if ($location_type === 'Ville') : ?>
        
        <?php
        $lat1 = get_field('latitude_field', 'location_' . $location->term_id);
        $lng1 = get_field('longitude_field', 'location_' . $location->term_id);
        
        $cities = get_terms($taxonomy, [
          'hide_empty' => false,
          'include' => [],
          'meta_query' => [
            'relation' => 'AND',
            [
              'key' => 'location_type',
              'value' => 'Ville',
              'compare' => '='
            ],
            [
              'key' => 'departement',
              'value' => $departement,
              'compare' => '='
            ],
          ]
        ]);
        ?><p><?php
            foreach ($cities as $city) :
              $lat2 = get_field('latitude_field', 'location_' . $city->term_id);
              $lng2 = get_field('longitude_field', 'location_' . $city->term_id);
              if (distance($lat1, $lng1, $lat2, $lng2) <= 15 && $location->term_id != $city->term_id) :
            ?>
              <?= $city->name ?>  ,
          <?php endif;
            endforeach; ?>
        </p>
      <?php endif; ?>




    </main>
  </section>
  <section class="accordion">
    <header class="accordion__header js-accordion">
      <h2 class="accordion__header__title title title--2">
        Vous souhaitez devenir distributeur Forever Living Products <?= $locationName; ?>
      </h2>
      <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
    </header>
    <main class="accordion__main">
      <p>Aloe Vera Forever est distributeur agréé <strong class="invisible">Forever Living Products <?= $locationName; ?></strong> recrute et forme des distributeurs <strong class="invisible">Forever Living Products dans toute la France</strong>. </p>
      <p>Si vous souhaitez rejoindre notre équipe de distributeurs et vous aussi commencer à gagner de l'argent en recommandant nos produits autour de vous n'hésitez pas à nous contacter.
      </p>
    </main>


  </section>


  <!-- New products -->
  <section class="products newProducts">
    <header class="products__header">
      <h2 class="products__header__title title title--2">Nouveaux produits Forever Living <?= $locationName; ?></h2>
      <p class="products__header__subtitle">
        Vos nouveaux produits préférés de la marque Forever Living fraichement arrivés sur le marché français
        <a href=<?= get_term_link('nouveaute', 'product_badge'); ?> class="products__header__subtitle__link" title="Nouveaux produits Forever">Voir Tous
        </a>
      </p>
    </header>
    <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'nouveaute', 'methode' => 'filter']); ?>
  </section>
  <!-- Last Posts -->
  <section class="lastPosts">
    <header class="lastPosts__header">
      <h2 class="lastPosts__header__title title title--2">
        Derniers articles du blog Forever <?= $locationName; ?>
      </h2>
    </header>
    <main class="lastPosts__main swiper-container">
      <?php
      $recent_posts_args = [
        'numberposts' => 5,
        'post_status' => 'publish'
      ];
      $recent_posts = wp_get_recent_posts($recent_posts_args, 'object');

      ?>
      <div class="lastPosts__main__list swiper-wrapper">
        <?php foreach ($recent_posts as $post) : ?>
          <?php get_template_part('template-parts/posts/latestPost/latestPost', null, $post); ?>
        <?php endforeach; ?>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </main>

  </section>

</main>
<?php get_footer(); ?>