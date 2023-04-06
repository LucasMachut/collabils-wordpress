<?php
get_header();
// Création d'une custom query pour recuperer les trois derniers posts
// publiés
?>

<body>
<?php if ( is_user_logged_in()) : ?>

  <div class="nav-container">
  <div class="nav-toggle">
    <span>&#9776;</span>
  </div>
  <?php 
    wp_nav_menu([
        'theme_location' => "menu_light",
        'container' => 'nav',
        'menu_class' => 'menu__list',
        'menu_id' => 'menuList',
    ]);
  ?>
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

    <script>
    document.querySelector('.nav-toggle').addEventListener('click', function () {
  const navContainer = document.querySelector('.nav-container');
  navContainer.classList.toggle('responsive');
});


</script>

<?php
get_footer();
?>