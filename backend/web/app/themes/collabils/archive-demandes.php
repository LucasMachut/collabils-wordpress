<?php
/**
 * Template Name: archive_demandes
 * Description: Page pour afficher toutes les demandes
 */

get_header();
?>

<div class="demandes-list">
  <h1>Toutes les demandes</h1>
  <div class="display-demandes-container">
    <?php
    // récupérer tous les CPT demande
    $args = array(
      'post_type' => 'demande',
      'posts_per_page' => -1 // pour afficher toutes les demandes
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
    ?>
        <div class="demande-item">
          <a href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
          </a>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>Aucune demande trouvée.</p>';
    endif;
    ?>
  </div>
</div>

<script src="<?php echo get_template_directory_uri() . '/assets/js/search.js' ?>"></script>

<?php
get_footer();
?>
