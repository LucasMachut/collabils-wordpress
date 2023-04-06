<?php
get_header();
// Création d'une custom query pour recuperer les trois derniers posts
// publiés
?>

<body>
<?php if ( is_user_logged_in()) : ?>

 <div class="nav-container">
  <?php 
    wp_nav_menu([
      'theme_location' => "menu_light",
      'container' => 'nav',
      'container_class' => 'navbar navbar-expand-md navbar-dark fixed-top',
      'menu_class' => 'menu__list',
      'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
      'walker' => new WP_Bootstrap_Navwalker()
    ]);
  ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</div>


<?php endif; ?>
<main>
      <div class="container-fluid">
      <header class="header">
        <div class="presentation-container">
            <h1><?php the_field('accueil-titre-1'); ?></h1>
            <h2><?php the_field('accueil-soustitre-1'); ?></h2>
            <a href="<?php echo home_url('/connexion/'); ?>"><button class="bouton1">Se connecter</button></a>

        </div>
        <div class="image-container">
            <img src="<?php the_field('accueil-image-1'); ?>" alt="people sharing ideas">
        </div>
    </header>
        <h2>Bienvenue!</h2>
        <div class="presentation">
            <div class="presentation-image">
                <img src="<?php the_field('accueil-image-2'); ?>" alt="peaople sharing ideas colorful">
            </div>
            <div class="presentation-text">
                <p><?php the_field('accueil-text-presentation'); ?></p>
                <a href="<?php echo home_url('/connexion/'); ?>"><button class="bouton1">Se connecter</button></a>
            </div>
        </div>
      </div>
    </main>
<?php
get_footer();
?>