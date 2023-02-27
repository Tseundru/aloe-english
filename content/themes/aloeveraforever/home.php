<?php get_header();
$taxonomy =  Post_Type_Product::TAXONOMY_NAME_CATEGORY;
$tax_terms = get_terms($taxonomy, [
  'hide_empty' => false,
  'include' => [],
]);
$terms_sort_by_order = [];
$x = 0;
foreach ($tax_terms as $tax_term) {
  $order = get_field('category_order_field', $tax_term);
  $subtitle = get_field('category_subtitle_field', $tax_term);
  $term_link = get_term_link($tax_term);
  $terms_sort_by_order[$order] = (object) array(
    'order' => $order,
    'name' => $tax_term->name,
    'slug' => $tax_term->slug,
    'term_id' => $tax_term->term_id,
    'subtitle' => $subtitle,
    'link' => $term_link,
    'x' => $x,
  );
  $x++;
}

sort($terms_sort_by_order);
$five_first_terms = array_slice($terms_sort_by_order, 0, 5, true);
$six_and_seven_terms = array_slice($terms_sort_by_order, 5, 2, true);
$eight_and_nine_terms = array_slice($terms_sort_by_order, 7, 1, true);
$ten_and_eleven = array_slice($terms_sort_by_order, 9, 2, true);

?>
<!-- banner gallery -->
<div class="bannerGallery">
  <?php
  foreach ($five_first_terms as $tax_term) :
    get_template_part('template-parts/banner-gallery/picture-card', null, $tax_term);
  endforeach;
  ?>
</div>



<!-- Aloe Max -->
<section class="products aloeMax">
  <header class="products__header">
    <h2 class="products__header__title title title--2">Riche en gel d'aloe vera</h2>
    <p class="products__header__subtitle">
      Les articles avec une forte teneur en
      <a href=<?= get_term_link('gel-aloe-vera', 'product_badge'); ?> class="products__header__subtitle__link" title="Gel d'aloe vera - Tous les produits">gel d'aloe vera
      </a>
    </p>
  </header>
  <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'gel-aloe-vera', 'methode' => 'filter']); ?>
</section>



<!-- banner gallery -->
<div class="gallery gallery--2pics gallery2">
  <?php
  foreach ($six_and_seven_terms as $tax_term) :
    get_template_part('template-parts/banner-gallery/picture-card', null, $tax_term);
  ?>
  <?php endforeach; ?>
</div>

<!-- Top Seller -->
<section class="products topSeller">
  <header class="products__header">
    <h2 class="products__header__title title title--2">Les plus vendus</h2>

    <p class="products__header__subtitle">Vos articles préférés 
      <a href=<?= get_term_link('top-vente', 'product_badge'); ?> class="products__header__subtitle__link" title="Meilleures ventes des produits Forever">Voir Tous</a>
    </p>
  </header>
  <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'favorite', 'methode' => 'filter']); ?>
</section>



<!-- banner gallery -->
<div class="gallery gallery--2pics gallery2">
  <?php
  foreach ($eight_and_nine_terms as $tax_term) :
    get_template_part('template-parts/banner-gallery/picture-card', null, $tax_term);
  ?>
  <?php endforeach; ?>
</div>

<!-- New products -->
<section class="products newProducts">
  <header class="products__header">
    <h2 class="products__header__title title title--2">Nouveautés</h2>
    <p class="products__header__subtitle">
      Vos nouveaux articles préférés 
      <a href=<?= get_term_link('nouveaute', 'product_badge'); ?> class="products__header__subtitle__link" title="Nouveaux produits Forever">Voir Tous
      </a>
    </p>
  </header>
  <?php get_template_part('template-parts/product/products-carousel', null, ['filter' => 'nouveaute', 'methode' => 'filter']); ?>
</section>

<!-- banner gallery -->
<div class="gallery gallery--2pics gallery2">
  <?php
  foreach ($ten_and_eleven as $tax_term) :
    get_template_part('template-parts/banner-gallery/picture-card', null, $tax_term);
  ?>
  <?php endforeach; ?>
 
</div>

