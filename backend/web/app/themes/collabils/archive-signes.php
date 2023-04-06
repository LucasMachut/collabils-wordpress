<?php
/**
 * Template Name: archive_signes
 * Description: Page pour afficher tous les signes
 */

get_header();
?>

<div class="nav-container">
    <?php 
    wp_nav_menu([
        'theme_location' => "menu_light",
        'container' => 'nav',
        'container_class' => 'menu navbar-expand-sm navbar-dark fixed-top',
        'menu_class' => 'menu__list'
    ]);
    ?>
  </div>

  
<div class="signes-list">
  <h1>Tous les Signes</h1>
  <div class="search-container">
    <!-- Ajoutez un formulaire HTML pour la barre de recherche -->
    <form id="search-form">
      <input type="text" id="search-input" placeholder="Rechercher un signe...">
      <button type="submit">Rechercher</button>
    </form>
    <!-- Ajoutez une div pour afficher les résultats de la recherche -->
    <div id="search-results"></div>
  </div>

  <div class="display-signs-container">
    <?php
    // récupérer tous les CPT signe
    $args = array(
      'post_type' => 'signe',
      'posts_per_page' => -1 // pour afficher tous les signes
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
    ?>
        <div class="sign-item">
          <a href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
          </a>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>Aucun signe trouvé.</p>';
    endif;
    ?>
  </div>
</div>

<script src="<?php echo get_template_directory_uri() . '/assets/js/search.js' ?>"></script>

<?php
get_footer();
?>
