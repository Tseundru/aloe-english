<?php get_header(); ?>

<?php
$id = get_the_ID();
$category_term = get_the_terms($id, Post_Type_Product::TAXONOMY_NAME_CATEGORY)[0];
$category_term_name = $category_term->name;
$category_term_link = get_term_link($category_term);
$pictures_gallery = get_field('product_picture_gallery_field');
$label_terms = get_the_terms($id, Post_Type_Product::TAXONOMY_NAME_LABEL) ? get_the_terms($id, Post_Type_Product::TAXONOMY_NAME_LABEL) : [];
$ingredient_terms = get_the_terms($id, Post_Type_Product::TAXONOMY_NAME_INGREDIENT) ? get_the_terms($id, Post_Type_Product::TAXONOMY_NAME_INGREDIENT) : [];

$is_pack = get_field('product_pack');
$is_variant = get_field('product_is_variant');
if($is_variant){
  $original_product_ID = get_field('product_variant')[0]->ID;
  
}

// Calcul de la note moyenne du produit
$comments = get_comments(['post_id' => $id, 'status' => 'approve']);
$rates_array = [];
$average = null;
$product_rate = null;
$product_rate_count = null;

if ($comments) {
  foreach ($comments as $comment) {
    array_push($rates_array, get_field('note', $comment));
  }
  if ($rates_array != null) {
    $average = array_sum($rates_array) / count($rates_array);
  }
  $product_rate = $average;
  $product_rate_count = count($rates_array);

 
}

?>
<!-- Microdonnées -->

<!-- Fil d'ariane -->

<div itemscope itemtype="https://schema.org/BreadcrumbList">

  <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="<?= get_home_url(); ?>">
      <meta itemprop="name" content="Home" />
    </a>
    <meta itemprop="position" content="1" />
  </div>

  <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="<?= ALL_PRODUCTS_URL; ?>">
      <meta itemprop="name" content="Produits Forever" />
    </a>
    <meta itemprop="position" content="2" />
  </div>

  <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="<?= $category_term_link ?>">
      <meta itemprop="name" content="<?= $category_term_name ?>" />
    </a>
    <meta itemprop="position" content="3" />
  </div>

  <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <meta itemprop="name" content="<?php the_title(); ?>" />
    <meta itemprop="position" content="4" />
  </div>
</div>

<!--
<div itemscope="" itemtype="https://schema.org/BreadcrumbList">
   
    <div itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="#">
        <meta itemprop="name" content="Home"></a>
        <meta itemprop="position" content="1">
    </div>

    <div itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="#">
        <meta itemprop="name" content="Produits Forever"></a>
        <meta itemprop="position" content="2">
    </div>

    <div itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="#">
        <meta itemprop="name" content="Fitness &amp; Minceur"></a>
        <meta itemprop="position" content="3">
    </div>

    <div itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
        <meta itemprop="name" content="Forever Fiber™">
        <meta itemprop="position" content="4">
    </div>
</div>
-->


<!-- Produits -->
<div>
  <div itemtype="https://schema.org/Product" itemscope>
    <meta itemprop="mpn" content="<?= get_field('product_ref'); ?>" />
    <meta itemprop="name" content="<?php the_title(); ?>" />
    <link itemprop="image" href="<?php the_post_thumbnail_url(); ?>" />
    <meta itemprop="description" content="<?= get_field('product_intro'); ?>" />
    <div itemprop="offers" itemtype="https://schema.org/Offer" itemscope>
      <link itemprop="url" href="<?php the_permalink(); ?>" />
      <meta itemprop="availability" content="https://schema.org/InStock" />
      <meta itemprop="priceCurrency" content="EUR" />
      <meta itemprop="itemCondition" content="https://schema.org/UsedCondition" />
      <meta itemprop="price" content="<?= get_field('product_price'); ?>" />
      <meta itemprop="priceValidUntil" content="" />
    </div>
    <?php if ($comments) : ?>
      <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
        <meta itemprop="reviewCount" content="<?= $product_rate_count ?>" />
        <meta itemprop="ratingValue" content="<?= $product_rate ?>" />
        <meta itemprop="bestRating" content="5" />
      </div>
      <?php foreach ($comments as $comment) : ?>
        <div itemprop="review" itemtype="https://schema.org/Review" itemscope>
          <div itemprop="author" itemtype="https://schema.org/Person" itemscope>
            <meta itemprop="name" content="<?= get_comment_author($comment) ?>" />
          </div>
          <div itemprop="reviewRating" itemtype="https://schema.org/Rating" itemscope>
            <meta itemprop="ratingValue" content="<?= get_field('note', $comment) ?>" />
            <meta itemprop="bestRating" content="5" />
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <meta itemprop="sku" content="" />
    <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
      <meta itemprop="name" content="Forever Living Product" />
    </div>
  </div>
