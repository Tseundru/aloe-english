<?php
//dump(get_queried_object());

$term_id = get_queried_object()->term_taxonomy_id;
$slug = get_queried_object()->slug;
$term_name = get_queried_object()->name;


$taxonomy_category =  Post_Type_Product::TAXONOMY_NAME_CATEGORY;
$taxonomy_badge =  Post_Type_Product::TAXONOMY_NAME_BADGE;
$taxonomy_label =  Post_Type_Product::TAXONOMY_NAME_LABEL;


$labels = get_terms([
  'taxonomy' => $taxonomy_label,
  'hide_empty' => false,
]);

//Filter and sort options
$filter_orderby = 'product_aloe_percentage';
$filter_order = 'DESC';
$filter_order_type = 'meta_value_num';
$filter_option = array();
$sort_option = '';


if (isset($_POST) && $_POST != null) {
  $sort_option = $_POST['sort'];
  $filter_option = isset($_POST['label']) ? $_POST['label'] : [];

  switch ($sort_option) {
    case 'aloe':
      $filter_orderby = 'product_aloe_percentage';
      $filter_order = 'DESC';
      $filter_order_type = 'meta_value_num';
      break;
    case 'ref':
      $filter_orderby = 'product_ref';
      $filter_order = 'ASC';
      $filter_order_type = 'meta_value_num';
      break;
    case 'rate':
      $filter_orderby = 'product_average_rate';
      $filter_order = 'DESC';
      $filter_order_type = 'meta_value_num';
      break;
    case 'price':
      $filter_orderby = 'product_price';
      $filter_order = 'ASC';
      $filter_order_type = 'meta_value_num';
      break;
    case 'abc':
      $filter_orderby = '';
      $filter_order = 'ASC';
      $filter_order_type = 'name';
      break;
  }
}

?>
<?php
if(is_page(ALL_PRODUCTS_SLUG)){
  $imageID = get_post_thumbnail_id();
  $catSubtitle = get_field('page_subtitle');
  $catTitle = get_the_title();
  $catDescription = get_the_content() ;

  $product_category_args = [
    'post_type'  => 'product',
    'order'         => $filter_order,
    'orderby'   => $filter_order_type,
    'meta_key'     => $filter_orderby,
    'posts_per_page' => -1,
    'tax_query' => [
      [
        'taxonomy' => $taxonomy_label,
        'field'    => 'slug',
        'terms'    => $filter_option,
        'operator' => 'AND',
      ],

    ]
  ];
}

if(is_tax($taxonomy_category)){
  $imageID = get_field('category_picture_field', $taxonomy_category . '_' . $term_id)['id'];
  $catSubtitle =  get_field('category_subtitle_field', $taxonomy_category . '_' . $term_id); 
  $catTitle = $term_name;
  $catDescription = term_description(); 
  $product_category_args = [
    'post_type'  => 'product',
    'order'         => $filter_order,
    'orderby'   => $filter_order_type,
    'meta_key'     => $filter_orderby,
    'posts_per_page' => -1,
    'tax_query' => [
      [
        'taxonomy' => $taxonomy_category,
        'field'    => 'slug',
        'terms'    => array($slug),
      ],
      [
        'taxonomy' => $taxonomy_label,
        'field'    => 'slug',
        'terms'    => $filter_option,
        'operator' => 'AND',
      ],

    ]
  ];
}

if(is_tax($taxonomy_badge)){
  $catTitle = $term_name;
  $imageID = get_field('badge_picture_field', $taxonomy_badge . '_' . $term_id)['id'];
  $catSubtitle =  get_field('badge_subtitle_field', $taxonomy_badge . '_' . $term_id); 
  $catDescription = term_description(); 
  $product_category_args = [
    'post_type'  => 'product',
    'order'         => $filter_order,
    'orderby'   => $filter_order_type,
    'meta_key'     => $filter_orderby,
    'posts_per_page' => -1,
    'tax_query' => [
      [
        'taxonomy' => $taxonomy_badge,
        'field'    => 'slug',
        'terms'    => array($slug),
      ],
      [
        'taxonomy' => $taxonomy_label,
        'field'    => 'slug',
        'terms'    => $filter_option,
        'operator' => 'AND',
      ],

    ]
  ];
}

