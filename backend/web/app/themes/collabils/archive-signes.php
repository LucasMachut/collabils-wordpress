<?php
/**
 * Template Name: archive_signes
 * Description: Page pour afficher tous les signes
 */

get_header();
?>

<div class="signes-list">
  <h1>Tous les Signes</h1>
  <div class="search-container">
    <form role="search" method="get" class="search-form" action="">
      <label>
        <span class="screen-reader-text"><?php echo _x( 'Recherche de :', 'label' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Recherche &hellip;', 'placeholder' ); ?>" value="" name="s" id="search-input" />
      </label>
      <button type="submit" class="search-submit" id="search-button"><?php echo esc_attr_x( 'Recherche', 'submit button' ); ?></button>
    </form>
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