</div>



<main class="main singleProduct ">
  <!-- Breadcrumb -->
  <nav class="breadcrumb">
    <ul class="breadcrumb__list">
      <li class="breadcrumb__list__item">
        <a href="<?= get_home_url(); ?>/produits-forever/" class="breadcrumb__list__item__link" title="Produits Forever">
          Produits Forever
        </a>
      </li>
      <li class="breadcrumb__list__item">
        <a href=<?= $category_term_link ?> class="breadcrumb__list__item__link" title="<?= $category_term_name ?>">
          <?= $category_term_name ?>
        </a>
      </li>
      <li class="breadcrumb__list__item">
        <?php the_title(); ?>
      </li>
    </ul>
  </nav>

  <div class="productGallery productGallerySwipperContainer">
    <div class="productGallery__list swiper-wrapper">
      <?php
      foreach ($pictures_gallery as $picture) :
        $img_id = $picture['ID'];
        $size = 'large';
        $title = get_post($img_id)->post_title;
        $image_src = wp_get_attachment_image_url($img_id, $size);
        $image_srcset = wp_get_attachment_image_srcset($img_id, $size);
        $alt = isset(get_post_meta($img_id, '_wp_attachment_image_alt')[0]) ? get_post_meta($img_id, '_wp_attachment_image_alt')[0] : $title;
        $caption = wp_get_attachment_caption($img_id);
        $sizes = wp_get_attachment_image_sizes($img_id);
      ?>
        <figure class="swiper-slide">
          <img src=<?= $image_src ?> alt=<?= $alt ?> srcset=<?= $image_srcset ?> class="productGallery__list__image" sizes=<?= $sizes ?>>
        </figure>
      <?php endforeach; ?>
    </div>
    <div class="productGallerySwipperContainerPagination"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>

  <!-- Product Header-->
  <div class="singleProduct__header">
    <a href="<?=$category_term_link ?>"class="singleProduct__header__category " title="Produit Forever <?=$category_term_name?>">
      <?= $category_term_name ?>
      </a>
    <h1 class="singleProduct__header__title productTitle">
      <?php the_title(); ?>

    </h1>

    <h2 class="singleProduct__header__subtitle productSubtitle">
      <?= $is_variant ? get_field('product_subtitle', $original_product_ID) : get_field('product_subtitle'); ?>
    </h2>
    <!-- singleProduct Excerpt-->
    <p class="singleProduct__header__excerpt">
      <?= $is_variant ? get_field('product_intro', $original_product_ID) : get_field('product_intro'); ?>

    </p>

    <!-- Average Rating -->
    <div class="singleProduct__header__averageRating">
      <a href="#evaluations" title="Laisser un avis">
        <?php
        if ($product_rate != null) {
          echo ('<ul class="ratingStars">');
          for ($i = 1; $i <= $product_rate; $i++) {
            echo ('<li class="ratingStars__star"><i class="fa fa-star" aria-hidden="true"></i></li>');
          }
          if (is_float($product_rate) && $product_rate != null) {
            echo ('<li class="ratingStars__star"><i class="fa fa-star-half-o" aria-hidden="true"></i></li>');
          }
          //echo('<li>'.$product_rate.'/5 - '.$product_rate_count.' Votes</li>');
          echo ('</ul>');
        }
        ?>
        <p class="singleProduct__header__averageRating__count">
          (
          <?php if ($product_rate_count) {
            echo $product_rate_count;
          } else {
            echo '0';
          } ?>
          ) avis | Ajouter un avis </p>
      </a>
    </div>