//Liste des catégories produits
$tax_terms = get_terms($taxonomy_category, [
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

?>

<div class="headerPicture">
  <?php write_src_set_image($imageID, '.headerPicture__imageBlur, .headerPicture__image'); ?>
  <div class=" headerPicture__imageBlur"></div>
  <div class="headerPicture__image">
    <div class="headerPicture__image__text">
      <h1 class="headerPicture__image__text__title"><?= $catTitle; ?></h1>
      <h2 class="headerPicture__image__text__subtitle"><?= $catSubtitle ?></h2>
    </div>
  </div>

</div>
<main class="main productCategory">
  <nav class="breadcrumb">
    <ul class="breadcrumb__list">
      <li class="breadcrumb__list__item"> <a href="<?= ALL_PRODUCTS_URL; ?>" class="breadcrumb__list__item__link">Produits Forever</a> </li>
      <li class="breadcrumb__list__item"><?= $catTitle; ?></li>
    </ul>
  </nav>
  <form method="post" name="sort_form">
    <div class="productCategory__actions">
      <div class="productCategory__actions__sort">
        <span>Trier par :</span>
        <select onchange="document.sort_form.submit();" name="sort" id="sortSelect" class="productCategory__actions__sort__select">
          <option value="none">sélectionner une option</option>
          <option value="aloe" <?= $sort_option == "aloe" ? 'selected' : '' ?>>Teneur en aloe vera</option>
          <!-- rate -->
          <option value="price" <?= $sort_option == "price" ? 'selected' : '' ?>>Prix le plus bas</option>
          <option value="abc" <?= $sort_option == "abc" ? 'selected' : '' ?>>Alphabétiquement</option>
          <option value="ref" <?= $sort_option == "ref" ? 'selected' : '' ?>>Référence produit</option>

        </select>
        <span class="focus"></span>
      </div>

      <div class="filter filter--product">
        <div class="button button--filter popup--opener">Filtrer</div>

        <div class="popup filter__popup">
          <div class="popup__closeIcon">
            <svg class="popup__closeIcon__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Calque_1" x="0px" y="0px" viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
              <path fill="currentColor" d="M103.6,100l95.6-95.6c1-1,1-2.6,0-3.6c-1-1-2.6-1-3.6,0L100,96.4L4.4,0.8c-1-1-2.6-1-3.6,0s-1,2.6,0,3.6L96.4,100L0.8,195.6  c-1,1-1,2.6,0,3.6s2.6,1,3.6,0l95.6-95.6l95.6,95.6c1,1,2.6,1,3.6,0c1-1,1-2.6,0-3.6L103.6,100z" />
            </svg>
          </div>

          <div class="filter__popup__wrapper">
            <?php foreach ($labels as $label) : ?>
              <div class="filter__popup__wrapper__element">
                <input type="checkbox" name="label[]" value="<?= $label->slug ?>" id="<?= $label->slug ?>" class="filter__popup__wrapper__element__input" <?php if (in_array($label->slug, $filter_option)) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                          } ?>>
                <label for="<?= $label->slug ?>" class="filter__popup__wrapper__element__label"> <img src="<?= get_field('label_picture_field', $taxonomy_label . '_' . $label->term_id)['url'] ?>" alt="" class="filter__popup__wrapper__element__label__image"> </label>
                <p class="filter__popup__wrapper__element__text"><?= $label->name ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="button">Filtrer</button>
  </form>
  </div>
  </div>
  </div>
  <div class="productCategory__products">
  <?php if($term_name == 'Packs'): ?>
    <div class="productCategory__products__description">
      <p><?= $catDescription; ?></p>
      <?php endif; ?>
    <div class="productCategory__products__list">
      <?php

      $taxo_category_product_query = new WP_Query($product_category_args);
      if ($taxo_category_product_query->have_posts()) :
        while ($taxo_category_product_query->have_posts()) : $taxo_category_product_query->the_post();
        if(!get_field('product_stop_field')){
          get_template_part('template-parts/product/product-card');
        }
        endwhile;
      else :
        echo ('<h2> Aucun résultats pour votre recherche </h2>  ');
      endif;
      wp_reset_postdata();
      ?>
    </div>
    <?php if($term_name != 'Packs'): ?>
    <div class="blogPost__main__content">
    <?php if(is_page(ALL_PRODUCTS_SLUG)) :?>
      <p><?php the_content();?></p>
      <?php else : ?>
        <p><?= $catDescription ?></p>

      <?php endif; ?>
      <?php endif; ?>


    </div>
    <aside class="productCategory__products__category">
      <header class="productCategory__products__category__header">
        <h2 class="productCategory__products__category__header__title ">
          Produits Forever
        </h2>
      </header>
      <main class="productCategory__products__category__main">
        <ul class="productCategory__products__category__main__list">
          <li class="productCategory__products__category__main__list__item <?= is_page(ALL_PRODUCTS_SLUG) ? 'productCategory__products__category__main__list__item--active' : '' ?>">
            <a href="<?= ALL_PRODUCTS_URL; ?>" title="Produits Forever"> Tous les produits</a>
          </li>
          <li class="productCategory__products__category__main__list__item <?= is_page(ALL_PRODUCTS_SLUG) ? 'productCategory__products__category__main__list__item--active' : '' ?>">
            <a href="<?= get_term_link('gel-aloe-vera', 'product_badge'); ?>" title="Gel d'aloe vera - Tous les produits">Gel d'aloe vera</a>
          </li>
          <?php foreach ($terms_sort_by_order as $term) : ?>
            <li class="productCategory__products__category__main__list__item <?= $term->term_id == $term_id ?  'productCategory__products__category__main__list__item--active' : '' ?>">
              <a href="<?= $term->link ?>" title="<?= $term->name ?>"> <?= $term->name ?></a>
            </li>
          <?php endforeach; ?>

        </ul>
      </main>
    </aside>
  </div>
</main>