<?php

$product_ID = get_field('block_product_product_relation_field')[0];
$image_ID = get_post_thumbnail_id($product_ID);
$product_description = get_field('block_product_product_description_field');
$badge = get_the_terms($product_ID , 'product_badge') ; 
$best_seller_product = [];
$newest_product = [];
// Calcul de la note moyenne du produit

$comments = get_comments(['post_id' => $product_ID, 'status' => 'approve']);
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



if ($badge){
$newest_product = count(array_filter($badge, function($obj){
  if (isset($obj->slug)) {
      if($obj->slug == 'nouveaute') return true;
  }
  return false;
}));

$best_seller_product = count(array_filter($badge, function($obj){
  if (isset($obj->slug)) {
      if($obj->slug == 'top-vente') return true;
  }
  return false;
}));
};
//dump($block);

$id = 'product-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ProductBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>


<div class="blockProduct">

  <div class="blockProduct__header">
  <div class="overlay">
  <a class=" buttonOverlay buttonOverlay--readmore" href="<?php the_permalink($product_ID) ?>" title="<?= get_the_title($product_ID) ?>">Voir le produit !</a>
  <?php  if($product_rate != null) :?>
      <p class="product__header__overlay__stars">
      <?php for ($i = 1; $i <=$product_rate ; $i++) :?>
        <i class="fa fa-star" aria-hidden="true"></i>
      <?php endfor; ?>
      <?php if(is_float($product_rate) && $product_rate != null ):?>
        <i class="fa fa-star-half-o" aria-hidden="true"></i>
       <?php endif;?> 
      </p>
      <p class="product__header__overlay__comment"><?= $product_rate_count ?> avis clients !</p>
      <?php endif; ?>
  </div>
  <ul class="product__header__badge">
      <?php if ($best_seller_product === 1) : ?>
        <li class="badge badge--top">Top Vente</li>
      <?php endif ?>
      <?php if (get_field('product_aloe_percentage',$product_ID) != 0) : ?>
        <li class="badge badge--aloe"><?= get_field('product_aloe_percentage',$product_ID) ?>% d'aloe</li>
      <?php endif;?>
      <?php if ($newest_product === 1) : ?>
        <li class="badge badge--new">Nouveau !</li>
      <?php endif ?>
    </ul>
  <?php write_responsive_image($image_ID, 'medium', 'blockProduct__header__picture', 0); ?>
  </div>

  <div class="blockProduct__title">
  <a href="<?php the_permalink($product_ID) ?>" title="<?= get_the_title($product_ID) ?>"><p><?= get_the_title($product_ID) ?></p></a>
  </div>

  <div class="blockProduct__meta">
  <a href="<?php the_permalink($product_ID) ?>" title="<?= get_the_title($product_ID) ?>">Ref. <?= get_field('product_ref',$product_ID); ?> | <?= get_field('product_price',$product_ID); ?> €</a>
  </div>

<div class="blockProduct__main">
  <p><?=$product_description?></p>
</div>

<div class="blockProduct__footer">
<?php if(!get_field('product_stop_field', $product_ID)) : ?>
          
<?php $orderUrl =get_field('option_page_shopURL_field', 'option').get_field('FBONum_field', 'option').'/'.get_field('product_ref',$product_ID); ?>
<a href="<?= $orderUrl ?>" class="singleProduct__header__action__order button button--order" title="Commander <?php the_title(); ?> sur la boutique en ligne" rel="nofollow" target="_blank">
Commander
      </a>
      <?php endif ; ?>
  
</div>

</div>