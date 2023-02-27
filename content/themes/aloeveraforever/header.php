<?php

//Logo

use RankMath\Sitemap\Providers\Post_Type;



$page_custom_classes ="" ;
if (is_singular('post') || is_singular('cocon') ){
  $page_custom_classes ="blog-post-article" ;

};


$canonical_link = 0;
if (is_singular('product')){
  $is_variant = get_field('product_is_variant');
if($is_variant){
  $original_product_ID = get_field('product_variant')[0]->ID;
  $canonical_link = get_permalink($original_product_ID);
} 

};

if(is_tax(Post_Type_Product::TAXONOMY_NAME_BADGE)){
  $canonical_link = ALL_PRODUCTS_URL;
}



$logo_words_array = explode(' ', get_bloginfo( 'name' ) ,2);
$taxonomy =  Post_Type_Product::TAXONOMY_NAME_CATEGORY;
$tax_terms = get_terms($taxonomy, [
  'hide_empty' => false,
  'include' => [],
  'exclude' => [42]
]);
$terms_sort_by_order = [];
$x = 0; 
foreach ($tax_terms as $tax_term) {
  $order = get_field('category_order_field', $tax_term);
  $subtitle = get_field('category_subtitle_field', $tax_term);
  $term_link = get_term_link($tax_term);
  $terms_sort_by_order[$order] = (object) array(
    'name' => $tax_term->name,
    'slug' => $tax_term->slug,
    'term_id' => $tax_term->term_id,
    'subtitle' => $subtitle,
    'link' => $term_link,
    'x' => $x,
  );
  $x++;
}
ksort($terms_sort_by_order, SORT_NUMERIC);


$args = [
  'hide_empty'      => true,
  'exclude' => [1,46305],
];
$blog_categories = get_categories($args);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php  if(is_tax(Post_Type_Distributor::TAXONOMY_NAME_LOCATION)){
    $location = get_queried_object();
    $location_type = get_field('location_type_field', 'location_' . $location->term_id);
    $departement = get_field('departement', 'location_' . $location->term_id);
    $departementID = get_term_by('name', $departement, 'location')->term_id;
    if ($location_type === 'Ville'){
      if(!get_field('big_city')){
        echo '<meta name="robots" content="noindex, follow, nocache">';
    }
  }
  }?>
</div>
  <?php wp_head(); ?>
  <?php if(is_home()):?>
  <!-- Shema organisation -->
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"organization","name":"<?=bloginfo( 'name' );?>","url":"<?= get_home_url();?>"}</script>
  <!-- Shema organisation -->
<?php endif ; ?>
  <!-- Shema site link -->
  <script type="application/ld+json">
  {"@context": "https://schema.org","@type":"WebSite","url":"<?= get_home_url();?>","potentialAction": { "@type": "SearchAction","target": "<?= get_home_url();?>?s={search_term_string}","query-input": "required name=search_term_string"}}
  </script>
<!-- Shema site link -->
<?php //$canonical_link ? '<link rel="canonical" href="'.$canonical_link.'" />' : '' ;?>