<section class="products">
  <article class="accordion">
    <header class="accordion__header js-accordion">
      <h2 class="accordion__header__title title title--2">
        Distributeur Forever Living Products France
      </h2>
      <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
    </header>
    <main class="accordion__main main">
      <p> Bienvenue sur notre boutique en ligne : aloeveraforever.fr, le site de Benjamin et Audrey Sergeant distributeurs Aloe Vera Forever Living Products en France et dans le monde.
      </p>
      <p>La marque est spécialisée dans les produits à base d'aloe vera. En effet elle s'est fait connaitre grâce à son Gel d'aloe vera. Cet aliment naturel concentre énormément de vitamines et de nutriments. Il apporte de l'énergie à vos cellules, renforce votre immunité, contribue à la perte de poids et à la beauté en général.</p>
      <p>Mais les produits à l'aloe vera ne se limitent pas aux diverses boissons comme Berry Nectar, Aloe Pêche ou Freedom à l'orange. En effet la plante est utilisée dans la fabrication d'articles d'hygiène pour le corps et les cheveux mais aussi des cosmétiques.</p>
      <p>La marque commercialise également des compléments alimentaires qui vous apporteront eux aussi leur lot de nutriments contribuant ainsi à améliorer votre alimentation. Le pack C9 qui vous aide à perdre du poids grâce à au bienfaits de l'aloe vera brille également par son efficacité à travers le monde.</p>
      <p>En effet, les avis clients en France et à l'international mettent toujours en avant la qualité avec des notes qui avoisinent toujours les 5/5</p>
    </main>
  </article>
  <article class="accordion">
    <header class="accordion__header js-accordion">
      <h2 class="accordion__header__title title title--2">
        L'excellence avant tout !
      </h2>
      <i class="fa fa-plus accordion__header__icon" aria-hidden="true"></i>
    </header>
    <main class="accordion__main main">
    <p>Le gel d’aloe vera que l’on retrouve dans la composition de la plupart des produits est aussi le produit Forever le plus connu et vendu dans le monde.</p>
    <p>Initialement connu sous le nom de «bidon jaune», il doit sa réputation à son procédé de stabilisation unique qui permet de conserver ses multiples vertus sans utiliser de conservateur chimique et nocif pour la santé. En effet la marque utilise simplement la technologie Tetrapak, de la vitamine C et de l’acide citrique pour conserver sa précieuse pulpe et empêcher son oxydation.</p>
    <p>Le contenu de ce fameux «bidon jaune» est issue de la partie gélatineuse interne des feuilles. Ce mucilage qui contient tous les principes actifs bénéfiques est séparée de la sève et de l’écorce qui ne sont pas adaptées à la consommation alimentaire.</p>
    <p>C’est ainsi que l’aloe vera conserve ses nombreuses propriétés pour le bien-être de toute la famille en usage interne et externe. </p>
    <h3>Une large gamme de produits naturels</h3>
    <p>Même si son coeur de métier est l’aloe vera, la marque sait très bien combiner les produits naturels aux dernières innovations technologiques dans les domaines du bien-être, de la perte de poids et des produits cosmétiques.</p>
    <p>Des buvables à l’aloe vera combinés avec des jus de fruits comme la canneberge dans Berry Nectar pour améliorer le confort urinaire, ou avec de la glucosamine et la chondroïtine dans Freedom pour soulager les inconforts articulaires.</p>
    <p>Les produits de la ruche comme la gelée royale, le pollen, la propolis et le miel d’abeille. Mais aussi des compléments alimentaires comme la Maca, le calcium, les probiotiques, le ginkgo biloba et encore l’ail, le thym ou la vitamine C.</p>
    <p>L’aloe vera est également un ingrédient de choix pour les soins du visage du corps et des cheveux. Avec ses propriétés hydratantes qui pénètrent efficacement l’épiderme, il est souvent ajouté dans des soins du visage pour lutter contre le vieillissement en le combinant avec de la vitamine E. Shampoing, après-shampoing, crème visage, soins anti-âge, masque, savon, crème lavante, crème contours des yeux, sérum, démaquillant, lotion après rasage, baume à lèvre, huiles essentielles.</p>
    <h3>Éthique, agriculture responsable et commerce équitable</h3>
    <p>Les produits ne sont pas testé sur les animaux, en effets la marque dispose du label Leasing Bunny pour sont engagement dans la lutte contre la cruauté envers les animaux.</p>
    <p>Les employés de la marque bénéficient toujours des meilleures conditions de travail possibles quelque soit le pays dans lequel ils oeuvrent.</p>
    <p>Une agriculture responsable et un commerce équitable d’un bout à l’autre de la chaine, de la production à la commercialisation par les distributeurs, l’humain est toujours au centre des préoccupations de l’entreprise.</p>
    </main>
  </article>
</section>


<!-- Last Posts -->
<section class="lastPosts">
  <header class="lastPosts__header">
    <p class="lastPosts__header__title title title--2">
      Derniers articles du blog
    </p>
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

