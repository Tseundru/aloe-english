<?php get_header();

//dump(get_queried_object());
$imageID = get_post_thumbnail_id();
?>

<div class="headerPicture">
  <?php write_src_set_image($imageID, ' .headerPicture__image'); ?>
  <div class="headerPicture__imageBlur"></div>
  <div class="headerPicture__image headerPicture__image--full">
    <div class="headerPicture__image__text">
      <h1 class="headerPicture__image__text__title"><?php the_title(); ?></h1>
      <h2 class="headerPicture__image__text__subtitle">La qualité Forever Living</h2>
    </div>
  </div>
</div>
<main class="ourAloe">
  <div class="sectionBlock">
    <h2 id="aloe-vera">L'aloe vera, la plante aux milles vertus</h2>
    <p>Cette plante mythique qu’est l’Aloe Vera est reconnu depuis plusieurs milliers d’années pour ses nombreux bienfaits. L’Aloe Vera est composée de plus de 250 principes actifs, y compris les Vitamines A, B, C et E, de nombreux minéraux comme le cuivre, le fer, le magnésium, la manganèse ou le zinc, on y trouve du glucose, du mannose et de la cellulose.</p>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(182, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Magique pour l'hydratation du corps</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(188, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Bénéfique pour le système digestif</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(294, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Régule le système immunitaire</p>
    </div>
  </div>
  <div class="sectionBlock">
    <?php write_responsive_image(298, 'full', null, 0, '') ?>
    <h2>Les bienfaits de l'aloe vera cette plante merveilleuse</h2>
  </div>
  <div class="dubbleSection">
    <div class="dubbleSection__block dubbleSection__block--primary">
      <h3>
        Pour votre Peau
      </h3>
      <?php write_responsive_image(309, 'full', 'dubbleSection__block__image', 0, '') ?>
      <ul>
        <li>L'aloe vera est très hydratante</li>
        <li>Elle aide à la reconstruction de la peau</li>
        <li>Aide à la cicatrisation</li>
        <li>Et à un effet analgésique</li>
      </ul>
      
        <p>Ses effets bénéfiques pour l’hydratation de la peau et son fort taux de pénétration dans l’épiderme lui son conféré par sa forte teneur en polysaccharides.
          L’aloe vera aide à la régénération de la peau par prolifération des kératinocytes (principale composant de l’épiderme) et la synthèse du collagène de type I.</p>
        <p> L’aloe vera aide aussi pour la cicatrisation de la peau.</p>
        <p> Grâce à ses effets analgésique et anti-inflammatoire, l’aloe vera est très efficace pour les piqûres et les brûlures.</p>
     
    </div>

    <div class="dubbleSection__block dubbleSection__block--secondary">
      <h3>
        Pour votre organisme
      </h3>
      <?php write_responsive_image(309, 'full', 'dubbleSection__block__image', 0, '') ?>
      <ul>
        <li>L'aloe vera booste le métabolisme</li>
        <li>Renfaorce le système immunitaire</li>
        <li>Accroît la résistance à la charge physique</li>
        <li>à un effet anti-inflammatoire</li>
      </ul>
      
        <p>
          L’aloe est un véritable booster pour le système immunitaire, elle aide à lutter efficacement contre les virus et les bactéries, et à une action de régulation du système immunitaire.
        </p>
        <p>
          Elle augmente le métabolisme, accroît la résistance à la charge physique et a un effet bénéfique en cas de fatigue.
        </p>
        <p>
          L’aloe vera est un légume de la famille des liliacée ce qui en fait une plante que l’on peut utiliser tous les jours pour entretenir un bon équilibre alimentaire.
        </p>
        <p>
          Elle à un effets anti-inflammatoire et peut avoir un effets positifs sur certaine douleurs et joue un rôle dans le maintien d’un bonne équilibre acido-basique.
        </p>
      
    </div>
  </div>
  <div class="sectionBlock">
    <h2>De la plante jusqu'au consommateur Forever fonctionne en intégration verticale</h2>
    <p>
      De la Culture à la récolte et extraction de la pulpe, sa stabilisation, la fabrication et le conditionnement des produits Forever maitrise chaque étape de production. Ce système de production intégrée fait de Forever Living Products le premier producteur Mondial de gel d’Aloe Vera.
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
      <iframe class="video video--full" src="https://www.youtube.com/embed/-_gA2aVl0tI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
  <?php write_responsive_image(378, 'full') ?>
  <div class="dubbleSection">
    <div class="dubbleSection__block dubbleSection__block--secondary">
      <h3>
        Ses Plantations
      </h3>
        <p>
          Les plantations d’aloe vera de Forever Living Products se trouvent à 3 endroits; aux états Unis près de Phoenix dans le Texas, au Méxique et en république dominicaine. Tous les trois ont un climat très favorable à la culture de l’aloe vera.
        </p>
        <?php write_responsive_image(382, 'full', 'dubbleSection__block__image', 1, '') ?>
    </div>

    <div class="dubbleSection__block dubbleSection__block--primary">
      <h3>
        Ses exigences
      </h3>
        <p>
          Forever Living s’assurent que ses plants d’aloe vera poussent dans les meilleurs conditions climatiques.
        </p>
        <p>
          La récolte est intégralement réalisée à la main pour s’assurer que l’aloe vera ne subit pas de dégradation et que les plants soient bien à maturité. Ensuite les feuilles d’aloe vera sont directement acheminées dans les usines à proximité des champs. La proximité des usines est très importante pour que l’aloe vera n’ait pas le temps de s’oxyder avant la stabilisation.
        </p>
        <p>
          Ensuite les feuilles d’aloe vera sont soigneusement lavées et rincées afin de les préparer au mieux pour en extraire la précieuse pulpe qui est la base de tous les produits Forever.
        </p>
        <p>
          Ensuite le gel est séparé de l’écorce et de nouveau rincé pour bien enlever la sève qui n’est pas comestible.
        </p>
        <p>
          La pulpe est ensuite prète pour être stabilisée à froid par un processus breveté unique.
        </p>
        <p>
          De nombreux tests de laboratoire en garantissent la qualité exeptionnelle permettant à la marque d’être labelisée par le IASC.
        </p>
    </div>
  </div>

  <?php write_responsive_image(389, 'full') ?>
  <div class="sectionBlock">
    <h2>Pour son Aloe Vera Forever Forever exige l'excellence</h2>
    <p>
      L’aloe vera est un des plus beaux cadeaux que nous fait la nature, il est normal que Forever Living mette tout en oeuvre pour en dévoiler tout son potientiel. C’est pour cette raison que Forever à décidé de maitriser toutes les étapes de la production, afin de garantir une Pulpe de la meilleure qualité qui soit. Ce n’est pas pour rien que tous les produits Forever à Base d’aloe vera sont certifiés par le prestigieux label IASC.
    </p>
    <?php write_responsive_image(391, 'full', null, 0) ?>

    <h2>Des critères de qualité spécifique à l'aloe vera Forever et reconnues internationalement</h2>
    <p>
      Forever est une société qui est très engagée écologiquement et socialement. Une ethique et une exigence sur la qualité des produits qui n’est plus à prouver. </p>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(399, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Cetifié ISO 14001</p>
      <p class="featureItem__text">Pour le respect de l’environnement dans les processus de productions des produits Forever.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(400, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Certifié ISO 9001</p>
      <p class="featureItem__text">Pour la qualité constante garantie des produits Forever Living Product.</p>
    </div>
    <div class="featureItem featureItem--4">
      <?php write_responsive_image(401, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Certifié OHSAS 18001</p>
      <p class="featureItem__text">Pour l’attention que porte Forever à la santé, la sécurité et le bien-être de ses employés.</p>
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
        Un grand nombre des produits Forever sont labellisés et garantis Kasher et Halal.
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
        Les tests scientifiques ont confirmé l’excellence de nos produits cosmétiques.
      </p>
    </div>
    <div class="featureItem featureItem--4">
      <img src="./images/notre-aloe/bunny-120.png" alt="" class="featureItem__icon">
      <?php write_responsive_image(534, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Programme Leaping Bunny</p>
      <p class="featureItem__text">
        Forever S’engage au coté de la PETA pour le bien-être des animaux et ne teste pas sur eux ses produits. Partenaire Cruelty Free International.
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
    <h2>En faisant confiance à Forever Living products pour votre aloe vous choisissez :</h2>
  </div>
  <div class="featureBlock">
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(365, 'thumbnail', 'featureItem__icon', 0) ?>
      <p class="featureItem__title">Des produits ethiques et responsables</p>
    </div>
    <div class="featureItem featureItem--3">
      <?php write_responsive_image(402, 'thumbnail', 'featureItem__icon', 0) ?>

      <p class="featureItem__title">Des produits de grande qualité</p>
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
        La provenance de la pulpe, elle doit pousser dans un environnement adapté, à l’air libre dans un lieu non pollué, elle a besoin de lumière et de chaleur.
      </li>
      <li>
        Le conditionnement de la pulpe ou du gel d’aloe vera doit impérativement être opaque, en effet la lumière dégrade les qualités de l’aloès très rapidement.
      </li>
      <li>
        La certification de la pulpe : vérifiez bien que le produit est certifié par le IASC.
      </li>
    </ol>



  </div>
  <a href="<?= ALL_PRODUCTS_URL; ?>" class="button button--center" title="Produits Forever Living"> Découvrez les produits Forever</a>
</main>

<?php get_footer(); ?>