<?php 
$badge = get_the_terms( get_the_ID() , 'product_badge') ; 
$best_seller_product = [];
$newest_product = [];
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

<article class="product swiper-slide">
  <header class="product__header">
    <a href="<?php the_permalink() ?>" class="product__header__link" title="<?php the_title() ?>"></a>
    <ul class="product__header__badge">
      <?php if ($best_seller_product === 1) : ?>
        <li class="badge badge--top">Top Vente</li>
      <?php endif ?>
      <?php if (get_field('product_aloe_percentage') != 0) : ?>
        <li class="badge badge--aloe"><?= get_field('product_aloe_percentage') ?>% d'aloe</li>
      <?php endif;?>
      <?php if ($newest_product === 1) : ?>
        <li class="badge badge--new">Nouveau !</li>
      <?php endif ?>
    </ul>

    <?php the_post_thumbnail('medium', ['class' => 'product__header__picture', 'title' => get_the_title()]) ?>
    <div class="product__header__overlay overlay">
      <a class=" buttonOverlay buttonOverlay--readmore" href="<?php the_permalink() ?>" title="<?php the_title() ?>">Voir le produit !</a>
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
  </header>
  <main class="product__main">
    <p class="product__main__title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"> <?php the_title() ?></a></p>
    <p class="product__main__subtitle"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>">Ref. <?= get_field('product_ref') ?> | <?= get_field('product_price') ?> €</a></p>
  </main>
</article>