<?php 
$is_productStop = get_field('product_stop_field');
$replacementProduct="";
if($is_productStop){
  if(get_field('product_replace_field')){
    $replacementProduct = get_field('product_replace_field')[0]->ID;
  }
   
}
?>
    <!-- singleProduct Data-->
    <div class="singleProduct__header__data">
      <p class="singleProduct__header__data__price productTitle">
        <?= $is_productStop ? '0,00' : get_field('product_price'); ?>€
        <?php if(!$is_productStop) : ?>
        <a href="<?= ORDER_URL.'#garanty' ?>">
          <img src="<?= wp_get_attachment_image_url( 944, 'full' ); ?>" alt="garantie satisfait ou remboursé 30 jours" class="singleProduct__header__data__price__satisfaction">
        </a>
        <?php  endif ; ?>
      </p>
      <p>Prix France Métropole</p>
      <p class="singleProduct__header__data__ref">
        <?php if(!$is_productStop ): ?>
        Réf: <?= get_field('product_ref'); ?>
        <?php else : ?>
          
          Ce produit n'est plus commercialisé en France ! <?= $replacementProduct ? 'Il à été remplacé par <a href="'.get_permalink($replacementProduct).'">'.get_post($replacementProduct)->post_title.'</a>' : '' ;?>
          <?php endif ;?>
      </p>
      
      <p class="singleProduct__header__data__content">
        Contenu :
      </p>
      <div class="singleProduct__header__data__content__detail">
        <p>
          <?= get_field('product_content'); ?>
        </p>
      </div>
    </div>

    <!-- singleProduct Button-->
    <script>
      function PopupWindow(source, strWindowToOpen) {
        var strWindowFeatures = "toolbar=no,resize=no,titlebar=no,";
        strWindowFeatures = strWindowFeatures + "menubar=no,width=413,height=600,maximize=null";
        window.open(strWindowToOpen, '', strWindowFeatures);
      }
    </script>
    <?php 
    $orderUrl =get_field('option_page_shopURL_field', 'option').get_field('FBONum_field', 'option').'/'.get_field('product_ref'); 
    $joinUrl = get_field('option_page_joinURL_field', 'option').get_field('FBONum_field', 'option'); 
   
    if(get_field('product_is_fbo_field')){
      $orderUrl = $joinUrl;
    }
    ?>

    <div class="singleProduct__header__action">
    <?php if(!$is_productStop) : ?>
      <a href="<?= $orderUrl ?>" class="singleProduct__header__action__order button button--order" title="Commander <?php the_title(); ?> sur la boutique en ligne" rel="nofollow" target="_blank">
        Acheter ce produit
      </a>
      <?php endif ; ?>
      <a href="<?= $joinUrl ?>" class="singleProduct__header__action__sell button  button button--sell" title="Devenir distributeur Forever Living" rel="nofollow" target="_blank">
        Vendre
      </a>
      <div class="singleProduct__header__action__share button button--social  ">
        <a class="button--social__icon" title="Partager sur Facebook" href="javascript:PopupWindow(this,'https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>');"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a class="button--social__icon" title="Partager sur Twitter" href="javascript:PopupWindow(this,' https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>');"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a class="button--social__icon" title="Partager sur Pinterest" href="javascript:PopupWindow(this,' https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php the_post_thumbnail_url(); ?>&description=<?php the_title(); ?>');"> <i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a class="button--social__icon" title="Partager sur Linkedin" href="javascript:PopupWindow(this,' https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>');"> <i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <a class="button--social__icon" title="Partager par mail" href="mailto:?&subject=%0A<?php the_title(); ?>&cc=&bcc=&body=<?php the_permalink(); ?>%0A<?php the_title(); ?>" target="_blank"> <i class="fa fa-envelope" aria-hidden="true"></i></a>
      </div>
    </div>

  </div>
  <!-- singleProduct Label-->
  <div class="singleProduct__label">
    <?php foreach ($label_terms as $term) : ?>
      <div class="seal popup--opener">
        <?php
        $img_id = get_field('label_picture_field', Post_Type_Product::TAXONOMY_NAME_LABEL . '_' . $term->term_id)['ID'];
        $size = 'thumbnail';
        $title = get_post($img_id)->post_title;
        $image_src = wp_get_attachment_image_url($img_id, $size);
        $image_srcset = wp_get_attachment_image_srcset($img_id, $size);
        $alt = isset(get_post_meta($img_id, '_wp_attachment_image_alt')[0]) ? get_post_meta($img_id, '_wp_attachment_image_alt')[0] : $title;
        $caption = wp_get_attachment_caption($img_id);
        $sizes = wp_get_attachment_image_sizes($img_id);
        ?>
        <img class="seal__image" src="<?= $image_src ?>" srcset="<?= $image_srcset ?>" alt="<?= $alt ?>" sizes="<?= $sizes ?>">
      </div>
      <div class="seal__popup popup">
        <div class="popup__closeIcon">
          <svg class="popup__closeIcon__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Calque_1" x="0px" y="0px" viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
            <path fill="currentColor" d="M103.6,100l95.6-95.6c1-1,1-2.6,0-3.6c-1-1-2.6-1-3.6,0L100,96.4L4.4,0.8c-1-1-2.6-1-3.6,0s-1,2.6,0,3.6L96.4,100L0.8,195.6  c-1,1-1,2.6,0,3.6s2.6,1,3.6,0l95.6-95.6l95.6,95.6c1,1,2.6,1,3.6,0c1-1,1-2.6,0-3.6L103.6,100z" />
          </svg>
        </div>
        <div class="seal__popup__wrapper">
          <div class="seal__popup__wrapper__content">
            <img src="<?= $image_src ?>" srcset="<?= $image_srcset ?>" alt="<?= $alt ?>" sizes="<?= $sizes ?>" class="seal__popup__wrapper__content__image">
            <div class="seal__popup__wrapper__content__text">
              <p class="seal__popup__wrapper__content__text__title">
                <?= $term->name ?>
              </p>
              <p class="seal__popup__wrapper__content__text__description">
                <?= $term->description ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- singleProduct Features-->
  <div class="singleProduct__feature">
    <ul class="singleProduct__feature__list">
      <?php
      if(get_field('product_aloe_percentage')):?>
       <li class="feature">
          Contient plus de 
          <?= get_field('product_aloe_percentage')?>% de pur <a href="<?= get_term_link('gel-aloe-vera', 'product_badge'); ?>">gel d'aloe vera 
        </li></a> 
      <?php endif ;
      $strengths_list = $is_variant ? get_field('product_strengths_list', $original_product_ID) : get_field('product_strengths_list');
      if ($strengths_list):
      foreach ($strengths_list as $strength) :
      ?>
        <li class="feature">
          <?= $strength['strength'] ?>
        </li>
      <?php
      endforeach;
    endif;
      ?>
    </ul>
  </div>

  <!-- singleProduct Ingredients-->
  <section class="singleProduct__ingredient">
    <header class="singleProduct__ingredient__header">
      <h2 class="singleProduct__ingredient__header__title title title--2">
        <?php
        $Ingredient_title = $is_pack ? 'Les produits du pack ' : 'Ingrédients clés de ';
        echo $Ingredient_title;
        the_title();
        ?>
      </h2>
      <div class="singleProduct__ingredient__header__subtitle popup--opener">
        <?php $Ingredient_subtitle = $is_pack ? 'Détail du contenu du pack ' : 'Tous les ingrédients ';
        echo $Ingredient_subtitle;
        ?>

      </div>
      <div class="popup singleProduct__ingredient__header__popup">
        <div class="popup__closeIcon">
          <svg class="popup__closeIcon__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Calque_1" x="0px" y="0px" viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
            <path fill="currentColor" d="M103.6,100l95.6-95.6c1-1,1-2.6,0-3.6c-1-1-2.6-1-3.6,0L100,96.4L4.4,0.8c-1-1-2.6-1-3.6,0s-1,2.6,0,3.6L96.4,100L0.8,195.6  c-1,1-1,2.6,0,3.6s2.6,1,3.6,0l95.6-95.6l95.6,95.6c1,1,2.6,1,3.6,0c1-1,1-2.6,0-3.6L103.6,100z" />
          </svg>
        </div>
        <div class="singleProduct__ingredient__header__popup__wrapper popup__wrapper">
          <p>
            <?php $ingredient_list = get_field('product_pack') ?   get_field('product_content') :  get_field('product_ingredient_list');
            echo $ingredient_list;
            ?>
          </p>
        </div>
      </div>
    </header>
    <main class="singleProduct__ingredient__main">
      <?php if (!get_field('product_pack')) : ?>
        <ul class="singleProduct__ingredient__main__list">
          <?php

          foreach ($ingredient_terms as $term) :
          ?>
            <li class="ingredient">
              <p class="ingredient__title">
                <span class="ingredient__title__text">
                  <?= $term->name ?>
                </span>
              </p>
              <?php
              $img_id = get_field('ingredient_picture_field', Post_Type_Product::TAXONOMY_NAME_INGREDIENT . '_' . $term->term_id)['ID'];
              $size = 'thumbnail';
              $title = get_post($img_id)->post_title;
              $image_src = wp_get_attachment_image_url($img_id, $size);
              $image_srcset = wp_get_attachment_image_srcset($img_id, $size);
              $alt = isset(get_post_meta($img_id, '_wp_attachment_image_alt')[0]) ? get_post_meta($img_id, '_wp_attachment_image_alt')[0] : $title;
              $caption = wp_get_attachment_caption($img_id);
              $sizes = wp_get_attachment_image_sizes($img_id);
              ?>
              <img src="<?= $image_src ?>" srcset="<?= $image_srcset ?>" alt="<?= $alt ?>" sizes="<?= $sizes ?> " class="ingredient__image">
            </li>
          <?php
          endforeach;

          ?>
        </ul>
      <?php else : ?>
        <section class="products ">
          <header class="products__header">
          </header>
          <main class="products__main swiper-container">
            <div class="carousel swiper-wrapper">
              <?php $product_pack_products = get_field('product_pack_products');
              if ($product_pack_products) : ?>
                <?php foreach ($product_pack_products as $post) : ?>
                  <?php setup_postdata($post); ?>
                  <?php get_template_part('template-parts/product/product-card'); ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              <?php endif; ?>
            </div>
            <!-- If we need pagination -->
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
          </main>
        </section>
      <?php endif; ?>
    </main>


  </section>
