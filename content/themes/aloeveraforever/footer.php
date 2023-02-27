<footer class="footer">
  <header class="footer__header">
    <h2 class="footer__header__title">
      Aloe Vera Forever
    </h2>
    <ul class="footer__header__social">
      <li class="footer__header__social__item"><a class="footer__header__social__item__link" href="<?= get_field('option_page_facebookURL_field', 'option'); ?> " title="Page Facebook" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      </li>
      <li class="footer__header__social__item"><a class="footer__header__social__item__link" href="<?= get_field('option_page_instagramURL_field', 'option'); ?>" title="Compte Instagram" rel="nofollow" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      </li>
      <li class="footer__header__social__item"><a class="footer__header__social__item__link" href="<?= get_field('option_page_youtubeURL_field', 'option'); ?>" title="Chaine Youtube" rel="nofollow" target="_blank"> <i class="fa fa-youtube-square" aria-hidden="true"></i></a>
      </li>
    </ul>
  </header>
  <div class="garanty">
    <div class="garanty__row">
      <div class="garanty__row__feature">
        <?php get_template_part('template-parts/svg/sav.svg'); ?>
      </div>
      <div class="garanty__row__feature">
        <?php get_template_part('template-parts/svg/satisfaction.svg'); ?>
      </div>
    </div>

    <div class="garanty__row">
      <div class="garanty__row__feature">
        <?php get_template_part('template-parts/svg/conseille.svg'); ?>
      </div>
      <div class="garanty__row__feature">
        <?php get_template_part('template-parts/svg/fidelite.svg'); ?>
      </div>
    </div>
  </div>







  <main class="footer__main">
    <div class="footer__main__widget">
      <nav class="footer__main__menu ">
        <p class="footer__main__menu__title  footer__main__widget__title">
          Service Client
        </p>
        <?php wp_nav_menu([
          'theme_location' => 'footer-menu',
          'container' => 'ul',

          'menu_class' => 'footer__main__menu__list footer__main__widget__text',


        ]); ?>
      </nav>

    </div>


    <div class="footer__main__info footer__main__widget">
      <p class="footer__main__info__title  footer__main__widget__title ">
        <?= bloginfo('name'); ?>
      </p>
      <div class="footer__main__info__text footer__main__widget__text">
        <p class="footer__main__info__text__phone"> <a href="tel:+33<?= substr(str_replace(' ', '', get_field('telNum_field', 'option')), 1); ?>" rel="nofollow" target="_blank"><?php the_field('telNum_field', 'option'); ?></a> </p>
        <p class="footer__main__info__text__mail"><a href="mailto:<?= get_field('option_page_Mail_field', 'option'); ?>" rel="nofollow" target="_blank"><?= str_replace('@', '{@}', get_field('option_page_Mail_field', 'option')); ?></a></p>

        <p class="footer__main__info__text__title">Entrepreneur indépendant <br /> Partenaire de la société <br />
          Forever Living Products</p>


        <p class="footer__main__info__text__nFBO">N°FBO : <?php the_field('FBONum_field', 'option'); ?></p>
      </div>
    </div>


    <!--<div class="footer__main__newsletter footer__main__widget">
          <p class="footer__main__newsletter__title  footer__main__widget__title">
            Newsletter
          </p>
          <form action="#" method="post" class="footer__main__widget__text">
            <p>Abonnez-vous à notre lettre d'information et recevez nos offres spéciale. (vous pourrez vous désincrire à tout moment)</p>
             ajout de ma nouvelle widget area -->

    <div class="footer__main__widget">
      <?php dynamic_sidebar('footer-2'); ?>
    </div>

    <!-- fin nouvelle widget area 
            <input class="footer__main__widget__text__input" type="text" name="email" id="email"
              placeholder="Adress e-mail" autocomplete="off">
            <button class="footer__main__widget__text__button" type="submit">S'abonner</button>
          </form>
        </div>-->
    <div class="footer__main__eatmove footer__main__widget">
      <p class="footer__main__eatmove__title  footer__main__widget__title">Notice</p>
      <div class="footer__main__eatmove__text footer__main__widget__text">
        <p>Pour votre santé, pratiquez une activité physique régulière.</p>
        <p>Les compléments alimentaires doivent être utilisé dans le cadre d'un mode de vie sain et ne pas se
          substituer à une alimentation variée et équilibrée.</p>
        <p>Plus d'info sur <a href="https://mangerbouger.fr" rel="nofollow" title="manger bouger site web" target="_blank">mangerbouger.fr</a> </p>
      </div>
    </div>
  </main>
  <footer class="footer__footer">

    <?php wp_nav_menu([
      'theme_location' => 'footer-line-menu',
      'container' => 'nav',
      'container_class' => 'footer__footer__menu',
      'menu_class' => 'footer__footer__menu',


    ]); ?>
  </footer>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>