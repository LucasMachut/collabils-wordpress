<?php
// Récupérer les informations du formulaire de création de signe
$signe_title = '';
$signe_date = '';
$signe_context = '';
$signe_video = '';
$signe_category = '';
$signe_definition = '';


if (isset($_POST['signe_title']) && isset($_POST['signe_context']) && isset($_POST['signe_video']) && isset($_POST['signe_categorie']) && isset($_POST['signe_definition'])) {
    $signe_title = sanitize_text_field($_POST['signe_title']);
    $signe_context = sanitize_text_field($_POST['signe_context']);
    $signe_video = sanitize_text_field($_POST['signe_video']);
    $signe_category = sanitize_text_field($_POST['signe_categorie']);
    $signe_definition = sanitize_text_field($_POST['signe_definition']);

 
    // Créer un nouvel objet signe
    $signe = array(
        'post_title'    => $signe_title,
        'post_type'     => 'signe',
        'post_status'   => 'publish'
    );
 
    // Insérer le signe dans la base de données
    $signe_id = wp_insert_post($signe);
 
    // Enregistrer les métadonnées du signe
    update_post_meta($signe_id, '_signe_date', date('Y-m-d'));
    update_post_meta($signe_id, '_signe_context', $signe_context);
    update_post_meta($signe_id, '_signe_video', $signe_video);
    update_post_meta($signe_id, '_signe_etat', 'demande');
    wp_set_post_terms($signe_id, $signe_category, 'category');
    update_post_meta($signe_id, '_signe_definition', $signe_definition);

 
    // Rediriger l'utilisateur vers la page du signe créé
    wp_redirect(get_permalink($signe_id));
    exit;
}

// Afficher le formulaire de création de signe
get_header(); ?>
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

<h1>Créer un signe</h1>

<div class="content-area">
  <form id="signe-form" method="post">
    <div class="form-item">
      <label for="signe-title">Titre du signe :</label>
      <input type="text" id="signe-title" name="signe_title" value="<?php echo esc_attr($signe_title); ?>" />
    </div>

    <div class="form-item">
      <label for="signe-categorie">Catégorie du signe :</label>
      <select id="signe-categorie" name="signe_categorie">
        <?php
        // Récupérer toutes les catégories du CPT "signe"
        $categories = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
        ));
            // Afficher chaque catégorie dans une option de select
    foreach ($categories as $category) {
      // Vérifier si la catégorie sélectionnée correspond à la catégorie en cours de traitement
      $selected = '';
      if ($category->term_id == $signe_categorie) {
          $selected = 'selected="selected"';
      }

      // Afficher l'option de la catégorie
      echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
  }
  ?>
</select>
</div>


<div class="form-item">
  <label for="signe-definition">Définition du signe :</label>
  <textarea id="signe-definition" name="signe_definition"><?php echo esc_attr($signe_definition); ?></textarea>
</div>
    <div class="form-item">
      <label for="signe-context">Contexte d'utilisation du signe :</label>
      <textarea id="signe-context" name="signe_context"><?php echo esc_attr($signe_context); ?></textarea>
    </div>

    <div class="form-item">
      <label for="signe-video">Lien de la vidéo :</label>
      <input type="text" id="signe-video" name="signe_video" value="<?php echo esc_attr($signe_video); ?>" />
    </div>

  

<input class="bouton1" type="submit" value="Créer le signe" />
  </form>
</div>
<?php get_footer(); ?>