<!-- REPRENDRE ICI -->
<?php 
$product_benefits = $is_variant ? get_field('product_benefits', $original_product_ID) : get_field('product_benefits');
?>
  <?php if ($product_benefits) : ?>
    <!--Bienfaits -->
    <section class="accordion singleProduct__benefit">
      <header class="accordion__header js-accordion">
        <h2 class="accordion__header__title title title--2">
          Bienfaits 
        </h2>
        <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
      </header>
      <main class="accordion__main">
        <?= $product_benefits; ?>
      </main>
    </section>
  <?php endif; ?>
  <!--Use -->
  <section class="accordion singleProduct__use">
    <header class="accordion__header js-accordion">
      <h2 class="accordion__header__title title title--2">
        Conseils d'utilisations 
      </h2>
      <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
    </header>
    <main class="accordion__main">
      <?= $is_variant ? get_field('product_how_to_use', $original_product_ID) : get_field('product_how_to_use'); ?>
    </main>
  </section>
<?php $product_faq = $is_variant ? get_field('product_faq', $original_product_ID) : get_field('product_faq'); ?>
  <?php if ($product_faq) : ?>
    <!--FAQ -->
    <section class="accordion singleProduct__faq">
      <header class="accordion__header js-accordion">
        <h2 class="accordion__header__title title title--2">
          F.A.Q 
        </h2>
        <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
      </header>
      <main class="accordion__main">
        <?= $product_faq; ?>
      </main>
    </section>
  <?php endif; ?>