</head>
<body <?php body_class( $page_custom_classes ); ?>>
<div class="fullOverlay"></div>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v11.0&appId=1994970534156032&autoLogAppEvents=1"
    nonce="PzJvz49M"></script>

  <div class="container <?= is_singular('post') || is_category() || is_page('blog') || is_singular('cocon') ? 'container--blog' : '' ?> ">
    <!--<div class="alert shipping">
      Délai de livraison dans les 1-3 jours ouvrables
    </div>-->
    <header class="header">
      <img src=
        <?php 
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        echo $image[0]; 
        ?> 
        alt="logo aloe vera forever living" class="logo">
        <?php if(is_home()):?>
          <h1 class="brand js-brand">
            <a href=<?= get_home_url();?> title="<?=bloginfo( 'name' );?>">
            <?=bloginfo( 'name' );?>
            
          </a> 
          </h1>
        <?php else: ?>
          <p class="brand js-brand">
            <a href=<?= get_home_url();?>  title="<?=bloginfo( 'name' );?>">
            <?=bloginfo( 'name' );?>
          </a> 
          </p>
        <?php endif ?>
      

      <nav class="mobilemenu js-mobileMenu">
        
        <ul class="mobilemenu__list">
          <div class="mobilemenu__list__icon js-closeIcon">
            <svg class="mobilemenu__list__icon__svg" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Calque_1" x="0px" y="0px"
              viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
              <path fill="currentColor"
                d="M103.6,100l95.6-95.6c1-1,1-2.6,0-3.6c-1-1-2.6-1-3.6,0L100,96.4L4.4,0.8c-1-1-2.6-1-3.6,0s-1,2.6,0,3.6L96.4,100L0.8,195.6  c-1,1-1,2.6,0,3.6s2.6,1,3.6,0l95.6-95.6l95.6,95.6c1,1,2.6,1,3.6,0c1-1,1-2.6,0-3.6L103.6,100z" />
            </svg>
          </div>
          <li class="mobilemenu__list__item"><a href="<?= ALL_PRODUCTS_URL; ?>" class="mobilemenu__list__item__link" title="Produits aloe vera Forever" >Produits</a>
            <ul class="mobilemenu__list__item__sublist">
            <li class="mobilemenu__list__item__sublist__subitem">
              <a href="<?= get_term_link('gel-aloe-vera', 'product_badge'); ?>"
                  class="mobilemenu__list__item__sublist__subitem__link"
                   title="Gel d'aloe vera - Tous les produits">
                   Gel d'aloe vera
              </a>
            </li>
              <?php foreach($terms_sort_by_order as $term):?>
              <li class="mobilemenu__list__item__sublist__subitem"><a href="<?= $term->link ?>"
                  class="mobilemenu__list__item__sublist__subitem__link" title="<?= $term->name ?>"><?= $term->name ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li class="mobilemenu__list__item"> <a href="<?= ALOE_VERA_URL; ?>" class="mobilemenu__list__item__link" title="Aloe vera" >Aloe vera</a> </li>
          <li class="mobilemenu__list__item"> <a href="<?= FOREVER_LIVING_URL; ?>" class="mobilemenu__list__item__link" title="Forever Living Products" >Forever Living</a> </li>

          <li class="mobilemenu__list__item"><a href="<?= JOIN_US_URL; ?>" class="mobilemenu__list__item__link" title="Devenez distributeur Forever" >Rejoignez-nous !</a></li>
          <li class="mobilemenu__list__item"><a href="<?= ORDER_URL; ?>" class="mobilemenu__list__item__link" title="Commander les produits Forever Living"  >Commander</a></li>
          <li class="mobilemenu__list__item"><a href="<?= BLOG_URL; ?>" class="mobilemenu__list__item__link" title="Blog aloe vera Forever" >Blog</a>
            
          </li>
        </ul>
        <div class="mobilemenu__emptyspace js-emptySpace"></div>
      </nav>



      <nav class="mainmenu">
        <ul class="mainmenu__list">
          <li class="mainmenu__list__item"><a href="<?= ALL_PRODUCTS_URL; ?>" class="mainmenu__list__item__link" title="Produits aloe vera Forever" >Produits</a>
            <ul class="mainmenu__list__item__sublist">
            <li class="mainmenu__list__item__sublist__subitem">
                <a href="<?= get_term_link('gel-aloe-vera', 'product_badge'); ?>" class="mainmenu__list__item__sublist__subitem__link" title="Gel d'aloe vera - Tous les produits">
                Gel d'aloe vera
                </a>
              </li>
            <?php foreach($terms_sort_by_order as $term):?>
              <li class="mainmenu__list__item__sublist__subitem">
                <a href="<?= $term->link ?>" class="mainmenu__list__item__sublist__subitem__link" title="<?= $term->name ?>">
                <?= $term->name ?>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li class="mainmenu__list__item"> <a href="<?= ALOE_VERA_URL; ?>" class="mainmenu__list__item__link" title="Aloe vera" >Aloe vera</a> </li>
          <li class="mainmenu__list__item"> <a href="<?= FOREVER_LIVING_URL; ?>" class="mainmenu__list__item__link" title="Forever Living Products" >Forever Living</a> </li>

          <li class="mainmenu__list__item"><a href="<?= JOIN_US_URL; ?>" class="mainmenu__list__item__link" title="Devenez distributeur Forever" >Rejoignez-nous !</a></li>
          <li class="mainmenu__list__item"><a href="<?= ORDER_URL; ?>" class="mainmenu__list__item__link" title="Commander les produits Forever Living">Commander</a></li>
        </ul>
        <i class="fa fa-bars mainmenu__icon js-burger-icon" aria-hidden="true"></i>
      </nav>
      <nav class="header__actions">
        <form role="search" method="get" id="searchform" class="header__actions__search js-search-bar" action="<?= WP_HOME ?>" >
          <input type="s" name="s" id="s" class="header__actions__search__input js-search-bar-input"
            placeholder="recherche..." autocomplete="off">
            
            <input type="hidden" value="post" name="post_type[]" />
            <input type="hidden" value="<?= Post_Type_Product::NAME ?>" name="post_type[]" />
          <i class="fa fa-times header__actions__search__closeIcon js-search-close-icon" aria-hidden="true"></i>
        </form>

        <ul class="header__actions__list">
          <li class="header__actions__list__item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon--user js-user-icon" viewBox="0 0 33 31">
              <!-- <path
                d="M30.2 30.2c0-5.9-4.1-10.7-9.8-12.3 3.1-1.4 5.4-4.6 5.4-8.2 0-5.1-4.2-9.1-9.2-9.1S7.3 4.7 7.3 9.7c0 3.7 2.2 6.8 5.4 8.2-5.6 1.6-9.8 6.4-9.9 12.3">
              </path> -->
            </svg>
          </li>
          <li class="header__actions__list__item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon--search js-search-icon" viewBox="0 0 33 31">
              <path d="M12.7 22.3c6.1 0 11-4.9 11-11s-4.9-11-11-11-11 4.9-11 11 5 11 11 11"></path>
              <circle cx="12.7" cy="11.5" r="11"></circle>
              <path d="M28.5 30.9L18.2 20.5l2.2-1.8 10.1 10.2z" class="icon__handle"></path>
            </svg>
          </li>
        </ul>

      </nav>
      <div class="infobar">
        <div class="infobar__info"> Livraison 24h - 72h jours ouvrés </div>
      </div>
    </header>
