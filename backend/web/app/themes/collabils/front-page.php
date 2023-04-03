<?php
get_header();
// Création d'une custom query pour recuperer les trois derniers posts
// publiés
?>

<body>
<?php get_template_part('template_parts/header_menu.php') ?>

<main>
      <div class="container-fluid">
      <header class="header">
        <div class="presentation-container">
            <h1><?php the_field('accueil-titre-1'); ?></h1>
            <h2><?php the_field('accueil-soustitre-1'); ?></h2>
            <a href="page-de-connexion.html"><button class="bouton1">Se connecter</button></a>

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
                <a href="page-de-connexion.html"><button class="bouton1">Se connecter</button></a>
            </div>
        </div>
      </div>
    </main>
<?php
get_footer();
?>