<div class="singleProduct__additionalAccordions">

  <?php $additionnal_accordions = $is_variant ? get_field('product_more_info_accordeon', $original_product_ID) : get_field('product_more_info_accordeon');?>
  <?php if ($additionnal_accordions) :
      foreach ($additionnal_accordions as $accordion) :?>
    <section class="accordion">
  <header class="accordion__header js-accordion">
        <h2 class="accordion__header__title title title--2">
          <?= $accordion['more_info_accordeon_title']; ?>
        </h2>
        <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
      </header>
      <main class="accordion__main">
        <?= $accordion['more_info_accordeon_content']; ?>
      </main>
    </section>
      <?php endforeach; ?>
      <?php endif;?>
    </div>
  <!--singleProduct Media-->
  <div class="singleProduct__media">
    <?php
    $with_video = $is_variant ? get_field('product_with_video', $original_product_ID) : get_field('product_with_video');
    if ($with_video == true) :
      $iframe = $is_variant ? get_field('product_video', $original_product_ID) : get_field('product_video');
      preg_match('/src="(.+?)"/', $iframe, $src);
      preg_match('/title="(.+?)"/', $iframe, $title);
      $src = $src[1];
      $title = $title[1];
    ?>
      <div class="video--full lazyframe"  data-title="<?= $title; ?>" data-src="<?= $src; ?>" data-vendor="youtube" data-thumbnail="<?=get_field('product_image_no_video')['url'];?>">

      </div>
    <?php else : ?>
      <?php $no_vide_image = get_field('product_image_no_video')['url']; ?>
      <?php $altvideo = isset(get_post_meta(get_field('product_image_no_video')['ID'], '_wp_attachment_image_alt')[0]) ? get_post_meta(get_field('product_image_no_video')['ID'], '_wp_attachment_image_alt')[0] : $title; ?>
      <img src="<?= $no_vide_image ?>" alt= "<?= $altvideo ?>">
    <?php endif; ?>
  </div>
  <div class="singleProduct__image" style="background-image: url(<?=  get_field('product_image_description')['url']; ?>); background-repeat:no-repeat">
  </div>
  <!--singleProduct description-->
  <section class="singleProduct__description">
    <header class="singleProduct__description__header">
      <h2 class="singleProduct__description__header__title productTitle">
        <?php the_title(); ?>
      </h2>
    </header>
    <main class="singleProduct__description__main">
      <h3 class="singleProduct__description__header__subtitle productSubtitle">
        <?= $is_variant ? get_field('product_descrition_intro', $original_product_ID) : get_field('product_descrition_intro'); ?>
      </h3>
      <?= $is_variant ? get_field('product_description', $original_product_ID) : get_field('product_description'); ?>
    </main>
  </section>
</main>

<!--Produits relatifs -->
<section class="products relatedProducts">
  <header class="products__header">
    <h2 class="products__header__title title title--2">Ces produits pourraient vous intéreesser</h2>
  </header>
  <main class="products__main swiper-container">
    <div class="carousel swiper-wrapper">
      <?php $related_products = get_field('product_related_products');
      if ($related_products) : ?>
        <?php foreach ($related_products as $post) : ?>
          <?php 
          setup_postdata($post); 
          if(!get_field('product_stop_field')){
           get_template_part('template-parts/product/product-card');
          }
         endforeach; 
         ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
    <!-- If we need pagination -->

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
  </main>
</section>
<section class=" evaluations">
      <header class=" evaluations__header">
        <h2 class=" evaluations__header__title title title--2" id="evaluations">
          Avis clients
        </h2>
        <button class="button evaluations__header__button"> Laisser un avis </button>
<?php comments_template(); // Par ici les commentaires 
?>
</section>

<?php get_footer(); ?>