<main class="ourAloe">
  <div class="sectionBlock">
   <h2 id="aloe-vera"><a href="https://www.aloeveraforever.fr/aloe-vera-plante-aux-milles-vertus/" title="Aloe vera plante aux milles vertus"> L'aloe vera, la plante aux milles vertus</a></h2>
    <p>Cette plante mythique qu’est l’Aloe Vera est reconnu depuis plusieurs milliers d’années pour ses nombreux bienfaits. L’Aloe Vera est composée de plus de 250 principes actifs, y compris les Vitamines A, B, C et E, de nombreux minéraux comme le cuivre, le fer, le magnésium, la manganèse ou le zinc, on y trouve du glucose, du mannose et de la cellulose.</p>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(182, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Magique pour l'hydratation</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(188, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Bénéfique pour la digestion</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(294, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Régule le système immunitaire</p>
    </div>
  </div>
  <div class="sectionBlock">
    <?php write_responsive_image(298, 'full', null, 0, '') ?>
    <h2>Les avantages de l'aloe vera cette plante merveilleuse</h2>
  </div>
  <div class="dubbleSection">
    <div class="dubbleSection__block dubbleSection__block--primary">
      <h3>
        Pour votre Peau
      </h3>
      <?php write_responsive_image(309, 'full', 'dubbleSection__block__image', 0, '') ?>
      <ul>
        <li>L'aloe vera est très hydratant</li>
        <li>Il aide à la reconstruction de la peau</li>
        <li>Aide à la cicatrisation</li>
        <li>Et à un effet analgésique</li>
      </ul>
      
        <p>Ses effets bénéfiques pour l’hydratation de la peau et son fort taux de pénétration dans l’épiderme lui son conféré par sa forte teneur en polysaccharides.
          Il à la régénération des cellules par prolifération des kératinocytes (principale composant de l’épiderme) et la synthèse du collagène de type I.</p>
        <p> Il aide aussi pour la cicatrisation.</p>
        <p> Grâce à ses effets analgésique et anti-inflammatoire, il est très efficace pour les piqûres et les brûlures.</p>
     
    </div>

    <div class="dubbleSection__block dubbleSection__block--secondary">
      <h3>
        Pour votre organisme
      </h3>
      <?php write_responsive_image(309, 'full', 'dubbleSection__block__image', 0, '') ?>
      <ul>
        <li>Booste le métabolisme</li>
        <li>Renforce l'immunité'</li>
        <li>Accroît la résistance à la charge physique</li>
        <li>À un effet anti-inflammatoire</li>
      </ul>
      
        <p>
          C'est est un véritable booster pour le système immunitaire, il aide à lutter efficacement contre les virus et les bactéries, et à une action de régulation de l'immunité.
        </p>
        <p>
          Il augmente le métabolisme, accroît la résistance à la charge physique et a un effet bénéfique en cas de fatigue.
        </p>
        <p>
          C'est un légume de la famille des liliacée donc on peut utiliser tous les jours pour entretenir un bon équilibre alimentaire.
        </p>
        <p>
          Il est anti-inflammatoire, peut avoir un effets positifs sur certaine douleurs et joue un rôle dans le maintien d’un bonne équilibre acido-basique.
        </p>
      
    </div>
  </div>
  <div class="sectionBlock">
    <h2 id="integration">Du champs jusqu'au consommateur Forever fonctionne en intégration verticale</h2>
    <p>
      De la Culture à la récolte et l'extraction du micillage, sa stabilisation, la fabrication et le conditionnement des produits, Forever maitrise chaque étape de production. Ce processus intégrée fait de Forever le premier producteur Mondial de gel d’Aloe Vera.
    </p>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(337, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Culture</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(360, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Récolte</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(182, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Extraction</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(364, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Stabilisation</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(364, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Production</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(365, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Conditionnement</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(366, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Acheminement</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(367, 'full', 'featureItem__icon', 0, '') ?>
      <p class="featureItem__title">Distribution</p>
    </div>
  </div>
  <div class="videoBlock">
    <h2 class="videoBlock__title title title--2">
      Qu'est-ce qui fait de Forever Living Le leader mondial de l'aloe vera ?
    </h2>
    <div class="videoBlock__video">
      <iframe class="video video--full" src="https://www.youtube.com/embed/FAG7cJD3xOI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
  <?php write_responsive_image(378, 'full') ?>
  <div class="dubbleSection">
    <div class="dubbleSection__block dubbleSection__block--secondary">
      <h3>
        Ses Plantations
      </h3>
        <p>
          Les plantations de Forever se trouvent à 3 endroits; aux états Unis près de Phoenix dans le Texas, au Méxique et en république dominicaine. Tous les trois ont un climat très favorable à la culture de l’aloe vera.
        </p>
        <?php write_responsive_image(382, 'full', 'dubbleSection__block__image', 1, '') ?>
    </div>

    <div class="dubbleSection__block dubbleSection__block--primary">
      <h3>
        Ses exigences
      </h3>
        <p>
          Forever Living s’assurent que ses plants poussent dans les meilleurs conditions climatiques.
        </p>
        <p>
          La récolte est intégralement réalisée à la main pour s’assurer que l’aloe vera ne subit pas de dégradation et que les plants soient bien à maturité. Ensuite les feuilles sont directement acheminées dans les usines à proximité des champs. La proximité des usines est très importante pour qu'elles n’aient pas le temps de s’oxyder avant la stabilisation.
        </p>
        <p>
          Ensuite les feuilles sont soigneusement lavées et rincées afin de les préparer au mieux pour en extraire la précieuse substance qui est la base de tous les produits.
        </p>
        <p>
          Ensuite le mucillage est séparé de l’écorce et de nouveau rincé pour bien enlever la sève qui n’est pas comestible.
        </p>
        <p>
          La pulpe est ensuite prète pour être stabilisée par un processus breveté unique.
        </p>
        <p>
          De nombreux tests de laboratoire en garantissent la qualité exeptionnelle permettant à la marque d’être labelisée par le IASC.
        </p>
    </div>
  </div>

  <?php write_responsive_image(389, 'full') ?>
  <div class="sectionBlock">
    <h2 id="excellence">Pour son Aloe Vera Forever Forever exige l'excellence</h2>
    <p>
      L’aloe vera est un des plus beaux cadeaux que nous fait la nature, il est normal que Forever mette tout en oeuvre pour en dévoiler son potientiel. C’est pour cette raison que la société à décidé de maitriser toutes les étapes de la production, afin de garantir la meilleure qualité qui soit. Ce n’est pas pour rien que tous les produits Forever à Base d’aloe vera sont certifiés par le prestigieux label IASC.
    </p>
    <?php write_responsive_image(391, 'full', null, 0) ?>

    <h2>Des critères de qualité spécifique à l'aloe vera Forever et reconnues internationalement</h2>
    <p>
      L'entreprise est très engagée écologiquement et socialement. Une ethique et une exigence sur la qualité des produits qui n’est plus à prouver. </p>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(399, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Cetifié ISO 14001</p>
      <p class="featureItem__text">Pour le respect de l’environnement dans les processus de productions.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(400, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Certifié ISO 9001</p>
      <p class="featureItem__text">Pour la qualité constante garantie.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(401, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Certifié OHSAS 18001</p>
      <p class="featureItem__text">Pour l’attention porté à la santé, la sécurité et le bien-être de ses employés.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(402, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Label qualité IASC</p>
      <p class="featureItem__text">Les produits Forever sont les 1er au monde à avoir obtenu le la label du Conseil scientifique international de l’aloe vera pour leur pureté.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(403, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Des produits certifiés</p>
      <p class="featureItem__text">
        Un grand nombre sont labellisés et garantis Kasher et Halal.
      </p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(367, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Un modèle qualitatif</p>
      <p class="featureItem__text">
        La qualité de notre système de vente est validée par notre adhésion à la Fédération de la Vente Directe et le respect de son Code Ethique. </p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(405, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Scientifiquement prouvé</p>
      <p class="featureItem__text">
        Les tests scientifiques ont confirmé l’excellence de nos cosmétiques et compléments.
      </p>
    </div>
    <div class="featureItem featureItem--4">
      <img src="./images/notre-aloe/bunny-120.png" alt="" class="featureItem__icon">
      <?php write_responsive_image(534, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Programme Leaping Bunny</p>
      <p class="featureItem__text">
        Forever s’engage au coté de la PETA pour le bien-être des animaux et ne teste pas sur eux ses produits. Partenaire Cruelty Free International.
      </p>
    </div>
  </div>
  <?php write_src_set_image('406', '.imageTitle'); ?>
  <div class="imageTitle">
    <h2 class="imageTitle__title">
      Faites le choix de Forever Living Products pour votre aloe vera
    </h2>
  </div>
  <div class="sectionBlock">
    <h2>En faisant confiance à Forever vous choisissez :</h2>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(365, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Des produits ethiques et responsables</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(402, 'thumbnail', 'featureItem__icon', 0) ?>

      <p class="featureItem__title">Des produits d'excellence'</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(337, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Le meilleur des aloe vera du monde</p>
    </div>
  </div>
  <div class="sectionBlock">
    <h2>Lorsque vous décidez d'acheter de l'aloe vera il est important de bien veillez aux points suivants :</h2>
    <ol>
      <li>
        La provenance, il doit pousser dans un environnement adapté, à l’air libre dans un lieu non pollué, elle a besoin de lumière et de chaleur.
      </li>
      <li>
        Le conditionnement doit impérativement être opaque, en effet la lumière dégrade les qualités de l’aloès très rapidement.
      </li>
      <li>
        La certification : vérifiez bien qu'il est certifié par le IASC.
      </li>
    </ol>



  </div>
  <a href="<?= ALL_PRODUCTS_URL; ?>" class="button button--center" title="Produits Forever Living"> Découvrez la gamme</a>
</main>

<?php get_footer(); ?>